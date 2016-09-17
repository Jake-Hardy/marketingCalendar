$('.shareShadowBox').hide();
$('.shareWindow').hide();

$('.card--calendar').on("click", "a", function(e) {
    e.preventDefault();
    var form = $(this).parent();

    //TODO: Fix this crap. 
    var spinner = $(this).parent().parent().parent().parent();
    var shrinker = $(this).parent().parent().parent();

    if ($(this).hasClass('button--delete')) {
        // $(this).parent().parent().css({
        //     //"margin-top" : '-1000px',
        //     "transform" : "scale(0, 0)"
        // });
        spinner.addClass('spin');
        shrinker.addClass('shrink');
        //window.setTimeout(1000);
        window.setTimeout(function() {

            form.submit();
            //console.log('timeout function');
        },
        1000);
    }
    else if ($(this).hasClass('buttonShare')) {
        $('.shareShadowBox').show();
        $('.shareWindow').show();
        var id = $(this).siblings('form').children('.idHook').val();
        $('.calID').val(id);
    }
    else {
        form.submit();
    }
});

$('.buttonClose').on("click", function() {
    $('.shareShadowBox').hide();
    $(this).parent().hide();
});

$('.userShareButton').on("click", function() {
    var data = {};
    data['user'] = $(this).text();
    data['id'] = $('.calID').val();

    $.ajax({
        url: 'share.php',
        method: 'post',
        data: data,
        success: function() {
            $('.buttonClose').click();
        }
    });
});
