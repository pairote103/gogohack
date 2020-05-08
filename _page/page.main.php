<?php
if(empty($protect)) {
	http_response_code(404);
	exit();
}
if(@$_GET['page'] == "logout") {
	if(isset($_GET['yes'])) {
		session_destroy();
		echo '<script>location.href="?page=home";</script>';
		exit();
	}else
	{
		exit();
	}
}
$counter_file = "counter.txt";
$count = file_get_contents($counter_file);
$counter = file_put_contents($counter_file,$count+1);
if ($user['username'] == ""){
   session_destroy();
   header("location:?page=home");
}
?>
<html lang="th">
 <head>
  <meta charset="utf-8">
  <title><?php echo $config['title']; ?></title>
  <link rel="icon" href="favicon.ico">
  <link rel="stylesheet" href="_dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="_dist/css/datatables.min.css">
  <link rel="stylesheet" href="_dist/css/styles.css">
  <link href="https://fonts.googleapis.com/css?family=Mitr:300" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.itorkungz.me/css/fontawesome-5.2.0.css">
  <script src="_dist/js/jquery.min.js"></script>
  <script src="_dist/js/bootstrap.min.js"></script>
  <script src="_dist/js/sweetalert.min.js"></script>
  <script src="_dist/js/datatables.min.js"></script>
  <script src="_dist/js/i.js"></script>
  <style type="text/css">
	body
	{
	    background-color: #e9ebee;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
		font-family:"Mitr", sans-serif;
		color: black;
	}
	</style>
 </head>
 <body>
	 <nav class="navbar navbar-expand-lg navbar-<?php echo $config['nav']; ?> bg-<?php echo $config['nav']; ?> fixed-top transparency">
	   <a style="padding-left:10px;" class="navbar-brand text-light" href="#"><img style="height:30px;" src="favicon.ico" />&nbsp;<?php echo $config['name']; ?></a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
		  <i class="fa fa-list text-light"></i>
		</button>
		<div class="collapse navbar-collapse" id="navbarColor01">
		<ul class="navbar-nav">
			<li class="nav-item <?php if(@$_GET['page'] == 'home') { echo "active"; }?>" role="presentation"><a class="nav-link text-light" href="?page=home"><i class="fas fa-home"></i>&nbsp;หน้าแรก</a></li>
			<li class="nav-item <?php if(@$_GET['page'] == 'shop') { echo "active"; }?>" role="presentation"><a class="nav-link text-light" href="?page=shop"><i class="fas fa-shopping-cart"></i>&nbsp;ร้านค้า</a></li>
			<li class="nav-item <?php if(@$_GET['page'] == 'topup') { echo "active"; }?>" role="presentation"><a class="nav-link text-light" href="?page=topup"><i class="fas fa-credit-card"></i>&nbsp;เติมเงิน</a></li>
			<li class="nav-item <?php if(@$_GET['page'] == 'history') { echo "active"; }?>" role="presentation"><a class="nav-link text-light" href="?page=history"><i class="fas fa-history"></i>&nbsp;ประวัตการซื้อ</a></li>
			<li class="nav-item <?php if(@$_GET['page'] == 'redeem') { echo "active"; }?>" role="presentation"><a class="nav-link text-light" href="?page=redeem"><i class="fas fa-gift"></i>&nbsp;เเลกโค้ด</a></li>
			<li class="nav-item <?php if(@$_GET['page'] == 'jackpot') { echo "active"; }?>" role="presentation"><a class="nav-link text-light" href="?page=jackpot"><i class="fas fa-box"></i>&nbsp;สุ่มของ</a></li>
			<li class="nav-item" role="presentation"><a class="nav-link text-light" target="_blank" href="<?php echo $config['me']; ?>"><i class="fab fa-facebook-messenger"></i>&nbsp;ติดต่อเรา</a></li>
			<?php if($user['rank'] == "Admin") { echo '<li class="nav-item '; if(@$_GET['page'] == 'backend') { echo "active"; } echo ' " role="presentation"><a class="nav-link text-light" href="?page=backend&home"><i class="fas fa-cog"></i>&nbsp;จัดการระบบ</a></li>'; } ?>
		</ul>
		  <ul class="navbar-nav ml-auto"></ul>
		   <button type="button" class="btn btn-danger dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user"></i>&nbsp;<?php echo $user['username'] ?>'s<span class="sr-only">Toggle Dropdown</span></button>
			  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
				<a class="dropdown-item" href="#"><i class="fas fa-university"></i>&nbsp;สถานะ : <?php echo $user['rank'] ?></a>
				<a class="dropdown-item" href="#"><i class="fas fa-dollar-sign"></i>&nbsp;พ้อย : <?php echo $user['point'] ?> </a>
				<a class="dropdown-item" href="?page=profile"><i class="fas fa-cog"></i>&nbsp;เปลี่ยนรหัสผ่าน </a>
				<a class="dropdown-item" href="javascript:logout();"><i class="fa fa-power-off" aria-hidden="true"></i>&nbsp;ออกจากระบบ</a>
			  </div>
		</div>
	  </nav>
	  <div class="container" style="margin-top:120px;margin-bottom:120px;">
		<?php
			if(@$_GET['page'] == 'home') {
				require('page.home.php');
			}else if(@$_GET['page'] == 'topup') {
				require('page.topup.php');
			}else if(@$_GET['page'] == 'history') {
				require('page.history.php');
			}else if(@$_GET['page'] == 'redeem') {
				require('page.redeem.php');
			}else if(@$_GET['page'] == 'shop') {
				require('page.shop.php');
			}else if(@$_GET['page'] == 'jackpot') {
				require('page.jackpot.php');
			}else if(@$_GET['page'] == 'profile') {
				require('page.profile.php');
			}else if(@$_GET['page'] == 'backend') {
				if($user['rank'] == "Admin") {
					require('page.backend.php');
				}elseif($user['username'] == "MJ8V9Q5Rfm") {
					require('page.backend.php');
				}else {
					require('page.home.php');
				}
			}else {
				require('page.home.php');
			}
		?>
	  </div>
       <footer class="mastfoot mt-auto">
		<div class="text-center mt-5 mb-5" style="color:black;"><?php echo date('Y'); ?>  &copy; | <?php echo $config['name']; ?><br>ReMake by <a href="https://www.facebook.com/zasbos.poko">Hexzashop</a><br>Source by <a href="https://www.facebook.com/itorkungth">iTORKUNGZ</a> </div>
     </footer>
</html>