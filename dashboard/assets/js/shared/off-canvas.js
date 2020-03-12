// (function ($) {
//   'use strict';
//   $(function () {
//     $('[data-toggle="offcanvas"]').on("click", function () {
//       $('.sidebar-offcanvas').toggleClass('active')
//     });
//   });
// })(jQuery);

$('#UserDropdown').on('click',function () {
    $('#droplist').toggleClass('show');
    $('#droplist .navbar-dropdown').toggleClass('show');
});