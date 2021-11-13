<?php
    class Dashboard extends Controllers{
        public function __construct(){

            parent::__construct();
            session_start();
            if(empty($_SESSION['login'])){
                header('Location: '.base_url().'login');
            }
        }

        public function dashboard(){
            //echo "Mensaje desde el controlador";
            $data['page_id'] = 2;
            $data['tag_page'] = "RetoRD | Punto De Venta";
            $data['page_title'] = "Dashboard | Punto De Venta";
            $data['page_name'] = "Dashboard" ;
            $this->views->getView($this,'dashboard',$data);
        }
    }

?>