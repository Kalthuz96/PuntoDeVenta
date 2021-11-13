<?php
     class Product extends Controllers{
        public function __construct(){

            parent::__construct();
            session_start();
            if(empty($_SESSION['login'])){
                header('Location: '.base_url().'login');
            }
        }

        public function product(){
            //echo "Mensaje desde el controlador";

            $data['tag_page'] = "RetoRD | Productos";
            $data['page_title'] = "PRODUCTOS |<small>Punto De Venta</small>";
            $data['page_name'] = "product" ;
            $data['page_function_js'] = "function_product.js";
            $this->views->getView($this,'product',$data);
        }
    }
?>