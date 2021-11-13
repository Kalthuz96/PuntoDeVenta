<?php
    class Users extends Controllers{
        public function __construct(){

            parent::__construct();
            session_start();
            if(empty($_SESSION['login'])){
                header('Location: '.base_url().'login');
            }
        }

        public function users(){
            //echo "Mensaje desde el controlador";

            $data['tag_page'] = "RetoRD | Usuarios";
            $data['page_title'] = "USUARIOS |<small>Punto De Venta</small>";
            $data['page_name'] = "usuario" ;
            $data['page_function_js'] = "function_users.js";
            $this->views->getView($this,'users',$data);
        }

        public function setUser(){
            if($_POST){
                //dep($_POST);
                if(empty($_POST['txtNickName']) || empty($_POST['txtName']) || empty($_POST['txtLastName']) || empty($_POST['txtEmail']) || empty($_POST['txtTelephone']) || empty($_POST['listStatus'])){
                    $arrResponse = array ("status" => false, "msg"=>'Datos Incorrectos');
                }else{
                    $idUser = intval($_POST['idUser']);
                    $strNickName = strClean($_POST['txtNickName']);
                    $strName = ucwords(strClean($_POST['txtName']));
                    $strLastName = ucwords(strClean($_POST['txtLastName']));
                    $strEmail = strtolower(strClean($_POST['txtEmail']));
                    $intTelephone = intval(strClean($_POST['txtTelephone']));
                    $intStatus = intval(strClean($_POST['listStatus']));

                    if($idUser == 0){
                        $option = 1;
                        $strPassword = empty($_POST['txtPassword']) ? hash("SHA256",passGenerator()) : hash("SHA256",$_POST['txtPassword']);
                        $request_user = $this->model->insertUser($strNickName,$strName,$strLastName,$strEmail,$intTelephone,$intStatus,$strPassword);
                    }else{
                        $option = 2;
                        $strPassword = empty($_POST['txtPassword']) ? hash("SHA256",passGenerator()) : hash("SHA256",$_POST['txtPassword']);
                        $request_user = $this->model->updateUser($idUser,$strNickName,$strName,$strLastName,$strEmail,$intTelephone,$intStatus,$strPassword);

                    }

                   if($request_user > 0){
                       if($option == 1){
                            $arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
                       }else{
                            $arrResponse = array('status' => true, 'msg' => 'Datos actualizados correctamente.');
                       }
                        
                    }else if($request_user == 'exist'){
                        $arrResponse = array('status' => false, 'msg' => '¡Atención! El Correo Electronico o Nickname ya existe, ingrese otro.');
                    }else{

                        $arrResponse = array('status' => false, 'msg' => 'No es posible almacenar los datos');
                    }
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            }
            die();
        }

        public function getUsers(){
            $arrData = $this->model->selectUsers();
            for ($i=0; $i < count($arrData); $i++) {

				if($arrData[$i]['UserStatus'] == 1)
				{
					$arrData[$i]['UserStatus'] = '<span class="badge badge-success">Activo</span>';
				}else{
					$arrData[$i]['UserStatus'] = '<span class="badge badge-danger">Inactivo</span>';
				}

				$arrData[$i]['UserOptions'] = '<div class="text-center">
				<button class="btn btn-secondary btn-sm btnViewUser" onClick="fntViewUser('.$arrData[$i]['UserID'].')" title="Ver Usuario"><i class="fa fa-eye"></i></button>
                <button class="btn btn-primary btn-sm btnEditUser" onClick="fntEditUser('.$arrData[$i]['UserID'].')" title="Editar Usuario"><i class="fa fa-pencil"></i></button>
				<button class="btn btn-danger btn-sm btnDelUser" onClick="fntDelUser('.$arrData[$i]['UserID'].')" title="Eliminar Usuario"><i class="fa fa-trash"></i></button>
				</div>';
			}
			echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			die();
            //dep($arrData);
        }

        public function getUser(int $idUser){
            $idUser = intval($idUser);
            if($idUser > 0){
                $arrData = $this->model->selectUser($idUser);
                //dep($arrData);
                if(empty($arrData)){
                    $arrResponse = array('status' => false, 'msg' => 'Datos no encontrados');
                }else{
                    $arrResponse = array('status' => true, 'data' => $arrData);
                }
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            }
            die();
        }

        public function delUser(){
            //dep($_POST);
            if($_POST){
                $intIDUser = intval($_POST['idUser']);
                $request_delete = $this->model->deleteUser($intIDUser);
                if($request_delete){
                    $arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el usuario');
                }else{
                    $arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el usuario');
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            }
            die();
        }
    
    }

?>