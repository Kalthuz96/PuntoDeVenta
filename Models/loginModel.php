<?php

    class loginModel extends Mysql{

        private $intIDUser;
        private $strNickName;
        private $strPassword;
        private $strToken;

        public function __construct(){
            //echo "Mensaje desde el modelo home";
            parent::__construct();
        }
        
        public function loginUser(string $nickname, string $password){
            $this->strNickName = $nickname;
            $this->strPassword = $password;
            $sql = "SELECT UserID, UserStatus FROM user WHERE UserNickName = '{$this->strNickName}' AND UserPassword = '{$this->strPassword}' AND UserStatus !=0 ";
            $request = $this->select($sql);
            return $request;
        }

        public function sessionLogin(int $idUser){
            $this->intIDUser = $idUser;
            $sql = "SELECT UserID, UserName, UserLastName, UserImage, UserEmail,  UserTelephone, UserStatus, UserNickName FROM user WHERE UserID = $this->intIDUser";
            $request = $this->select($sql);
            return ($request);
        }
    }
?>