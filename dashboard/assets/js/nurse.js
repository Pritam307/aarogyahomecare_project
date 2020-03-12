var mon_list=new Map([[1,'January'],[2,'February'],[3,'March'],[4,'April'],[5,'May'],[6,'June'],[7,'July'],[8,'August'],[9,'September'],[10,'October'],[11,'November'],[12,'December']]);
$(document).ready(function () {
    var join_mon=$('#monselect').attr('data-value');
    for(i=parseInt(join_mon); i<=mon_list.size; i++){
        console.log(mon_list.get(i));
        $('#monselect').append('<option>'+mon_list.get(i)+'</option>');
    }
    var joinYear=$('#selectYear').attr('data-value');
    var currYear=new Date().getFullYear();
    for(var j=joinYear; j<=currYear; j++){
        $('#selectYear').append('<option>'+j+'</option>');
    }

    $('#manHra').css('display','none');
})



$('#upPhoto').on('change',function(){
    console.log('photo select!!!')
    $('#textPhoto').text($('#upPhoto')[0].files[0].name);
})

$('#upSign').on('change',function(){
    console.log('photo select!!!')
    $('#textSign').text($('#upSign')[0].files[0].name);
})


// $(function () {
//     $("#datepicker").datepicker({
//         // autoclose: true,
//         // todayHighlight: true,
//         changeMonth: false,
//         changeYear: true,
//         dateFormat: "MM",
//     })
// })



function changeMonth(mon,joyear) {
    var resyear=$('#selectYear').val();
    var i;
    $('#monselect').empty();
    if(resyear===joyear){
        console.log(mon_list.size);
        for(i=parseInt(mon); i<=mon_list.size; i++){
            console.log(mon_list.get(i));
            $('#monselect').append('<option>'+mon_list.get(i)+'</option>');
        }
    }else{
        for(i=1; i<=mon_list.size; i++){
            console.log(mon_list.get(i));
            $('#monselect').append('<option>'+mon_list.get(i)+'</option>');
        }
    }
}

$('#prebtn').on('click',function () {
    $('#abbtn').css('display','none');
    $(this).prop('disabled',true);
    $('#todaystat').append('Present');
    $('#todaystat').css('color','rgba(0,176,0,0.75)');
    var id=$(this).attr('data-value');
    $.post('../dashboard/click_server.php',{regId:id,attendence:1},function (response) {
        console.log(response);
    });

})

$('#abbtn').on('click',function () {
    $('#prebtn').css('display','none');
    $(this).prop('disabled',true);
    $('#todaystat').append('Absent');
    $('#todaystat').css('color','rgb(176,56,26)');
    var id=$(this).attr('data-value');
    $.post('../dashboard/click_server.php',{regId:id,attendence:0},function (response) {
        console.log(response);
    });
})

function hideEsic() {
    console.log('hide');
    var stat=  $('#manHra').css('display');
    if(stat==='block'){
        $('#manHra').css('display','none');
    }
}

function showEsic() {
    console.log('show');
    var stat=  $('#manHra').css('display');
    if(stat==='none'){
        $('#manHra').css('display','block');
    }
}


// function submitForm() {
//     // document.getElementById('myForm').submit();
//     $()
// }
// $('select.month').click(function () {
//     var smon=$(this).children("option:selected").val();
//     console.log('You have selected'+smon);
//
// })