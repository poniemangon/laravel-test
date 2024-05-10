function loginUser(action, method, data) {
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
                window.location.href = url;
            } else {
                Swal.fire({
                    title: "Error",
                    text: response.message, 
                });
            }
        },
        error: function(xhr){
            if (xhr.status === 422) {
                var errors = xhr.responseJSON.errors;
                console.log(errors)
                if (errors) {
                    var errorMessage = '';
                    $.each(errors, function(key, value) {
                        errorMessage += value + '\n';
                    });
                    Swal.fire({
                        title: "Error",
                        text: errorMessage,
                      });
                }
            } else {
                Swal.fire({
                    title: "Error",
                    text: "Hubo un error en el servidor",
                  });
            }
        }
    })
}

$(document).on('submit', '#login-form', function(event){
    event.preventDefault();

    var action = $(this).attr('action'),
    method = $(this).attr('method'),
    data = new FormData(this);
    loginUser(action, method, data);

});

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
                Swal.fire({
                    title: "Usuario registrado",
                    icon: "success",
                  });
                $('#user-registration-form')[0].reset();
            }else {
                Swal.fire({
                    title: "Error",
                    text: response.message, 
                });
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
                    Swal.fire({
                        title: "Error",
                        text: errorMessage,
                      });
                }
            } else {
                Swal.fire({
                    title: "Error",
                    text: "Hubo un error en el servidor",
                  });
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

function editUser(action, method, data) {

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
                Swal.fire({
                    title: "Usuario editado correctamente",
                    text: response.message,
                    icon: "success",
                  });
                $('#user-edition-form')[0].reset();
                $(document).ready(function() {
                    $('.swal2-confirm').on('click', function() {
                        window.location.reload(true);
                    });
                });
            } else {
                Swal.fire({
                    title: "Error",
                    text: response.message, 
                });
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
                    Swal.fire({
                        title: "Error",
                        text: errorMessage,
                      });
                }
            } else {
                Swal.fire({
                    title: "Error",
                    text: "Hubo un error en el servidor",
                  });
            }
        }
    })
}

$(document).on('submit', '#user-edition-form', function(event){
    event.preventDefault();

    var action = $(this).attr('action');
    var method = $(this).attr('method');
    var data = new FormData(this);

    editUser(action, method, data);
});


$(document).on('click', '.delete-user-button', function(){

    var userId = $(this).attr('data-user-id');
    deleteUser(userId);
})

function deleteUser(userId){
    $.ajax({
        url: url + '/delete-user/' + userId,
        type: 'delete',
        data: null,
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN' : $('meta[name="token"]').attr('content')
        },
        success: function(response){
            location.reload();

        },  
        error: function(xhr){
            if (xhr.status === 422) {
                var errors = xhr.responseJSON.errors;
                if (errors) {
                    var errorMessage = '';
                    $.each(errors, function(key, value) {
                        errorMessage += value + '\n';
                    });
                    Swal.fire({
                        title: "Error",
                        text: errorMessage,
                      });
                }
            } else {
                Swal.fire({
                    title: "Error",
                    text: "Hubo un error en el servidor",
                  });
            }
        }

    })

}

