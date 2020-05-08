<?php
if(empty($protect)) {
	http_response_code(404);
	exit();
}
?>
<div class="card card-header bg-danger text-light" style="margin-top:20px;"><h5><i class="fa fa-gift"></i>&nbsp;เเลกโค้ด</h5></div>
	<div class="card card-body">
			<div class="row justify-content-md-center justify-content-center">
				<div class="col-md-4">
					<div class="input-group" style="margin-top: 15px;">
				<span class="input-group-text"><i class="fas fa-gift"></i>&nbsp;โค้ด</span>
				<input type="text" class="form-control" name="code" placeholder="กรอกโค้ด" id="code" required="">
			  </div>
			  <br>
			  <center>
			  	<div id="return"></div>
				<a class="btn btn-success" href="javascript:redeem();" id="btn"><i class="fas fa-gift"></i>&nbsp;เเลกโค้ด</a>
			</center>
				</div>
			</div>
	</div><hr>
	<div class="card card-header bg-success text-light" style="margin-top:20px;"><h5><i class="fa fa-history"></i>&nbsp;ประวัติการเเลกโค้ด</h5></div>
	<div class="card card-body">
			<div class="row justify-content-md-center justify-content-center">
				<div class="col-md-4">
				</div>
				<table class="table table-default table-striped table-condenseds">
				<thead>
					<tr>
						<th style="background-color: #FFF;" class="text-dark">#</th>
						<th style="background-color: #FFF;" class="text-center text-dark">โค้ด</th>
						<th style="background-color: #FFF;" class="text-center text-dark">ราคา</th>
						<th style="background-color: #FFF;" class="text-center text-dark">เวลา</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$logs = $connect->query('SELECT * FROM log_redeem WHERE username = "'.$user['username'].'" order by id desc');
						$i = '1';
						while($log = $logs->fetch_assoc()) {
					echo '
						<tr>
							<td class="text-left">'.$log['id'].'</td>
							<td class="text-center">'.$log['code'].'</td>
							<td class="text-center">'.$log['price'].'</td>
							<td class="text-center">'.th($log['time']).'</td>
						</tr>
						';
						$i++;
						}
						?>
				</tbody>
			</table>
			</div>
	</div>
<script>
$(document).ready(function() {
		$('#love').DataTable();
});
</script>