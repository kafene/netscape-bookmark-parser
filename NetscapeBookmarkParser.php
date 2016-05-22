<?php

/**
 * Generic Netscape bookmark parser
 */
class NetscapeBookmarkParser
{
    protected $defaultTag;
    protected $defaultPub;
    protected $items;

    const TRUE_PATTERN = 'y|yes|on|checked|ok|1|true|array|\+|okay|yes|t|one';
    const FALSE_PATTERN = 'n|no|off|empty|null|false|nil|0|-|exit|die|neg|f|zero|void';

    /**
     * Instantiates a new NetscapeBookmarkParser
     *
     * @param string $defaultTag Link tag if missing
     * @param mixed  $defaultPub Link publication status if missing
     *                           - 'true' => public
     *                           - 'false' => private)
     */
    public function __construct($defaultTag=null, $defaultPub=false)
    {
        if ($defaultTag) {
            $this->defaultTag = $defaultTag;
        } else {
            $this->defaultTag = 'imported-'.date("Ymd");
        }
        if ($defaultPub) {
            $this->defaultPub = $defaultPub;
        }
    }

    /**
     * Parses a Netscape bookmark file
     *
     * @param string $filename Bookmark file to parse
     *
     * @return array An associative array containing parsed links
     */
    public function parseFile($filename)
    {
        return $this->parseString(file_get_contents($filename));
    }

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
     * @param string $bookmarkString String containing Netscape bookmarks
     *
     * @return array An associative array containing parsed links
     */
    public function parseString($bookmarkString) {
        $i = 0;
        $next = false;
        $currentTag = $this->defaultTag;

        $lines = explode("\n", $this->sanitizeString($bookmarkString));

        foreach ($lines as $line_no => $line) {
            if (preg_match('/^<h\d+>(.*?)<\/h\d+>/i', $line, $m1)) {
                // a header is matched:
                // - links may be grouped in a (sub-)folder
                // - set the header's content as the current tag
                //   - child links: use this value if the tag list is empty
                $currentTag = $m1[2];
                continue;

            } elseif (preg_match('/^<\/DL>/i', $line)) {
                // <DL> matched: stop using header value
                $currentTag = $this->defaultTag;
            }

            if (preg_match('/<a/i', $line, $m2)) {
                if ($currentTag) {
                    $this->items[$i]['tags'] = $currentTag;
                }

                if (preg_match('/href="(.*?)"/i', $line, $m3)) {
                    $this->items[$i]['uri'] = $m3[1];
                } else {
                    $this->items[$i]['uri'] = '';
                }

                if (preg_match('/<a.*>(.*?)<\/a>/i', $line, $m4)) {
                    $this->items[$i]['title'] = $m4[1];
                } else {
                    $this->items[$i]['title'] = 'untitled';
                }

                if (preg_match('/note="(.*?)"<\/a>/i', $line, $m5)) {
                    $this->items[$i]['note'] = $m5[1];
                } elseif (preg_match('/<dd>(.*?)<\//i', $line, $m6)) {
                    $this->items[$i]['note'] = str_replace('<br>', "\n", $m6[1]);
                } else {
                    $this->items[$i]['note'] = '';
                }

                if (preg_match('/(tags?|labels?|folders?)="(.*?)"/i', $line, $m7)) {
                    $this->items[$i]['tags'] = strtr($m7[2], ',', ' ');
                } else {
                    $this->items[$i]['tags'] = $currentTag;
                }

                if (preg_match('/add_date="(.*?)"/i', $line, $m8)) {
                    $this->items[$i]['time'] = $this->parseDate($m8[1]);
                } else {
                    $this->items[$i]['time'] = time();
                }

                if (preg_match('/(public|published|pub)="(.*?)"/i', $line, $m9)) {
                    $this->items[$i]['pub'] = $this->parseBoolean($m9[2], false) ? 1 : 0;
                } elseif (preg_match('/(private|shared)="(.*?)"/i', $line, $m10)) {
                    $this->items[$i]['pub'] = $this->parseBoolean($m10[2], true) ? 0 : 1;
                }

                $i++;
            }
        }
        ksort($this->items);
        return $this->items;
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
    public static function parseDate($date)
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
     *
     * @return mixed 'true' when the value is evaluated as true
     *               'false' when the value is evaluated as false
     *               $this->defaultPub if the value is not a boolean
     */
    public function parseBoolean($value) {
        if (! $value) {
            return false;
        }
        if (! is_string($value)) {
            return true;
        }

        if (preg_match("/^(".self::TRUE_PATTERN.")$/i", $value)) {
            return true;
        }
        if (preg_match("/^(".self::FALSE_PATTERN.")$/i", $value)) {
            return false;
        }
        return $this->defaultPub;
    }

    /**
     * Sanitizes the content of a string containing Netscape bookmarks
     *
     * This removes extra newlines, trailing spaces and tabs.
     *
     * @param string $bookmarkString Original bookmark string
     *
     * @return string Sanitized bookmark string
     */
    public static function sanitizeString($bookmarkString)
    {
        $sanitized = $bookmarkString;
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
}
