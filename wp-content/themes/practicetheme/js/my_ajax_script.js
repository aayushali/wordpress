jQuery(document).ready(function($)
{
    $('button.btn-get-posts').on('click',function(){
        $.ajax({
            url: ajaxobj.ajaxurl,
            method: 'GET',
            data: {
                'action': 'example_ajax_request',
            },
            beforeSend : function ( xhr ) {
                $('button').text('Loading...'); // change the button text, you can also add a preloader image
            },
            success: function(response){
                $('.posts-content').append(response);

            },
            error: function(errorThrown){
                console.log(errorThrown);
            },
        });


    });
});
