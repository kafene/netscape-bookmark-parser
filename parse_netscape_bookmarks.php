<?php

/**
 * Parses a string containing Netscape-formatted bookmarks
 *
 * Output format:
 *
 *     Array
 *     (
 *         [0] => Array
 *             (
 *                 [note]  => Some comments about this link
 *                 [pub]   => 1
 *                 [tags]  => a list of tags
 *                 [time]  => 1459371397
 *                 [title] => Some page
 *                 [uri]   => http://domain.tld:5678/some-page.html
 *             )
 *         [1] => Array
 *             (
 *                 ...
 *             )
 *     )
 *
 * @param string $bkmk_str    String containing Netscape bookmarks
 * @param string $default_tag Default link tag
 *
 * @return array An associative array containing parsed links
 */
function parse_netscape_bookmarks($bkmk_str, $default_tag=null) {
    $i = 0;
    $next = false;
    $items = array();

    $current_tag = $default_tag = $default_tag ?: 'imported-'.date("Ymd");

    $lines = explode("\n", sanitize_bookmark_string($bkmk_str));

    foreach ($lines as $line_no => $line) {
        if (preg_match('/^<h\d(.*?)>(.*?)<\/h\d>/i', $line, $m1)) {
            // a tag is matched: set its value as current
            $current_tag = $m1[2];
            continue;

        } elseif (preg_match('/^<\/DL>/i', $line)) {
            // <DL> matched: stop using tag
            $current_tag = $default_tag;
        }

        if (preg_match('/<a/i', $line, $m2)) {
            if ($current_tag) {
                $items[$i]['tags'] = $current_tag;
            }

            if (preg_match('/href="(.*?)"/i', $line, $m3)) {
                $items[$i]['uri'] = $m3[1];
            } else {
                $items[$i]['uri'] = '';
            }

            if (preg_match('/<a(.*?)>(.*?)<\/a>/i', $line, $m4)) {
                $items[$i]['title'] = $m4[2];
            } else {
                $items[$i]['title'] = 'untitled';
            }

            if (preg_match('/note="(.*?)"<\/a>/i', $line, $m5)) {
                 $items[$i]['note'] = $m5[1];
            } elseif (preg_match('/<dd>(.*?)<\//i', $line, $m6)) {
                 $items[$i]['note'] = str_replace('<br>', "\n", $m6[1]);
            } else {
                $items[$i]['note'] = '';
            }

            if (preg_match('/(tags?|labels?|folders?)="(.*?)"/i', $line, $m7)) {
                 $items[$i]['tags'] = strtr($m7[2], ',', ' ');
            } else {
                $items[$i]['tags'] = $current_tag;
            }

            if (preg_match('/add_date="(.*?)"/i', $line, $m8)) {
                $items[$i]['time'] = parse_bookmark_date($m8[1]);
            } else {
                $items[$i]['time'] = time();
            }

            if (preg_match('/(public|published|pub)="(.*?)"/i', $line, $m9)) {
                $items[$i]['pub'] = parse_boolean_attribute($m9[2], false) ? 1 : 0;
            } elseif (preg_match('/(private|shared)="(.*?)"/i', $line, $m10)) {
                $items[$i]['pub'] = parse_boolean_attribute($m10[2], true) ? 0 : 1;
            }

            $i++;
        }
    }
    ksort($items);
    return $items;
}


/**
 * Parses a formatted date
 *
 * @see http://php.net/manual/en/datetime.formats.compound.php
 * @see http://php.net/manual/en/function.strtotime.php
 *
 * @param string $date formatted date
 *
 * @return int Unix timestamp corresponding to a successfully parsed date,
 *             else current date and time
 */
function parse_bookmark_date($date)
{
    if (strtotime('@'.$date)) {
        // Unix timestamp
        return strtotime('@'.$date);
    } else if (strtotime($date)) {
        // attempt to parse a known compound date/time format
        return strtotime($date);
    }
    // current date & time
    return time();
}


/**
 * Parses the value of a supposedly boolean attribute
 *
 * @param string $value   Attribute value to evaluate
 * @param string $default Value to return if the attribute is not a boolean
 *
 * @return bool 'true' when the value is evaluated as true
 *              'false' when the value is evaluated as false
 *              $default if the value is not a boolean
 */
function parse_boolean_attribute($value, $default=false) {
    if (! $value) {
        return false;
    }
    if (! is_string($value)) {
        return true;
    }

    $true  = 'y|yes|on|checked|ok|1|true|array|\+|okay|yes+|t|one';
    $false = 'n|no|off|empty|null|false|0|-|exit|die|neg|f|zero|void';

    if (preg_match("/^($true)$/i", $value)) {
        return true;
    }
    if (preg_match("/^($false)$/i", $value)) {
        return false;
    }
    return $default;
};

/**
 * Sanitizes the content of a string containing Netscape bookmarks
 *
 * This removes extra newlines, trailing spaces and tabs.
 *
 * @param string $str Original bookmark string
 *
 * @return string Sanitized bookmark string
 */
function sanitize_bookmark_string($str)
{
    $sanitized = $str;
    $sanitized = str_replace(array("\r", "\t"), array('',' '), $sanitized);

    $sanitized = preg_replace_callback(
        '@<DD>(.*?)(<A|<\/|<DL|<DT|<P)@mis',
        function($match) {
            return '<DD>'.str_replace("\n", '<br>', trim($match[1])).'</';
        },
        $sanitized
    );

    $sanitized = preg_replace('@>(\s*?)<@mis', ">\n<", $sanitized);
    $sanitized = preg_replace('@<br>\n<br>@mis', "<br><br>", $sanitized);
    $sanitized = preg_replace('@(<!DOCTYPE|<META|<!--|<TITLE|<H1|<P)(.*?)\n@i', '', $sanitized);
    $sanitized = trim($sanitized);
    $sanitized = preg_replace('@\n<dd@i', '<dd', $sanitized);

    return $sanitized;
}
