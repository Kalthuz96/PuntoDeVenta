<?php
     class Category extends Controllers{
        public function __construct(){

            parent::__construct();
            session_start();
            if(empty($_SESSION['login'])){
                header('Location: '.base_url().'login');
            }
        }

        public function category(){
            //echo "Mensaje desde el controlador";

            $data['tag_page'] = "RetoRD | Categorias";
            $data['page_title'] = "CATEGORIAS |<small>Punto De Venta</small>";
            $data['page_name'] = "category" ;
            $data['page_function_js'] = "function_category.js";
            $this->views->getView($this,'category',$data);
        }
    }
?>