<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

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
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code

/**
 * Define by Steve Tran
 * 
 */
# Setting common
define('HOTLINE', '0946.404.282');
define('WORKTIME', '08h00\' - 20h00\'');
define('COMPANY', 'DAILYAZ');
define('Company', 'DailyAz');
define('company', 'dailydz');
define('PREORDERNAME', '#DAZ-');

define('obj_on_page', 20); // panigation
define('email_default', 'vnlivi@gmail.com');
#Email smtp
define('folderWeb', '');

define('GNAME', 'ADMIN DAILYAZ WEB');  // Email use to send SMTP
//define('SMTPHOST', 'smtp.gmail.com');
define('SMTP', 'smtp');
//define('SMTPPORT', 587);
//define('SMTPSERCURITY', 'tls');
//define('RUSER', 'vnlivi@gmail.com');   // Email use to receive reply SMTP
// define('GUSER', 'vnlivi@gmail.com');   // Email use to send SMTP
// define('GPWD', 'toi0yeutoikhongyeu');  // Password access to mail host
//define('GUSER', 'akirahuy90@gmail.com');   // Email use to send SMTP
//define('GPWD', 'dothinhutho');  // Password access to mail host

// define('SMTPHOST', 'mail.azibai.com');
// define('SMTPPORT', 587);
// define('SMTPSERCURITY', '');
// define('GUSER', 'no-reply@azibai.com');  // Email use to send SMTP
// define('GPWD', 'Admin123456!'); 	// Password use to send SMTP
// define('RUSER', 'akirahuy90@gmail.com');

define('SMTPHOST', 'smtp.zoho.com');
define('SMTPPORT', 465);
define('SMTPSERCURITY', 'SSL');
define('GUSER', 'baotran@lkvsolutions.com');  // Email use to send SMTP
define('GPWD', '8ftzM1NVRs3P'); 	// Password use to send SMTP
define('RUSER', 'akirahuy90@gmail.com');

// define('SMTPHOST', 'smtp.gmail.com');
// define('SMTPPORT', 25); // port 25 for web, 158 - tls gmail, 456 ssl
// define('SMTPSERCURITY', '');
// define('GUSER', 'no-reply@azibai.com');  // Email use to send SMTP
// define('GPWD', 'Admin123456!');

define('MAXUPLOADEMAIL', 25600); // 25Mb
define('MAXUPLOAD', 10240); // 10Mb
define('ACCEPTIMG', 'gif|jpg|png|jpeg|tiff|jpe|img|bmp'); // accept stand image
define('ACCEPTVIDEO', 'mp4|avi|flv|webm|mkv|wmv|amv|m4v|3gp|ogg|ogv|mov|yuv|m4p|mpeg|m2v'); // accept stand video
define('ACCEPTAUDIO', 'mp3|wma|au|snd|rmi|mid|aiff|ram|wav'); // accept stand audio
define('ACCEPTDOC', 'doc|docx|xls|xlsx|pdf|rar|zip|gz|sql|txt|html|php|js|java|xml|cshtml|ini|exe|iso|msi'); // accept stand audio

# CART 
define('LIMITADDCART', 20); // Use add cart limit