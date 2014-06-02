<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');

/* 
|--------------------------------------------------------------------------
| Custom Constant Variables
|--------------------------------------------------------------------------
|
| Create your custom constant variables
| E.g: Social Url - such as facebook etc, contact page emails etc
|
*/
define('LIVE_SERVER', true);
define('fb_url','https://www.facebook.com');
define('twitter_url','https://www.twitter.com');
define('linkedin_url','http://www.linkedin.com');
define('checkout_stage_signin', 1);
define('checkout_stage_review', 2);
define('checkout_stage_payment', 3);
define('checkout_stage_download', 4);
define('GST',0.1);
define('records_per_page',25);




/* End of file constants.php */
/* Location: ./application/config/constants.php */