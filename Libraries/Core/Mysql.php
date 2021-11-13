<?php
    class Mysql extends Conexion{
        private $conection;
        private $strquery;
        private $arrValues;

        function __construct(){
            $this->conection = new Conexion();
            $this->conection = $this->conection->conect();  
        }

        //Insertar un registro
        public function insert(string $query, array $arrValues){
            $this->strquery = $query;
            $this->arrValues = $arrValues;

            $insert = $this->conection->prepare($this->strquery);
            $resInsert = $insert->execute($this->arrValues);
            if($resInsert){
                $lastInsert = $this->conection->lastInsertId();
            }else{
                $lastInsert = 0;
            }
            return $lastInsert;
        }
        
        //Seleccionar un registro
        public function select(string $query){
            $this->strquery = $query;
            $result = $this->conection->prepare($this->strquery);
            $result->execute();
            $data = $result->fetch(PDO::FETCH_ASSOC);
            return $data;
        }

        //Seleccionar todos los registros
        public function select_all(string $query){
            $this->strquery = $query;
            $result = $this->conection->prepare($this->strquery);
            $result->execute();
            $data = $result->Fetchall(PDO::FETCH_ASSOC);
            return $data;
        }

        //Actualizar un registro
        public function update(string $query, array $arrValues){
            $this->strquery = $query;
            $this->arrValues = $arrValues;
            $update = $this->conection->prepare($this->strquery);
            $resExecute = $update->execute($this->arrValues);
            return $resExecute;
        }

        //Eliminar un registro
        public function delete(string $query){
            $this->strquery = $query;
            $result = $this->conection->prepare($this->strquery);
            $result->execute();
            return $result;
        }
    }
?>