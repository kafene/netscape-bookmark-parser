<?php

/**
 * Basically netscape bookmark files often come so badly formed, there's
 * no reliable way I could find to parse them with DOM or SimpleXML,
 * even after running HTML Tidy on them. So, this function does a bunch of
 * transformations on the general format of a netscape bookmark file, to get
 * Each bookmark and its description onto one line, and goes through line by
 * line, matching tags and attributes. It's messy, but it works better than
 * anything I could find in hours of googling, and anything that I could
 * write after hours with DOM and SimpleXML. I didn't want to pull in a big
 * DOM parsing library just to do this one thing, so this is it.
 * @todo - running Tidy before doing this might be beneficial.
 *   Something like:
       $bkmk_str = tidy_parse_string($bkmk_str)
       $bkmk_str->cleanRepair();
 */
function parse_netscape_bookmarks($bkmk_str, $default_tag = null) {
  $i = 0;
  $next = false;
  $items = array();
  $current_tag = $default_tag = $default_tag ?: 'imported-'.date("Ymd");
  /* Strip out all new lines and convert tabs to spaces. */
  $bkmk_str = str_replace(array("\r","\n","\t"), array('','',' '), $bkmk_str);
  /* Convert any text between <DD> and a new tag to one line with <BR> tags. */
  $bkmk_str = preg_replace_callback(
    '@<dd>(.*?)(<A|<\/|<DL|<DT|<P)@mis'
  , function($match){
      return '<dd>'.str_replace(
        array("\r", "\n"), array('', '<br>')
      , trim($match[1])).'</';
    }, $bkmk_str
  );
  /* Remove any whitespace between html tags and insert 1 new line. */
  $bkmk_str = preg_replace('/>(\s*?)</mis', ">\n<", $bkmk_str);
  /* Remove unnecessary html tags */
  $bkmk_str = preg_replace(
    '/(<!DOCTYPE|<META|<!--|<TITLE|<H1|<P)(.*?)\n/i', '', $bkmk_str
  );
  /* Remove any surrounding whitespace thats left. */
  $bkmk_str = trim($bkmk_str);
  /* Shift <DD> tags onto the same line as the preceding <A> */
  $bkmk_str = preg_replace('/\n<dd/', '<dd', $bkmk_str);
  // echo '<PRE>';print_r(htmlspecialchars($bkmk_str));die;
  /* split all lines into an array and process each */
  $lines = explode("\n", $bkmk_str);
  foreach($lines as $line_no => $line) {
    /* If we match a tag, set current tag to that, if <DL>, stop tag. */
    if(preg_match('/^<h\d(.*?)>(.*?)<\/h\d>/i', $line, $match)) {
      $current_tag = $match[2];
      continue;
    } elseif(preg_match('/^<\/DL>/i',$line)) {
      $current_tag = $default_tag;
    }
    if(preg_match('/<a/i', $line, $match2)) {
      if($current_tag) $items[$i]['tags'] = $current_tag;
      if(preg_match('/href="(.*?)"/i', $line, $match3)) {
        $items[$i]['uri'] = $match3[1];
        // $items[$i]['meta'] = meta($match3[1]);
      } else {
        $items[$i]['uri'] = '';
        // $items[$i]['meta'] = '';
      }
      if(preg_match('/<a(.*?)>(.*?)<\/a>/i', $line, $match4)) {
        $items[$i]['title'] = $match4[2];
        // $items[$i]['slug'] = slugify($match4[2]);
      } else {
        $items[$i]['title'] = 'untitled';
        // $items[$i]['slug'] = '';
      }
      if(preg_match('/note="(.*?)"<\/a>/i', $line, $match5))
           $items[$i]['note'] = $match5[1];
      elseif(preg_match('/<dd>(.*?)<\//i', $line, $match6))
           $items[$i]['note'] = str_replace('<br>', "\n", $match6[1]);
      else $items[$i]['note'] = '';
      if(preg_match('/(tags?|labels?|folders?)="(.*?)"/i', $line, $match7))
           $items[$i]['tags'] = strtr($match7[2], ',', ' ');
      else $items[$i]['tags'] = $current_tag;
      if(preg_match('/add_date="(.*?)"/i', $line, $match8))
           $items[$i]['time'] = strtotime($match8[0]) ?: time();
      else $items[$i]['time'] = time();
      /* calculate a boolean value of a string based on some "yes"/"no" words */
      $str_bool = function($str, $default = false) {
        if(!$str) return false;
        elseif(!is_string($str) && $str) return true;
        $true  = 'y|yes|on|checked|ok|1|true|array|\+|okay|yes+|t|one';
        $false = 'n|no|off|empty|null|false|0|-|exit|die|neg|f|zero|void';
        if(preg_match('/^('.$true.')$/i', $str)) return true;
        elseif(preg_match('/^('.$false.')$/i', $str)) return false;
        return $default;
      };
      if(preg_match('/(public|published|pub)="(.*?)"/i', $line, $match9))
          $items[$i]['pub'] = $str_bool($match9[2], false) ? 1 : 0;
      elseif(preg_match('/(private|shared)="(.*?)"/i', $line, $match10))
          $items[$i]['pub'] = $str_bool($match9[2], true) ? 0 : 1;
      $i++;
    }
  }
  ksort($items);
  return $items;
}
