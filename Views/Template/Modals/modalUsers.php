<!-- Modal -->
<div class="modal fade" id="modalFormUser" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Nuevo Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
              <form id="formUser" name="formUser">
                <input type="hidden" id="idUser" name="idUser" value="">
                <p class="text-primary">Todos los campos son obligatorios</p>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="txtNickName">NickName</label>
                        <input type="text" class="form-control valid validText" id="txtNickName" name="txtNickName" required="">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="txtName">Nombre(s)</label>
                        <input type="text" class="form-control valid validText" id="txtName" name="txtName" required="">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="txtLastName">Apellidos(s)</label>
                        <input type="text" class="form-control valid validText" id="txtLastName" name="txtLastName" required="">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="txtEmail">Email</label>
                        <input type="email" class="form-control valid validEmail" id="txtEmail" name="txtEmail" required="">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="txtTelephone">Teléfono</label>
                        <input type="tel" class="form-control valid validNumber" id="txtTelephone" name="txtTelephone" required="" onkeypress="return controlTag(event);">
                    </div>
                </div>
                    <div class="form-row">
                      <!--div class="form-group col-md-6">
                        <label for="txtImg">Imagen</label>
                        <input type="file" class="form-control" id="txtImg" name="txtImg">
                    </div-->
                    <div class="form-group col-md-6">
                        <label for="listStatus">Status</label>
                        <select class="form-control" id="listStatus" name="listStatus">
                            <option value="1">Activo</option>
                            <option value="2">Inactivo</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="txtPassword">Contraseña</label>
                        <input type="password" class="form-control"id="txtPassword" name="txtPassword">
                    </div>
                </div>

                <div class="tile-footer">
                  <button id="btnActionForm" class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Guardar</span></button>&nbsp;&nbsp;&nbsp;
                  <button class="btn btn-danger" type="button" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-fa-times-circle"></i>Cerrar</button>
                </div>
              </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalViewUser" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header header-primary">
        <h5 class="modal-title" id="titleModal">Datos Del Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered">
          <tbody>
            <tr>
              <td>ID Del Usuario: </td>
              <td id="cellIDUser"></td>
            </tr>
            <tr>
              <td>Nickname: </td>
              <td id="cellNickName"></td>
            </tr>
            <tr>
              <td>Nombre(s): </td>
              <td id="cellName"></td>
            </tr>
            <tr>
              <td>Apellido(s): </td>
              <td id="cellLastName"></td>
            </tr>
            <tr>
              <td>Email: </td>
              <td id="cellEmail"></td>
            </tr>
            <tr>
              <td>Telefono: </td>
              <td id="cellTelephone"></td>
            </tr>
            <tr>
              <td>Status: </td>
              <td id="cellStatus"></td>
            </tr>
            <tr>
              <td>Fecha De Ingreso: </td>
              <td id="cellRegister"></td>
            </tr>
            <!--tr>
              <td>Imagen Usuario: </td>
              <td id="cellImage"></td>
            </tr-->
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
