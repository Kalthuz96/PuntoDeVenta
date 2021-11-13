document.addEventListener('DOMContentLoaded', function() {

    tableUser = $('#tableUsers').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax": {
            "url": " " + base_url + "/Users/getUsers",
            "dataSrc": ""
        },
        "columns": [
            { "data": "UserID" },
            { "data": "UserName" },
            { "data": "UserLastName" },
            { "data": "UserEmail" },
            { "data": "UserTelephone" },
            { "data": "UserStatus" },
            { "data": "UserOptions" },
        ],
        dom: 'lBfrtip',
        buttons: [
            {
                "extend": "copyHtml5",
                "text": "<i class='fa fa-copy'></i>Copiar",
                "titleAttr":"Copiar",
                "className": "btn btn-secondary"
            },{
                "extend": "excelHtml5",
                "text": "<i class='fa fa-file-excel'></i>Excel",
                "titleAttr":"Exportar a Excel",
                "className": "btn btn-success"
            },{
                "extend": "pdfHtml5",
                "text": "<i class='fa fa-file-pdf'></i>PDF",
                "titleAttr":"Exportar a PDF",
                "className": "btn btn-danger"
            },{
                "extend": "csvHtml5",
                "text": "<i class='fa fa-file-csv'></i>CSV",
                "titleAttr":"Exportar a CSV",
                "className": "btn btn-info"
            }
        ],
        "resonsieve": "true",
        "bDestroy": true,
        "iDisplayLength": 10,
        "order": [
            [0, "desc"]
        ]
    });


    var formUser = document.querySelector("#formUser");
    formUser.onsubmit = function(e) {
        e.preventDefault();

        var strNickName = document.querySelector('#txtNickName').value;
        var strName = document.querySelector('#txtName').value;
        var strLastName = document.querySelector('#txtLastName').value;
        var strEmail = document.querySelector('#txtEmail').value;
        var intTelephone = document.querySelector('#txtTelephone').value;
        //var strImage = document.querySelector('#txtImg').value;
        var intStatus = document.querySelector('#listStatus').value;
        var strPassword = document.querySelector('#txtPassword').value;

        if (strNickName == '' || strName == '' || strLastName == '' || strEmail == '' || intTelephone == '' || intStatus == '') {
            swal("Atención", "Todos los campos son obligatorios", "error");
            return false;
        }

        let elementsValid = document.getElementsByClassName("valid");
        for (let i = 0; i < elementsValid.length; i++){
            if(elementsValid[i].classList.contains('is-invalid')){
                swal("Atención","Por favor verifique los campos en rojo", "error");
                return false;
            }
        }

        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var ajaxUrl = base_url + '/Users/setUser';
        var formData = new FormData(formUser);
        request.open("POST", ajaxUrl, true);
        request.send(formData);
        request.onreadystatechange = function() {
            if (request.readyState == 4 && request.status == 200) {
                var objData = JSON.parse(request.responseText);
                if (objData.status) {
                    $('#modalFormUser').modal("hide");
                    formUser.reset();
                    swal("Usuarios", objData.msg, "success");
                    tableUser.api().ajax.reload(function() {
                        /*setTimeout(() => {
                            fntViewUser();
                            fntEditUser();
                            fntDelUser();
                        }, 600); */     
                    });
                } else {
                    swal("Error", objData.msg, "error");
                }
            }
        }

    }
}, false);

window.addEventListener('load', function() {
    /*setTimeout(() => {
        fntViewUser();
        fntEditUser();
        fntDelUser();
    }, 600);*/
}, false);

function fntViewUser(idUser) {
    var idUser = idUser;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxetUser = base_url + 'Users/getUser/' + idUser;
    request.open("GET", ajaxetUser, true);
    request.send();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            var objData = JSON.parse(request.responseText);
            if (objData.status) {
                var UserStatus = objData.data.UserStatus == 1 ?
                    '<span class="badge badge-success">Activo</span>' :
                    '<span class="badge badge-danger">Inactivo</span>';
                document.querySelector('#cellIDUser').innerHTML = objData.data.UserID;
                document.querySelector('#cellNickName').innerHTML = objData.data.UserNickName;
                document.querySelector('#cellName').innerHTML = objData.data.UserName;
                document.querySelector('#cellLastName').innerHTML = objData.data.UserLastName;
                document.querySelector('#cellEmail').innerHTML = objData.data.UserEmail;
                document.querySelector('#cellTelephone').innerHTML = objData.data.UserTelephone;
                document.querySelector('#cellStatus').innerHTML = UserStatus;
                document.querySelector('#cellRegister').innerHTML = objData.data.dateRegister;
                $('#modalViewUser').modal('show');
            } else {
                swal("Error", objData.msg, "error");
            }
        }
    }
}

function fntEditUser(idUser) {
    document.querySelector('#titleModal').innerHTML = "Actualizar Usuario";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
    document.querySelector('#btnText').innerHTML = "Actualizar";


    var idUser = idUser;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxetUser = base_url + 'Users/getUser/' + idUser;
    request.open("GET", ajaxetUser, true);
    request.send();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            var objData = JSON.parse(request.responseText);

            if (objData.status) {
                document.querySelector('#idUser').value = objData.data.UserID;
                document.querySelector('#txtNickName').value = objData.data.UserNickName;
                document.querySelector('#txtName').value = objData.data.UserName;
                document.querySelector('#txtLastName').value = objData.data.UserLastName;
                document.querySelector('#txtEmail').value = objData.data.UserEmail;
                document.querySelector('#txtTelephone').value = objData.data.UserTelephone;

                if (objData.data.UserStatus == 1) {
                    document.querySelector('#listStatus').value = 1;
                } else {
                    document.querySelector('#listStatus').value = 2;
                }
            }
        }

        $('#modalFormUser').modal("show");
    }
}

function fntDelUser(idUser){
    var idUser = idUser;
    swal({
        title: "Eliminar Usuario",
        text: "¿Realmente quiere eliminar el Usuario?",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, eliminar!",
        cancelButtonText: "No, cancelar!",
        closeOnConfirm: false,
        closeOnCancel: true
    }, function(isConfirm) {
        if (isConfirm) 
        {
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var ajaxUrl = base_url+'/Users/delUser';
            var strData = "idUser="+idUser;
            request.open("POST",ajaxUrl,true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    var objData = JSON.parse(request.responseText);
                    if(objData.status)
                    {
                        swal("Eliminar!", objData.msg , "success");
                        tableUser.api().ajax.reload(function(){
                            /*setTimeout(() => {
                                fntViewUser();
                                fntEditUser();
                                fntDelUser();
                            }, 600); */ 
                        });
                    }else{
                        swal("Atención!", objData.msg , "error");
                    }
                }
            }
        }
    });
}


function openModal() {
    document.querySelector('#idUser').value = "";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML = "Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevo Usuario";
    document.querySelector('#formUser').reset();
    $('#modalFormUser').modal('show');
}