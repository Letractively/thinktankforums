<?php
/* think tank forums
 *
 * archivepost.php
 */

$ttf_title = $ttf_label = "archive a post";

require_once "include_common.php";

kill_guests();

if (empty($_REQUEST["post_id"])) {

    message($ttf_label, $ttf_msg["fatal_error"], "you must specify a post.");
    die();

};

$post_id = clean($_REQUEST["post_id"]);

if (!empty($_GET["post_id"])) {

    $title = $label = "archiving post $post_id";

    require_once "include_header.php";

?>
            <form action="archivepost.php" method="post">
                <div class="contenttitle">you're archiving post <?php echo $post_id; ?></div>
                <div class="contentbox">are you sure you wish to archive this post?</div>
                <div id="archivepost_button">
                    <input class="archivepost" type="submit" value="yes. archive!" />
                </div>
                <div>
                    <input type="hidden" name="post_id" value="<?php echo $post_id; ?>" />
                </div>
            </form>
<?php

    require_once "include_footer.php";

    die();

};

// archive the post if the user is either an admin or the post's author
$sql = "UPDATE ttf_post                 ".
       "SET archive=UNIX_TIMESTAMP()    ".
       "WHERE post_id='$post_id'        ";
if ($ttf["perm"] != 'admin') $sql .= " AND author_id='{$ttf["uid"]}'";
if (!$result = mysql_query($sql)) showerror();

if (mysql_affected_rows() !== 1) {

    message($ttf_label, $ttf_msg["fatal_error"], "you don't have permission to do this.");
    die();

};

// find out the thread_id for the given post
$sql = "SELECT thread_id        ".
       "FROM ttf_post           ".
       "WHERE post_id='$post_id'";
if (!$result = mysql_query($sql)) showerror();
list($thread_id) = mysql_fetch_array($result);

// find out the forum_id for the given thread
$sql = "SELECT forum_id             ".
       "FROM ttf_thread             ".
       "WHERE thread_id='$thread_id'";
if (!$result = mysql_query($sql)) showerror();
list($forum_id) = mysql_fetch_array($result);
    
// update the thread table, subtracting a post from the count
// and setting the date to the date of the most recent post in the thread
// WORD UP ==> IF THE THREAD HAS NO OTHER POSTS, date->0, listing it last.
$sql = "UPDATE ttf_thread                       ".
       "SET posts=posts-1,                      ".
       "    date=(SELECT date                   ".
       "          FROM ttf_post                 ".
       "          WHERE thread_id='$thread_id'  ".
       "             && archive IS NULL         ".
       "          ORDER BY date DESC LIMIT 1)   ".
       "WHERE thread_id='$thread_id' LIMIT 1    ";
if (!$result = mysql_query($sql)) showerror();

// update the forum table, subtracting a post from the count
// and setting the date to the date of the most recent post in the forum
// WORD UP ==> IF THE FORUM HAS NO OTHER POSTS, date->0, listing it last.
$sql = "UPDATE ttf_forum                                        ".
       "SET posts=posts-1,                                      ".
       "    date=(SELECT ttf_post.date                          ".
       "          FROM ttf_post, ttf_thread                     ".
       "          WHERE ttf_thread.thread_id=ttf_post.thread_id ".
       "             && ttf_thread.forum_id='$forum_id'         ".
       "             && ttf_post.archive IS NULL                ".
       "          ORDER BY ttf_post.date DESC LIMIT 1)          ".
       "WHERE forum_id='$forum_id'                              ";
if (!$result = mysql_query($sql)) showerror();

/* NOTE: this script does not revert back the author's
 * post_date to the most recent non-hidden post date.
 * it retains the post_date regardless of whether the
 * latest post is hidden or not hidden. it may be determined
 * if this is a good or bad policy in the future. at this
 * point in time, ttf_user.post_date is only used by two
 * scripts:
 *   => reply.php           UPDATE
 *   => admin_userinfo.php  SELECT
 *   => profile.php         SELECT
 */
  
header("Location: thread.php?thread_id=$thread_id");

?>