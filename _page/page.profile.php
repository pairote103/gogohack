<?php
if(empty($protect)) {
	http_response_code(404);
	exit();
}
?>
			   <div id="return"></div>
			   <br>
			   <div class="text-left mt-1"><i class="fa fa-angle-right"></i> รหัสผ่านปัจจุบัน</div>
				<div class="input-group" style="margin-bottom: 10px;">
				<input class="form-control" style="height: 40px;" name="password_old" id="password_old" type="passsword" placeholder="Old Passsword" required="">
				</div>
			   <div class="text-left mt-1"><i class="fa fa-angle-right"></i> รหัสผ่านใหม่</div>
				<div class="input-group">
				<input class="form-control" style="height: 40px;" name="password_new" id="password_new" type="password" placeholder="New Password" required="">
				</div>
				<div class="text-left mt-1"><i class="fa fa-angle-right"></i> รหัสผ่านใหม่ อีกครั้ง</div>
				<div class="input-group" style="margin-bottom: 10px;">
				<input class="form-control" style="height: 40px;" name="repassword_new" id="repassword_new" type="password" placeholder="New Password Confirm" required="">
				</div>
				<div class="text-left mt-1"><i class="fas fa-shield-alt"></i> <img src="captcha.php"></div>
				<div class="input-group" style="margin-bottom: 10px;">
				<input class="form-control" style="height: 40px;margin-top: 7px;" name="captcha" id="captcha" type="text" placeholder="Captcha" required="">
				</div>
					<br>
					<br>
					<center>
						<a class="btn btn-success" id="btn" href="javascript:password();"><i class="fas fa-check"></i> ยืนยันการเปลี่ยน</a>
						<a class="btn btn-danger" id="btn" href="?page=home"><i class="fas fa-times"></i> ยกเลิก</a>
					</center>