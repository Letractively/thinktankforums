<?php
/* think tank forums 1.0-beta
 *
 * Copyright (c) 2004, 2005, 2006 Jonathan Lucas Reddinger <lucas@wingedleopard.net>
 *
 * Permission to use, copy, modify, and distribute this software for any
 * purpose with or without fee is hereby granted, provided that the above
 * copyright notice and this permission notice appear in all copies.
 *
 * THE SOFTWARE IS PROVIDED "AS IS" AND THE AUTHOR DISCLAIMS ALL WARRANTIES
 * WITH REGARD TO THIS SOFTWARE INCLUDING ALL IMPLIED WARRANTIES OF
 * MERCHANTABILITY AND FITNESS. IN NO EVENT SHALL THE AUTHOR BE LIABLE FOR
 * ANY SPECIAL, DIRECT, INDIRECT, OR CONSEQUENTIAL DAMAGES OR ANY DAMAGES
 * WHATSOEVER RESULTING FROM LOSS OF USE, DATA OR PROFITS, WHETHER IN AN
 * ACTION OF CONTRACT, NEGLIGENCE OR OTHER TORTIOUS ACTION, ARISING OUT OF
 * OR IN CONNECTION WITH THE USE OR PERFORMANCE OF THIS SOFTWARE.
 *
 ****************************************************************************
 */
require "common.inc.php";
admin();
$label = "administration � decoding all html characters in posts...";
require "header.inc.php";
?>
   <div class="whitebox">
<?php
$sql = "SELECT post_id, body FROM ttf_post";
$result = mysql_query($sql);
while ($post = mysql_fetch_array($result)) {
	$post_id = mysql_real_escape_string(trim($post["post_id"]));
	$body = mysql_real_escape_string(trim(html_entity_decode($post["body"], ENT_QUOTES)));
	$sql_x = "UPDATE ttf_post SET body='$body' WHERE post_id='$post_id'";
	$result_x = mysql_query($sql_x);
	if ($result_x == 1) echo "updated post $post_id with success!<br />\n";
	else echo "ENCOUNTERED AN ERROR WHEN CONVERTING POST $post_id!<br />\n";
};
mysql_free_result($result);
?>

<hr width="590" /><br />

<?php
$sql = "SELECT user_id, username, email, title, profile FROM ttf_user";
$result = mysql_query($sql);
while ($user = mysql_fetch_array($result)) {
	$user_id = mysql_real_escape_string($user["user_id"]);
	$username = mysql_real_escape_string(trim(html_entity_decode($user["username"], ENT_QUOTES)));
	$email = mysql_real_escape_string(trim(html_entity_decode($user["email"], ENT_QUOTES)));
	$title = mysql_real_escape_string(trim(html_entity_decode($user["title"], ENT_QUOTES)));
	$profile = mysql_real_escape_string(trim(html_entity_decode($user["profile"], ENT_QUOTES)));
	$sql_x = "UPDATE ttf_user ".
		 "SET username='$username', email='$email', title='$title', profile='$profile' ".
		 "WHERE user_id='$user_id'";
	$result_x = mysql_query($sql_x);
	if ($result_x == 1) echo "updated user $user_id with success!<br />\n";
	else echo "ENCOUNTERED AN ERROR WHEN CONVERTING USER $user_id!<br />\n";
};
mysql_free_result($result);
?>

<hr width="590" /><br />

<?php
$sql = "SELECT thread_id, title FROM ttf_thread";
$result = mysql_query($sql);
while ($thread = mysql_fetch_array($result)) {
	$thread_id = mysql_real_escape_string($thread["thread_id"]);
	$title = mysql_real_escape_string(trim(html_entity_decode($thread["title"], ENT_QUOTES)));
	$sql_x = "UPDATE ttf_thread SET title='$title' WHERE thread_id='$thread_id'";
	$result_x = mysql_query($sql_x);
	if ($result_x == 1) echo "updated thread $thread_id with success!<br />\n";
	else echo "ENCOUNTERED AN ERROR WHEN CONVERTING THREAD $thread_id!<br />\n";
};
mysql_free_result($result);
?>
   </div>
<?php
mysql_close();
include "footer.inc.php";
?>
