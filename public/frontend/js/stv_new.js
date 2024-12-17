$(document).ready(function () {
    $(function () {
        $(window).scroll(function () {
            var windowScrollTop = $(this).scrollTop();
            if (windowScrollTop >= 800) {
                $('#bttop').fadeIn();
            } else {
                $('#bttop').fadeOut();
            }
        });
        $('#bttop').click(function () {
            event.preventDefault();
            $('body,html').animate({ scrollTop: 0 }, 1600);
        });
    }); 
});
function add_cart_detail(id,iOn)
{
    var pid = id;var online = iOn;       
    location.href="/index.php?mod=cart&ajax&task=add&pid="+pid+"&ion="+online;
}