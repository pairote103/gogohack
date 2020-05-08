<?php
if(empty($protect)) {
	http_response_code(404);
	exit();
}
?>
<html lang="th">
 <head>
  <meta charset="utf-8">
  <meta name="description" content="<?php echo $config['description']; ?>">
  <meta name="keywords" content="<?php echo $config['description']; ?>">
  <meta name="author" content="<?php echo $config['name']; ?>">
  <meta property="og:title" content="|| <?php echo $config['name']; ?> - ขายไอดีต่างๆ ||">
  <meta property="og:type" content="website">
  <meta property="og:image" content="<?php echo $config['icon']; ?>">
  <meta property="og:url" content="<?php echo $config['www']; ?>">
  <meta property="og:description" content="เว็บขายไอดีเกมส์ต่างๆ">
  <title><?php echo $config['title']; ?></title>
  <link rel="icon" href="<?php echo $config['icon']; ?>">
  <link rel="stylesheet" href="_dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="_dist/css/styles.css">
  <link href="https://fonts.googleapis.com/css?family=Mitr:300" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.itorkungz.me/css/fontawesome-5.2.0.css">
  <script src="_dist/js/jquery.min.js"></script>
  <script src="_dist/js/bootstrap.min.js"></script>
  <script src="_dist/js/sweetalert.min.js"></script>
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
		<div class="container col-5" style="margin-top:170px;">
			  <div class="border border-secondary" style="margin-top:30px; margin-bottom: 50px; ">
			 <div class="card-header border-secondary" style="background: rgba(243, 243, 243,0.98)!important">
			 <div class="row">
			 <div class="col-4"> <h2 style="margin-top:3px;"><i class="fas fa-home"></i>&nbsp;Home</h2></div>
			 <div class="col-8">
				<div class="input-group mb-3">
				  <div class="input-group-prepend">
					<span class="input-group-text bg-success text-light">&nbsp;ประกาศ</span>
						<span class="input-group-text bg-white text-dark">
						<marquee onmouseout="this.start()" onmouseover="this.stop()" style="font-size:18px;"><?php echo $config['alert']; ?></marquee>
					   </span>
				  </div>
				</div>
			 </div>
			 </div>
			 </div>
			   <div class="card card-body">
			   <div id="return"></div>
			   <hr class="bg-light">
			   <p>
			   </p>
			   <div class="text-left mt-1"><i class="fa fa-angle-right"></i> ชื่อผู้ใช้</div>
				<div class="input-group" style="margin-bottom: 10px;">
				<input class="form-control" style="height: 40px;" name="username" id="username" type="username" placeholder="Username" required>
				</div>
			   <div class="text-left mt-1"><i class="fa fa-angle-right"></i> รหัสผ่าน</div>
				<div class="input-group">
				<input class="form-control" style="height: 40px;" name="password" id="password" type="password" placeholder="Password" required>
				</div>
					<br>
					<br>
						<a class="btn btn-success btn-block" id="btn" href="javascript:login();"><i class="fas fa-sign-in-alt"></i> เข้าสู่ระบบ</a>
						<a class="btn btn-primary float-right" style="margin-top:10px;" id="btn" href="?page=register"><i class="fas fa-sign-in-alt"></i> สมัครสมาชิก</a>
						<hr>
					<div class="text-center" style="margin-top:20px;">
					  <i class="fa fa-angle-right"></i> เว็บไซต์ <?php echo $config['name']; ?> มีบริการดังนี้:
						<li> ขายไอดี Minecraft, ไอดีแท้ไมน์คราฟถูกๆ ซื้อไอดีแท้ไมน์คราฟ, ร้านค้าขายไอดี</li>
						<li> ขาย Netflix, ขาย Spotify, ขาย ไอดีไมน์คราฟ, ขาย ไอดีมายคราฟ..</li>
						<li> เว็บขายไอดีแท้, ขายไอดีแท้มายคราฟ, ร้านขายIDแท้, ร้านขายไอดี</li>
						<li> ขายไอดีเกม, ไอดีแท้ Minecraft, ระบบอัตโนมัต</li>
					</div>
		     </div>
		  </div>
		</div>
       <footer class="mastfoot mt-auto">
      <div class="text-center mt-5 mb-5" style="color: black;"><?php echo date('Y'); ?>  &copy; | <?php echo $config['name']; ?><br>Powered by <a href="https://www.facebook.com/itorkungth">iTORKUNGz</a></div>
     </footer>
  </body>
</html>
