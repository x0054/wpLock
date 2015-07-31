<?php
	// Settings
	$baseDir = getcwd();
	$onFile = $baseDir . "/wp-login.php";
	$offFile = $baseDir . "/wp-login.php-off";
	$loginUrl = "wp-admin/";
	$self = $_SERVER['PHP_SELF'];
	
	// Lock or Unlock the Login Page and Check Current State
	$locked = false;
	if(isset($_GET['login']) && $_GET['login'] == 'off'){
		if(!file_exists($offFile) && file_exists($onFile)){
			rename ($onFile, $offFile);
		}
		$locked = true;
	}else if(isset($_GET['login']) && $_GET['login'] == 'on'){
		if(file_exists($offFile) && !file_exists($onFile)){
			rename ($offFile, $onFile);
		}
		$locked = false;
	}else{
		if(file_exists($offFile) && !file_exists($onFile)){
			$locked = true;
		}else{
			$locked = false;
		}
	}
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>wpLock - Lock and Unlock Word Press Login</title>
	<link rel="stylesheet" href="css/styles.css?v=1.0">
</head>
<body>
	<h1>wpLock</h1>
	<p>Using this page you can lock and unlock the WordPress <a href="<?=$loginUrl?>" target="_new">Login Page</a>
	to prevent all of those annoying bot login attempts.</p>
	<p>
	The <a href="<?=$loginUrl?>" target="_new">Login Page</a> is now <b><?php if($locked){ echo "LOCKED"; }else{ echo "UNLOCKED"; }?></b>.
	Click here to <a href="<?php if($locked){ echo "$self?login=on"; }else{ echo "$self?login=off"; }?>"><?php if($locked){ echo "unlock"; }else{ echo "lock"; }?></a> it.
	</p>
</body>
</html>