<?php
/**
 * Basic constants/variables required for flyspray operation
 *
 * @notes be a real paranoid here.
 * @version $Id$
 */

define('BASEDIR', dirname(dirname(__FILE__)));

// Change this line if you move flyspray.conf.php elsewhere
$conf = @parse_ini_file(Flyspray::get_config_path(), true);

// $baseurl
// htmlspecialchars because PHP_SELF is user submitted data, and can be used as an XSS vector.
if (isset($conf['general']['force_baseurl']) && $conf['general']['force_baseurl'] != '') {
    $baseurl = $conf['general']['force_baseurl'];
} else {
    if (!isset($webdir)) {
        $webdir = dirname(htmlspecialchars($_SERVER['PHP_SELF'], ENT_QUOTES, 'utf-8'));
        if (!$webdir) {
            $webdir = dirname($_SERVER['SCRIPT_NAME']);
        }
        if (substr($webdir, -9) == 'index.php') {
            $webdir = dirname($webdir);
        }
    }

    $baseurl = rtrim(Flyspray::absoluteURI($webdir),'/\\') . '/' ;
}




define('GET_CONTENTS', true);

// Others
define('MIN_PW_LENGTH', 5);
define('LOGIN_ATTEMPTS', 5);

# 201508: webdot currently used not anymore in flyspray. Graphs can be done in future with svg or canvas elements.
define('FLYSPRAY_WEBDOT', 'http://webdot.flyspray.org/');
define('FS_DOMAIN_HASH', md5($_SERVER['SERVER_NAME'] . BASEDIR));
define('FS_CACHE_DIR', Flyspray::get_tmp_dir() . DIRECTORY_SEPARATOR . FS_DOMAIN_HASH);

is_dir(FS_CACHE_DIR) || @mkdir(FS_CACHE_DIR, 0700);

// developers or advanced users only
//define('DEBUG_SQL',true);

# 201508: Currently without usage! Was once used in file fsjabber.php (not in src anymore), but not within class.jabber2.php. 
//define('JABBER_DEBUG', true);
//define('JABBER_DEBUG_FILE', BASEDIR . '/logs/jabberlog.txt');

//define('FS_MAIL_LOGFILE', BASEDIR . '/logs/maillog.txt');
