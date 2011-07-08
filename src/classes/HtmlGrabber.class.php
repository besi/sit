<?php

/**
 * HtmlGrabber
 *
 */

class HtmlGrabber {

  /**
  * Static method for fetching HTML from URL
  */
   public static function getHtml($fetchUrl) {
    // is cURL installed yet?
    if (!function_exists('curl_init')){
        die('Sorry cURL is not installed!');
    }
    // OK cool - then let's create a new cURL resource handle
    $ch = curl_init();

    // Now set some options (most are optional)
    // Set URL to download
    curl_setopt($ch, CURLOPT_URL, $fetchUrl);
    // Set a referer
    curl_setopt($ch, CURLOPT_REFERER, "http://www.example.org/yay.htm");
    // User agent
    curl_setopt($ch, CURLOPT_USERAGENT, "MozillaXYZ/1.0");
    // Include header in result? (0 = no, 1 = yes)
    curl_setopt($ch, CURLOPT_HEADER, 0);
    // Should cURL return or print out the data? (true = return, false = print)
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // Timeout in seconds
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    // UTF-8
    //curl_setopt($ch, CURLOPT_HTTPHEADER, array ("Content-Type: text/html; charset=utf-8", "Expect: 100-continue"));

    // Download the given URL, and return output
    $output = curl_exec($ch);
    // Close the cURL resource, and free system resources
    curl_close($ch);

    return $output;
  }

  /**
  * Static method to extract SimpleNote content from HTML string
  */
   public static function getSimpleNoteContent($html) {
     $start = strrpos ($html , "<div class=\"note\">");
     $end = strrpos ($html , "<!-- .note -->", $start);
     $html = substr ($html, $start, $end-$start);
     return $html;
   }

  /**
  * Static method to get only Header from URL
  */
   public static function lastChanged($fetchUrl) {
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $fetchUrl);
    curl_setopt($curl, CURLOPT_HEADER, true);
    curl_setopt($curl, CURLOPT_FILETIME, true);
    curl_setopt($curl, CURLOPT_NOBODY, true);
    curl_setopt($curl, CURLOPT_USERAGENT, $useragent);
    curl_exec($curl);
    $last_change = curl_getinfo($curl);
    curl_close($curl);
    return $last_change['datetime'];
   }

}
?>