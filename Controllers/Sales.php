<?php
     class Sales extends Controllers{
        public function __construct(){

            parent::__construct();
            session_start();
            if(empty($_SESSION['login'])){
                header('Location: '.base_url().'login');
            }
        }

        public function sales(){
            //echo "Mensaje desde el controlador";

            $data['tag_page'] = "RetoRD | Ventas";
            $data['page_title'] = "VENTAS |<small>Punto De Venta</small>";
            $data['page_name'] = "sales" ;
            $data['page_function_js'] = "function_sales.js";
            $this->views->getView($this,'sales',$data);
        }
    }
?>