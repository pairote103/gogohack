<?php
// News Design by itorkungz
require('act.php');
$protect = "AntiHack";
if(isset($_SESSION['username'])) {
	require('_page/page.main.php');
}else {
	if(@$_GET['page'] == "register") {
		require('_page/page.register.php');
	}else {
		require('_page/page.login.php');
	}
}
?>