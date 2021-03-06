$('.login-content [data-toggle="flip"]').click(function() {
    $('.login-box').toggleClass('flipped');
    return false;
});

document.addEventListener("DOMContentLoaded", function() {
    if (document.querySelector("#formLogin")) {

        let formLogin = document.querySelector("#formLogin");
        formLogin.onsubmit = function(e) {
            e.preventDefault();

            let strNickName = document.querySelector("#txtNickName").value;
            let strPassword = document.querySelector("#txtPassword").value;

            if (strNickName == "" || strPassword == "") {
                swal("Por Favor", "Escribe Usuario y Contraseña", "error");
                return false;
            } else {
                var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                var ajaxUrl = base_url + '/Login/loginUser';
                var formData = new FormData(formLogin);
                request.open("POST", ajaxUrl, true);
                request.send(formData);

                request.onreadystatechange = function() {
                    if (request.readyState != 4) return;
                    if (request.status == 200) {
                        var objData = JSON.parse(request.responseText);
                        if (objData.status) {
                            window.location = base_url + "/dashboard";
                        } else {
                            swal("Atención", objData.msg, "error");
                            document.querySelector("#txtPassword").value = "";
                        }
                    } else {
                        swal("Atención", "Error En El Proceso", "error");
                    }
                    //console.log(request);
                    return false;
                }
            }
        }
    }

    if (document.querySelector("#formRecetPass")) {
        let formRecetPass = document.querySelector("#formRecetPass");
        formRecetPass.onsubmit = function(e) {
            e.preventDefault();

            let strEmail = document.querySelector("#txtEmailReset").value;
            if (strEmail == "") {
                swal("Por favor", "Escribe tu correo electrónico", "error");
                return false;
            } else {
                var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                var ajaxUrl = base_url + 'Login/resetPass';
                var formData = new FormData(formRecetPass);
                request.open("POST", ajaxUrl, true);
                request.send(formData);
                request.onreadystatechange = function() {
                    if (request.readyState != 4) return;
                    if (request.status == 200) {
                        var objData = JSON.parse(request.responseText);
                        if (objData.status) {
                            swal({
                                title: "",
                                text: objData.msg,
                                type: "success",
                                confirmButtonText: "Aceptar",
                                closeOnConfirm: false,
                            }, function(isConfirm) {
                                if (isConfirm) {
                                    window.location = base_url;
                                }
                            });
                        } else {
                            swal("Atención", objData.msg, "error");
                        }
                    } else {
                        swal("Atención", "Error en el proceso", "error");
                    }
                    return false;
                }
            }
        }
    }

    if (document.querySelector("#formResetPass")) {
        let formResetPass = document.querySelector("#formResetPass");
        formResetPass.onsubmit = function(e) {
            e.preventDefault();

            let strPassword = document.querySelector("#txtPassword").value;
            let strPasswordConfirm = document.querySelector("#txtPasswordConfirm").value;
            let idUsuario = document.querySelector("#idUser").value;

            if (strPassword == "" || strPasswordConfirm == "") {
                swal("Por Favor", "Escribe La Nueva Contraseña", "error");
                return false;
            } else {
                if (strPassword.length < 5) {
                    swal("Atención", "La Contraseña debe tener un mínimo de 5 caracteres", "info");
                    return false;
                }
                if (strPassword != strPasswordConfirm) {
                    swal("Atención", "Las Contraseñas No Coinciden", "error");
                    return false;
                }

                var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                var ajaxUrl = base_url + 'Login/setPassword';
                var formData = new FormData(formResetPass);
                request.open("POST", ajaxUrl, true);
                request.send(formData);
                request.onreadystatechange = function() {
                    if (request.readyState != 4) return;
                    if (request.status == 200) {
                        var objData = JSON.parse(request.responseText);
                        if (objData.status) {
                            swal({
                                title: "",
                                text: objData.msg,
                                type: "success",
                                confirmButtonText: "Iniciar Sesión",
                                closeOnConfirm: false,
                            }, function(isConfirm) {
                                if (isConfirm) {
                                    window.location = base_url + 'login';
                                }
                            });
                        } else {
                            swal("Atención", objData.msg, "error");
                        }
                    } else {
                        swal("Atención", "Error En El Proceso", "error");
                    }
                }
            }
        }
    }
}, false);