<?php
if(empty($protect)) {
	http_response_code(404);
	exit();
}
?>
<div class="card card-header bg-success text-light" style="margin-top:20px;"><h5><i class="fa fa-history"></i>&nbsp;ประวัตการซื้อของ/สุ่มกล่อง</h5></div>
	<div class="card card-body">
			<table class="table table-default table-striped table-condenseds">
				<thead>
					<tr>
						<th style="background-color: #FFF;" class="text-dark">#</th>
						<th style="background-color: #FFF;" class="text-center text-dark">ตัวละคร</th>
						<th style="background-color: #FFF;" class="text-center text-dark">เมล์/รหัส</th>
						<th style="background-color: #FFF;" class="text-center text-dark">รายละเอียด</th>
						<th style="background-color: #FFF;" class="text-center text-dark">ราคา</th>
						<th style="background-color: #FFF;" class="text-center text-dark">เวลา</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$logs = $connect->query('SELECT * FROM log_shop WHERE username = "'.$user['username'].'" order by id desc');
						$i = '1';
						while($log = $logs->fetch_assoc() ) {
					echo '
						<tr>
							<td class="text-left">'.$log['id'].'</td>
							<td class="text-center">'.$log['name'].'</td>
							<td class="text-center">'.$log['email'].'<br>'.$log['password'].'</td>
							<td class="text-center">'.$log['lore'].'</td>
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
<script>
$(document).ready(function() {
		$('#love').DataTable();
});
</script>