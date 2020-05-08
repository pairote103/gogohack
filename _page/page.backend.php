<?php
$id = $connect->query("SELECT * FROM log_shop")->num_rows;
$user = $connect->query("SELECT * FROM user")->num_rows;
?>
<br>
<?php
		echo '<div style="margin-bottom:30px;">';
		echo '<a class="btn btn-primary col-4" href="?page=backend&home" style="border-radius: 0px; border-top-left-radius: 4px;"><i class="fa fa-cog"></i>&nbsp;ข้อมูลเว็บไซด์</a>';
		echo '<a class="btn btn-info col-4" href="?page=backend&say" style="border-radius: 0px;"><i class="fa fa-bullhorn"></i>&nbsp;ระบบประกาศ</a>';
		echo '<a class="btn btn-warning col-4" href="?page=backend&items" style="border-radius: 0px; border-top-right-radius: 4px;"><i class="fa fa-truck"></i>&nbsp;จัดการสินค้า</a>';
		echo '<a class="btn btn-success col-4" href="?page=backend&users" style="border-radius: 0px; border-bottom-left-radius: 4px;"><i class="fa fa-users"></i>&nbsp;จัดการผู้ใช้</a>';
		echo '<a class="btn btn-danger col-4" href="?page=backend&code" style="border-radius: 0px;"><i class="fa fa-gift"></i>&nbsp;จัดการโค้ด</a>';
		echo '<a class="btn btn-dark col-4" href="?page=backend&ids" style="border-radius: 0px; border-bottom-right-radius: 4px;"><i class="fa fa-user"></i>&nbsp;จัดการไอดี</a>';
		echo '<a class="btn btn-dark col-4" href="?page=backend&jackpot" style="border-radius: 0px; border-bottom-right-radius: 4px;border-bottom-left-radius: 4px;"><i class="fa fa-box"></i>&nbsp;ระบบสุ่มของ</a>';
		echo '</div>';
if(isset($_GET['code'])) {
		if(isset($_POST['save-edit'])) {
			   $update = $connect->query("UPDATE redeem SET code = '{$_POST['code']}',
				price = '{$_POST['price']}',
				status = '{$_POST['status']}' where id = '{$_POST['save-edit']}'
			   ");
			if($update) {
					iDisplayMSG('isuccess','Success Saveed','บันทึกข้อมูลสำเร็จ','true','?page=backend&code');			
			}else {
				iDisplayMSG('error','Error Database','เกิดข้อผิดพลาด '.$query.'','false','');	
			} 
		}
		if(isset($_GET['delete'])) {
			   if(empty($_GET['number'])) {
		iDisplayMSG('error','Error Empty','กรุณาอย่าเว้นช่องว่าง','false','');
	}else {
	$query = $connect->query("SELECT * FROM redeem where id = {$_GET['number']}");
	if($query->num_rows == 1) {
		$connect->query("DELETE FROM `redeem` WHERE `redeem`.`id` = {$_GET['number']}");
		iDisplayMSG('isuccess','Success Delete','ลบโค้ดนี้ เรียบร้อย !!','true','?page=backend&code');
	}else {
		iDisplayMSG('ierror','Error Empty','ไม่พบโค้ดนี้.','true','?page=backend&code');
	}
	}
		}
		if(isset($_POST['ac'])) {
			   if(empty($_POST['code']) || empty($_POST['price'])) {
		iDisplayMSG('error','Error Empty','กรุณาอย่าเว้นช่องว่าง','false','');
	}else {
		$c_query = $connect->query('SELECT * FROM redeem WHERE code = "'.$_POST['code'].'"');
		$code_num = $c_query->num_rows;
		if ($code_num){
			iDisplayMSG('error','Error Already','โค้ดนี้ซ้ำกับโค้ดอื่น','false','');
		}else {
	$query = $connect->query("INSERT INTO redeem (code, price)
VALUES ('{$_POST['code']}', '{$_POST['price']}')");
	iDisplayMSG('isuccess','Success Add','เพิ่มโค้ด เรียบร้อย !!','true','?page=backend&code');
}
	}
		}
	?>
		<div class="card card-header bg-danger text-light" style="margin-top:20px;"><h5><i class="fa fa-gift"></i>&nbsp;จัดการระบบเเลกโค้ด</h5></div>
	<div class="card card-body">
		<?php
		if (isset($_GET['acode'])){ ?>
<center>
		 <div>
<form method="post" action="">
	
			 <div class="input-group">
				<span class="input-group-text"><i class="fas fa-gift"></i>&nbsp;โค้ด</span>
				<input type="text" class="form-control" name="code" placeholder="โค้ด">
			  </div>
			  <div class="input-group" style="margin-top: 15px;">
				<span class="input-group-text"><i class="fas fa-dollar-sign"></i>&nbsp;ราคา</span>
				<input type="text" class="form-control" name="price" placeholder="ราคา">
			  </div>
			  <br>
			  <input type="hidden" name="ac">
			  <button class="btn btn-info" type="submit"><i class="fa fa-plus"></i>&nbsp;เพิ่มโค้ด</button>
			  <a class="btn btn-warning" href="?page=backend&code"><i class="fa fa-home"></i>&nbsp;กลับ</a>
			  
			</form></div><hr>
		<?php }else { ?>
<center>
<a class="btn btn-success text-light" href="?page=backend&code&acode"><i class="fas fa-plus"></i>&nbsp;เพิ่มโค้ด</a></center><br>
	<?php	}
		if (isset($_GET['mcode'])){
$logs = $connect->query("SELECT * FROM redeem where id = '{$_GET['mcode']}'");
						while($g1 = $logs->fetch_assoc() ) {
$g['id'] = $g1['id'];							
$g['code'] = $g1['code'];
$g['price'] = $g1['price'];
$g['status'] = $g1['status'];
						}
		 ?><center>
		 <div>
<form method="post" action="">
	
			 <div class="input-group">
				<span class="input-group-text"><i class="fas fa-gift"></i>&nbsp;โค้ด</span>
				<input type="text" class="form-control" value="<?php echo $g['code'];?>" name="code" placeholder="โค้ด">
			  </div>
			  <div class="input-group" style="margin-top: 15px;">
				<span class="input-group-text"><i class="fas fa-dollar-sign"></i>&nbsp;ราคา</span>
				<input type="text" class="form-control" value="<?php echo $g['price'];?>" name="price" placeholder="ราคา">
			  </div>
			  <div class="input-group" style="margin-top: 15px;">
				<select class="form-control" name="status" id="status">
					<option <?php if($g['status'] == "Redeem"){echo "selected";} ?> >Redeem</option>
					<option <?php if($g['status'] == "UnRedeem"){echo "selected";} ?> >UnRedeem</option>
				</select>
			  </div><br>
			  <input type="hidden" name="save-edit" value="<?php echo $g['id']; ?>">
			  <button class="btn btn-success" type="submit"><i class="fa fa-save"></i>&nbsp;บันทึก</button>
			  <a class="btn btn-danger" href="javascript:cdelete('<?php echo $g['id']; ?>');"><i class="fas fa-trash-alt"></i>&nbsp;ลบโค้ด</a>
			  <a class="btn btn-warning" href="?page=backend&code"><i class="fa fa-home"></i>&nbsp;กลับ</a>
			  
			</form></div><hr>
	<?php } ?>
			<table class="table table-default table-striped table-condenseds">
				<thead>
					<tr>
						<th style="background-color: #FFF;" class="text-center text-dark">โค้ด</th>
						<th style="background-color: #FFF;" class="text-center text-dark">ราคา</th>
						<th style="background-color: #FFF;" class="text-center text-dark">สถานะ</th>
						<th style="background-color: #FFF;" class="text-center text-dark">จัดการ</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$logs = $connect->query('SELECT * FROM redeem');
						$i = '1';
						while($log = $logs->fetch_assoc() ) {
					echo '
						<tr>
							<td class="text-center">'.$log['code'].'</td>
							<td class="text-center">'.$log['price'].'</td>
							<td class="text-center"><span class="badge badge-primary" style="font-size: 17px;">'.$log['status'].'</span></td>
							<td class="text-center"><a class="btn btn-warning" href="?page=backend&code&mcode='.$log['id'].'"><i class="fa fa-cog"></i>&nbsp;จัดการ</a></td>
						</tr>
						';
						$i++;
						}
						?>
				</tbody>
			</table>
	</div>
	<?php
}

if(isset($_GET['ids'])) {
		if(isset($_POST['save-edit'])) {
			   $update = $connect->query("UPDATE ids SET `email` = '{$_POST['email']}',
				`password` = '{$_POST['password']}',
				`status` = '{$_POST['status']}',
				`category` = '{$_POST['category']}' where id = '{$_POST['save-edit']}'
			   ");
			if($update) {
					iDisplayMSG('isuccess','Success Saveed','บันทึกข้อมูลสำเร็จ','true','?page=backend&ids');			
			}else {
				iDisplayMSG('error','Error Database','เกิดข้อผิดพลาด '.$query.'','false','');	
			} 
		}
		if(isset($_GET['delete'])) {
			   if(empty($_GET['number'])) {
		iDisplayMSG('error','Error Empty','กรุณาอย่าเว้นช่องว่าง','false','');
	}else {
	$query = $connect->query("SELECT * FROM ids where id = {$_GET['number']}");
	if($query->num_rows == 1) {
		$connect->query("DELETE FROM `ids` WHERE `ids`.`id` = {$_GET['number']}");
		iDisplayMSG('isuccess','Success Delete','ลบไอดีนี้ เรียบร้อย !!','true','?page=backend&ids');
	}else {
		iDisplayMSG('ierror','Error Empty','ไม่พบไอดีนี้.','true','?page=backend&ids');
	}
	}
		}
		if(isset($_POST['ai'])) {
			if ($_POST['ai'] == "1"){
			   if(empty($_POST['email']) || empty($_POST['password']) || empty($_POST['status']) || empty($_POST['category'])) {
		iDisplayMSG('error','Error Empty','กรุณาอย่าเว้นช่องว่าง','false','');
	}else {
		$c_query = $connect->query('SELECT * FROM ids WHERE email = "'.$_POST['email'].'"');
		$code_num = $c_query->num_rows;
		if ($code_num){
			iDisplayMSG('error','Error Already','อีเมลนี้ถูกใช้ไปเเล้ว','false','');
		}else {
	$query = $connect->query("INSERT INTO ids (`email`, `password`,`status`,`category`)
VALUES ('{$_POST["email"]}', '{$_POST["password"]}','{$_POST["status"]}', '{$_POST["category"]}')");
	iDisplayMSG('isuccess','Success Add','เพิ่มไอดี เรียบร้อย !!','true','?page=backend&ids');
}
	}
}
 if ($_POST['ai'] == "2"){
	$data = explode("\n", $_POST["txt"]);
	foreach ($data as $value) {
	$ep = explode(":", $value);
	$ep[1] = str_replace(",", "", $ep[1]);
    $connect->query("INSERT INTO `ids` (`id`, `email`, `password`, `status`, `category`) VALUES (NULL, '".$ep[0]."', '".$ep[1]."', 'unbuy', '".$_POST["category"]."'); ");
    
}
iDisplayMSG('isuccess','Success Add','เพิ่มไอดี เรียบร้อย !!','true','?page=backend&ids');
}
		}
if (isset($_POST["categoryw"])){
	$connect->query("INSERT INTO `category` (`id`, `category`) VALUES (NULL, '".$_POST["categoryw"]."'); ");
	iDisplayMSG('isuccess','Success Add','เพิ่มหมวดหมู่ เรียบร้อย !!','true','?page=backend&ids');
}
	?>
	<div class="card card-header bg-dark text-light" style="margin-top:20px;"><h5><i class="fa fa-bars"></i>&nbsp;หมวดหมู่</h5></div>
	<div class="card card-body">
		<center>
			<?php
if (isset($_GET['actr'])){ ?>
	<form method="post" action="">
	
			 <div class="input-group">
				<span class="input-group-text"><i class="fas fa-bars"></i>&nbsp;หมวดหมู่</span>
				<input type="text" class="form-control" name="categoryw" placeholder="หมวดหมู่">
			  </div><br>
			  <button class="btn btn-info" type="submit"><i class="fa fa-plus"></i>&nbsp;เพิ่มหมวดหมู่</button>
			  <a class="btn btn-warning text-light" href="?page=backend&ids"><i class="fas fa-home"></i>&nbsp;กลับ</a>
			  </form>	
<?php	}else if (!isset($_GET['ectr'])){
			?>
<a class="btn btn-success text-light" href="?page=backend&ids&actr"><i class="fas fa-plus"></i>&nbsp;เพิ่มหมวดหมู่</a>
<?php }
			   
if (isset($_GET['ectr'])){
if (isset($_GET['euctr'])){
	if (isset($_POST['ucategory'])){
		$ucsql = $connect->query("UPDATE category SET `category` = '{$_POST['ucategory']}' where id = '{$_GET['euctr']}'");
		iDisplayMSG('isuccess','Success Update','เเก้ไขหมวดหมู่ เรียบร้อย !!','true','?page=backend&ids&ectr');
	}
	if (isset($_GET['ductr'])){
		$dcsql = $connect->query("DELETE FROM `category` WHERE `id` = {$_GET['ductr']}");
		if ($dcsql){
		iDisplayMSG('isuccess',$_GET['euctr'],'ลบหมวดหมู่ เรียบร้อย !!','true','?page=backend&ids&ectr');
	}
	}
$euctr = $connect->query('SELECT * FROM category WHERE id = "'.$_GET['euctr'].'"');
$euctrf = $euctr->fetch_assoc();
 ?>
	<form method="post" action="">
	
			 <div class="input-group">
				<span class="input-group-text"><i class="fas fa-edit"></i>&nbsp;เเก้ไขหมวดหมู่</span>
				<input type="text" class="form-control" name="ucategory" placeholder="หมวดหมู่" value="<?php echo $euctrf['category']; ?>">
			  </div><br>
			  <button class="btn btn-info" type="submit"><i class="fa fa-save"></i>&nbsp;บันทึกหมวดหมู่</button>
			  <a class="btn btn-danger col-md-1 col-3" href="?page=backend&ids&ectr&euctr&ductr=<?php echo $euctrf['id']; ?>" style="height: 38px;"><i class="fa fa-trash-alt"></i>&nbsp;ลบ</a>
			  </form>
<?php }
 ?>

<?php $logs = $connect->query("SELECT * FROM category");
						while($g1 = $logs->fetch_assoc() ) {
$g4['id'] = $g1['id'];							
$g4['category'] = $g1['category'];
						 ?>
<div class="row justify-content-md-center">
						<div class="col-md-6 col-12">
						<div class="alert" style="background-color: #8ad919; color: #fff; font-size: 19px; height: 60px;"><h4 class="float-left" style="margin-top: 3px;"><?php echo $g4['category']; ?></h4>
							<a class="btn btn-warning col-md-3 col-5 float-right" href="?page=backend&ids&ectr&euctr=<?php echo $g4['id']; ?>"><i class="fa fa-edit"></i>&nbsp;เเก้ไข</a>
						</div>
					</div></div>
<?php } ?>
				<br>
			  <a class="btn btn-warning text-light" href="?page=backend&ids"><i class="fas fa-home"></i>&nbsp;กลับ</a>
			
			  
<?php	}else if (!isset($_GET['actr'])){
			?>
<a class="btn btn-danger text-light" href="?page=backend&ids&ectr"><i class="fas fa-edit"></i>&nbsp;เเก้ไขหมวดหมู่</a>
<br>
<div class="input-group" style="margin-top: 15px;">
			<span class="input-group-text"><i class="fas fa-edit"></i>&nbsp;เลือกหมวดหมู่</span>
				<select class="form-control" name="category" id="category" onchange="javascript:oc(this.value);">
					<option selected="" value="all">ทั้งหมด</option>
					<?php
$logs = $connect->query("SELECT * FROM category");
						while($g1 = $logs->fetch_assoc() ) {
$g['id'] = $g1['id'];							
$g['category'] = $g1['category'];
echo '<option value="'.$g['id'].'">'.$g['category'].'</option>';
						}
					?>
					
				</select>
			  </div>		
<?php } ?>
</center>
	</div>
		<div class="card card-header bg-dark text-light" style="margin-top:20px;"><h5><i class="fa fa-user"></i>&nbsp;จัดการไอดี</h5></div>
	<div class="card card-body">
		<?php
		if (isset($_GET['adid'])){ ?>
<center>
		 <div class="row justify-content-md-center">
		 	<div class="col-md-6">
<form method="post" action="">
	
			 <div class="input-group">
				<span class="input-group-text"><i class="fas fa-envelope"></i>&nbsp;อีเมล</span>
				<input type="text" class="form-control" name="email" placeholder="อีเมล">
			  </div>
			  <div class="input-group" style="margin-top: 15px;">
				<span class="input-group-text"><i class="fas fa-lock"></i>&nbsp;รหัสผ่าน</span>
				<input type="text" class="form-control" name="password" placeholder="รหัสผ่าน">
			  </div>
			  <div class="input-group" style="margin-top: 15px;">
				<select class="form-control" name="status" id="status">
					<option value="unbuy" selected>ยังไม่ซื้อ</option>
					<option value="buy">ซื้อเเล้ว</option>
				</select>
			  </div>
			  <select class="form-control" name="category" id="category" style="margin-top: 15px;">
					<?php
$logs = $connect->query("SELECT * FROM category");
						while($g1 = $logs->fetch_assoc() ) {
$g3['id'] = $g1['id'];							
$g3['category'] = $g1['category'];
echo '<option value="'.$g3['id'].'">'.$g3['category'].'</option>';
						}
					?>
					
				</select>
			  <br>
			  <input type="hidden" name="ai" value="1">
			  <button class="btn btn-success" type="submit"><i class="fa fa-plus"></i>&nbsp;เพิ่มไอดี</button>
			  <a class="btn btn-warning" href="?page=backend&ids"><i class="fa fa-home"></i>&nbsp;กลับ</a>
			  
			</form></div>
<div class="col-md-6">
<form method="post" action="">
			 <textarea class="form-control" style="height: 200px;" name="txt" placeholder="dev@itorkungz.me:passw0rd
game@itorkungz.me:passw1rd"></textarea>
			 <select class="form-control" name="category" id="category" style="margin-top: 15px;">
					<?php
$logs = $connect->query("SELECT * FROM category");
						while($g1 = $logs->fetch_assoc() ) {
$g3['id'] = $g1['id'];							
$g3['category'] = $g1['category'];
echo '<option value="'.$g3['id'].'">'.$g3['category'].'</option>';
						}
					?>
					
				</select>
			  <br>
			  <input type="hidden" name="ai" value="2">
			  <button class="btn btn-dark" type="submit"><i class="fa fa-plus"></i>&nbsp;เพิ่มไอดี</button>
			  <a class="btn btn-danger" href="?page=backend&ids"><i class="fa fa-home"></i>&nbsp;กลับ</a>
			  
			</form></div>
		</div><hr>
		<?php }else { ?>
<center>
<a class="btn btn-dark text-light" href="?page=backend&ids&adid"><i class="fas fa-plus"></i>&nbsp;เพิ่มไอดี</a><br><span class="badge badge-primary" style="margin-top: 15px; font-size: 18px;">มีไอดีในระบบทั้งหมด : <?php echo $connect->query("SELECT * FROM ids")->num_rows; ?> ไอดี</span></center><br>
	<?php	}
		if (isset($_GET['uid'])){
$logs = $connect->query("SELECT * FROM ids where id = '{$_GET['uid']}'");
						while($g1 = $logs->fetch_assoc() ) {
$g['id'] = $g1['id'];							
$g['email'] = $g1['email'];
$g['password'] = $g1['password'];
$g['status'] = $g1['status'];
$g['category'] = $g1['category'];
						}
		 ?><center>
		 <div class="row justify-content-md-center">
		 	<div class="col-md-12">
<form method="post" action="">
	
			 <div class="input-group">
				<span class="input-group-text"><i class="fas fa-envelope"></i>&nbsp;อีเมล</span>
				<input type="text" class="form-control" value="<?php echo $g['email'];?>" name="email" placeholder="อีเมล">
			  </div>
			  <div class="input-group" style="margin-top: 15px;">
				<span class="input-group-text"><i class="fas fa-lock"></i>&nbsp;รหัสผ่าน</span>
				<input type="text" class="form-control" value="<?php echo $g['password'];?>" name="password" placeholder="รหัสผ่าน">
			  </div>
			  <div class="input-group" style="margin-top: 15px;">
				<select class="form-control" name="status" id="status">
					<option <?php if($g['status'] == "buy"){echo "selected";} ?> value="buy">ซื้อเเล้ว</option>
					<option <?php if($g['status'] == "unbuy"){echo "selected";} ?> value="unbuy">ยังไม่ซื้อ</option>
				</select>
			  </div><br>
			  <select class="form-control" name="category" id="category">
					<?php
$logs = $connect->query("SELECT * FROM category");
						while($g1 = $logs->fetch_assoc() ) {
$g2['id'] = $g1['id'];							
$g2['category'] = $g1['category'];
if ($g2['id'] == $g['category']){
	$isl = "selected";
}else {
	$isl = null;
}
echo '<option value="'.$g2['id'].'" '.$isl.'>'.$g2['category'].'</option>';
						}
					?>
				</select>
			  <br>
			  <input type="hidden" name="save-edit" value="<?php echo $g['id']; ?>">
			  <button class="btn btn-success" type="submit"><i class="fa fa-save"></i>&nbsp;บันทึก</button>
			  <a class="btn btn-danger" href="javascript:iddelete('<?php echo $g['id']; ?>');"><i class="fas fa-trash-alt"></i>&nbsp;ลบไอดีนี้</a>
			  <a class="btn btn-warning" href="?page=backend&ids"><i class="fa fa-home"></i>&nbsp;กลับ</a>
			  
			</form></div>

		</div><hr>
	<?php } ?>
			<div id="return"><table class="table table-default table-striped table-condenseds">
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
			</table></div>
	</div>
	<?php
}

if(isset($_GET['say'])) {
		if(isset($_POST['save-edit'])) {
			   $update = $connect->query("UPDATE say SET
				`news` = '{$_POST['say']}' where id = '{$_POST['save-edit']}'
			   ");
			if($update) {
					iDisplayMSG('isuccess','Success Saveed','บันทึกข้อมูลสำเร็จ','true','?page=backend&say');			
			}else {
				iDisplayMSG('error','Error Database','เกิดข้อผิดพลาด '.$query.'','false','');	
			}
		}
	?>
		<div class="card card-header bg-info text-light" style="margin-top:20px;"><h5><i class="fa fa-bullhorn"></i>&nbsp;ระบบประกาศ</h5></div>
	<div class="card card-body">
	<?php	if (isset($_GET['usay'])){
$querys = $connect->query("SELECT * FROM say where id = {$_GET['usay']}");
$say = $querys->fetch_assoc();
	 ?>
		<center>
		 <div>
<form method="post" action="">
			  <div class="input-group" style="margin-top: 15px;">
				<span class="input-group-text"><i class="fas fa-bullhorn"></i>&nbsp;ประกาศ</span>
				<input type="text" class="form-control" name="say" placeholder="ประกาศ" value="<?php echo $say['news']; ?>">
			  </div>
			  <br>
			  <input type="hidden" name="save-edit" value="<?php echo $say['id']; ?>">
			  <button class="btn btn-info" type="submit"><i class="fa fa-plus"></i>&nbsp;เเก้ไข</button>
			  <a class="btn btn-warning" href="?page=backend&say"><i class="fa fa-home"></i>&nbsp;กลับ</a>
			  
			</form></div><hr>
		<?php }
$querys1 = $connect->query("SELECT * FROM config");
$say1 = $querys1->fetch_assoc();
		 ?>
		<div class="custom-control custom-checkbox mr-sm-2">
        <input type="checkbox" class="custom-control-input" id="customControlAutosizing" onchange="osay(this.value);" <?php if ($say1['say'] == "on"){
        	echo "checked";
        } ?>>
        <label class="custom-control-label" for="customControlAutosizing">เปิดใช้งาน</label>
        <div id="return"></div>
      </div>
			<table class="table table-default table-striped table-condenseds">
				<thead>
					<tr>
						<th style="background-color: #FFF;" class="text-center text-dark">ประกาศ</th>
						<th style="background-color: #FFF;" class="text-center text-dark">เเก้ไข</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$logs = $connect->query('SELECT * FROM say');
						$i = '1';
						while($log = $logs->fetch_assoc() ) {
					echo '
						<tr>
							<td class="text-center">'.$log['news'].'</td>
							<td class="text-center"><a class="btn btn-warning" href="?page=backend&say&usay='.$log['id'].'"><i class="fa fa-edit"></i>&nbsp;เเก้ไข</a></td>
						</tr>
						';
						$i++;
						}
						?>
				</tbody>
			</table>
	</div>
	<?php
}

if(isset($_GET['users'])) {
		if(isset($_POST['save-edit'])) {
			if ($_POST['password'] == $_POST['repassword']){
				if (isset($_POST['password'])){
				$pw = md5($_POST['password']."bXdUeXX6Tzs7utwP");
			   $update = $connect->query("UPDATE user SET `username` = '{$_POST['username']}',
				`point` = '{$_POST['point']}',
				`password` = '{$pw}',
				`ban` = '{$_POST['status']}',
				`rank` = '{$_POST['rank']}' where id = '{$_POST['save-edit']}'
			   ");
			}else {
			   $update = $connect->query("UPDATE user SET `username` = '{$_POST['username']}',
				`point` = '{$_POST['point']}',
				`ban` = '{$_POST['status']}',
				`rank` = '{$_POST['rank']}' where id = '{$_POST['save-edit']}'
			   ");
			}
			if($update) {
					iDisplayMSG('isuccess','Success Saveed','บันทึกข้อมูลสำเร็จ','true','?page=backend&users');			
			}else {
				iDisplayMSG('error','Error Database','เกิดข้อผิดพลาด '.$query.'','false','');	
			} 
		}else {
			iDisplayMSG('error','Error Password','รหัสผ่านไม่ตรงกัน','false','');
		}
		}
		if(isset($_GET['delete'])) {
			   if(empty($_GET['number'])) {
		iDisplayMSG('error','Error Empty','กรุณาอย่าเว้นช่องว่าง','false','');
	}else {
	$query = $connect->query("SELECT * FROM user where id = {$_GET['number']}");
	if($query->num_rows == 1) {
		$connect->query("DELETE FROM `user` WHERE `user`.`id` = {$_GET['number']}");
		iDisplayMSG('isuccess','Success Delete','ลบผู้ใช้นี้ เรียบร้อย !!','true','?page=backend&users');
	}else {
		iDisplayMSG('ierror','Error Empty','ไม่พบผู้ใช้นี้.','true','?page=backend&users');
	}
	}
		}
		if(isset($_POST['au'])) {
			   if(empty($_POST['username']) || empty($_POST['point']) || empty($_POST['password']) || empty($_POST['repassword']) || empty($_POST['status']) || empty($_POST['rank'])) {
		iDisplayMSG('error','Error Empty','กรุณาอย่าเว้นช่องว่าง','false','');
	}else {
		$c_query = $connect->query('SELECT * FROM user WHERE username = "'.$_POST['username'].'"');
		$code_num = $c_query->num_rows;
		if ($code_num){
			iDisplayMSG('error','Error Already','ชื่อผู้ใช้ถูกใช้ไปเเล้ว','false','');
		}else {
	if ($_POST['password'] == $_POST['repassword']){
	$pw = md5($_POST['password']."bXdUeXX6Tzs7utwP");
	$query = $connect->query("INSERT INTO user (`username`, `password`,`ip`, `point`,`ban`,`rank`)
VALUES ('{$_POST["username"]}', '{$pw}','{$_SERVER["REMOTE_ADDR"]}', '{$_POST["point"]}', '{$_POST["status"]}', '{$_POST["rank"]}')");
	iDisplayMSG('isuccess','Success Add','เพิ่มผู้ใช้ เรียบร้อย !!','true','?page=backend&users');
}else {
	iDisplayMSG('error','Error Password','รหัสผ่านไม่ตรงกัน','false','');
}
}
	}
		}
	?>
		<div class="card card-header bg-success text-light" style="margin-top:20px;"><h5><i class="fa fa-users"></i>&nbsp;จัดการผู้ใช้</h5></div>
	<div class="card card-body">
		<?php
		if (isset($_GET['auser'])){ ?>
<center>
		 <div>
<form method="post" action="">
	
			 <div class="input-group">
				<span class="input-group-text"><i class="fas fa-edit"></i>&nbsp;ชื่อผู้ใช้</span>
				<input type="text" class="form-control" name="username" placeholder="ชื่อผู้ใช้">
			  </div>
			  <div class="input-group" style="margin-top: 15px;">
				<span class="input-group-text"><i class="fas fa-dollar-sign"></i>&nbsp;พ้อยท์</span>
				<input type="text" class="form-control" name="point" placeholder="พ้อยท์" value="0.00">
			  </div>
			  <div class="input-group" style="margin-top: 15px;">
				<span class="input-group-text"><i class="fas fa-dollar-sign"></i>&nbsp;รหัสผ่าน</span>
				<input type="text" class="form-control" name="password" placeholder="รหัสผ่าน">
			  </div>
			  <div class="input-group" style="margin-top: 15px;">
				<span class="input-group-text"><i class="fas fa-dollar-sign"></i>&nbsp;ยืนยันรหัสผ่าน</span>
				<input type="text" class="form-control" name="repassword" placeholder="ยืนยันรหัสผ่าน">
			  </div>
			  <div class="input-group" style="margin-top: 15px;">
				<select class="form-control" name="status" id="status">
					<option value="true">เเบน</option>
					<option value="false" selected>ไม่เเบน</option>
				</select>
			  </div>
			  <div class="input-group" style="margin-top: 15px;">
				<select class="form-control" name="rank" id="rank">
					<option value="Member">ผู้ใช้</option>
					<option value="Admin" selected>เเอดมิน</option>
				</select>
			  </div>
			  <br>
			  <input type="hidden" name="au">
			  <button class="btn btn-info" type="submit"><i class="fa fa-plus"></i>&nbsp;เพิ่มผู้ใช้</button>
			  <a class="btn btn-warning" href="?page=backend&users"><i class="fa fa-home"></i>&nbsp;กลับ</a>
			  
			</form></div><hr>
		<?php }else { ?>
<center>
<a class="btn btn-warning text-light" href="?page=backend&users&auser"><i class="fas fa-plus"></i>&nbsp;เพิ่มผู้ใช้</a></center><br>
	<?php	}
		if (isset($_GET['ucode'])){
$logs = $connect->query("SELECT * FROM user where id = '{$_GET['ucode']}'");
						while($g1 = $logs->fetch_assoc() ) {
$g['id'] = $g1['id'];							
$g['username'] = $g1['username'];
$g['point'] = $g1['point'];
$g['ban'] = $g1['ban'];
$g['rank'] = $g1['rank'];
						}
		 ?><center>
		 <div>
<form method="post" action="">
	
			 <div class="input-group">
				<span class="input-group-text"><i class="fas fa-edit"></i>&nbsp;ชื่อผู้ใช้</span>
				<input type="text" class="form-control" value="<?php echo $g['username'];?>" name="username" placeholder="ชื่อผู้ใช้">
			  </div>
			  <div class="input-group" style="margin-top: 15px;">
				<span class="input-group-text"><i class="fas fa-dollar-sign"></i>&nbsp;พ้อยท์</span>
				<input type="text" class="form-control" value="<?php echo $g['point'];?>" name="point" placeholder="พ้อยท์">
			  </div>
			  <div class="input-group" style="margin-top: 15px;">
				<span class="input-group-text"><i class="fas fa-lock"></i>&nbsp;รหัสผ่าน</span>
				<input type="text" class="form-control" name="password" placeholder="รหัสผ่าน">
			  </div>
			  <div class="input-group" style="margin-top: 15px;">
				<span class="input-group-text"><i class="fas fa-lock"></i>&nbsp;ยืนยันรหัสผ่าน</span>
				<input type="text" class="form-control" name="repassword" placeholder="ยืนยันรหัสผ่าน">
			  </div>
			  <div class="input-group" style="margin-top: 15px;">
				<select class="form-control" name="status" id="status">
					<option <?php if($g['ban'] == "true"){echo "selected";} ?> value="true">เเบน</option>
					<option <?php if($g['ban'] == "false"){echo "selected";} ?> value="false">ไม่เเบน</option>
				</select>
			  </div>
			  <div class="input-group" style="margin-top: 15px;">
				<select class="form-control" name="rank" id="rank">
					<option <?php if($g['rank'] == "Admin"){echo "selected";} ?> value="Admin">เเอดมิน</option>
					<option <?php if($g['rank'] == "User"){echo "selected";} ?> value="Member">ผู้ใช้</option>
				</select>
			  </div>
			  <br>
			  <input type="hidden" name="save-edit" value="<?php echo $g['id']; ?>">
			  <button class="btn btn-success" type="submit"><i class="fa fa-save"></i>&nbsp;บันทึก</button>
			  <a class="btn btn-danger" href="javascript:udelete('<?php echo $g['id']; ?>');"><i class="fas fa-trash-alt"></i>&nbsp;ลบผู้ใช้</a>
			  <a class="btn btn-warning" href="?page=backend&users"><i class="fa fa-home"></i>&nbsp;กลับ</a>
			  
			</form></div><hr>
	<?php } ?>
			<table class="table table-default table-striped table-condenseds">
				<thead>
					<tr>
						<th style="background-color: #FFF;" class="text-center text-dark">ชื่อผู้ใช้</th>
						<th style="background-color: #FFF;" class="text-center text-dark">พ้อยท์</th>
						<th style="background-color: #FFF;" class="text-center text-dark">เเบน</th>
						<th style="background-color: #FFF;" class="text-center text-dark">ยศ</th>
						<th style="background-color: #FFF;" class="text-center text-dark">จัดการ</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$logs = $connect->query('SELECT * FROM user');
						$i = '1';
						while($log = $logs->fetch_assoc() ) {
							if ($log['ban'] == "true"){
								$bs = "โดนเเบน";
							}else {
								$bs = "ไม่โดนเเบน";
							}
					echo '
						<tr>
							<td class="text-center">'.$log['username'].'</td>
							<td class="text-center">'.$log['point'].'</td>
							<td class="text-center"><span class="badge badge-success" style="font-size: 17px;">'.$bs.'</span></td>
							<td class="text-center"><span class="badge badge-info" style="font-size: 17px;">'.$log['rank'].'</span></td>
							<td class="text-center"><a class="btn btn-warning" href="?page=backend&users&ucode='.$log['id'].'"><i class="fa fa-cog"></i>&nbsp;จัดการ</a></td>
						</tr>
						';
						$i++;
						}
						?>
				</tbody>
			</table>
	</div>
	<?php
}
if(isset($_GET['home'])) {
		if(isset($_POST['save-edit'])) {
			   $update = $connect->query("UPDATE config SET title = '{$_POST['title']}',
				description = '{$_POST['description']}',
				icon = '{$_POST['icon']}',
				name = '{$_POST['name']}',
				www = '{$_POST['www']}',
				alert = '{$_POST['alert']}',
				website = '{$_POST['website']}',
				me = '{$_POST['me']}',
				promotion_tm = '{$_POST['promotion_tm']}',
				promotion_tw = '{$_POST['promotion_tw']}',
				truewallet_phone = '{$_POST['truewallet_phone']}',
				truewallet_name = '{$_POST['truewallet_name']}',
				truewallet_msg = '{$_POST['truewallet_msg']}',
				truewallet_email = '{$_POST['truewallet_email']}',
				truewallet_password = '{$_POST['truewallet_password']}',
				nav = '{$_POST['color']}'
			   ");
			if($update) {
					iDisplayMSG('isuccess','Success Saveed','บันทึกข้อมูลสำเร็จ','true','?page=backend&home');			
			}else {
				iDisplayMSG('error','Error Database','เกิดข้อผิดพลาด '.$query.'','false','');	
			} 
		}
	?>
		<form method="post">
			 <div class="input-group">
				<span class="input-group-text"><i class="fas fa-edit"></i>&nbsp;Title</span>
				<input type="text" class="form-control" value="<?php echo $config['title'];?>" name="title" placeholder="Title">
			  </div>
			  <div class="input-group">
				<span class="input-group-text"><i class="fas fa-edit"></i>&nbsp;Description</span>
				<input type="text" class="form-control" value="<?php echo $config['description'];?>" name="description" placeholder="Description">
			  </div>
			  <div class="input-group">
				<span class="input-group-text"><i class="fas fa-edit"></i>&nbsp;Icon</span>
				<input type="text" class="form-control" value="<?php echo $config['icon'];?>" name="icon" placeholder="Icon">
			  </div>
			  <div class="input-group">
				<span class="input-group-text"><i class="fas fa-edit"></i>&nbsp;Name</span>
				<input type="text" class="form-control" value="<?php echo $config['name'];?>" name="name" placeholder="Name">
			  </div>
			  <div class="input-group">
				<span class="input-group-text"><i class="fas fa-edit"></i>&nbsp;Www</span>
				<input type="text" class="form-control" value="<?php echo $config['www'];?>" name="www" placeholder="www">
			  </div>
			  <div class="input-group">
				<span class="input-group-text"><i class="fas fa-edit"></i>&nbsp;Domain</span>
				<input type="text" class="form-control" value="<?php echo $config['website'];?>" name="website" placeholder="Domain">
			  </div>
			  <div class="input-group">
				<span class="input-group-text"><i class="fas fa-edit"></i>&nbsp;Alert News</span>
				<input type="text" class="form-control" value="<?php echo $config['alert'];?>" name="alert" placeholder="Alert News">
			  </div>
			  
			  <div class="input-group" style="margin-top:25px;">
				<span class="input-group-text"><i class="fab fa-facebook-square"></i>&nbsp;Facebook Pange</span>
				<input type="text" class="form-control" value="<?php echo $config['me'];?>" name="me" placeholder="Facebook Pange">
			  </div>
			  
			  
			  <div class="input-group" style="margin-top:25px;">
				<span class="input-group-text"><i class="fas fa-edit"></i>&nbsp;Promotion TrueMoney</span>
				<input type="text" class="form-control" value="<?php echo $config['promotion_tm'];?>" name="promotion_tm" placeholder="Promotion TrueMoney">
			  </div>
			  
			  <div class="input-group">
				<span class="input-group-text"><i class="fas fa-edit"></i>&nbsp;Promotion TrueWallet</span>
				<input type="text" class="form-control" value="<?php echo $config['promotion_tw'];?>" name="promotion_tw" placeholder="Promotion TrueWallet">
			  </div>
			   
			  <div class="input-group" style="margin-top:25px;">
				<span class="input-group-text"><i class="fas fa-edit"></i>&nbsp;TrueWallet Phone</span>
				<input type="text" class="form-control" value="<?php echo $config['truewallet_phone'];?>" name="truewallet_phone" placeholder="TrueWallet Phone">
			 </div>
			  <div class="input-group">
				<span class="input-group-text"><i class="fas fa-edit"></i>&nbsp;TrueWallet Name</span>
				<input type="text" class="form-control" value="<?php echo $config['truewallet_name'];?>" name="truewallet_name" placeholder="TrueWallet Name">
			 </div>
			  <div class="input-group">
				<span class="input-group-text"><i class="fas fa-edit"></i>&nbsp;TrueWallet Message</span>
				<input type="text" class="form-control" value="<?php echo $config['truewallet_msg'];?>" name="truewallet_msg" placeholder="TrueWallet Message">
			 </div>
			  <div class="input-group">
				<span class="input-group-text"><i class="fas fa-edit"></i>&nbsp;TrueWallet Email</span>
				<input type="text" class="form-control" value="<?php echo $config['truewallet_email'];?>" name="truewallet_email" placeholder="TrueWallet Email">
			 </div>
			  <div class="input-group">
				<span class="input-group-text"><i class="fas fa-edit"></i>&nbsp;TrueWallet Password</span>
				<input type="text" class="form-control" value="<?php echo $config['truewallet_password'];?>" name="truewallet_password" placeholder="TrueWallet Password">
			 </div><br>
			 <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name="color">
        <option value="primary" <?php if ($config['nav'] == "primary"){echo "selected";} ?>>สีฟ้าเข้ม</option>
        <option value="info" <?php if ($config['nav'] == "info"){echo "selected";} ?>>สีฟ้าอ่อน</option>
        <option value="dark" <?php if ($config['nav'] == "dark"){echo "selected";} ?>>สีดำ</option>
        <option value="success" <?php if ($config['nav'] == "success"){echo "selected";} ?>>สีเขียว</option>
        <option value="warning" <?php if ($config['nav'] == "warning"){echo "selected";} ?>>สีส้ม</option>
        <option value="danger" <?php if ($config['nav'] == "danger"){echo "selected";} ?>>สีเเดง</option>
      </select>
				
				<button type="submit" style="margin-top:20px;" name="save-edit" class="btn btn-success btn-block"><i class="fas fa-edit"></i>&nbsp;เซฟการตั้งค่า</button>
			 
		</form>
	<?php
}
if(isset($_GET['items'])) {
		if(isset($_GET['edit'])){
		$query = $connect->query("SELECT * FROM shop WHERE id = {$_GET['edit']}");
		$data = $query->fetch_assoc();
?>
<i class="fa fa-shopping-cart"></i>&nbsp;จัดการสินค้า<hr>
<div class="row justify-content-md-center">
	<div class="col-md-5">
	<div style="background: white;border-radius: 10px;padding: 20px;" >
		<i class="fa fa-shopping-cart"></i>&nbsp;<text>จัดการสินค้า</text><hr>
	<form method="post" action="?page=backend&items&edit=<?php echo $_GET['edit'] ?>&act=save">
				<div class="input-group mb-3">
					  <div class="input-group-prepend">
						<span class="input-group-text" id="basic-addon1">ชื่อ : </span>
					  </div>
					  <input type="text" name="name" class="form-control" placeholder="ชื่อ" value="<?php echo $data['name']; ?>">
				</div>
				<div class="input-group mb-3">
					  <div class="input-group-prepend">
						<span class="input-group-text" id="basic-addon1">รูปภาพ : </span>
					  </div>
					  <input type="text" name="img" class="form-control" placeholder="รูปภาพ" value="<?php echo $data['img']; ?>">
				</div>
				<div class="input-group mb-3">
					  <div class="input-group-prepend">
						<span class="input-group-text" id="basic-addon1">ข้อมูล : </span>
					  </div>
						<input type="text" name="lore" class="form-control" placeholder="ข้อมูล" value="<?php echo $data['lore']; ?>">
				</div>
				<div class="input-group mb-3">
				  <div class="input-group-prepend">
					<span class="input-group-text" id="basic-addon1">ราคา : </span>
				  </div>
					<input type="text" name="price" class="form-control" placeholder="ราคา" value="<?php echo $data['price']; ?>">
				</div>
					<div class="input-group mb-3">
				  <div class="input-group-prepend">
					<span class="input-group-text" id="basic-addon1">หมวดหมู่ไอดี : </span>
				  </div>
				  <select class="form-control" name="categoryug" id="categoryug">
					<?php
$logs = $connect->query("SELECT * FROM category");
						while($g12 = $logs->fetch_assoc() ) {
$g21['id'] = $g12['id'];							
$g21['category'] = $g12['category'];
if ($g21['id'] == $data['category']){
	$ise = "selected";
}else {
	$ise = null;
}
echo '<option value="'.$g21['id'].'" '.$ise.'>'.$g21['category'].'</option>';
						}
					?>
					
				</select>
				</div>
		<button type="submit" class="btn btn-danger btn-block"><i class="fa fa-save"></i>&nbsp;บันทึกข้อมูล</button>
		<a href="?page=backend&items" class="btn btn-primary btn-block"><i class="fa fa-home"></i>&nbsp;กลับ</a>
	</div>
	</div>
					
			</form>	
</div>

<?php 
	if(@$_GET['act'] == "save"){
		if(empty($_POST['name']) || empty($_POST['img']) || empty($_POST['lore']) || empty($_POST['price']) || empty($_POST['categoryug']) ){
			iDisplayMSG('error','Error Empty','กรุณากรอกข้อมูลให้ครบ','false','');
		}else{
			$query = $connect->query("UPDATE shop SET name = '{$_POST['name']}', img = '{$_POST['img']}',lore = '{$_POST['lore']}',price = '{$_POST['price']}',category = '{$_POST['categoryug']}' WHERE id = '{$_GET['edit']}'");
		if($query){
			iDisplayMSG('isuccess','Success Saveed','บันทึกข้อมูลสำเร็จ','true','?page=backend&items&edit='.$_GET['edit']);
		}else{
			iDisplayMSG('error','Error Database','เกิดข้อผิดพลาด '.$query.'','false','');			
			}
		}
	}
	  echo '<hr>';
}
if(isset($_GET['add'])) {
	if(isset($_POST['add-items'])) {
			if(empty($_POST['name']) || empty($_POST['img']) || empty($_POST['lore']) || empty($_POST['price']) || empty($_POST['category'])){
				iDisplayMSG('error','Error Empty','กรุณากรอกข้อมูลให้ครบ !!','false','');
	}else {
		$query = $connect->query("INSERT INTO `shop` (`id`, `name`, `lore`, `category`, `price`, `img`) VALUES (NULL, '{$_POST['name']}', '{$_POST['lore']}', '{$_POST['category']}', '{$_POST['price']}', '{$_POST['img']}');");
		if($query) {
			iDisplayMSG('isuccess','Success Added','เพิ่มสินค้าเรียบร้อย','true','?page=backend&items');
		}else {
			iDisplayMSG('error','Error Database','เกิดข้อผิดพลาด '.$query.'','false','');			
		}
	}
}
?>
<i class="fa fa-shopping-cart"></i>&nbsp;จัดการสินค้า<hr>
<div class="row justify-content-md-center">
	<div class="col-12 col-md-5">
	<div style="background: white;border-radius: 10px;padding: 20px;" >
		<i class="fa fa-shopping-cart"></i>&nbsp;<text>เพิ่มสินค้า</text><hr>
<form method="post">
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">ชื่อ : </span>
  </div>
  <input type="text" name="name" class="form-control" placeholder="ชื่อ">
</div>
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">รูปภาพ : </span>
  </div>
  <input type="text" name="img" class="form-control" placeholder="รูปภาพ">
</div>
 <div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">ข้อมูล : </span>
  </div>
  <input type="text" name="lore" class="form-control" placeholder="ข้อมูล">
</div>
 <div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">ราคา : </span>
  </div>
  <input type="text" name="price" class="form-control" placeholder="ราคา">
</div>
 <div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">หมวดหมู่ไอดี : </span>
  </div>
  <select class="form-control" name="category" id="category">
					<?php
$logs = $connect->query("SELECT * FROM category");
						while($g1 = $logs->fetch_assoc() ) {
$g['id'] = $g1['id'];							
$g['category'] = $g1['category'];
echo '<option value="'.$g['id'].'">'.$g['category'].'</option>';
						}
					?>
					
				</select>
</div>
<button type="submit" name="add-items" class="btn btn-danger btn-block"><i class="fa fa-save"></i>&nbsp;เพิ่มสินค้า</button>
			</form>
 <a href="?page=backend&items" class="btn btn-primary btn-block"><i class="fa fa-home"></i>&nbsp;กลับ</a>
	</div>
	</div>
</div>
			<?php
		}
	echo '
		<div class="row" style="margin-top:20px;">
	';
if(isset($_GET['delete'])) {
	if(empty($_GET['number'])) {
		iDisplayMSG('error','Error Empty','กรุณาอย่าเว้นช่องว่าง','false','');
	}else {
	$query = $connect->query("SELECT * FROM shop where id = {$_GET['number']}");
	if($query->num_rows == 1) {
		$connect->query("DELETE FROM `shop` WHERE `shop`.`id` = {$_GET['number']}");
		iDisplayMSG('isuccess','Success Delete','ลบสินค้านี้ เรียบร้อย !!','true','?page=backend&items');
	}else {
		iDisplayMSG('ierror','Error Empty','ไม่พบสินค้านี้.','true','?page=backend&items');
	}
	}
}
$query = $connect->query("SELECT * FROM shop");
while($ez = $query->fetch_assoc()){
$logs = $connect->query("SELECT * FROM category where id = '{$ez['category']}'");
						while($g1 = $logs->fetch_assoc() ) {
$g6['id'] = $g1['id'];
$g6['category'] = $g1['category'];
$ls = $connect->query("SELECT * FROM ids where category = '{$g1['id']}'")->num_rows;
						}
?>
	<div class="col-6 col-md-4" style="  padding: 5px;">
		<div class="card" style="padding: 10px; background: rgba(0,0,0,0.1); ">
			<img class="card-img-top" src="<?php echo $ez['img']; ?>" style="width:320px;height:300px;">
		<div class="card-body" style="background: white;">
			Name : <?php echo $ez['name']; ?>
			<br>Lore :<br>&nbsp;<?php  echo $ez['lore']; ?>
			<br>Price : <?php  echo $ez['price']; ?>
			<br>หมวดหมู่ : <?php  echo $g6['category'].' ('.$ls.' ไอดี)';?><hr>
			<a class="btn btn-success btn-block" href="?page=backend&items&edit=<?php echo $ez['id']; ?>"><i class="fa fa-cog"></i>&nbsp;แก้ไขสินค้า</a>
			<a class="btn btn-danger btn-block" href="javascript:idelete('<?php echo $ez['id'] ?>');"><i class="fas fa-trash-alt"></i>&nbsp;ลบสินค้า</a>
		</div>
		</div>
	</div>
<?php
}
?>
	<div class="col-6 col-md-4" style="padding: 5px;">
		<div class="card" style="padding: 10px; background: rgba(0,0,0,0.1); ">
		<div class="card-body" style="background: white;">
		<center><img src="https://www.colourbox.com/preview/5697410-icon-plus-black.jpg" style="width: 30%">
			<hr>
			<h3>เพิ่มสินค้า</h3></center>
			<a class="btn btn-info btn-block" style="margin-top:20px;" href="?page=backend&items&add"><i class="fas fa-cart-plus"></i>&nbsp;เพิ่มสินค้า</a>
		</div>
		</div>
	</div>
<?php
echo ' </div>';
	}

if(isset($_GET['jackpot'])) {
		if(isset($_GET['edit'])){
		$query = $connect->query("SELECT * FROM jackpot WHERE id = {$_GET['edit']}");
		$data = $query->fetch_assoc();
?>
<i class="fa fa-shopping-cart"></i>&nbsp;จัดการ Jackpot<hr>
<div class="row justify-content-md-center">
	<div class="col-md-5">
	<div style="background: white;border-radius: 10px;padding: 20px;" >
		<i class="fa fa-shopping-cart"></i>&nbsp;<text>จัดการสินค้า</text><hr>
	<form method="post" action="?page=backend&jackpot&edit=<?php echo $_GET['edit'] ?>&act=save">
				<div class="input-group mb-3">
					  <div class="input-group-prepend">
						<span class="input-group-text" id="basic-addon1">ชื่อ : </span>
					  </div>
					  <input type="text" name="name" class="form-control" placeholder="ชื่อ" value="<?php echo $data['name']; ?>">
				</div>
				<div class="input-group mb-3">
					  <div class="input-group-prepend">
						<span class="input-group-text" id="basic-addon1">รูปภาพ : </span>
					  </div>
					  <input type="text" name="img" class="form-control" placeholder="รูปภาพ" value="<?php echo $data['img']; ?>">
				</div>
				<div class="input-group mb-3">
					  <div class="input-group-prepend">
						<span class="input-group-text" id="basic-addon1">ข้อมูล : </span>
					  </div>
						<input type="text" name="detail" class="form-control" placeholder="ข้อมูล" value="<?php echo $data['detail']; ?>">
				</div>
				<div class="input-group mb-3">
				  <div class="input-group-prepend">
					<span class="input-group-text" id="basic-addon1">ราคา : </span>
				  </div>
					<input type="text" name="price" class="form-control" placeholder="ราคา" value="<?php echo $data['price']; ?>">
				</div>
				<div class="input-group mb-3">
				  <div class="input-group-prepend">
					<span class="input-group-text" id="basic-addon1">โอกาสได้ : </span>
				  </div>
					<input type="text" name="chance_s" class="form-control" placeholder="โอกาสได้" value="<?php echo $data['chance_s']; ?>">
				</div>
				<div class="input-group mb-3">
				  <div class="input-group-prepend">
					<span class="input-group-text" id="basic-addon1">โอกาสเสีย : </span>
				  </div>
					<input type="text" name="chance_f" class="form-control" placeholder="โอกาสเสีย" value="<?php echo $data['chance_f']; ?>">
				</div>
					<div class="input-group mb-3">
				  <div class="input-group-prepend">
					<span class="input-group-text" id="basic-addon1">หมวดหมู่ไอดี : </span>
				  </div>
				  <select class="form-control" name="categoryug" id="categoryug">
					<?php
$logs = $connect->query("SELECT * FROM category");
						while($g12 = $logs->fetch_assoc() ) {
$g21['id'] = $g12['id'];							
$g21['category'] = $g12['category'];
if ($g21['id'] == $data['category']){
	$ise = "selected";
}else {
	$ise = null;
}
echo '<option value="'.$g21['id'].'" '.$ise.'>'.$g21['category'].'</option>';
						}
					?>
					
				</select>
				</div>
		<button type="submit" class="btn btn-danger btn-block"><i class="fa fa-save"></i>&nbsp;บันทึกข้อมูล</button>
		<a href="?page=backend&items" class="btn btn-primary btn-block"><i class="fa fa-home"></i>&nbsp;กลับ</a>
	</div>
	</div>
					
			</form>	
</div>

<?php 
	if(@$_GET['act'] == "save"){
		if ($_POST['chance_s'] == "0"){
			$ps = "1";
 			$pf = "1";
		}else if ($_POST['chance_f'] == "0"){
			$ps = "1";
 			$pf = "1";
		}else if (isset($_POST['chance_s']) || isset($_POST['chance_f'])){
 			$ps = "1";
 			$pf = "1";
		}
		if(empty($_POST['name']) || empty($_POST['img']) || empty($_POST['detail']) || empty($_POST['price']) || empty($_POST['categoryug']) || empty($ps) || empty($pf)){
			iDisplayMSG('error','Error Empty','กรุณากรอกข้อมูลให้ครบ','false','');
		}else{
			$chance = $_POST['chance_s'] + $_POST['chance_f'];
			if ($chance == 100){
			$query = $connect->query("UPDATE jackpot SET name = '{$_POST['name']}', img = '{$_POST['img']}',detail = '{$_POST['detail']}',price = '{$_POST['price']}',category = '{$_POST['categoryug']}',chance_s = '{$_POST['chance_s']}',chance_f = '{$_POST['chance_f']}' WHERE id = '{$_GET['edit']}'");
		if($query){
			iDisplayMSG('isuccess','Success Saveed','บันทึกข้อมูลสำเร็จ','true','?page=backend&jackpot&edit='.$_GET['edit']);
		}else{
			iDisplayMSG('error','Error Database','เกิดข้อผิดพลาด '.$query.'','false','');			
		}
		}else {
			iDisplayMSG('error','Error Chance','โอกาสได้กับโอกาสเสีย ต้อง บวกกันได้ 100','false','');
		}
		}
	}
	  echo '<hr>';
}
if(isset($_GET['add'])) {
	if(isset($_POST['add-items'])) {
			if ($_POST['chance_s'] == "0"){
			$ps = "1";
 			$pf = "1";
		}else if ($_POST['chance_f'] == "0"){
			$ps = "1";
 			$pf = "1";
		}else if (isset($_POST['chance_s']) || isset($_POST['chance_f'])){
 			$ps = "1";
 			$pf = "1";
		}
		if(empty($_POST['name']) || empty($_POST['img']) || empty($_POST['detail']) || empty($_POST['price']) || empty($_POST['categoryug']) || empty($ps) || empty($pf)){
			iDisplayMSG('error','Error Empty','กรุณากรอกข้อมูลให้ครบ','false','');
		}else {
		$chance = $_POST['chance_s'] + $_POST['chance_f'];
		if ($chance == 100){
			$query = $connect->query("INSERT INTO `jackpot` (`id`, `name`, `detail`, `category`, `price`, `img`,chance_s,chance_f) VALUES (NULL, '{$_POST['name']}', '{$_POST['detail']}', '{$_POST['category']}', '{$_POST['price']}', '{$_POST['img']}', '{$_POST['chance_s']}', '{$_POST['chance_f']}');");
		if($query) {
			iDisplayMSG('isuccess','Success Added','เพิ่ม Jackpot เรียบร้อย','true','?page=backend&jackpot');
		}else {
			iDisplayMSG('error','Error Database','เกิดข้อผิดพลาด '.$query.'','false','');			
		}
		}else {
			iDisplayMSG('error','Error Chance','โอกาสได้กับโอกาสเสีย ต้อง บวกกันได้ 100','false','');
		}

		//ไม่เกี่ยว
	}
}
?>
<i class="fa fa-box"></i>&nbsp;จัดการ Jackpot<hr>
<div class="row justify-content-md-center">
	<div class="col-12 col-md-5">
	<div style="background: white;border-radius: 10px;padding: 20px;" >
		<i class="fa fa-box"></i>&nbsp;<text>เพิ่ม Jackpot</text><hr>
<form method="post">
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">ชื่อ : </span>
  </div>
  <input type="text" name="name" class="form-control" placeholder="ชื่อ">
</div>
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">รูปภาพ : </span>
  </div>
  <input type="text" name="img" class="form-control" placeholder="รูปภาพ">
</div>
 <div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">ข้อมูล : </span>
  </div>
  <input type="text" name="detail" class="form-control" placeholder="ข้อมูล">
</div>
 <div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">ราคา : </span>
  </div>
  <input type="text" name="price" class="form-control" placeholder="ราคา">
</div>
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">โอกาสได้ : </span>
  </div>
  <input type="text" name="chance_s" class="form-control" placeholder="โอกาสได้">
</div>
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">โอกาสเสีย : </span>
  </div>
  <input type="text" name="chance_f" class="form-control" placeholder="โอกาสเสีย">
</div>
 <div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">หมวดหมู่ไอดี : </span>
  </div>
  <select class="form-control" name="category" id="category">
					<?php
$logs = $connect->query("SELECT * FROM category");
						while($g1 = $logs->fetch_assoc() ) {
$g['id'] = $g1['id'];							
$g['category'] = $g1['category'];
echo '<option value="'.$g['id'].'">'.$g['category'].'</option>';
						}
					?>
					
				</select>
</div>
<button type="submit" name="add-items" class="btn btn-danger btn-block"><i class="fa fa-save"></i>&nbsp;เพิ่มJackpot</button>
			</form>
 <a href="?page=backend&jackpot" class="btn btn-primary btn-block"><i class="fa fa-home"></i>&nbsp;กลับ</a>
	</div>
	</div>
</div>
			<?php
		}
	echo '
		<div class="row" style="margin-top:20px;">
	';
if(isset($_GET['delete'])) {
	if(empty($_GET['number'])) {
		iDisplayMSG('error','Error Empty','กรุณาอย่าเว้นช่องว่าง','false','');
	}else {
	$query = $connect->query("SELECT * FROM jackpot where id = {$_GET['number']}");
	if($query->num_rows == 1) {
		$connect->query("DELETE FROM `jackpot` WHERE `jackpot`.`id` = {$_GET['number']}");
		iDisplayMSG('isuccess','Success Delete','ลบ Jackpot นี้ เรียบร้อย !!','true','?page=backend&jackpot');
	}else {
		iDisplayMSG('ierror','Error Empty','ไม่พบ Jackpot นี้.','true','?page=backend&jackpot');
	}
	}
}
$query = $connect->query("SELECT * FROM jackpot");
while($ez = $query->fetch_assoc()){
$logs = $connect->query("SELECT * FROM category where id = '{$ez['category']}'");
						while($g1 = $logs->fetch_assoc() ) {
$g6['id'] = $g1['id'];
$g6['category'] = $g1['category'];
$ls = $connect->query("SELECT * FROM ids where category = '{$g1['id']}'")->num_rows;
						}
?>
	<div class="col-6 col-md-4" style="  padding: 5px;">
		<div class="card" style="padding: 10px; background: rgba(0,0,0,0.1); ">
			<img class="card-img-top" src="<?php echo $ez['img']; ?>" style="width:320px;height:300px;">
		<div class="card-body" style="background: white;">
			Name : <?php echo $ez['name']; ?>
			<br>Lore :<br>&nbsp;<?php  echo $ez['detail']; ?>
			<br>Price : <?php  echo $ez['price']; ?>
			<br>หมวดหมู่ : <?php  echo $g6['category'].' ('.$ls.' ไอดี)';?>
			<br>โอกาส : ได้ <?php  echo $ez['chance_s']; ?> %/เสีย <?php  echo $ez['chance_f']; ?> %
			<hr>
			<a class="btn btn-success btn-block" href="?page=backend&jackpot&edit=<?php echo $ez['id']; ?>"><i class="fa fa-cog"></i>&nbsp;แก้ไข Jackpot</a>
			<a class="btn btn-danger btn-block" href="javascript:jdelete('<?php echo $ez['id'] ?>');"><i class="fas fa-trash-alt"></i>&nbsp;ลบ Jackpot</a>
		</div>
		</div>
	</div>
<?php
}
?>
	<div class="col-6 col-md-4" style="padding: 5px;">
		<div class="card" style="padding: 10px; background: rgba(0,0,0,0.1); ">
		<div class="card-body" style="background: white;">
		<center><img src="https://www.colourbox.com/preview/5697410-icon-plus-black.jpg" style="width: 30%">
			<hr>
			<h3>เพิ่ม Jackpot</h3></center>
			<a class="btn btn-info btn-block" style="margin-top:20px;" href="?page=backend&jackpot&add"><i class="fas fa-plus"></i>&nbsp;เพิ่ม Jackpot</a>
		</div>
		</div>
	</div>
<?php
echo ' </div>';
	}
?>