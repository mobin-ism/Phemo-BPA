$(function() {
    $('#modal-submit-button').on('click', function(e) {
        e.preventDefault();
        if ($('#modal-form > #attachment')) {
            var form = $('#modal-form');
            var options = {
                success: handleResponse
            };
            form.ajaxSubmit(options);
            var dangerClass = form[0].querySelectorAll('.form-group');
            dangerClass.forEach(function() {
                var div = $('.form-group');
                if (div.hasClass('has-danger')) {
                    div.removeClass('has-danger');
                }
            });
            $(this).addClass('m-loader m-loader--right').attr('disabled', !0);
        } else {
            var form = $('#modal-form');
            var dangerClass = form[0].querySelectorAll('.form-group');
            dangerClass.forEach(function() {
                var div = $('.form-group');
                if (div.hasClass('has-danger')) {
                    div.removeClass('has-danger');
                }
            });
            $(this).addClass('m-loader m-loader--right').attr('disabled', !0);
            var url = form.attr('action');
            var formData = form.serializeJSON();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val()
                }
            });
            $.post(url, formData, function(response) {
                if (response.errors) {
                    showErrors(response.errors, form);
                    hideButtonSpinner();
                } else {
                    location.reload();
                    hideButtonSpinner();
                }
            }).fail(function(response) {
                console.log(response);
                hideButtonSpinner();
            });
        }
    });
    $('.modal-close').on('click', function() {
        hideButtonSpinner();
        $('#m_modal_4').modal('hide');
    });
});

function hideButtonSpinner() {
    $('#modal-submit-button').removeClass('m-loader m-loader--right').removeAttr('disabled');
}

function showErrors(errors, form) {
    var keys = Object.keys(errors);
    var array = Object.keys(errors).map(function(i) {
        return errors[i];
    });
    array.forEach(function(value, index) {
        var group = form.find('#' + keys[index] + '-group');
        group.addClass('has-danger');
        if (index == 0) {
            var element = $('#' + keys[index] + '-group');
            var focus = element.find('input');
            focus.focus();
        }
    });    
}

function handleResponse(responseText, statusText, xhr, $form) {
    if (responseText.errors) {
        showErrors(responseText.errors, $form);
        hideButtonSpinner();
    } else {
        location.reload();
        hideButtonSpinner();
    }
}