$(document).foundation();

$(document).ready(function() {
    var send = 0;
    var emailFilter = /^.+\@.+$/;

    function showError( x,y ){
        if ( x ) {
            y.removeClass('input-error');
            y.prev().hide();
            send = 1;
            return send;
        } else {
            y.addClass('input-error');
            y.prev().show();
            send = 0;
            return send;
        }
    };

    function isEmailValid() {
        var x = emailFilter.test($('#email').val());
        var y = $('#email');
        return showError( x,y );
    };

    $('.email-form').on('keyup keypress', function(e) {
        var keyCode = e.keyCode || e.which;

        if ( keyCode == 13 ) {
            e.preventDefault();
            $('#submit-button')[0].click();
        }
    })

    $('#submit-button').on( 'click tap',function( e ) {
        e.preventDefault();

        if ( isEmailValid() ) {
            var email = $("#email").val();

            $.ajax({
                url:"verification.php",
                type:"POST",
                data: { email: email },
                success:function(data, textStatus, jqXHR){

                    var result_class = data.includes("Success") ? 'display-response-success' : 'display-response-error';
                    var result_txt = data.split("__")[1];

                    $(".response")
                        .addClass(result_class)
                        .text(result_txt);

                    // if email invalid
                    $(".response")
                        .addClass(result_class)
                        .text(result_txt);

                    if ( result_class === 'display-response-success' ) {
                        $(".email-title, .email-form").fadeOut("slow", function() {
                            $(this).remove();
                        });
                    }

                }
            });
        } else {
            // if email invalid
            $(".response")
                .addClass('display-response-error')
                .text('Email is invalid');
        }
    });

});
