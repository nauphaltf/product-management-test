/*!
    * Start Bootstrap - SB Admin v7.0.7 (https://startbootstrap.com/template/sb-admin)
    * Copyright 2013-2023 Start Bootstrap
    * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
    */
    // 
// Scripts
// 

window.addEventListener('DOMContentLoaded', event => {

    // Toggle the side navigation
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    if (sidebarToggle) {
        // Uncomment Below to persist sidebar toggle between refreshes
        // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
        //     document.body.classList.toggle('sb-sidenav-toggled');
        // }
        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
        });
    }

});


$(function() {
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $('#save-attr-btn').click(function() {
        let error = false;
        if (!$('#attr-title').val()) {
            $('#attr-title-error').text('Title cannot be blank');
            error = true;
        } else {
            $('#attr-title-error').text('');
        }

        if (!$('#attr-value').val()) {
            $('#attr-value-error').text('Values cannot be blank');
            error = true;
        } else {
            $('#attr-value-error').text('');
        }

        if (error) {
            return false;
        }

        $.ajax({
            type: "POST",
            url: "/attributes/store",
            data: {
                _token: CSRF_TOKEN,
                title: $('#attr-title').val(),
                values: $('#attr-value').val()
            },
            dataType: 'JSON',
            success: function(resultData){
                location.reload();
            }
      });
    });
    
    $('#product-image').on('change', function(event){
        event.preventDefault();
        $('#product-save-btn').attr('disabled', true);
        var url = $('#image-upload-form').attr('action');

        $.ajax({
            url: url,
            method: 'POST',
            data: new FormData($('#image-upload-form')[0]),
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success:function(response)
            {
                $('#demo-image').attr('src', response.image).show();
                $('#image-path').val(response.image);
                $('#product-save-btn').attr('disabled', false);
            },
            error: function(response) {
                $('.error').remove();
                $.each(response.responseJSON.errors, function(k, v) {
                    $('[name=\"image\"]').after('<p class="error">'+v[0]+'</p>');
                });
            }
        });
    });

    $('#product-save-btn').click(function() {
        $('#product-form').submit();
    })
});