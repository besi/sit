<?php header("Content-Type: text/html; charset=utf-8"); ?>
<?php
/**
 * Constants
 */

/** Simple Note Base URL */
@define(SIMPLE_NOTE_BASE_URL, "http://simple-note.appspot.com/publish/");

/** URL-Attribute for SimpleNote ID e.g. JrPsqQ */
@define(SIMPLE_NOTE_ID, "id");

/** URL-Attribute for SimpleNote output e.g. jsonp */
@define(SIMPLE_NOTE_OUTPUT, "output");

/** Name of the JSONP callback JS function */
@define(JSONP_CALLBACK, "callback");

/** Time to cache in Minutes*/
@define(CACHE_MINUTES, "cachetime");

/** Cache for 60 Minutes*/
@define(CACHE_MINUTES_DEFAULT, 60);

/** URL-Attribute "debug": Debug-Mode */
@define(CONTROLLER_DEBUG, "debug");

/** Allowed Referrer Hosts, comma separated */
@define(ALLOWED_REFERERS, "unicate.ch,gurgeli.ch,dev.gurgeli.ch");
?>