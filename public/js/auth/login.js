$(document).ready(function () {
    $("#username").focus();
    $("#password").keyup(function (event) {
        if (event.keyCode === 13) {
            $("#btn_login").click();
        }
    });
});
setTimeout(function () {
    $(".preloader").fadeOut();
}, 500);

var Do_login = function Do_login() {
    var Toast = Set_Toast();
    var Array_id = [
        'username',
        'password'
    ];
    var Check_input = Check_null_input(Array_id);
    if (Check_input == true) {
        $(".preloader").fadeIn();
        axios({
            method: 'POST',
            url: '/api/v1/do_login',
            headers: {
                "Content-Type": "application/json"
            },
            data: {
                username: $("#username").val(),
                password: $("#password").val()
            }
        })
        .then(function (response) {
            $("#username").removeClass('is-valid').removeClass('is-invalid');
            $("#password").removeClass('is-valid').removeClass('is-invalid');

            location.href = "/dashboard";
        })
        .catch(function (error) {
            $(".preloader").fadeOut();
            Swal.fire({
                icon: 'error',
                title: 'แจ้งเตือน!',
                text: error.response.data.massage,
                confirmButtonText: 'ยืนยัน'
            })
            if (error.response.data.response_color.username == 'error') {
                $("#username").removeClass('is-valid').addClass('is-invalid').focus();
            }
            if (error.response.data.response_color.password == 'error') {
                $("#password").removeClass('is-valid').addClass('is-invalid').focus();
            }
        })
    } else {
        Toast.fire({
            icon: 'error',
            title: 'ข้อมูลยังไม่ครบ'
        })
    }
}

var Check_null_input = function Check_null_input(Array_id) {
    var success_rows = 0;
    var error_rows = 0;

    $(Array_id).each(function (index, value) {
        function Check_null_Input() {
            if ($("#" + value).val() == '') {
                $("#" + value).removeClass('is-valid').addClass('is-invalid');
                return false;
            } else {
                $("#" + value).removeClass('is-invalid').addClass('is-valid');
                return true;
            }
        }
        var Check_null_Input = Check_null_Input() == true ? success_rows++ : error_rows++;
    });
    var result = success_rows == Array_id.length ? true : false;
    return result;
}

var Set_Toast = function Set_Toast() {
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 5000,
        timerProgressBar: true,
        onOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })

    return Toast
}