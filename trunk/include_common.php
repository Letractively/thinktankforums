<?php
/* think tank forums
 *
 * include_common.php
 *
 * this script *MUST* be run at the beginning of
 * every request to the ttf installation. ALWAYS!
 */



// start timing the execution
$time_start = microtime(TRUE);



// make php use utf-8
mb_internal_encoding('UTF-8');



/* database variables
 * ~~~~~~~~~~~~~~~~~~
 *
 * let $dbms_host be the hostname
 *     $dbms_user be the username
 *     $dbms_pass be the password
 *     $dbms_db   be the database
 */
require "include_credentials.php";



// include configuration variables
require "include_config.php";



// include widely-used functions
require "include_functions.php";



// remove magic quotes (from php.net docs)
if (get_magic_quotes_gpc()) {
    function stripslashes_deep($value) {
        $value = is_array($value) ?
            array_map('stripslashes_deep', $value) :
            stripslashes($value);
        return $value;
    };
    $_POST = array_map('stripslashes_deep', $_POST);
    $_GET = array_map('stripslashes_deep', $_GET);
    $_COOKIE = array_map('stripslashes_deep', $_COOKIE);
    $_REQUEST = array_map('stripslashes_deep', $_REQUEST);
};



// mysql dbms connection
if (!($dbms_cnx = @mysql_pconnect($dbms_host, $dbms_user, $dbms_pass))) showerror();
if (!mysql_select_db($dbms_db)) showerror();
if (!mysql_query("SET NAMES 'utf8'")) showerror();



// kill agent if banned
$sql = "SELECT * FROM ttf_banned GROUP BY ip";
if (!$result = mysql_query($sql)) showerror();
while ($ban = mysql_fetch_array($result)) {
    if ($ban["ip"] == $_SERVER["REMOTE_ADDR"]) {
        message($ttf_cfg["forum_name"], $ttf_msg["fatal_error"], $ttf_msg["ip_banned"]);
        die();
    };
};



// cookie management
if (isset($_COOKIE["{$ttf_cfg["cookie_name"]}"])) {

    // pull the data out of the cookie
    list($uid, $pwd) = unserialize(stripslashes($_COOKIE["{$ttf_cfg["cookie_name"]}"]));

    // select the data from ttf_user associated with this user
    $sql = "SELECT user_id,                     ".
           "       username,                    ".
           "       perm,                        ".
           "       avatar_type,                 ".
           "       time_zone                    ".
           "FROM ttf_user                       ".
           "WHERE user_id='".clean($uid)."'     ".
           "   && password='".clean($pwd)."'    ";
    if (!$result = mysql_query($sql)) showerror();

    // if we could find a user matching the specified user_id and password...
    if (mysql_num_rows($result) === 1) {

        // put the user data into the $ttf array
        list($ttf["uid"],
             $ttf["username"],
             $ttf["perm"],
             $ttf["avatar_type"],
             $ttf["time_zone"]) = mysql_fetch_array($result);

    } else {

        // or print an error and exit
        message($ttf_cfg["forum_name"], $ttf_msg["fatal_error"], $ttf_msg["cookie_inv"]);
        die();

    };

};



// kill if in maintenance mode and not an admin
if ($ttf_cfg["maintenance"] && $ttf["perm"] != 'admin') {

    message($ttf_msg["fatal_error"], $ttf_msg["maint_title"], $ttf_msg["maint_body"]);
    die();

};



// update the user's visit_date and visit_ip
if (isset($ttf["uid"])) {

    $sql = "UPDATE ttf_user                             ".
           "SET visit_date=UNIX_TIMESTAMP(),            ".
           "    visit_ip='{$_SERVER["REMOTE_ADDR"]}'    ".
           "WHERE user_id='{$ttf["uid"]}'               ";
    if (!$result = mysql_query($sql)) showerror();

};

?>
