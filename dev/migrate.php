<?php

// //////////////////// //
// FILL THESE VARIABLES //
// //////////////////// //
$dbms_db   = "";
$dbms_user = "";
$dbms_pass = "";
$dbms_host = "";
// //////////////////// //

set_time_limit("120");
mb_internal_encoding('UTF-8');

require_once "include_functions.php";

if (!($dbms_cnx = @mysql_pconnect($dbms_host, $dbms_user, $dbms_pass))) showerror();
if (!mysql_select_db($dbms_db)) showerror();
if (!mysql_query("SET NAMES 'utf8'")) showerror();

$sql = "ALTER TABLE `ttf_user` ADD `rev_date` INT( 11 ) NULL AFTER `post_date`          ";
if (!$result = mysql_query($sql)) die("serious error. exiting.");

$sql = "ALTER TABLE `ttf_user` CHANGE `time_zone` `time_zone` FLOAT NOT NULL DEFAULT '0'";
if (!$result = mysql_query($sql)) die("serious error. exiting.");

$sql = "UPDATE ttf_user SET rev_date = post_date                                        ";
if (!$result = mysql_query($sql)) die("serious error. exiting.");

$sql = "ALTER TABLE `ttf_post`                                                          ".
       "ADD `rev` SMALLINT( 6 ) NOT NULL DEFAULT '0' AFTER `hide` ,                     ".
       "ADD `archive` INT( 11 ) NULL AFTER `rev`                                        ";
if (!$result = mysql_query($sql)) die("serious error. exiting.");

$sql = "UPDATE ttf_post SET archive = UNIX_TIMESTAMP( ) WHERE hide = 't'                ";
if (!$result = mysql_query($sql)) die("serious error. exiting.");

$sql = "ALTER TABLE `ttf_post` DROP `hide`                                              ";
if (!$result = mysql_query($sql)) die("serious error. exiting.");

$sql = "CREATE TABLE `ttf_recover` (                                                    ".
       "    `recover_id` mediumint(9) NOT NULL auto_increment,                          ".
       "    `date` int(11) NOT NULL,                                                    ".
       "    `ip` varchar(15) collate utf8_unicode_ci NOT NULL,                          ".
       "    `user_id` mediumint(9) NOT NULL,                                            ".
       "    `password` varchar(40) collate utf8_unicode_ci NOT NULL,                    ".
       "    `passkey` varchar(32) collate utf8_unicode_ci NOT NULL,                     ".
       "    PRIMARY KEY  (`recover_id`),                                                ".
       "    UNIQUE KEY `passkey` (`passkey`)                                            ".
       "  ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci                 ";
if (!$result = mysql_query($sql)) die("serious error. exiting.");

$sql = "CREATE TABLE `ttf_revision` (                                                   ".
       "    `rev_id` int(9) NOT NULL auto_increment,                                    ".
       "    `ref_id` mediumint(9) NOT NULL,                                             ".
       "    `type` enum('post','profile','title') collate utf8_unicode_ci NOT NULL,     ".
       "    `author_id` mediumint(9) NOT NULL,                                          ".
       "    `date` int(11) NOT NULL,                                                    ".
       "    `ip` varchar(15) collate utf8_unicode_ci NOT NULL,                          ".
       "    `body` longtext collate utf8_unicode_ci NOT NULL,                           ".
       "    PRIMARY KEY  (`rev_id`)                                                     ".
       "  ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci                 ";
if (!$result = mysql_query($sql)) die("serious error. exiting.");

$sql = "REPLACE INTO `ttf_config` (`name`, `value`) VALUES                              ".
       "    ('version', 'v1-alpha'),                                                    ".
       "    ('forum_name', 'think tank forums'),                                        ".
       "    ('bot_email', 'violet@thinktankforums.com'),                                ".
       "    ('bot_name', 'violet'),                                                     ".
       "    ('admin_email', 'trashbin@ttfproject.com'),                                 ".
       "    ('admin_name', 'lucas reddinger'),                                          ".
       "    ('address', 'www.thinktankforums.com'),                                     ".
       "    ('cookie_name', 'thinktank'),                                               ".
       "    ('cookie_time', '31556926')                                                 ";
if (!$result = mysql_query($sql)) die("serious error. exiting.");

$sql = "OPTIMIZE TABLE `ttf_banned` , `ttf_config` , `ttf_forum` , `ttf_forum_new` ,    ".
       "`ttf_post` , `ttf_recover` , `ttf_revision` , `ttf_thread` , `ttf_thread_new` , ".
       "`ttf_user` , `ttf_visit`                                                        ";
if (!$result = mysql_query($sql)) die("serious error. exiting.");

$sql = "SELECT * FROM ttf_user ORDER BY user_id ASC";
if (!$result = mysql_query($sql)) die("serious error. exiting.");
while ($user = mysql_fetch_array($result)) {

    $sql = "INSERT INTO ttf_revision                ".
           "SET ref_id='{$user["user_id"]}',        ".
           "    type='title',                       ".
           "    author_id='{$user["user_id"]}',     ".
           "    date=UNIX_TIMESTAMP(),              ".
           "    body='".clean($user["title"])."'    ";
    if (!$result_nested = mysql_query($sql)) {
        die("mysql error ".mysql_errno().": ".mysql_error()." exiting. (FAILED on user={$user["user_id"]} title -> rev)");
    } else {
        echo "SUCCESS user={$user["user_id"]} title -> rev<br />\n";
    };

    $sql = "INSERT INTO ttf_revision                ".
           "SET ref_id='{$user["user_id"]}',        ".
           "    type='profile',                     ".
           "    author_id='{$user["user_id"]}',     ".
           "    date=UNIX_TIMESTAMP(),              ".
           "    body='".clean($user["profile"])."'  ";
    if (!$result_nested = mysql_query($sql)) {
        die("mysql error ".mysql_errno().": ".mysql_error()." exiting. (FAILED on user={$user["user_id"]} profile -> rev)");
    } else {
        echo "SUCCESS user={$user["user_id"]} profile -> rev<br />\n";
    };

};

$sql = "SELECT * FROM ttf_post ORDER BY post_id ASC";
if (!$result = mysql_query($sql)) die("serious error. exiting.");
while ($post = mysql_fetch_array($result)) {

    $sql = "INSERT INTO ttf_revision                ".
           "SET ref_id='{$post["post_id"]}',        ".
           "    type='post',                        ".
           "    author_id='{$post["author_id"]}',   ".
           "    date='{$post["date"]}',             ".
           "    ip='{$post["ip"]}',                 ".
           "    body='".clean($post["body"])."'     ";
    if (!$result_nested = mysql_query($sql)) {
        die("mysql error ".mysql_errno().": ".mysql_error()." exiting. (FAILED on post={$post["post_id"]} post -> rev)");
    } else {
        echo "SUCCESS post={$post["post_id"]} post -> rev<br />\n";
    };

};

reformat_bodies();

?>

