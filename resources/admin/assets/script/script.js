$(function () {
    $("#example1").DataTable();
});

$(function () {
    //Initialize Select2 Elements
    $('.select2').select2();
    //Date picker
    $('#datepicker').datepicker({
        autoclose: true
    });
    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
        checkboxClass: 'icheckbox_minimal-blue',
        radioClass: 'iradio_minimal-blue'
    });

    $('.delete').on('submit', function (event) {
        event.preventDefault();
        let data = $(this).serialize();
        let url = $(this).attr('action');
        let target = $(event.target).parents('tr');
        $.ajax({
            method: "DELETE",
            url: url,
            data: data,
            beforeSend: function () {
                $('.delete__submit').prop('disabled', true);
            }
        }).done(function (data) {
            if(data) {
                window.location.replace(data);
            }
            $('.delete__error').remove();
            $(event.target).parents('table').DataTable().row(target).remove().draw();
        }).fail(function (jqXHR) {
            console.log('Что-то не так ' + jqXHR.responseText);
            $('.delete__error').remove();
            $(event.target).parents('table').after('<p class="delete__error" style="color: red; text-align:right">Что-то пошло не так</p>')
        }).always(function () {
            $('.delete__submit').prop('disabled', false);
        })
    })

    $('#exampleInputFile').on('change', function (event) {
        let selectedFile = $('#exampleInputFile')[0].files[0];
        $('.img-responsive').remove();
        $(event.target).parent().prepend('<img src="" alt="" class="img-responsive" width="200">');
        let img = $('.img-responsive');
        img.fadeTo(0, 0, function () {
            $(this).fadeTo(2000, 1);
        })
        let objectURL = window.URL.createObjectURL(selectedFile);
        img.attr('src', objectURL);
    })
});
