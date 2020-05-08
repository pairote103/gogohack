<?php
if(empty($protect)) {
	http_response_code(404);
	exit();
}

$id = $connect->query("SELECT * FROM log_shop")->num_rows;
$user = $connect->query("SELECT * FROM user")->num_rows;
$cfs = $connect->query("SELECT * FROM config");
$cfsa = $cfs->fetch_assoc();
?>
<div class="row" style="margin-top:30px;">
                <div class="col-md-4">
                    <div class="card text-dark border-secondary">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <a href="#"><i class="fas fa-signal fa-4x fa-lg text-primary"></i>&nbsp;</a>
                                <div class="m-l-15 m-t-10">
                                    <h4 class="font-medium m-b-0">ยอดเข้าชมเว็บ</h4>
                                    <h5><?php echo number_format($count); ?>&nbsp; ครั้ง</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-dark border-secondary">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <a href="#"><i class="fas fa-signal fa-4x fa-lg text-info"></i>&nbsp;</a>
                                <div class="m-l-15 m-t-10">
                                    <h4 class="font-medium m-b-0">ไอดีที่ขายทั้งหมด</h4>
                                    <h5><?php echo number_format($id); ?>&nbsp; ไอดี</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-dark border-secondary">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <a href="#"><i class="fas fa-user fa-4x fa-lg text-success"></i>&nbsp;</a>
                                <div class="m-l-15 m-t-10">
                                    <h4 class="font-medium m-b-0">สมาชิกทั้งหมด</h4>
                                    <h5><?php echo number_format($user); ?>&nbsp; คน</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
			<hr>
<div align="center" class="row" style="margin-top:20px;">
	<div class="col-md-4"><h2><img src="_dist/img/pencil.png" width="160" height="159"></h2>
	  <h2>สมัครสมาชิก!</h2>
	  <h4><strong>ขั้นตอนที่ 1</strong></h4>สมัครสมาชิกแล้วเข้าเข้าสู่ระบบเพื่อซื้อสินค้า</div>
	<div class="col-md-4"><h2><img src="_dist/img/wallet.png" width="160" height="159"></h2>
	  <h2>เติมเงิน</h2>
	  <h4><strong>ขั้นตอนที่ 2</strong></h4>เติมเงินเพื่อซื้อสินค้าโดย เติมด้วย บัตรทรู หรือ วอเลท</div>
	<div class="col-md-4"><h2><img src="_dist/img/market.png" width="160" height="159"></h2>
	  <h2>ซื้อสินค้า</h2>
	  <h4><strong>ขั้นตอนที่ 3</strong></h4>ซื้อสินค้าแล้วรับสินค้าอัตโนมัติ</div>
</div>
<hr>
	<div class="card card-body" style="margin-top:30px;">
		<h3><u>ทำไมคุณต้องเลือกเรา</u></h3>
		<li>เพราะเรามี ID แท้ในราคาที่ถูก เริ่มต้นเพียงแค่ 10 บาทเท่านั้น</li>
		<li>และเว็บเรายังมีระบบอัตโนมัต ซื้อได้ตลอด 24 ชั่วโมง</li>
		<li>ท่านสามารถชำระด้วยบัตรทรู หรือ โอนผ่านทรูวอเลท พ้อยจะเข้าทันที</li>
		<br>
		<li>ไอดีที่ไม่มีประกันอาจจะถูกดึงกลับได้ใน 7-30 วัน อาจจะน้อยหรือมากกว่านี้ </li>
		<li>ถ้าชื้อไอดีมาไม่ถึง 7วันแล้วเข้าไม่ได้ติดต่อ รับไอดีใหม่ได้ที่เพจ (ไม่รับประกันไอดีโดนแบน) </li>
	</div>
<?php if ($cfsa['say'] == "on"){ ?>
    <script type="text/javascript">
    $(window).on('load',function(){
        $('#myModal').modal('show');
    });
</script>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-bullhorn"></i>&nbsp;ประกาศ</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php
$logs1 = $connect->query('SELECT * FROM say where id = "1"');
$log1 = $logs1->fetch_assoc();
$logs2 = $connect->query('SELECT * FROM say where id = "2"');
$log2 = $logs2->fetch_assoc();
$logs3 = $connect->query('SELECT * FROM say where id = "3"');
$log3 = $logs3->fetch_assoc();
$logs4 = $connect->query('SELECT * FROM say where id = "4"');
$log4 = $logs4->fetch_assoc();
$logs5 = $connect->query('SELECT * FROM say where id = "5"');
$log5 = $logs5->fetch_assoc();
        ?>
        <div class="alert alert-info text-center" role="alert">
  <?php echo $log1['news']; ?>
</div>
<div class="alert alert-secondary text-center" role="alert">
  <?php echo $log2['news']; ?>
</div>
<div class="alert alert-success text-center" role="alert">
  <?php echo $log3['news']; ?>
</div>
<div class="alert alert-danger text-center" role="alert">
  <?php echo $log4['news']; ?>
</div>
<div class="alert alert-warning text-center" role="alert">
  <?php echo $log5['news']; ?>
</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;ปิด</button>
      </div>
    </div>
  </div>
</div>
<?php } ?>