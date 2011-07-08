<?php header("Content-Type: text/html; charset=utf-8"); ?>
<?php
/**
 * SnRequest
 */

  class SnRequest {
    private $requestParams;

    function SnRequest() {
        if (!empty($_GET)){
        $this->requestParams = $_GET;
      } else {
        $this->requestParams = $_POST;
      }
    }

    function getParameter() {
        if (!empty($this->requestParams)){
        	return $this->requestParams;
        } else {
        	return null;
        }
    }

    function getId() {
      if (!empty($this->requestParams[SIMPLE_NOTE_ID])) {
        return $this->requestParams[SIMPLE_NOTE_ID];
      } else {
        return null;
      }
    }

   function getOutput() {
      if (!empty($this->requestParams[SIMPLE_NOTE_OUTPUT])) {
          return $this->requestParams[SIMPLE_NOTE_OUTPUT];
      } else {
        return null;
      }
    }

    function getCallback() {
      if (!empty($this->requestParams[JSONP_CALLBACK])) {
        return $this->requestParams[JSONP_CALLBACK];
      } else {
        return null;
      }
    }

     function getCacheMinutes() {
      if (!empty($this->requestParams[CACHE_MINUTES])) {
        return $this->requestParams[CACHE_MINUTES];
      } else {
        return null;
      }
    }


    function getReferer() {
    	$referer = $_SERVER["HTTP_REFERER"];
      if (!empty($referer)){
        return $referer;
      } else {
        return null;
      }
    }

    function getRefererHostName() {
    	$referer = $_SERVER["HTTP_REFERER"];
      if (!empty($referer)){
        $host = parse_url($referer, PHP_URL_HOST);
        $hostArray = explode ("." , $host);
        $hostArray = array_reverse($hostArray);
        $hostName = $hostArray[1].".".$hostArray[0];
        return $hostName;
      } else {
        return null;
      }
    }

}


?>