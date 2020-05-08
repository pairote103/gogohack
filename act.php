<?php
// Script by NowKung_ 
require('setting.php');
if(isset($_GET['login'])) {
	if(empty($_POST['username']) || empty($_POST['password']))  {
		DisplayMSG('error','Error', 'กรุณาอย่าเว้นช่องว่าง.','false');
		}
	$username = $_POST['username'];
	$password = $connect->real_escape_string(md5($_POST['password']."bXdUeXX6Tzs7utwP"));
	$query = $connect->query('SELECT * FROM user WHERE username = "'.$username.'" and password = "'.$password.'" ');
	$username_check = $query->num_rows;
	$account = $query->fetch_assoc();
  if($username_check == 0){
	  DisplayMSG('error','Error', 'ชื่อผู้ใช้์ หรือ รหัสผ่านไม่ถูกต้อง.','false');
  }
  if($account['ban'] == "true"){
	  DisplayMSG('error','Banned !!!', 'บัญชีของคุณถูกแบนถาวร !!!','false');
  }else {
	  $_SESSION['username'] = $username;
	  $connect->query("UPDATE `user` SET `ip` = '".$_SERVER['REMOTE_ADDR']."' WHERE `user`.`username` = '$username' ;");
	  DisplayMSG('success','Login Success !!!', 'เข้าสู่ระบบสำเร็จ !!','true');
  }
}
if(isset($_GET['register'])) {
	if(empty($_POST['username']) || empty($_POST['password']))  {
	   DisplayMSG('error','Error', 'กรุณาอย่าเว้นช่องว่าง.','false');
		}
	if (!preg_match('/^[a-zA-Z0-9\_]*$/', $_POST['username'])) {
		DisplayMSG('error','Error', 'ชื่อผู้ใช้ไม่ถูกต้อง ต้องเป็น A-Z 0-9 เท่านั้น !!.','false');
	}
	if(mb_strlen($_POST['username']) <= 4) {
		DisplayMSG('error','Error', 'ชื่อผู้ใช้อย่างน้อย 5 ตัวขึ้นไป !!','false');
	}
	if(mb_strlen($_POST['username']) >= 25) {
		DisplayMSG('error','Error', 'ชื่อผู้ใช้สูงสุด 24 ตัวขึ้นไป !!','false');
	}
	if(strlen($_POST['password']) <= 4) {
		DisplayMSG('error','Error', 'รหัสผ่านอย่างน้อย 5 ตัวขึ้นไป !!','false');
	}
	if(mb_strlen($_POST['password']) >= 25) {
		DisplayMSG('error','Error', 'รหัสผ่านสูงสุด 24 ตัว !!','false');
	}
	if($_POST['password'] != $_POST['repassword'])  {
	  DisplayMSG('error','Error', 'รหัสผ่าน ไม่ตรงกัน !!','false');
		}
	if (trim($_POST['captcha']) != $_SESSION['cap_code']){
		DisplayMSG('error','Error', 'รหัสความปลอดภัย ไม่ถูกต้อง !!!','false');
	}
	$username = $_POST['username'];
	$password = $connect->real_escape_string(md5($_POST['password']."bXdUeXX6Tzs7utwP"));
	$query = $connect->query('SELECT * FROM user WHERE username = "'.$username.'" ');
	$username_check = $query->num_rows;
  if($username_check >= 1){
	  DisplayMSG('error','Error', 'ชื่อผู้ใช้์ มีผู้ใช้งานไปแล้ว !!!','false');
  }else {
	  $query = $connect->query
	  ('
		INSERT INTO `user` (`id`, `username`, `password`, `ip`, `point`, `ban`, `rank`) VALUES 
		(NULL, "'.$username.'", "'.$password.'", "'.$_SERVER['REMOTE_ADDR'].'", "0", "false", "Member");
	  ');
	  DisplayMSG('success','Register Success !!!', 'สมัครสมาชิกสำเร็จ !!!..','true');
  }
}
if(isset($_SESSION['username'])) {
		$user = $connect->query(' SELECT * FROM `user` WHERE `username` = "'.$_SESSION['username'].'" ')->fetch_assoc();
		if(isset($_GET['cpassword'])) {
			if(empty($_POST['password_old']) || empty($_POST['password_new']) || empty($_POST['repassword_new']) || empty($_POST['captcha']))  {
				DisplayMSG('error','Error', 'กรุณาอย่าเว้นช่องว่าง.','false');
				}
			if(strlen($_POST['password_new']) <= 4) {
				DisplayMSG('error','Error', 'รหัสผ่านอย่างน้อย 4 ตัวขึ้นไป !!','false');
				exit();
			}
			if(mb_strlen($_POST['password_new']) >= 21) {
				DisplayMSG('error','Error', 'รหัสผ่านสูงสุด 20 ตัว !!','false');
				exit();
			}
			if($_POST['password_new'] != $_POST['repassword_new'])  {
			  DisplayMSG('error','Error', 'รหัสผ่าน ไม่ตรงกัน !!','false');
				}
			if (trim($_POST['captcha']) != $_SESSION['cap_code']){
				DisplayMSG('error','Error', 'รหัสความปลอดภัย ไม่ถูกต้อง !!!','false');
			}
			$password = $connect->real_escape_string(md5($_POST['password_old']."bXdUeXX6Tzs7utwP"));
			$password_query = $connect->query('SELECT * FROM user WHERE username = "'.$user['username'].'" and password = "'.$password.'" ');
			$password_check = $password_query->num_rows;
		  if($password_check == 0){
			  DisplayMSG('error','Error', 'รหัสเก่าไม่ถูกต้อง.','false');
		  }else {
			  $password_new = $connect->real_escape_string(md5($_POST['password_new']."bXdUeXX6Tzs7utwP"));
			  $connect->query("UPDATE `user` SET `password` = '$password_new' WHERE `user`.`id` = ".$user['id']);
			  session_destroy();
			  DisplayMSG('success','Change Password !!!', 'เปลี่ยนรหัสผ่านสำเร็จ','true');
		  }
		}
		if (isset($_GET['redeem'])){
	if (empty($_POST['code'])){
		DisplayMSG('error','Error', 'กรุณาอย่าเว้นช่องว่าง.','false');
 	}else if(isset($_POST['code'])){
		$code = $connect->real_escape_string($_POST['code']);
		$query = $connect->query('SELECT * FROM redeem WHERE code = "'.$code.'" and status = "UnRedeem" ');
		$code_check = $query->num_rows;
		$cq = $query->fetch_assoc();
		if ($code_check == 1){
			$pt = $user['point'] + $cq['price'];
			$su = $connect->query("UPDATE redeem SET status = 'Redeem' WHERE id = '".$cq['id']."'");
			$up = $connect->query("UPDATE `user` SET `point` = '$pt' WHERE `id` = ".$user['id']);
			$connect->query("INSERT INTO `log_redeem` (`id`, `code`, `price`, `time`, `username`) VALUES (NULL, '".$_POST['code']."', '".$cq['price']."','".time()."', '".$user['username']."'); ");
			if ($su || $up){
				DisplayMSG('success','Redeem Success !!!', 'เเลกโค้ดสำเร็จ !!!..','true');
			}
		}else {
			DisplayMSG('error','Error', 'โค้ดนี้ถูกใช้ไปเเล้วหรือ กรอกผิด.','false');
		}
	}
}
if ($user['rank'] == "Admin"){
if (isset($_GET['category'])){
if ($_GET['category'] == "all"){ ?>
	<table class="table table-default table-striped table-condenseds">
				<thead>
					<tr>
						<th style="background-color: #FFF;" class="text-center text-dark">อีเมล</th>
						<th style="background-color: #FFF;" class="text-center text-dark">รหัสผ่าน</th>
						<th style="background-color: #FFF;" class="text-center text-dark">สถานะ</th>
						<th style="background-color: #FFF;" class="text-center text-dark">จัดการ</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$logs = $connect->query('SELECT * FROM ids');
						$i = '1';
						while($log = $logs->fetch_assoc() ) {
					echo '
						<tr>
							<td class="text-center">'.$log['email'].'</td>
							<td class="text-center">'.$log['password'].'</td>
							<td class="text-center"><span class="badge badge-success" style="font-size: 17px;">'.$log['status'].'</span></td>
							<td class="text-center"><a class="btn btn-warning" href="?page=backend&ids&uid='.$log['id'].'"><i class="fa fa-cog"></i>&nbsp;จัดการ</a></td>
						</tr>
						';
						$i++;
						}
						?>
				</tbody>
			</table>
<?php	}else {
 ?>
		<table class="table table-default table-striped table-condenseds">
				<thead>
					<tr>
						<th style="background-color: #FFF;" class="text-center text-dark">อีเมล</th>
						<th style="background-color: #FFF;" class="text-center text-dark">รหัสผ่าน</th>
						<th style="background-color: #FFF;" class="text-center text-dark">สถานะ</th>
						<th style="background-color: #FFF;" class="text-center text-dark">จัดการ</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$logs = $connect->query('SELECT * FROM ids where category = "'.$_GET['category'].'"');
						$i = '1';
						while($log = $logs->fetch_assoc() ) {
					echo '
						<tr>
							<td class="text-center">'.$log['email'].'</td>
							<td class="text-center">'.$log['password'].'</td>
							<td class="text-center"><span class="badge badge-success" style="font-size: 17px;">'.$log['status'].'</span></td>
							<td class="text-center"><a class="btn btn-warning" href="?page=backend&ids&uid='.$log['id'].'"><i class="fa fa-cog"></i>&nbsp;จัดการ</a></td>
						</tr>
						';
						$i++;
						}
						?>
				</tbody>
			</table>

<?php
	}}
}
	if(isset($_GET['truemoney'])) {
			if(empty($_SESSION['username']) || empty($_POST['truemoney'])) {
				DisplayMSG('error','Error', 'กรุณาอย่าเว้นช่องว่าง.','false');
		}
			if(!is_numeric($_POST['truemoney']) || strlen($_POST['truemoney'])!='14' || $_POST['truemoney'] < 1) { 
				DisplayMSG('error','Error', 'กรุณากรอกเลขทรูมันนี่ให้ถูกต้อง.','false');
		}
			$ijson = WALLET('https://payment-gateway.itorkungz.me/truemoney?card='.$_POST['truemoney']);
			$itopup = json_decode($ijson, true);
			if($itopup['code'] == 3) {
				DisplayMSG('error','Error', 'กรุณาติดต่อแอดมิน !!','false');
			}
			if($itopup['code'] == 2) {
				DisplayMSG('error','Error', 'บัตรทรูมันนี่ ถูกใช้ไปแล้ว..','false');
			}
			if ($itopup['code'] == 1) {
			$point = $itopup['amount'] * $config['promotion_tm'];
			$connect->query("  INSERT INTO `log_topup` (`id`, `value`, `transaction`, `time`, `point`, `amount`, `username`, `status`) VALUES (NULL, 'Truemoney', '".$_POST['truemoney']."', '".time()."', '".$amount."', '".$itopup['amount']."', '".$user['username']."', 'success'); ");
			$connect->query("UPDATE `user` SET `point` = point+'$point' WHERE `user`.`id` = ".$user['id']);
				DisplayMSG('success','Success Topup', 'เติมเงินสำเร็จ <br>จำนวน : '.$itopup['amount'].' บาท <br>ได้รับพ้อย : '.$amount.' <i class="fas fa-gift"></i>.','false');
			}else{
				$connect->query("  INSERT INTO `log_topup` (`id`, `value`, `transaction`, `time`, `point`, `amount`, `username`, `status`) VALUES (NULL, 'Truemoney', '".$_POST['truemoney']."', '".time()."', '0', '0', '".$user['username']."', 'fail'); ");
				DisplayMSG('error','Error', 'บัตรทรูมันนี่ ไม่ถูกต้อง..','false');
			}
		}
		if (isset($_GET['osay'])){
			if ($_GET['osay'] == "1"){
				$connect->query("UPDATE `config` SET `say` = 'on'");
				DisplayMSG('success','Success On', 'เปิดเรียบร้อยเเล้ว','false');
			}else {
				$connect->query("UPDATE `config` SET `say` = 'off'");
				DisplayMSG('success','Success Off', 'ปิดเรียบร้อยเเล้ว','false');
			}
		}
	if(isset($_GET['truewallet'])) {
			if(empty($_SESSION['username']) || empty($_POST['truewallet'])) {
				DisplayMSG('error','Error', 'กรุณาอย่าเว้นช่องว่าง.','false');
		}
			if(!is_numeric($_POST['truewallet']) || strlen($_POST['truewallet'])!='14' || $_POST['truewallet'] < 1) { 
				DisplayMSG('error','Error', 'กรุณากรอกเลขทรูมันนี่ให้ถูกต้อง.','false');
		}
			$ijson = WALLET('https://payment-gateway.itorkungz.me/truewallet?transaction='.$_POST['truewallet']);
			$itopup = json_decode($ijson, true);
			if($itopup['code'] == 3) {
				DisplayMSG('error','Error Topup', 'กรุณาติดต่อแอดมิน !!','false');
			}
			$transaction = $connect->query('SELECT * FROM log_topup WHERE transaction = "'.$_POST['truewallet'].'" AND value = "Truewallet" ');
			$transaction = $transaction->num_rows;
			  if($transaction >= 1){
				  DisplayMSG('error','Error Topup', 'เลขอ้างอิง ถูกใช้ไปแล้ว..','false');
			  }
			if ($itopup['code'] == 1) {
			 if($itopup['msg'] == $config['truewallet_msg']){
					$point = $itopup['amount'] * $config['promotion_tw'];
					$connect->query("  INSERT INTO `log_topup` (`id`, `value`, `transaction`, `time`, `point`, `amount`, `username`, `status`) VALUES (NULL, 'Truewallet', '".$_POST['truewallet']."', '".time()."', '".$amount."', '".$itopup['amount']."', '".$user['username']."', 'success'); ");
					$connect->query("UPDATE `user` SET `point` = point+'$point' WHERE `user`.`id` = ".$user['id']);
					DisplayMSG('success','Success Topup', 'เติมเงินสำเร็จ <br>จำนวน : '.$itopup['amount'].' บาท <br>ได้รับพ้อย : '.$point.' <i class="fas fa-gift"></i>.','false');
				}else {
					DisplayMSG('error','Error Topup', 'คุณกรอกข้อความไม่ตรงกับระบบกำหนด !!..','false');
				}
			}else{
				$connect->query("  INSERT INTO `log_topup` (`id`, `value`, `transaction`, `time`, `point`, `amount`, `username`, `status`) VALUES (NULL, 'Truemoney', '".$_POST['truewallet']."', '".time()."', '0', '0', '".$user['username']."', 'fail'); ");
				DisplayMSG('error','Error Topup', 'ไม่พบเลขอ้างอิงนี้..','false');
			}
		}
		if(isset($_GET['shop'])) {
			$id = $_GET['id'];
			if(empty($id)) {
				DisplayMSG('error','Error Buy','ไม่พบสินค้านี้','false');
			}
			$query = $connect->query('SELECT * FROM shop WHERE id = "'.$id.'"');
			if($query->num_rows == 0) {
			DisplayMSG('error','Error Buy','ไม่พบสินค้านี้','false');
			}
			$shop = $query->fetch_assoc();
			if($user['point'] >= $shop['price']) {
				$rid = $connect->query('SELECT * FROM ids WHERE status = "unbuy" AND category = "'.$shop['category'].'" ORDER BY RAND() limit 1');
				$rids = $rid->fetch_assoc();
				if ($rid->num_rows == 0){
					$data = "Stock";
					$data = "Error";
				}
				if($data == "Stock" || $data == "Error") {
					DisplayMSG('error','Error Buy','สินค้าหมด !!','false');
				}
				//$connect->query("DELETE FROM `shop` WHERE `shop`.`id` = {$shop['id']}");
				$connect->query("UPDATE `ids` SET `status` = 'buy' WHERE `ids`.`id` = ".$rids['id']." ");
				$connect->query("INSERT INTO `log_shop` (`id`, `name`, `lore`, `price`, `time`, `username`, `email`, `password`) VALUES (NULL, '".$shop['name']."', '".$shop['lore']."', '".$shop['price']."', '".time()." ', '".$user['username']."', '".$rids['email']."', '".$rids['password']."'); ");
				$connect->query("UPDATE `user` SET `point` = point-'".$shop['price']."' WHERE `user`.`id` = ".$user['id']." ");
				DisplayMSG('success','Success Buy', 'ซื้อสินค้า <U>"'.$shop['name'].'"</U> สำเร็จ <br>คุณสามารถรับ ข้อมูลการใช้งานที่ <br><a class="btn btn-success" href="?page=history"><i class="fas fa-gift"></i>&nbsp;ประวัตการซื้อเลย</a>','false');
			}else {
				DisplayMSG('error','Error Buy','พ้อยของคุณไม่เพียงพอ','false');
			}
		}
		if(isset($_GET['act_jackpot'])) {
			$id = $_GET['id'];
			if(empty($id)) {
				DisplayMSG('error','Error Buy','ไม่พบ Jackpotนี้','false');
			}
			$query = $connect->query('SELECT * FROM jackpot WHERE id = "'.$id.'"');
			if($query->num_rows == 0) {
			DisplayMSG('error','Error Buy','ไม่พบ Jackpotนี้','false');
			}
			$shop = $query->fetch_assoc();
			if($user['point'] >= $shop['price']) {
function chance($percent) {
  return mt_rand(0, 99) < $percent;
}
$randbox = chance($shop['chance_s']);
if ($randbox == 1){
				$rid = $connect->query('SELECT * FROM ids WHERE status = "unbuy" AND category = "'.$shop['category'].'" ORDER BY RAND() limit 1');
				$rids = $rid->fetch_assoc();
				if ($rid->num_rows == 0){
					$data = "Stock";
					$data = "Error";
				}
				if($data == "Stock" || $data == "Error") {
					DisplayMSG('error','Error Buy','ของรางวัลหมด !!','false');
				}
				$connect->query("UPDATE `ids` SET `status` = 'buy' WHERE `ids`.`id` = ".$rids['id']." ");
				$connect->query("INSERT INTO `log_shop` (`id`, `name`, `lore`, `price`, `time`, `username`, `email`, `password`) VALUES (NULL, '".$shop['name']."', '".$shop['detail']."', '".$shop['price']."', '".time()." ', '".$user['username']."', '".$rids['email']."', '".$rids['password']."'); ");
				$connect->query("UPDATE `user` SET `point` = point-'".$shop['price']."' WHERE `user`.`id` = ".$user['id']." ");
				DisplayMSG('success','Rewards', 'สุ่มกล่อง <U>"'.$shop['name'].'"</U> ยินดีด้วยคุณได้รางวัล <br>คุณสามารถรับ ข้อมูลการใช้งานที่ <br><a class="btn btn-success" href="?page=history"><i class="fas fa-gift"></i>&nbsp;ประวัตการซื้อเลย</a>','false');
			}else {
				DisplayMSG('error','Bad Luck','เสียใจด้วย โชคร้ายไปหน่อย ลองอีกครั้งได้เลย','false');
			}
			}else {
				DisplayMSG('error','Error Buy','พ้อยของคุณไม่เพียงพอ','false');
			}
		}
		//end
}
function DisplayMSG($function,$title,$msg,$reload){
	global $url;
	if($reload == 'true') {
		$data = exit("<script>$function('$title', '$msg', 'true');setTimeout(function(){ location.href = \"$url\"; }, 2500);</script>");
	}else {
	$data = exit("<script>$function('$title', '$msg', 'false');</script>");
	}
	return $data;
}
function iDisplayMSG($function,$title,$msg,$reload,$url){
	if(empty($url)) {
		$url = "..";
	}else {
		$url = $url;
	}
	if($function == 'isuccess' || $function == 'ierror') {
		if($reload == 'true') {
			$data = "<script>$function('$title', '$msg', 'true', '$url');setTimeout(function(){ location.href = \"$url\"; }, 2500);</script>";
		}else {
			$data = "<script>$function('$title', '$msg', 'false','');</script>";
		}
	}else {
		if($reload == 'true') {
			$data = "<script>$function('$title', '$msg', 'true');setTimeout(function(){ location.href = \"$url\"; }, 2500);</script>";
		}else {
			$data = "<script>$function('$title', '$msg', 'false');</script>";
		}
	}
	echo $data;
}
function WALLET($url) {
	global $config;
	$ch = curl_init();  
	$post = [
		'email' => $config['truewallet_email'],
		'password' => $config['truewallet_password']
	];
	curl_setopt($ch, CURLOPT_URL, $url);    
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);    
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
	$data = curl_exec($ch);     
	curl_close($ch);    
	return $data; 
}
$months =array( 
			"0"=>"", "1"=>"มกราคม", "2"=>"กุมภาพันธ์", "3"=>"มีนาคม","4"=>"เมษายน","5"=>"พฤษภาคม","6"=>"มิถุนายน", "7"=>"กรกฎาคม","8"=>"สิงหาคม","9"=>"กันยายน","10"=>"ตุลาคม","11"=>"พฤศจิกายน","12"=>"ธันวาคม"
				  );
function th($time){
	global $months;
		@$th.= date("H",$time);
		@$th.= ":".date("i",$time);
		@$th.= "  วันที่ ".date("j",$time);
		@$th.= " ".$months[date("n",$time)];
		@$th.= " พ.ศ.".(date("Y",$time)+543);
	return $th;
}
function Read($file) {
	$i = file_get_contents($file);
	return $i;
}
?>