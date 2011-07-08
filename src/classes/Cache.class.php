<?php

/**
 * JsonStore Cache
 *
 */
@define(CACHE_FILE_PATH, "./cache/");
@define(CACHE_FILE_EXT, ".cache");


class Cache {
  private $id;

  /**
  *
  */
  public function Cache($sn_id) {
    $this->id = $sn_id;
  }

   public function getResult() {
    $cacheFile = md5($this->id);
    $filename = CACHE_FILE_PATH.$cacheFile.CACHE_FILE_EXT;
    if (file_exists($filename)) {
      $txt = file_get_contents($filename);
      return $txt;
    } else {
      return null;
    }
  }

  public function setResult($resultString) {
    $cacheFile = md5($this->id);
    $filename = CACHE_FILE_PATH.$cacheFile.CACHE_FILE_EXT;
    $success = file_put_contents($filename, $resultString, LOCK_EX);
    if ($success > 0){ // Number of bytes written
      return $success;
    } else {
      return -1;
    }
  }


  public function clearCache() {
    $cacheFile = md5($this->id);
    $filename = CACHE_FILE_PATH.$cacheFile.CACHE_FILE_EXT;
    $success = unlink($filename);
    return $success;
  }


  public function clearCacheIfOlderThan($minutes) {
    $cacheFile = md5($this->id);
    $filename = CACHE_FILE_PATH.$cacheFile.CACHE_FILE_EXT;
    if (file_exists($filename)) {
      $age = (time() - filectime($filename))/60;
      if ($age > $minutes || $minutes <=0) {
        $success = unlink($filename);
        return $success;
      } else {
        return false;
      }
    } else {
      return false;
    }
  }

}
?>