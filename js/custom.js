jQuery(document).ready(function() {
	$('#regbtn').attr('disabled',true);
	"use strict";

	$('#reg_but').on('click',function(){
		var con_val=$('#con_pass').val();
		var pass=$('#pass').val();
		console.log(con_val);
		if(con_val === pass){
			console.log('QQQQQQQ');
			$('#registerForm').submit();
		}
		
	});

	$('#agree-check').on('click',function(){
		if($(this).prop("checked") === true){
			$('#reg_but').prop('disabled',false);
		}
		if($(this).prop("checked") === false){
			$('#reg_but').prop('disabled',true);
		}
	});
	// Your custom js code goes here.

	$('#cities').on('click',function () {
		console.log('clicked!!');
		$.getJSON("../dashboard/assets/cities.json",function (data) {

			for(var i = 0; i < data.length; i++) {
				$("#cities").append('<option value="' + data[i].name + '">' + data[i].name + '</option');
				// console.log(data[i].name);
			}
		});
	});

	$("#customCheck").on("click",function(){
		if($(this).prop("checked")===true){
			$("#booknursebtn").prop("disabled",false)
		}else{
			$("#booknursebtn").prop("disabled",true)
		}
	});

	// $('#aboutPage').addClass('active');

	if(location.pathname.split("/")[1]==='index.php'){
		$('#indexPage').addClass('active');
	}else if(location.pathname.split("/")[1]==='services.php'){
		$('#servicePage').addClass('active');
	}else if(location.pathname.split("/")[1]==='about.php'){
		$('#aboutPage').addClass('active');
	}else if(location.pathname.split("/")[1]==='projects.php'){
		$('#projectsPage').addClass('active');
	}else if(location.pathname.split("/")[1]==='contact.php'){
		$('#contactPage').addClass('active');
	}else if(location.pathname.split("/")[1]==='book_nurse.php'){
		$('#bookPage').addClass('active');
	}

	$('#unurse').on('click',function () {
		$(this).prop('checked',true);
		$('#upatient').prop('checked',false);
	});

	$('#upatient').on('click',function () {
		$(this).prop('checked',true);
		$('#unurse').prop('checked',false);
	});

	$('#regagree').on('click',function () {
		if($(this).prop('checked')){
			$('#regbtn').attr('disabled',false);
		}else{
			$('#regbtn').attr('disabled',true	);
		}
	});

	var add_card_width=$('#headOff').css('height');
	$('#branchOff1').css('height',add_card_width);
	$('#branchOff2').css('height',add_card_width);



});