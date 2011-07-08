<?php
require_once('./classes/Constants.class.php');
require_once('./classes/HtmlGrabber.class.php');
require_once('./classes/SnRequest.class.php');
require_once('./classes/Cache.class.php');


/**
*
* Example usage:
*  www.unicate.ch/sn/?id=JrPsqQ
*  www.unicate.ch/sn/?id=JrPsqQ&output=jsonp&callback=someFunctionName
*  www.unicate.ch/sn/?id=JrPsqQ&output=jsonp&callback=someFunctionName&cachetime=1
*
* Required parameters:
*  @param id The SimpleNote id e.g. JrPsqQ
*
* Optional parameters:
*  @param output [Optional] Output format. Default is html. Other values: jsonp
*  @param callback [Optional] JavaScript callback function. Required if output is jsonp.
*  @param cachetime [Optional] Time in minutes to cache the note. Default is 60 minutes.
*         Values smaller or equal 0 supress caching.
*/

// Get Request Parameters
  $request = new SnRequest();

// Who is calling ? Only whitelisted requests are allowed!
  $referer = $request->getReferer();
  $refererHost = $request->getRefererHostName();
  $allowedHosts = explode(',', ALLOWED_REFERERS);
  if (in_array($refererHost, $allowedHosts) === false and !empty($referer)){
    $msg = $request->getCallback()."({\"result\":\"Only whitelisted domains are allowed! Contact info@unicate.ch to get added. Your hostname:".$refererHost."\"});";
    die($msg);
  }

// Grab HTML from SimpleNote and generate output
  $id = $request->getId();
  $cache = new Cache($id);
  // Clear cache if older than *cachetime"
  $cacheTime = ($request->getCacheMinutes() != null) ? $request->getCacheMinutes() : CACHE_MINUTES_DEFAULT;
  $cache->clearCacheIfOlderThan($cacheTime);
  $result = $cache->getResult();

  if ($id != null) {
    // Check for cached result
    if ($result!=null) {
      $out = $result;
    } else {
      // Get SimpleNote HTML Output
      $html = HtmlGrabber::getHtml(SIMPLE_NOTE_BASE_URL.$id);
      $out = HtmlGrabber::getSimpleNoteContent($html);
      $cache->setResult($out);
    }
    // Jsonp-Wrapper Output
    if ($request->getOutput() == "jsonp" && $request->getCallback() != null){
      //$out = utf8_decode($out);
      // $out = rawurlencode($out);
      $out = json_encode($out);
      $out = "{\"result\":".$out."}";
      $out = $request->getCallback()."($out);";
      header("Content-Type: application/javascript; charset=utf-8");
      echo $out;
    } else {
      // Output as HTML
      header("Content-Type: text/html; charset=utf-8");
      echo $out;
    }
  } else {
    die ("Missing or invalid query parameter! aka Error 500!");
  }


?>