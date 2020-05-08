<?php
if(empty($protect)) {
	http_response_code(404);
	exit();
}
?>
	  <div id="return"></div>
		<div class="card card-header bg-info text-light" style="margin-top:20px;"><h5><i class="fa fa-box"></i>&nbsp;สุ่มกล่อง</h5></div>	 
		<div class="card card-body">
			<div class="row">
<?php
  $item['query'] = $connect->query('SELECT * FROM jackpot');
  if($item['query']->num_rows == 0) {
	  echo '<div class="col-12 text-center">
	  <div class="alert alert-warning" role="alert">แอดมิน ยังไม่วางกล่องสุ่ม...</div>
	  </div>';
  }
  while($item['detail'] = $item['query']->fetch_assoc())
  {
  	$ls = $connect->query("SELECT * FROM ids where category = '{$item['detail']['category']}'")->num_rows;
	  echo '
			<div class="col-6 col-md-4" style="  padding: 5px;">
				<div class="card" style="padding: 10px; background: rgba(0,0,0,0.1); ">
				<center>
					<img class="card-img-top float-center" src="'.$item['detail']['img'].'" style="width:320px;height:300px;">
					</center>
					<div class="card-body" style="background: white;">
						<h5 class="card-title"><b>'.$item['detail']['id'].'. '.$item['detail']['name'].'</b></h5>
						<p class="card-text">
							รายละเอียด : <br>'.$item['detail']['detail'].'
							<br>
							โอกาส : ได้ '.$item['detail']['chance_s'].' %/เสีย '.$item['detail']['chance_f'].' %
							<br>
							สินค้าเหลือ: '.number_format($ls).' ชิ้น	
							<br>
							ราคา: '.number_format($item['detail']['price'],2).' พ้อยท์	
							<br>
						</p>
						<a class="btn btn-primary btn-block text-light" onclick="buybox('.$item['detail']['id'].')"><i class="fa fa-shopping-cart hvr-icon"></i> สุ่มเลย ('.number_format($item['detail']['price'],2).')</a>
					</div>
				</div>
			</div>
			';
  }
?>
			</div>
		</div>