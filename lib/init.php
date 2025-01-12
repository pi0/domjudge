<?php
if ( !defined('LIBDIR') ) die ("LIBDIR not defined.");

if( DEBUG & DEBUG_TIMINGS ) {
	require_once(LIBDIR . '/lib.timer.php');
}

require_once(LIBDIR . '/lib.error.php');
require_once(LIBDIR . '/lib.misc.php');
require_once(LIBDIR . '/lib.dbconfig.php');
require_once(LIBDIR . '/use_db.php');

// Initialize default timezone to system default. PHP generates
// E_NOTICE warning messages otherwise.
@date_default_timezone_set(@date_default_timezone_get());

// Raise floating point print precision (default is 14) to be able to
// use microsecond resolution timestamps. Note that since PHP uses the
// IEEE 754 double precision format, which can only handle about 15-16
// digits, we can't go beyond microseconds without reverting to
// arbitrary precision float formats.
$precision = ini_get('precision');
if ( $precision===FALSE || empty($precision) ) {
	error("Could not read PHP setting 'precision'");
}
if ( $precision<17 ) ini_set('precision', '17');

// Set for using mb_* functions:
mb_internal_encoding(DJ_CHARACTER_SET);
