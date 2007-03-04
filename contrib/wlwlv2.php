<?php
//////////////////////////////////////// ADD POST //////////////////////////////////////// OK
 function print_add() {
?>
   <tr><td width="600">
    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
     <table class="text" border="0" cellpadding="0" cellspacing="0" width="600">
      <tr><td colspan="5" height="8" width="600"><img src="images/02.gif" alt="!" height="8" width="600" /></td></tr>
      <tr>
       <td rowspan="2" width="12">&nbsp;</td>
       <td class="bold" valign="top" width="82">write:</td>
       <td rowspan="2" width="26">&nbsp;</td>
       <td rowspan="2" class="bold" valign="top" width="474"><textarea cols="55" rows="6" name="add" wrap="virtual"></textarea></td>
       <td rowspan="2" width="6">&nbsp;</td>
      </tr>
      <tr><td valign="bottom" width="82"><input type="submit" value="post!" /></td></tr>
      <tr><td colspan="5" height="8" width="600"><img src="images/03.gif" alt="!" height="8" width="600" /></td></tr>
     </table>
    </form>
   </td></tr>
   <tr><td class="tiny" height="10" width="600">&nbsp;</td></tr>
<?php
 };
//////////////////////////////////////// EDIT PROFILE //////////////////////////////////////// add password thing
 function print_edit($uid) {
  $sql = "SELECT profile FROM wlwl_user WHERE user_id='$uid'";
  $result = mysql_query($sql);
  $user = mysql_fetch_array($result);
  mysql_free_result($result);
?>
   <tr><td width="600">
    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
     <table class="text" border="0" cellpadding="0" cellspacing="0" width="600">
      <tr><td colspan="5" height="8" width="600"><img src="images/02.gif" alt="!" height="8" width="600" /></td></tr>
      <tr>
       <td rowspan="2" width="12">&nbsp;</td>
       <td class="bold" valign="top" width="82">write:</td>
       <td rowspan="2" width="26">&nbsp;</td>
        <td rowspan="2" class="bold" valign="top" width="474"><textarea cols="55" rows="6" name="edit" wrap="virtual"><?php echo stripslashes($user["profile"]); ?></textarea></td>
       <td rowspan="2" width="6">&nbsp;</td>
      </tr>
      <tr><td valign="bottom" width="82"><input type="submit" value="edit!" /></td></tr>
      <tr><td colspan="5" height="8" width="600"><img src="images/03.gif" alt="!" height="8" width="600" /></td></tr>
     </table>
    </form>
   </td></tr>
   <tr><td class="tiny" height="10" width="600">&nbsp;</td></tr>
<?php
 };
//////////////////////////////////////// MESSAGE //////////////////////////////////////// OK
 function print_message($message) {
?>
   <tr><td width="600">
   <table class="text" border="0" cellpadding="0" cellspacing="0" width="600">
    <tr><td colspan="5" height="8" width="600"><img src="images/02.gif" alt="!" height="8" width="600" /></td></tr>
     <tr>
      <td width="12">&nbsp;</td>
      <td class="bold" valign="top" width="82">error!</td>
      <td width="26">&nbsp;</td>
      <td valign="top" width="474"><?php echo $message; ?></td>
      <td width="6">&nbsp;</td>
     </tr>
     <tr><td colspan="5" height="8" width="600"><img src="images/03.gif" alt="!" height="8" width="600" /></td></tr>
    </table>
   </td></tr>
   <tr><td class="tiny" height="10" width="600">&nbsp;</td></tr>
<?php
 };
//////////////////////////////////////// SIGN IN //////////////////////////////////////// OK
 function print_signin() {
?>
   <tr><td width="600">
    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
     <table class="text" border="0" cellpadding="0" cellspacing="0" width="600">
      <tr><td colspan="5" height="8" width="600"><img src="images/02.gif" alt="!" height="8" width="600" /></td></tr>
      <tr>
       <td width="12">&nbsp;</td>
       <td valign="top" width="82"><input type="submit" value="sign in!" /></td>
       <td width="26">&nbsp;</td>
       <td valign="top" width="474">
        user: <input type="text" name="username" maxlength="12" size="16" />
        pass: <input type="password" name="password" maxlength="32" size="16" />
       </td>
       <td width="6">&nbsp;</td>
      </tr>
      <tr><td colspan="5" height="8" width="600"><img src="images/03.gif" alt="!" height="8" width="600" /></td></tr>
     </table>
    </form>
   </td></tr>
   <tr><td class="tiny" height="10" width="600">&nbsp;</td></tr>
<?php
 };
//////////////////////////////////////// ABOUT //////////////////////////////////////// OK
 function print_about() {
?>
   <tr><td width="600">
   <table class="text" border="0" cellpadding="0" cellspacing="0" width="600">
    <tr><td colspan="5" height="8" width="600"><img src="images/02.gif" alt="!" height="8" width="600" /></td></tr>
     <tr>
      <td rowspan="2" width="12">&nbsp;</td>
      <td valign="top" width="82"><span class="bold">about wlwl!</span></td>
      <td rowspan="2" width="26">&nbsp;</td>
      <td rowspan="2" valign="top" width="474">
       this is the new version of the winged leopard web log. same place, 
       same people. again, a bmt-based community of jerx.
       <br /><br />
       <b>here's the way it works:</b> every bmter has a link with their 
       name at the top. this is their own web log where their own posts 
       go. anyone on the internet can comment on these posts. the five 
       most recent posts made by bmters appear on the main page. the 
       twenty most recent comments appear when you click on the "most 
       recent comments" link at the bottom of the page. unfortunately, you 
       cannot have your own web log, but please comment on the posts to 
       your heart's desire. however, abuse will be noticed by a moderator 
       and you will be ip-banned. all times are in bmt standard time (GMT -7). 
       <br /><br />
       <b>the making of wlwlv2:</b> this is the second version, so that 
       means that there was a first. the original winged leopard web log 
       had both discussion blogs and personal blogs. discussion blogs 
       appeared in a forum style thread layout, while the personal blogs 
       were a typical journal style never-ending-page. the journals were 
       getting long, it was hard to find new posts and comments, and the 
       original blog was kind of ugly. sure, it was a good result for a 
       weekend of coding, but much greater things can be achieved. the 
       original blog was online beginning in january of 2004. thanks to 
       the concept of procrastination, 2004 would never see the second 
       version. but with another weekend dedicated to coding, the new 
       version made it online in january of 2005. so here we are. and here 
       are some of the other design proposals: 
       <a href="images/draft-0.png">one</a>, 
       <a href="images/draft-1.png">two</a>, 
       <a href="images/draft-2.png">three</a>, 
       <a href="images/draft-3.png">four</a>, 
       <a href="images/draft-4.png">five</a>, 
       <a href="images/draft-5.png">six</a>.
       what was at this domain before the blog, you ask? well, look here:
       <a href="http://web.archive.org/web/*/http://www.wingedleopard.net">click</a>.
       nice, no? wingedleopard.net was registered on september 29, 
       1999. that means that this domain and the concept of "winged 
       leopard web" has been around for over five years.
       <br /><br />       
       <b>credits:</b> thanks to all of the hosts over the years (from 
       cyclonehost.com to racksense.com; fuck you, one eighty) and 
       thank you to dc for hosting us in 2005. thanks to 
       webmaster-resources.com (now sitepoint.com) and evilwalrus.com. 
       thanks to everyone in the simpsons community (namely simpsons100.com 
       for first getting me into web design in 1998). also, 
       though they should be thanking me, thanks to everyone i have hosted 
       over the years at "winged leopard web network" for promoting the 
       web presence. and thanks to everyone who was involved in the last 
       blog or this blog. and thanks for the support for think tank 
       forums, which you can expect in 2005.
       <br /><br />
       <b>signed,<br /><br />lucas</b>
       <br /><br />
       p.s. wlwlv2 officially died on 6 jan 2006. heart, lr.
      </td>
      <td rowspan="2" width="6">&nbsp;</td>
     </tr>
     <tr><td valign="bottom" width="82">1/31, 11:45p</td></tr>
     <tr><td colspan="5" height="8" width="600"><img src="images/03.gif" alt="!" height="8" width="600" /></td></tr>
    </table>
   </td></tr>
   <tr><td class="tiny" height="10" width="600">&nbsp;</td></tr>
<?php
 };
//////////////////////////////////////// RECENT COMMENTS //////////////////////////////////////// OK
 function print_recent() {
  $sql = "SELECT wlwl_comment.*, wlwl_user.username FROM wlwl_comment LEFT JOIN wlwl_user ON wlwl_comment.name=wlwl_user.user_id  ORDER BY date DESC LIMIT 20";
  $result = mysql_query($sql);
  while ($comment = mysql_fetch_array($result)) {
   $zoneadj = 3600 * -2; // bmt standard time
   $date = substr(date("n\/j, g\:ia", $comment["date"] + $zoneadj), 0, -1);
?>
   <tr><td width="600">
   <table class="text" border="0" cellpadding="0" cellspacing="0" width="600">
    <tr><td colspan="5" height="8" width="600"><img src="images/02.gif" alt="!" height="8" width="600" /></td></tr>
     <tr>
      <td rowspan="2" width="12">&nbsp;</td>
<?php
 if ($comment["type"] == "user") {
?>
      <td valign="top" width="82"><a class="bold" href="<?php echo $_SERVER["PHP_SELF"]."?profile=".$comment["name"]."\">".$comment["username"]."</a><br />".$date; ?></td>
      <td rowspan="2" width="26">&nbsp;</td>
      <td rowspan="2" valign="top" width="474"><?php echo nl2br(stripslashes($comment["body"])); ?></td>
<?php } else { ?>
      <td valign="top" width="82"><span class="bold"><?php echo $comment["name"]."</span><br />".$date; ?></td>
      <td rowspan="2" width="26">&nbsp;</td>
      <td rowspan="2" valign="top" width="474"><?php echo nl2br($comment["body"]); ?></td>
<?php }; ?>
      <td rowspan="2" width="6">&nbsp;</td>
     </tr>
     <tr><td valign="bottom" width="82"><a href="<?php echo $_SERVER["PHP_SELF"]."?comment=".$comment["post_id"]; ?>">link</a></td></tr>
     <tr><td colspan="5" height="8" width="600"><img src="images/03.gif" alt="!" height="8" width="600" /></td></tr>
    </table>
   </td></tr>
   <tr><td class="tiny" height="10" width="600">&nbsp;</td></tr>
<?php
  };
 };
//////////////////////////////////////// PRINT PROFILE //////////////////////////////////////// OK
 function print_profile($user_id) {
  $sql = "SELECT username, moderator, profile FROM wlwl_user WHERE user_id='$user_id'";
  $result = mysql_query($sql);
  $user = mysql_fetch_array($result);
  mysql_free_result($result);
?>
   <tr><td width="600">
   <table class="text" border="0" cellpadding="0" cellspacing="0" width="600">
    <tr><td colspan="5" height="8" width="600"><img src="images/02.gif" alt="!" height="8" width="600" /></td></tr>
     <tr>
      <td width="12">&nbsp;</td>
      <td valign="top" width="82"><span class="bold"><?php echo $user["username"]; ?></span><?php if ($user["moderator"] == "1") echo "<br />moderator"; ?></td>
      <td width="26">&nbsp;</td>
      <td valign="top" width="474"><?php echo nl2br(stripslashes($user["profile"])); ?></td>
      <td width="6">&nbsp;</td>
     </tr>
     <tr><td colspan="5" height="8" width="600"><img src="images/03.gif" alt="!" height="8" width="600" /></td></tr>
    </table>
   </td></tr>
   <tr><td class="tiny" height="10" width="600">&nbsp;</td></tr>
<?php
 };
//////////////////////////////////////// PRINT COMMENTS //////////////////////////////////////// OK
 function print_comments($post_id, $noname) {
  $sql = "SELECT wlwl_post.*, wlwl_user.username FROM wlwl_post, wlwl_user WHERE wlwl_post.user_id=wlwl_user.user_id AND wlwl_post.post_id='$post_id'";
  $result = mysql_query($sql);
  while ($post = mysql_fetch_array($result)) {
   $zoneadj = 3600 * -2; // bmt standard time
   $date = substr(date("n\/j, g\:ia", $post["date"] + $zoneadj), 0, -1);
   if ($post["comments"] != 1) $plural = "s";
?>
   <tr><td width="600">
   <table class="text" border="0" cellpadding="0" cellspacing="0" width="600">
    <tr><td colspan="5" height="8" width="600"><img src="images/02.gif" alt="!" height="8" width="600" /></td></tr>
     <tr>
      <td width="12">&nbsp;</td>
      <td valign="top" width="82"><a class="bold" href="<?php echo $_SERVER["PHP_SELF"]."?profile=".$post["user_id"]."\">".$post["username"]."</a><br />".$date; ?></td>
      <td width="26">&nbsp;</td>
      <td valign="top" width="474"><?php echo nl2br(stripslashes($post["body"])); ?></td>
      <td width="6">&nbsp;</td>
     </tr>
     <tr><td colspan="5" height="8" width="600"><img src="images/03.gif" alt="!" height="8" width="600" /></td></tr>
    </table>
   </td></tr>
   <tr><td class="tiny" height="10" width="600">&nbsp;</td></tr>
<?php
  };
  $sql = "SELECT wlwl_comment.*, wlwl_user.username FROM wlwl_comment LEFT JOIN wlwl_user ON wlwl_comment.name=wlwl_user.user_id WHERE wlwl_comment.post_id='$post_id' ORDER BY date";
  $result = mysql_query($sql);
  while ($comment = mysql_fetch_array($result)) {
   $zoneadj = 3600 * -2; // bmt standard time
   $date = substr(date("n\/j, g\:ia", $comment["date"] + $zoneadj), 0, -1);
?>
   <tr><td width="600">
   <table class="text" border="0" cellpadding="0" cellspacing="0" width="600">
    <tr><td colspan="5" height="8" width="600"><img src="images/02.gif" alt="!" height="8" width="600" /></td></tr>
     <tr>
      <td width="12">&nbsp;</td>
<?php
 if ($comment["type"] == "user") {
?>
      <td valign="top" width="82"><a class="bold" href="<?php echo $_SERVER["PHP_SELF"]."?profile=".$comment["name"]."\">".$comment["username"]."</a><br />".$date; ?></td>
      <td width="26">&nbsp;</td>
      <td valign="top" width="474"><?php echo nl2br(stripslashes($comment["body"])); ?></td>
<?php } else { ?>
      <td valign="top" width="82"><span class="bold"><?php echo $comment["name"]."</span><br />".$date; ?></td>
      <td width="26">&nbsp;</td>
      <td valign="top" width="474"><?php echo nl2br($comment["body"]); ?></td>
<?php }; ?>
      <td width="6">&nbsp;</td>
     </tr>
     <tr><td colspan="5" height="8" width="600"><img src="images/03.gif" alt="!" height="8" width="600" /></td></tr>
    </table>
   </td></tr>
   <tr><td class="tiny" height="10" width="600">&nbsp;</td></tr>
<?php
  };
?>
<!-- WLWL IS DEAD
   <tr><td width="600">
    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
     <table class="text" border="0" cellpadding="0" cellspacing="0" width="600">
      <tr><td colspan="5" height="8" width="600"><img src="images/02.gif" alt="!" height="8" width="600" /></td></tr>
      <tr>
       <td rowspan="2" width="12">&nbsp;</td>
       <td valign="top" width="82"><span class="bold"><?php if ($noname != 1) echo "name:<br />"; ?>write:</span></td>
       <td rowspan="2" width="26">&nbsp;</td>
       <td rowspan="2" valign="top" width="474">
<?php if ($noname != 1) echo "        <input type=\"text\" name=\"name\" maxlength=\"12\" size=\"50\" /><br />\n"; ?>
        <textarea cols="55" rows="6" name="body" wrap="virtual"></textarea>
       </td>
       <td width="6">&nbsp;</td>
      </tr>
      <tr><td valign="bottom" width="82"><input type="submit" value="post!" /></td></tr>
      <tr><td colspan="5" height="8" width="600"><img src="images/03.gif" alt="!" height="8" width="600" /></td></tr>
     </table>
     <input type="hidden" name="comment" value="<?php echo $post_id; ?>" />
    </form>
   </td></tr>
   <tr><td class="tiny" height="10" width="600">&nbsp;</td></tr>
-->
<?php
 };
//////////////////////////////////////// PRINT POSTS //////////////////////////////////////// OK
 function print_posts($sql, $noname) {
  $result = mysql_query($sql);
  while ($post = mysql_fetch_array($result)) {
   $zoneadj = 3600 * -2; // bmt standard time
   $date = substr(date("n\/j, g\:ia", $post["date"] + $zoneadj), 0, -1);
   if ($post["comments"] != 1) $plural = "s";
?>
   <tr><td width="600">
   <table class="text" border="0" cellpadding="0" cellspacing="0" width="600">
    <tr><td colspan="5" height="8" width="600"><img src="images/02.gif" alt="!" height="8" width="600" /></td></tr>
     <tr>
      <td rowspan="2" width="12">&nbsp;</td>
      <td valign="top" width="82">
<?php if ($noname == 1) { echo "       ".$date; } else { ?>
       <a class="bold" href="<?php echo $_SERVER["PHP_SELF"]."?profile=".$post["user_id"]."\">".$post["username"]."</a><br />".$date; ?></td>
<?php }; ?>
      </td>
      <td rowspan="2" width="26">&nbsp;</td>
      <td rowspan="2" valign="top" width="474"><?php echo nl2br(stripslashes($post["body"])); ?></td>
      <td rowspan="2" width="6">&nbsp;</td>
     </tr>
     <tr><td valign="bottom" width="82"><a href="<?php echo $_SERVER["PHP_SELF"]."?comment=".$post["post_id"]."\">".$post["comments"]." comment".$plural; ?></a></td></tr>
     <tr><td colspan="5" height="8" width="600"><img src="images/03.gif" alt="!" height="8" width="600" /></td></tr>
    </table>
   </td></tr>
   <tr><td class="tiny" height="10" width="600">&nbsp;</td></tr>
<?php
  };
 };
//////////////////////////////////////// CONNECTION / COOKIE MGMT ////////////////////////////////////////
 require "../../credentials.inc.php";
 $server = mysql_connect($dbms_host, $dbms_user, $dbms_pass)
           or die("Could not connect: ".mysql_error());
 mysql_select_db($dbms_db);
 if (isset($_GET["signout"]) && isset($_COOKIE["wlw"])) {
  $expire = time() - 60;
  setcookie("wlw", "", $expire);
 } else if (isset($_POST["username"]) && isset($_POST["password"])) {
/* WLWL IS DEAD
  $username = $_POST["username"];
  $password = sha1($_POST["password"]);
  $result = mysql_query("SELECT user_id, username moderator FROM wlwl_user WHERE username='$username' AND password='$password'");
  $user = mysql_fetch_array($result);
  mysql_free_result($result);
  if (isset($user["user_id"])) {
   $expire = time() + 2678400;
   $cookie = serialize(array($user["user_id"],$password));
   setcookie("wlw", $cookie, $expire);
   $wlwl = array("uid"=>$user["user_id"],"mod"=>$user["moderator"],"name"=>$user["username"]);
  } else {
   $message = "incorrect username and/or passphrase!";
  };
*/
 } else if (isset($_COOKIE["wlw"])) {
/* WLWL IS DEAD
  $cookie = unserialize(stripslashes($_COOKIE["wlw"]));
  $result = mysql_query("SELECT user_id, username, moderator FROM wlwl_user WHERE user_id='{$cookie[0]}' AND password='{$cookie[1]}'");
  $user = mysql_fetch_array($result);
  mysql_free_result($result);
  if (isset($user["user_id"])) {
   $wlwl = array("uid"=>$user["user_id"],"mod"=>$user["moderator"],"name"=>$user["username"]);
  } else {
   $message = "invalid cookie.";
  };
*/
 };
 if (isset($_POST["comment"])) {
/* WLWL IS DEAD
  if (isset($wlwl["uid"])) {
   $name = $wlwl["uid"];
   $user = "user";
   $body = addslashes(trim($_POST["body"]));
   $results = mysql_query("UPDATE wlwl_user SET unsketch=UNIX_TIMESTAMP() WHERE user_id='{$wlwl["uid"]}'");
  } else {
   $name = htmlspecialchars(trim($_POST["name"]), ENT_QUOTES);
   $user = "guest";
   $body = htmlspecialchars(trim($_POST["body"]), ENT_QUOTES);
  };
  if ($name != "" && $body != "") {
   mysql_free_result($resulta);
   $resulta = mysql_query("INSERT INTO wlwl_comment VALUES ('', '{$_POST["comment"]}', UNIX_TIMESTAMP(), '{$name}', '{$user}', '{$_SERVER["REMOTE_ADDR"]}', '{$body}')");
   $resultb = mysql_query("UPDATE wlwl_post SET comment_date=UNIX_TIMESTAMP(), comments=comments+1 WHERE post_id='{$_POST["comment"]}'");
  };
  header("Location: ".$_SERVER["PHP_SELF"]."?comment=".$_POST["comment"]);
*/
 } else if (isset($_POST["add"])) {
  if ($wlwl["uid"] != "" && $_POST["add"] != "") {
   $body = addslashes(trim($_POST["add"]));
   $result = mysql_query("INSERT INTO wlwl_post VALUES ('', UNIX_TIMESTAMP(), UNIX_TIMESTAMP(), '0', '{$wlwl["uid"]}', '{$body}')");
   $insertid = mysql_insert_id();
   $results = mysql_query("UPDATE wlwl_user SET unsketch=UNIX_TIMESTAMP() WHERE user_id='{$wlwl["uid"]}'");
  };
  header("Location: ".$_SERVER["PHP_SELF"]."?comment=".$insertid);
 } else if (isset($_POST["edit"])) {
  if ($wlwl["uid"] != "" && $_POST["edit"] != "") {
   $body = addslashes(trim($_POST["edit"]));
   $result = mysql_query("UPDATE wlwl_user SET profile='$body' WHERE user_id='{$wlwl["uid"]}'");
  };
  header("Location: ".$_SERVER["PHP_SELF"]."?profile=".$wlwl["uid"]);
 };
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
 <head>
  <title>winged leopard web log</title>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
  <style type="text/css">
   <!--
    drk blue 00cccc
    med blue 73e6e6
    lte blue b6f2f2
    med gry  cccccc
    brt red  ff0000
    off wht  fff0f0
    drk orng ff9900
    lte orng ffcc80
   -->
           a {color: #cc0000;}
    a:active {color: #cc0000;}
      a:link {color: #cc0000;}
   a:visited {color: #cc0000;}
        body {background-color: #b6f2f2;}
    textarea {color: #000000; font-family: arial, sans-serif; font-size: 10pt; background-color: transparent; border: 1px solid grey;}
       input {color: #000000; font-family: arial, sans-serif; font-size: 10pt; background-color: transparent; border: 1px solid grey;}
       .text {color: #000000; font-family: arial, sans-serif; font-size: 10pt; background-image: url(images/01.gif);}
      .links {color: #000000; font-family: arial, sans-serif; font-size: 10pt; font-weight: bold;}
        .box {padding-top: 2px; background-image: url(images/00.gif);}
       .bold {font-weight: bold;}
       .tiny {font-size: 2px;}
 </style>
 </head>
 <body>
  <table align="center" border="0" cellpadding="0" cellspacing="0" width="600">
   <tr><td class="tiny" height="20" width="600">&nbsp;</td></tr>
   <tr><td class="tiny" height="50" width="600"><a href="<?php echo $_SERVER["PHP_SELF"]; ?>"><img src="images/00.png" alt="winged leopard web log" height="50" width="600" border="0" /></a></td></tr>
   <tr><td class="tiny" height="10" width="600">&nbsp;</td></tr>
   <tr><td class="box" width="600" height="21">
    <table class="links" border="0" cellpadding="0" cellspacing="0" width="600"><tr>
     <td align="center" width="20">&nbsp;</td>
<?php
 $sql = "SELECT wlwl_user.user_id, wlwl_user.username, wlwl_user.unsketch FROM wlwl_post, wlwl_user WHERE wlwl_post.user_id=wlwl_user.user_id GROUP BY wlwl_user.username";
 $result = mysql_query($sql);
 $width = floor(560 / mysql_num_rows($result));
 $sketchtime = time() - (7*24*60*60);
 while ($link = mysql_fetch_array($result)) {
  if ($link["unsketch"] < $sketchtime) { $flag = "&nbsp;<img src=\"images/04.gif\" width=\"10\" height=\"12\" alt=\"sketch flag\" align=\"absbottom\" />"; } else { $flag = ""; };
  if ($_GET["log"] == $link["user_id"]) {
?>
     <td align="center" width="<?php echo $width; ?>"><a href="<?php echo $_SERVER["PHP_SELF"]."?profile=".$link["user_id"]; ?>"><?php echo $link["username"]."</a>".$flag; ?></td>
<?php
  } else {
?>
      <td align="center" width="<?php echo $width; ?>"><a style="color: #ffffff;" href="<?php echo $_SERVER["PHP_SELF"]."?log=".$link["user_id"]; ?>"><?php echo $link["username"]."</a>".$flag; ?></td>
<?php
  }
 };
 mysql_free_result($result);
?>
     <td align="center" width="20">&nbsp;</td>
    </tr></table>
   </td></tr>
   <tr><td class="tiny" height="10" width="600">&nbsp;</td></tr>
<?php
 if (isset($message)) {
  print_message($message);
 } else if (isset($_GET["profile"])) {
  print_profile($_GET["profile"]);
 } else if (isset($_GET["log"])) {
   print_posts("SELECT wlwl_post.*, wlwl_user.username FROM wlwl_post, wlwl_user WHERE wlwl_post.user_id=wlwl_user.user_id AND wlwl_post.user_id='{$_GET["log"]}' ORDER BY date DESC", 1);
 } else if (isset($_GET["comment"])) {
  if (isset($wlwl["uid"])) print_comments($_GET["comment"], 1); else print_comments($_GET["comment"], 0);
 } else if (isset($_GET["recent"])) {
  print_recent();
 } else if (isset($_GET["about"])) {
  print_about();
 } else if (isset($_GET["signin"])) {
  print_signin();
 } else if (isset($_GET["add"])) {
  print_add();
 } else if (isset($_GET["edit"])) {
  print_edit($wlwl["uid"]);
 } else {
  print_posts("SELECT wlwl_post.*, wlwl_user.username FROM wlwl_post, wlwl_user WHERE wlwl_post.user_id=wlwl_user.user_id ORDER BY date DESC LIMIT 5", 0);
 };
?>
   <tr><td class="box" width="600" height="21">
    <table class="links" border="0" cellpadding="0" cellspacing="0" width="600"><tr>
     <td align="center" width="20">&nbsp;</td>
     <td align="center" width="187"><a style="color: #ffffff;" href="<?php echo $_SERVER["PHP_SELF"]; ?>?about">about wlwl</a></td>
     <td align="center" width="186"><a style="color: #ffffff;" href="<?php echo $_SERVER["PHP_SELF"]; ?>?recent">most recent comments</a></td>
     <td align="center" valgin="bottom" width="187">
<?php
 if (isset($wlwl["uid"])) {
?>
      <a href="<?php echo $_SERVER["PHP_SELF"]; ?>?add"><img src="images/10.gif" alt="add a post" height="16" width="16" border="0" align="absmiddle" /></a>&nbsp;
      <a href="<?php echo $_SERVER["PHP_SELF"]; ?>?edit"><img src="images/11.gif" alt="edit your profile" height="16" width="16" border="0" align="absmiddle" /></a>&nbsp;
      <a href="<?php echo $_SERVER["PHP_SELF"]; ?>?signout"><img src="images/12.gif" alt="sign the fuck out" height="16" width="16" border="0" align="absmiddle" /></a></td>
<?php
 } else {
?>
      <a style="color: #ffffff;" href="<?php echo $_SERVER["PHP_SELF"]; ?>?signin">sign in</a>
<?php
 };
?>
     <td align="center" width="20">&nbsp;</td>
    </tr></table>
   </td></tr>
  </table>
<script src="http://www.google-analytics.com/urchin.js" type="text/javascript">
</script>
<script type="text/javascript">
_uacct = "UA-397643-1";
urchinTracker();
</script>
 </body>
</html>
<?php mysql_close(); ?>