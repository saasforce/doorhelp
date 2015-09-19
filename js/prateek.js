(function($) {

    $("#testform").on("submit", function(e) {
        e.preventDefault();
        $.ajax({
            'url': "php/order.php",
            'method': 'POST',
            'data': {
                'area': $("#area").val(),
                'email': $("#email").val(),
                'name': $("#name").val(),
                'phone': $("#phone").val(),
                'category': $("#mark").val(),
                'subcategory': $("#series").val(),
                'address': $("#house-id").val(),
                'postal-code': $("#street").val(),
                'date': $("#datepicker").val(),
                'time': $("#time").val(),
                'comments': $("#comments").val()
            },
            success: function(response) {
                $('#testform_error').slideUp(800);
                $('#testform').slideUp(1000, function() {
                    $('#testthank_you').slideDown(800);
                });

            },
            error: function(response, status, error) {
                $('#testform_error').slideDown(800);
            }
        });

    });




    $("#feedback_form").on("submit", function(e) {
        e.preventDefault();
        var email = new RegExp(/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/);
        if ($('#name2').val() == '' || $('#email2').val() == '' || !email.test($('#email2').val()) || $('#subject2').val() == '' || $('#message2').val() == '') {

            $('#box_error').slideDown(800);
        } else {
            $.ajax({
                'url': "php/feedback.php",
                'method': 'POST',
                'data': {
                    'name': $("#name2").val(),
                    'email': $("#email2").val(),
                    'subject': $("#subject2").val(),
                    'message': $("#message2").val()
                },
                success: function(response) {
                    $('#form_error').slideUp(800);
                    $('#box_error').slideUp(800);
                    $('#feedback_form').slideUp(1000, function() {
                        $('#thank_you').slideDown(800);
                    });

                },
                error: function(response, status, error) {
                    $('#form_error').slideDown(800);
                }
            });
        }
    });


})(jQuery);
