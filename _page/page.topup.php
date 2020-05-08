<?php
if(empty($protect)) {
	http_response_code(404);
	exit();
}
?>
<div class="row">
   <div id="return"></div>
	<div class="col-6">
		<div class="card card-header bg-warning text-light"><h5><i class="fas fa-dollar-sign"></i>&nbsp;เติมเงินด้วย TrueMoney <small style="padding-left:20px;">(โปรโมชั่น x<?php echo $config['promotion_tm']; ?>)</small></h5></div>
			<div class="card card-body bg-light">
			  <div class="alert alert-warning">เติมเงินด้วยทรูมันนี่ จะได้รับพ้อยตามจำนวน</div>
				<input type="text" class="form-control" id="truemoney" name="truemoney" placeholder="รหัสบัตรทรูมันนี่ 14 หลัก" maxlength="14" />
					<button style="margin-top:10px;" class="btn btn-success" onclick="truemoney();">เติมเงิน</button>
			<hr>
			<table class="table table-striped table-bordered" style="margin-top:20px;">
				<tbody>
				<tr>
					<th class="bg-info">จำนวนเงิน</th>
					<th class="bg-info">พ้อยที่ได้</th>
				</tr>
						<tr>
							<td>50</td>
							<td><?php echo 50 * $config['promotion_tm']; ?></td>
						</tr>
						<tr>
							<td>90</td>
							<td><?php echo 90 * $config['promotion_tm']; ?></td>
						</tr>
						<tr>
							<td>150</td>
							<td><?php echo 150 * $config['promotion_tm']; ?></td>
						</tr>
						<tr>
							<td>300</td>
							<td><?php echo 300 * $config['promotion_tm']; ?></td>
						</tr>
						<tr>
							<td>500</td>
							<td><?php echo 500 * $config['promotion_tm']; ?></td>
						</tr>
						<tr>
							<td>1000</td>
							<td><?php echo 1000 * $config['promotion_tm']; ?></td>
						</tr>
				</tbody>
			</table>
		  <div style="margin-bottom:63px;"></div>
			</div>
	</div>
	<div class="col-6">
		<div class="card card-header bg-danger text-light"><h5><i class="fas fa-dollar-sign"></i>&nbsp;เติมเงินด้วย TrueWallet <small style="padding-left:20px;">(โปรโมชั่น x<?php echo $config['promotion_tw']; ?>)</small></h5></div>
			<div class="card card-body bg-light">
			  <div class="alert alert-danger">ชื่อบัญชี "<?php echo $config['truewallet_name'] ?>"<br>เบอร์โทรศัพท์ "<?php echo $config['truewallet_phone'];?>"<br>กรุณาใส่ข้อความว่า "<?php echo $config['truewallet_msg'];?>" ด้วยไม่งั้นระบบไม่เช็ค !!</div>
				<input type="text" class="form-control" id="truewallet" name="truewallet" placeholder="เลขอ้างอิงวอเลท 14 หลัก" maxlength="14" />
					<button style="margin-top:10px;" class="btn btn-primary" onclick="truewallet();">เติมเงิน</button>
			<hr>
				<table class="table table-bordered table-condensed" style="margin-top:20px;">
				  		<tbody>
				  			<tr>
				            	<th class="bg-warning">จำนวนเงิน</th>
				            	<th class="bg-warning">พ้อยที่ได้</th>
							</tr>
							<tr style="background:#FFF;">
								<td>
									<div class="input-group">
					          			<input id='number' type="number" class="form-control" placeholder="ใส่จำนวนเงินตรงนี้" onkeyup='ptw()' />
									</div>
								</td>
				                <td class="text-center">
							 		<span class="input-group-text" id="show">0</span>
							 	</td>
							</tr>
				  		</tbody>
				  	</table>
					<div class="row">
					 <div class="col-6">
					  <img id="zoom"style="width:255px; height:255px;" src="_dist/img/tran.png" />
					 </div>
					  <div class="col-6">
					   <div id="iszoom" class="iszoom"></div>
					  </div>
				  </div>
			</div>
	</div>
</div>
		<div class="card card-header bg-success text-light" style="margin-top:20px;"><h5><i class="fa fa-history"></i>&nbsp;ประวัติการเติมเงิน</h5></div>
		  <div class="card card-body">
			<table class="table table-default table-striped table-condenseds">
				<thead>
					<tr>
						<th style="background-color: #FFF;" class="text-dark">#</th>
						<th style="background-color: #FFF;" class="text-center text-dark">เลขบัตรทรูมันนี่</th>
						<th style="background-color: #FFF;" class="text-center text-dark">สถานะบัตร</th>
						<th style="background-color: #FFF;" class="text-center text-dark">จำนวน</th>
						<th style="background-color: #FFF;" class="text-center text-dark">เวลาที่เติม</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$logs = $connect->query('SELECT * FROM log_topup WHERE username = "'.$user['username'].'" order by id desc');
						$i = '1';
						while($log = $logs->fetch_assoc() ) {
							if($log['status'] == 'success') {
							$log['status'] = '<b style="color: #388e3c"><i class="fa fa-check"></i> สำเร็จ</b>'; 
								}
							elseif($log['status'] == 'fail') {
							$log['status'] = '<b style="color: #F00"><i class="fa fa-times"></i> ล้มเหลว</b>'; 
								}
							else {
							$log['status'] = '<b style="color: #ff6f00"><i class="fa fa-times"></i> รอการตรวจสอบ</b>'; }
					echo '
						<tr>
							<td class="text-left">'.$log['id'].'</td>
							<td class="text-center">'.$log['transaction'].'</td>
							<td class="text-center">'.$log['status'].'</td>
							<td class="text-center">'.$log['amount'].'</td>
							<td class="text-center">'.th($log['time']).'</td>
						</tr>
						';
						$i++;
						}
						?>
				</tbody>
			</table>
		</div>
<script type="text/javascript">
izoom("zoom", "iszoom"); 
function ptw(){
	var int1 = document.getElementById('number').value;
	var n1 = parseInt(int1);
	var show = document.getElementById('show');
     if (int1.length > 0) {
	 if (int1.length > 0){
	  document.getElementById("show").setAttribute("color","black");
	   show.innerHTML=n1 * <?php echo $config['promotion_tw'] ; ?>;
		}
	   }
}
</script>