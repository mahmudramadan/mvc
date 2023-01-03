$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(".form-signin").submit(function () {
        let submitButton = $("#submitButton");
        submitButton.attr("disabled", "disabled");
        $.ajax({
            method: "POST",
            url: BASE_URL+"login-user",
            data: {
                email: $("#inputEmail").val(),
                password: $("#inputPassword").val(),
            },
            dataType: "json",
            success: function (response) {
                if (response.success === true) {
                    $("#form-error").html("<div class='alert alert-success'>Login user successfully</div>");
                    submitButton.remove();
                    window.setTimeout(function () {
                        window.location.href = BASE_URL+"admin-page";
                    }, 3000);
                } else {
                    submitButton.removeAttr("disabled");
                    $("#form-error").html("<div class='alert alert-danger'>" + response.message + "</div>")
                }
            }
        })
        return false;
    });
});
