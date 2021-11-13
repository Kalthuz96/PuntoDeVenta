<?php
     class Transaction extends Controllers{
        public function __construct(){

            parent::__construct();
            session_start();
            if(empty($_SESSION['login'])){
                header('Location: '.base_url().'login');
            }
        }

        public function transaction(){
            //echo "Mensaje desde el controlador";

            $data['tag_page'] = "RetoRD | Transacciones";
            $data['page_title'] = "TRANSACCIONES |<small>Punto De Venta</small>";
            $data['page_name'] = "transaction" ;
            $data['page_function_js'] = "function_transaction.js";
            $this->views->getView($this,'transaction',$data);
        }
    }
?>