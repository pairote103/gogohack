function success(title, desc, reload) { 
	if(reload == "true") {
		swal({
		title: '<span style="color:black">'+title+'</span>',
		type: 'success',
		html: '<span style="color:gray">'+desc+'</span>',
		showConfirmButton: true,
		}).then(function(isConfirm) {
		 var url = "";   
		  if (isConfirm === true) {
			$(location).attr('href',url);
		  }else {
			$(location).attr('href',url);
		  }
		})
	}else {
		swal({
		title: '<span style="color:black">'+title+'</span>',
		type: 'success',
		html: '<span style="color:gray">'+desc+'</span>',
		showConfirmButton: true,
		})
	}
}
function isuccess(title, desc, reload, url) { 
	if(reload == "true") {
		swal({
		title: '<span style="color:black">'+title+'</span>',
		type: 'success',
		html: '<span style="color:gray">'+desc+'</span>',
		showConfirmButton: true,
		}).then(function(isConfirm) {
		  if (isConfirm === true) {
			$(location).attr('href',url);
		  }else {
			$(location).attr('href',url);
		  }
		})
	}else {
		swal({
		title: '<span style="color:black">'+title+'</span>',
		type: 'success',
		html: '<span style="color:gray">'+desc+'</span>',
		showConfirmButton: true,
		})
	}
}

function error(title, desc, reload) {
	if(reload == "true") {
		swal({
		title: '<span style="color:black">'+title+'</span>',
		type: 'error',
		html: '<span style="color:gray">'+desc+'</span>',
		confirmButtonText: '<span style="color:black;"><i class="fa fa-times"></i> ปิด</span>',
		confirmButtonColor: '#e54d40',
		}).then(function(isConfirm) {
		 var url = "";   
		  if (isConfirm === true) {
			$(location).attr('href',url);
		  }else {
			$(location).attr('href',url);
		  }
		})
	}else {
		swal({
		title: '<span style="color:black">'+title+'</span>',
		type: 'error',
		html: '<span style="color:gray">'+desc+'</span>',
		confirmButtonText: '<span style="color:black;"><i class="fa fa-times"></i> ปิด</span>',
		confirmButtonColor: '#e54d40',
		})
	}
}
function ierror(title, desc, reload, url) {
	if(reload == "true") {
		swal({
		title: '<span style="color:black">'+title+'</span>',
		type: 'error',
		html: '<span style="color:gray">'+desc+'</span>',
		confirmButtonText: '<span style="color:black;"><i class="fa fa-times"></i> ปิด</span>',
		confirmButtonColor: '#e54d40',
		}).then(function(isConfirm) {
		  if (isConfirm === true) {
			$(location).attr('href',url);
		  }else {
			$(location).attr('href',url);
		  }
		})
	}else {
		swal({
		title: '<span style="color:black">'+title+'</span>',
		type: 'error',
		html: '<span style="color:gray">'+desc+'</span>',
		confirmButtonText: '<span style="color:black;"><i class="fa fa-times"></i> ปิด</span>',
		confirmButtonColor: '#e54d40',
		})
	}
}

function warning(title, desc) {
	swal({
	title: '<span style="color:black">'+title+'</span>',
	type: 'warning',
	html: '<span style="color:gray">'+desc+'</span>',
	showConfirmButton: false,
    showCancelButton: false,
    showConfirmButton: false,
    allowOutsideClick: false,
    allowEscapeKey: false,
   })
}

function info(title, desc) {
	swal({
	title: '<span style="color:black">'+title+'</span>',
	type: 'info',
	html: '<span style="color:gray">'+desc+'</span>',
	confirmButtonText: '<span style="color:black;"><i class="fa fa-times"></i> ปิด</span>',
	confirmButtonColor: '#e54d40',
   })
}

function login() {
	$("#return").html("<script>warning('<i class=\"fa fa-spinner fa-spin fa-fw\"></i>\', 'กรุณารอสักครู่...');</script>");
	$.post( "act.php?login",{username: $('#username').val(),password: $('#password').val()},  function( data ) {
	$("#btn").prop("disabled", true);
	$( "#return" ).html( data );
	$("#btn").prop("disabled", false); 
  }
 );
}
function register() {
	$("#return").html("<script>warning('<i class=\"fa fa-spinner fa-spin fa-fw\"></i>\', 'กรุณารอสักครู่...');</script>");
	$.post( "act.php?register",{
		username: $('#username').val(),
		password: $('#password').val(),
		repassword: $('#repassword').val(),
		captcha: $('#captcha').val(),
		},  function( data ) {
	$("#btn").prop("disabled", true);
	$( "#return" ).html( data );
	$("#btn").prop("disabled", false); 
  }
 );
}
function redeem() {
	$("#return").html("<script>warning('<i class=\"fa fa-spinner fa-spin fa-fw\"></i>\', 'กรุณารอสักครู่...');</script>");
	$.post( "act.php?redeem",{code: $('#code').val()},  function( data ) {
	$("#btn").prop("disabled", true);
	$( "#return" ).html( data );
	$("#btn").prop("disabled", false); 
  }
 );
}
function password() {
	$("#return").html("<script>warning('<i class=\"fa fa-spinner fa-spin fa-fw\"></i>\', 'กรุณารอสักครู่...');</script>");
	$.post( "act.php?cpassword",{
		password_old: $('#password_old').val(),
		password_new: $('#password_new').val(),
		repassword_new: $('#repassword_new').val(),
		captcha: $('#captcha').val(),
		},  function( data ) {
	$("#btn").prop("disabled", true);
	$( "#return" ).html( data );
	$("#btn").prop("disabled", false); 
  }
 );
}
function buy(id) {
	$("#return").html("<script>warning('<i class=\"fa fa-spinner fa-spin fa-fw\"></i>\', 'กรุณารอสักครู่...');</script>");
	$.get( "act.php?buy&id="+id,  function( data ) {
	$("#btn").prop("disabled", true);
	$( "#return" ).html( data );
	$("#btn").prop("disabled", false); 
  }
 );
}
function truemoney() {
	$("#return").html("<script>warning('<i class=\"fa fa-spinner fa-spin fa-fw\"></i>\', 'กรุณารอสักครู่...');</script>");
	$.post( "act.php?truemoney",{
		truemoney: $('#truemoney').val()
		},  function( data ) {
	$("#btn").prop("disabled", true);
	$( "#return" ).html( data );
	$("#btn").prop("disabled", false); 
  }
 );
}
function truewallet() {
	$("#return").html("<script>warning('<i class=\"fa fa-spinner fa-spin fa-fw\"></i>\', 'กรุณารอสักครู่...');</script>");
	$.post( "act.php?truewallet",{
		truewallet: $('#truewallet').val()
		},  function( data ) {
	$("#btn").prop("disabled", true);
	$( "#return" ).html( data );
	$("#btn").prop("disabled", false); 
  }
 );
}
function code() {
	$("#return").html("<script>warning('<i class=\"fa fa-spinner fa-spin fa-fw\"></i>\', 'กำลังทำรายการ รอสักครู่');</script>");
	$.post( "act.php?code",{code: $('#code').val()}, function( data ) {
	$("#btn").prop("disabled", true);
	$( "#return" ).html( data );
	$("#btn").prop("disabled", false); 
  }
 );
}
function buyitem(id) {
	swal({
		type: 'warning',
		title: 'ยืนยันการ การซื้อสินค้า',
		showConfirmButton: false,
		html: '<br><br>' +
		'<a class="float-left btn btn-danger text-light" onclick="swal.close()"><i class="fa fa-times"></i> ยกเลิก</a>' +
		'<a class="float-right btn btn-success text-light" onclick="ibuyitem(\''+id+'\')"><i class="fa fa-check"></i> ยืนยัน</a>',
	});
}
function ibuyitem(id) {
	$("#return").html("<script>warning('<i class=\"fa fa-spinner fa-spin fa-fw\"></i>\', 'กำลังทำรายการ รอสักครู่');</script>");
	$.get( "act.php?shop&id="+id, function( data ) {
	$( "#return" ).html( data );
  }
 );
}
function buybox(id) {
	swal({
		type: 'warning',
		title: 'ยืนยันการ การสุ่มกล่อง',
		showConfirmButton: false,
		html: '<img class="float-center" src="_dist/img/box.gif" style="width: 250px; height: 219px;"><br>' +
		'<a class="float-left btn btn-danger text-light" onclick="swal.close()"><i class="fa fa-times"></i> ยกเลิก</a>' +
		'<a class="float-right btn btn-success text-light" onclick="ibuybox(\''+id+'\')"><i class="fa fa-check"></i> ยืนยัน</a>',
	});
}
function ibuybox(id) {
	$("#return").html("<script>warning('<i class=\"fa fa-spinner fa-spin fa-fw\"></i>\', 'กำลังทำรายการ รอสักครู่');</script>");
	$.get( "act.php?act_jackpot&id="+id, function( data ) {
	$( "#return" ).html( data );
  }
 );
}

function logout() {
	swal({
		type: 'warning',
		title: 'ยืนยันการ ออกจากระบบ',
		showConfirmButton: false,
		html: '<br><br>' +
		'<a class="float-left btn btn-danger text-light" onclick="swal.close()"><i class="fa fa-times"></i> ยกเลิก</a>' +
		'<a class="float-right btn btn-success" href="?page=logout&yes"><i class="fa fa-check"></i> ยืนยัน</a>',
	});
}
function idelete(id) {
	swal({
		type: 'warning',
		title: 'ยืนยันการ ลบสินค้า',
		showConfirmButton: false,
		html: '<br><br>' +
		'<a class="float-left btn btn-danger text-light" onclick="swal.close()"><i class="fa fa-times"></i> ยกเลิก</a>' +
		'<a class="float-right btn btn-success" href="?page=backend&items&delete&number='+id+'"><i class="fa fa-check"></i> ยืนยัน</a>',
	});
}
function jdelete(id) {
	swal({
		type: 'warning',
		title: 'ยืนยันการ ลบ Jackpot',
		showConfirmButton: false,
		html: '<br><br>' +
		'<a class="float-left btn btn-danger text-light" onclick="swal.close()"><i class="fa fa-times"></i> ยกเลิก</a>' +
		'<a class="float-right btn btn-success" href="?page=backend&jackpot&delete&number='+id+'"><i class="fa fa-check"></i> ยืนยัน</a>',
	});
}
function cdelete(id) {
	swal({
		type: 'warning',
		title: 'ยืนยันการ ลบโค้ดนี้',
		showConfirmButton: false,
		html: '<br><br>' +
		'<a class="float-left btn btn-danger text-light" onclick="swal.close()"><i class="fa fa-times"></i> ยกเลิก</a>' +
		'<a class="float-right btn btn-success" href="?page=backend&code&delete&number='+id+'"><i class="fa fa-check"></i> ยืนยัน</a>',
	});
}
function oc(id){
  $.get("act.php?category="+id, function(data, status){
  	$( "#return" ).html( data );
  });
}
function osay(){
$('#customControlAutosizing').change(function(){
if ($(this).is(":checked")) 
{
	var id = 1;
   $.get("act.php?osay="+id, function(data, status){
  	$( "#return" ).html( data );
  });
}
else
{
	var id = 0;
 $.get("act.php?osay="+id, function(data, status){
  	$( "#return" ).html( data );
  });
}
});
/*$( "#customControlAutosizing" ).is(":checked");
  $.get("act.php?osay="+id, function(data, status){
  	$( "#return" ).html( data );
  });*/
}
function udelete(id) {
	swal({
		type: 'warning',
		title: 'ยืนยันการ ลบผู้ใช้นี้',
		showConfirmButton: false,
		html: '<br><br>' +
		'<a class="float-left btn btn-danger text-light" onclick="swal.close()"><i class="fa fa-times"></i> ยกเลิก</a>' +
		'<a class="float-right btn btn-success" href="?page=backend&users&delete&number='+id+'"><i class="fa fa-check"></i> ยืนยัน</a>',
	});
}
function iddelete(id) {
	swal({
		type: 'warning',
		title: 'ยืนยันการ ลบไอดีนี้',
		showConfirmButton: false,
		html: '<br><br>' +
		'<a class="float-left btn btn-danger text-light" onclick="swal.close()"><i class="fa fa-times"></i> ยกเลิก</a>' +
		'<a class="float-right btn btn-success" href="?page=backend&ids&delete&number='+id+'"><i class="fa fa-check"></i> ยืนยัน</a>',
	});
}
function izoom(imgID, resultID) {
  var img, lens, result, cx, cy;
  img = document.getElementById(imgID);
  result = document.getElementById(resultID);
  lens = document.createElement("DIV");
  lens.setAttribute("class", "iszoom-len");
  img.parentElement.insertBefore(lens, img);
  cx = result.offsetWidth / lens.offsetWidth;
  cy = result.offsetHeight / lens.offsetHeight;
  result.style.backgroundImage = "url('" + img.src + "')";
  result.style.backgroundSize = (img.width * cx) + "px " + (img.height * cy) + "px";
  lens.addEventListener("mousemove", moveLens);
  img.addEventListener("mousemove", moveLens);
  lens.addEventListener("touchmove", moveLens);
  img.addEventListener("touchmove", moveLens);
  function moveLens(e) {
    var pos, x, y;
    e.preventDefault();
    pos = getCursorPos(e);
    x = pos.x - (lens.offsetWidth / 2);
    y = pos.y - (lens.offsetHeight / 2);
    if (x > img.width - lens.offsetWidth) {x = img.width - lens.offsetWidth;}
    if (x < 0) {x = 0;}
    if (y > img.height - lens.offsetHeight) {y = img.height - lens.offsetHeight;}
    if (y < 0) {y = 0;}
    lens.style.left = x + "px";
    lens.style.top = y + "px";
    result.style.backgroundPosition = "-" + (x * cx) + "px -" + (y * cy) + "px";
  }
  function getCursorPos(e) {
    var a, x = 0, y = 0;
    e = e || window.event;
    a = img.getBoundingClientRect();
    x = e.pageX - a.left;
    y = e.pageY - a.top;
    x = x - window.pageXOffset;
    y = y - window.pageYOffset;
    return {x : x, y : y};
  }
}