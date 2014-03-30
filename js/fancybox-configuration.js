$(function() {
    $(".fancybox").fancybox(
        {
            wrapCSS    : 'fancybox-custom',
    closeClick : true,

    helpers : {
        title : {
            type : 'inside'
        },
    overlay : {
        css : {
            'background-color' : '#eee'
        }
    }
    }
        });
});
