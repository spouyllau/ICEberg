<?php require("config.inc.php") ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd">
<html>
<head>
<meta name="robots" content="noindex,nofollow">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title><?php print "$title" ?></title>
</head>

<frameset rows="*" cols="420,*" frameborder="YES" border="1px" framespacing="0">
  <frameset rows="50,*" frameborder="no" framespacing="0">
  	<frame src="list.php" name="topFrame" scrolling="NO" noresize>
    <frame src="tmp.php" name="leftFrame" scrolling="auto" noresize>
  </frameset>
  <frame src="ours.php" name="mainFrame" scrolling="auto" noresize>
</frameset>

<noframes>
<body>
</body>
</noframes>
</html>
