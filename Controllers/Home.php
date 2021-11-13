<?php
    class Home extends Controllers{
        public function __construct(){

            parent::__construct();
            session_start();
            if(empty($_SESSION['login'])){
                header('Location: '.base_url().'login');
            }
        }

        public function home(){
            //echo "Mensaje desde el controlador";
            $data['page_id'] = 1;
            $data['tag_page'] = "RetoRD | Punto De Venta";
            $data['page_title'] = "Pagina principal";
            $data['page_name'] = "home" ;
            $data['page_function_js'] = "function_home.js";
            $this->views->getView($this,'home',$data);
        }
    }

?>