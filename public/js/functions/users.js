function registerUser(action, method, data) {

    $.ajax({
        url: action,
        type: method, 
        data: data,
        dataType: 'json',
        cache: false,
        contentType: false,
        processData: false,
        headers: {
            'X-CSRF-TOKEN' : $('meta[name="token"]').attr('content')
        },
        success: function(response){
            if (response.success){
                alert(response.message);
                $('#user-registration-form')[0].reset();
            }
        },
        error: function(xhr){
            if (xhr.status === 422) {
                var errors = xhr.responseJSON.errors;
                if (errors) {
                    var errorMessage = '';
                    $.each(errors, function(key, value) {
                        errorMessage += value + '\n';
                    });
                    alert(errorMessage);
                }
            } else {
                alert('Hubo un error en el servidor. Por favor, inténtelo de nuevo más tarde.');
            }
        }
    })
}

$(document).on('submit', '#user-registration-form', function(event){
    event.preventDefault();

    var action = $(this).attr('action');
    var method = $(this).attr('method');
    var data = new FormData(this);

    registerUser(action, method, data);
});