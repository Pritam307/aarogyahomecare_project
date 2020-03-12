function openReject(id) {
    $('#rBtn'+id).attr('onclick','rejectReq('+id+')');
    $('#rejectModal'+id).modal('show');
}



function rejectReq(id) {
    console.log("OK");
    $.post("../dashboard/click_server.php",{id:id},function (response) {
        // console.log(JSON.parse(response));
        if(JSON.parse(response).status ==="success"){
            console.log(response);
            $('#acceptBtn'+id).css('display','none');
            $('#rejectBtn'+id).css('display','none');
            $('#reject_stat'+id).css('display','block');
            $('#rejectModal'+id).modal('hide');
        }
    })
}

function getPatientId(id) {
    $('#patient_id').prop('value',id);
}


$(document).ready(function () {
    if($(window).width()<=1300){
        if(location.pathname.split("/").pop()==='patient_request.php'){
            // console.log(location.pathname.split("/").pop());
            $('.main-panel').css('width','unset');
            $('sidebar-offcanvas-mod').css('z-index','9999');
            $('.sidebar').addClass('sidebar-offcanvas-mod');

            $('#sidebar_toggle').on("click", function () {
                $('.sidebar').addClass('sidebar-offcanvas-mod');
                $('.sidebar-offcanvas-mod').toggleClass('active');
            });
        }

    }
});