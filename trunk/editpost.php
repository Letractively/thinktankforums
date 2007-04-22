<?php
/* think tank forums
 *
 * editpost.php
 */

require_once "include_common.php";

// pull through the variables
$post_id = $_REQUEST["post_id"];
$body = $_POST["body"];

// if the agent is not logged in as a valid user
if (!isset($ttf["uid"])) {

    message("edit a post", "fatal error",
            "you must be logged in to edit a post.");
    die();

};

// if a post_id is not specified
if (empty($post_id)) {

    message("edit a post", "fatal error",
            "you must specify a post to edit.");
    die();

};

// let's check some permissions (either admin or author)
if ($ttf["perm"] != "admin") {
    
    $sql = "SELECT author_id FROM ttf_post ".
           "WHERE post_id='".clean($post_id)."'";
    if (!$result = mysql_query($sql)) showerror();
    list($author_id) = mysql_fetch_array($result);
    mysql_free_result($result);

    if ($ttf["uid"] != $author_id) {
       
        message("edit a post", "fatal error",
                "you do not have permission to edit this post.");
        die();

    };

};


if (!empty($body)) {
    
    // let's build our current HEAD revision
    // if this post already has revisions
    list($head, ) = buildHead($post_id, 'post');

    if (empty($head)) {

        message("edit a post", "fatal error",
                "serious error encountered. please contact an admin.");
        die();
    
    };

    if ($body == $head) {

        message("edit a post", "fatal error",
                "you didn't make any changes.");
        die();
    
    };
    
    // so now we have the current HEAD as $head;
    // we need to diff our new $body against $head
    // and insert a new ttf_revision and ttf_post
    $diff = clean(serialize(diff($head, $body)));
    
    $sql = "INSERT INTO ttf_revision SET ".
           "ref_id='".clean($post_id)."', ".
           "type='post', ".
           "author_id='{$ttf["uid"]}', ".
           "date=UNIX_TIMESTAMP(), ".
           "ip='{$_SERVER["REMOTE_ADDR"]}', ".
           "body='$diff'";
    if (!$result = mysql_query($sql)) showerror();

    // update the formatted ttf_post
    $sql = "UPDATE ttf_post SET rev=rev+1, ".
           "body='".clean(outputbody($body))."' WHERE post_id='$post_id'";
            if (!$result = mysql_query($sql)) showerror();
    
    // wow, all of that worked! let's grab the thread_id
    // and redirect the user to their edited post
    $sql = "SELECT thread_id FROM ttf_post ".
           "WHERE post_id='".clean($post_id)."'";
    if (!$result = mysql_query($sql)) showerror();
    list($thread_id) = mysql_fetch_array($result);
    
    header("Location: thread.php?thread_id=".$thread_id."#".$post_id);

} else if (!isset($_POST["body"])) {
    
    $title = "editing post_id $post_id";
    $label = $title;
    require_once "include_header.php";
    
    // they need to see a HEAD rev build from scratch
    // because ttf_post is formatted, so make it
    list($head, $lastrev) = buildHead($post_id, 'post');

    // the following html kinda needs some work,
    // but i'm lazy about that right now.. i just
    // want to get this feature working perfectly! --jlr
?>
            <form action="editpost.php" method="post">
            <div class="contenttitle">you're creating revision <?php echo ($lastrev+1); ?></div>
                <div class="contentbox" style="text-align: center;">
                    <textarea class="profile" cols="70" rows="15" name="body" wrap="virtual"><?php echo output($head); ?></textarea><br />
                </div>
                <div class="contentbox" style="text-align: center;">
                        <input type="submit" value="create revision" />
                </div>
                <input type="hidden" name="post_id" value="<?php echo $post_id; ?>" />
            </form>
<?php

} else {
   
    message("edit a post", "fatal error",
            "you cannot edit a post into inexistence. use the archive feature!");

};

?>
