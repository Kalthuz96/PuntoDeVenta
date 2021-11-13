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
            $data['page_id'] = 1;
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
    }

?>