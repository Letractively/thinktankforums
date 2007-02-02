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
 *
 * forum.php
 *
 * AUDITED BY JLR 200611250140
 *
 * this script accepts the following variables:
 * 	$_GET["forum_id"]	clean
 *	$_GET["offset"]		clean
 *
 * sanity checks include:
 * 	valid forum exists
 * 	includes are REQUIRED
 */
 require "common.inc.php";
 $forum_id = clean($_GET["forum_id"]);
 $offset   = clean($_GET["offset"]);
 $sql = "SELECT name FROM ttf_forum WHERE forum_id='$forum_id'";
 $result = mysql_query($sql);
 $forum  = mysql_fetch_array($result);
 mysql_free_result($result);
 if (isset($forum["name"])) {
  if (isset($ttf["uid"])) {
   $result = mysql_query("REPLACE INTO ttf_forum_new SET forum_id='$forum_id', user_id='{$ttf["uid"]}', last_view=UNIX_TIMESTAMP()");
  }; 
  $label = $forum["name"]; // should this be run through output() ? --jlr
  require "header.inc.php";
?>
   <div class="sidebox"><a href="newthread.php?forum_id=<?php echo $forum_id; ?>"><b>start new thread</b></a></div>
<?php
  $sql = "SELECT COUNT(thread_id) FROM ttf_thread WHERE forum_id='$forum_id'";
  $result = mysql_query($sql);
  $count = mysql_fetch_array($result);
  $numrows = $count[0];
  mysql_free_result($result);
  if ($numrows > ($ttf_config["forum_display"] + $offset)) {
   $next = $offset + $ttf_config["forum_display"];
   $left = min($numrows - $offset - $ttf_config["forum_display"], $ttf_config["forum_display"]);
?>
	<div class="sidebox"><a href="forum.php?forum_id=<?php echo $forum_id; ?>&amp;offset=<?php echo $next; ?>"><b>next <?php echo $left; ?> threads</b></a><br />(<?php echo $numrows; ?> total)</div>
<?php
  };
?>
   <table border="0" cellpadding="2" cellspacing="1" width="600" class="shift">
    <tr class="mediuminv">
     <td width="40"><b>&nbsp;</b></td>
     <td width="304"><b>title</b></td>
     <td width="110"><b>started by</b></td>
     <td width="70"><b>posts</b></td>
     <td width="70"><b>views</b></td>
    </tr>
<?php
  if ($offset == "") $offset = 0;
  $sql = "SELECT ttf_thread.thread_id, ttf_thread.author_id,
                 ttf_thread.posts, ttf_thread.views, ttf_thread.date,
                 ttf_thread.title, ttf_user.username, ttf_thread_new.last_view
          FROM ttf_thread
          LEFT JOIN ttf_user ON ttf_user.user_id=ttf_thread.author_id
	  LEFT JOIN ttf_thread_new ON ttf_thread_new.thread_id=ttf_thread.thread_id
	                           && ttf_thread_new.user_id='{$ttf["uid"]}'
          WHERE ttf_thread.forum_id='$forum_id'
          ORDER BY ttf_thread.date DESC
          LIMIT $offset, {$ttf_config["forum_display"]}";
  $result = mysql_query($sql);
  while ($thread = mysql_fetch_array($result)) {
	  /* THERE IS SURELY A MORE EFFICIENT WAY
	   * TO PRINT A JUMP LINK RATHER THAN TO
	   * QUERY FOR EACH THREAD!! --JLR
	   * here's an idea! instead of using dates in the new_thread table,
	   * use the number of the reply. so reply_id=5 means that they read
	   * the fifth reply but nothing after that. maybe this would work
	   * pretty slick! --jlr
	   */
   $code = "&nbsp;";
   unset ($code2);
   if ($thread["last_view"] < $thread["date"] && isset($ttf["uid"])) {
    $code = "<img src=\"images/arrow.gif\" width=\"11\" height=\"11\" alt=\"new post!\" />";
    $sql = "SELECT ttf_post.post_id ".
           "FROM ttf_post ".	 
           "WHERE ttf_post.thread_id='{$thread["thread_id"]}' ".
           "ORDER BY ttf_post.date DESC ".
           "LIMIT 0, 1";
    $resulta = mysql_query($sql);
    $newpost = mysql_fetch_array($resulta);
    mysql_free_result($resulta);
    $code2 = "<span class=\"small\">&nbsp;&nbsp;&nbsp;(<a href=\"thread.php?thread_id=".$thread["thread_id"]."#".$newpost["post_id"]."\">jump</a>)</span>";
   };
?>
    <tr class="medium">
     <td align="center"><?php echo $code; ?></td>
     <td><?php echo $sticky; ?><a href="thread.php?thread_id=<?php echo $thread["thread_id"]; ?>"><?php echo output($thread["title"]); ?></a><?php echo $code2; ?></td>
     <td><a href="profile.php?user_id=<?php echo $thread["author_id"]; ?>"><?php echo output($thread["username"]); ?></a></td>
     <td><?php echo $thread["posts"]; ?></td>
     <td><?php echo $thread["views"]; ?></td>
    </tr>
<?php
  };
  mysql_free_result($result);
?>
   </table>
<?php
 } else { message("view forum","error!","not a valid forum.",1,0); };
 mysql_close();
 require "footer.inc.php";
?>