<?php
    class Login extends Controllers{
        public function __construct(){
            session_start();
            parent::__construct();
            if(isset($_SESSION['login'])){
                header('Location: '.base_url().'dashboard');
            }
        }

        public function login(){
            //echo "Mensaje desde el controlador";
            $data['page_tag'] = "RetoRD | Login";
            $data['page_title'] = "RetoRD | Login";
            $data['page_name'] = "Login" ;
            $data['page_function_js'] = "function_login.js";
            $this->views->getView($this,'login',$data);
        } 

        public function loginUser(){
            //dep($_POST);
            if($_POST){
                if(empty($_POST['txtNickName']) || empty($_POST['txtPassword'])){
                    $arrResponse = array('status' => false, 'msg' => 'Error de datos');
                }else{
                    $strUser = strClean($_POST['txtNickName']);
                    $strPassword = hash("SHA256", $_POST['txtPassword']);
                    $requestUser = $this->model->loginUser($strUser, $strPassword);
                    //dep($requestUser);
                    if(empty($requestUser)){
                        $arrResponse = array('status' => false, 'msg' => 'El usuario o la contraseña es incorrecto.');
                    }else{
                        $arrData = $requestUser;
                        if($arrData['UserStatus'] == 1){
                            $_SESSION['idUser'] = $arrData['UserID'];
                            $_SESSION['login'] = true;

                            $arrData = $this->model->sessionLogin($_SESSION['idUser']);
                            $_SESSION['userData'] = $arrData;

                            $arrResponse = array('status' => true, 'msg' => 'ok');
                        }else{
                            $arrResponse = array('status' => false, 'msg' => 'Usuario Inactivo. Verifica Con El Administrador.');
                        }
                    }
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            }
            die();
        }

        public function resetPass(){
            if($_POST){
                if(empty($_POST['txtEmailReset'])){
                    $arrResponse = array('status' => false, 'msg' => 'Error de datos');
                }else{
                    $token = token();
                    $strEmail = strtolower(strClean($_POST['txtEmailReset']));
                    $arrData = $this->model->getUserEmail($strEmail);

                    if(empty($arrData)){
                        $arrResponse = array('status' => false, 'msg' => 'Usuario No Encontrado');
                    }else{
                        $idUser = $arrData['UserID'];
                        $NameUser = $arrData['UserName'].' '.$arrData['UserLastName'];

                        $url_recovery = base_url().'login/confirmUser/'.$strEmail.'/'.$token;
                        $requestUpdate = $this->model->setTokenUser($idUser, $token);

                        $dataUser = array('nameUser' => $NameUser, 'UserEmail' => $strEmail, 'Asunto' => 'Recuperar Contraseña -'.NOMBRE_REMITENTE, 'url_recovery => $url_recovery'=>$url_recovery);
                        $sendEmail = sendEmail($dataUser,'changePassword');

                        if($requestUpdate){
                            $sendEmail = sendEmail($dataUser,'changePassword');
                            if($sendEmail){
                                $arrResponse = array('status' => true, 'msg' => 'Se ha enviado un email a tu cuenta de correo para cambiar tu contraseña');
                            }else{
                                $arrResponse = array('status' => false, 'msg' => 'No es posible realizar el proceso, intenta más tarde.');
                            }

                           
                        }else{
                            $arrResponse = array('status' => false, 'msg' => 'No es posible realizar el proceso, intenta más tarde.');
                        }
                    }
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            }
            die();
        }

        public function confirmUser(string $params){

            if(empty($params)){
                header('Location'.base_url());
            }else{
                $arrParams = explode(',',$params);
                $strEmail = strClean($arrParams[0]);
                $strToken = strClean($arrParams[1]);

                $arrData = $this->model->getUser($strEmail,$strToken);
                if(empty($arrData)){
                    header("Location: ".base_url());
                }else{
                    $data['page_tag'] = "RetoRD | Cambiar Contraseña";
                    $data['page_title'] = "RetoRD | Cambiar Contraseña";
                    $data['page_name'] = "Cambiar Contraseña" ;
                    $data['UserID'] = $arrData['UserID'];
                    $data['UserEmail'] = $strEmail;
                    $data['UserToken'] = $strToken;
                    $data['page_function_js'] = "function_login.js";

        
                    $this->views->getView($this,"change_password",$data);
                }
            }
        }

        public function setPassword(){
            //dep($_POST);

            if(empty($_POST['idUser']) || empty($_POST['txtPassword']) || empty($_POST['txtPasswordConfirm']) || empty($_POST['txtEmail'])|| empty($_POST['txtToken'])){
                $arrResponse = array('status' => false, 'msg' => 'Error De Datos');
            }else{
                $intIDUser = intval($_POST['idUser']);
                $strPassword = strClean($_POST['txtPassword']);
                $strEmail = strClean($_POST['txtEmail']);
                $strToken = strClean($_POST['txtToken']);
                $strPasswordConfirm = strClean($_POST['txtPasswordConfirm']);

                if($strPassword != $strPasswordConfirm){
                    $arrResponse = array('status' => false, 'msg' => 'Las Contraseñas No Son Iguales.');
                }else{
                    $arrDataUser = $this->model->getUser($strEmail,$strToken);
                    if(empty($arrDataUser)){
                        $arrResponse = array('status' => false, 'msg' => 'Error De Datos.');
                    }else{
                        $strPassword = hash("SHA256",$strPassword);
                        $requestPass = $this->model->insertPassword($intIDUser,$strPassword);

                        if($requestPass){
                            $arrResponse = array('status' => true, 'msg' => 'Contraseña Actualizada con Éxito.');
                        }else{
                            $arrResponse = array('status' => false, 'msg' => 'No Es Posible Realizar El Proceso, Intente Más Tarde');
                        }
                    }
                }
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            die();
        }
    }

?>