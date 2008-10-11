<?php
/* think tank forums
 *
 * admin_ban.php
 */

require_once "include_common.php";

kill_nonadmin();

$ttf_label = "Administration &raquo; Ban or Unban a User";
$ttf_title = $ttf_label;



/* ban a user
 * ~~~~~~~~~~
 * this code allows the administration to block access to the forums
 * for a specific user, while also banning the register_ip and all 
 * visit_ip's as well.
 */
function ban_user($user_id) {
    $sql = "SELECT username, perm, register_ip, visit_ip ".
           "FROM ttf_user WHERE user_id='$user_id'";
    if (!$result = mysql_query($sql)) showerror();
    $user = mysql_fetch_array($result);
    if (!empty($user["perm"]) && $user["perm"] != "banned") {
        if (!empty($user["register_ip"])) {
            $sql = "REPLACE INTO ttf_banned ".
                   "SET user_id='$user_id', ip='{$user["register_ip"]}'";
            if (!$result = mysql_query($sql)) {
                showerror();
            } else {
                $messages[] = "The register IP of " .$user["register_ip"]." is banned.";
            };
        } else {
            $messages[] = "<span class=\"error\">There is no register IP for this user.</span>";
        };
        if (!empty($user["visit_ip"])) {
            $sql = "REPLACE INTO ttf_banned ".
                   "SET user_id='$user_id', ip='{$user["visit_ip"]}'";
            if (!$result = mysql_query($sql)) {
                showerror();
            } else {
                $messages[] = "The visit IP of ".$user["visit_ip"]." is banned.";
            };
        } else {
            $messages[] = "<span class=\"error\">There is no visit IP for this user.</span>";
        };
        $sql = "SELECT ip FROM ttf_revision ".
               "WHERE author_id='$user_id'  ".
               "   && ip IS NOT NULL        ".
               "GROUP BY ip                 ";
        if (!$result = mysql_query($sql)) showerror();
        while ($rev = mysql_fetch_array($result)) {
            $sql = "REPLACE INTO ttf_banned SET user_id='$user_id', ip='{$rev["ip"]}'";
            if (!$result_nested = mysql_query($sql)) {
                showerror();
            } else {
                $messages[] = "The revision IP of ".$rev["ip"]." is banned.";
            };
        };
        $sql = "UPDATE ttf_user SET perm='banned' WHERE user_id='$user_id'";
        if (!$result = mysql_query($sql)) {
            showerror();
        } else {
            $messages[] = $user["username"] ." is now banned.";
        };
    } else if ($user["perm"] == 'banned') {
        $messages[] = "<span class=\"error\">This user is already banned.</span>";
    } else {
        $messages[] = "<span class=\"error\">This user is invalid.</span>";
    };
    return $messages;
};



/* unban a user
 * ~~~~~~~~~~~~
 * this code allows the administration to unblock access to the forums
 * for a specific user, while also unbanning the register_ip and all 
 * visit_ip's as well. 
 */
function unban_user($user_id) {
    $sql = "SELECT username, perm, register_ip, visit_ip ".
           "FROM ttf_user WHERE user_id='$user_id'";
    if (!$result = mysql_query($sql)) showerror();
    $user = mysql_fetch_array($result);
    if ($user["perm"] == 'banned') {
        $sql = "DELETE FROM ttf_banned WHERE user_id='$user_id' ";
        if (!$result = mysql_query($sql)) {
            showerror();
        } else {
            $messages[] = "All associated IPs were removed from the banned list.";
        };
        $sql = "UPDATE ttf_user SET perm='user' WHERE user_id='$user_id'";
        if (!$result = mysql_query($sql)) {
            showerror();
        } else {
            $messages[] = $user["username"] ." is now unbanned.";
        };
    } else if ($user["perm"] != 'banned') {
        $messages[] = "<span class=\"error\">This user is not banned.</span>";
    } else {
        $messages[] = "<span class=\"error\">This user is invalid.</span>";
    };
    return $messages;
};



require_once "include_header.php";

$user_id = clean($_GET["user_id"]);

if ($_GET["action"] == "ban") {
    message($ttf_label, $ttf_msg["resultstitl"], ban_user($user_id));
} else if ($_GET["action"] == "unban") {
    message($ttf_label, $ttf_msg["resultstitl"], unban_user($user_id));
} else {
    message($ttf_label, $ttf_msg["fatal_error"], $ttf_msg["noactnspec"]);
};

require_once "include_footer.php";

?>