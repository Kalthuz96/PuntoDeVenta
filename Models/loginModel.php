<?php

    class loginModel extends Mysql{

        private $intIDUser;
        private $strNickName;
        private $strPassword;
        private $strEmail;
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

        public function getUserEmail(string $email){
            $this->strEmail = $email;
            $sql = "SELECT UserID, UserName, UserLastName, UserStatus FROM user WHERE UserEmail = '$this->strEmail' AND UserStatus = 1";
            $request = $this->select($sql);
            return $request;
        }

        public function setTokenUser(int $idUser, string $token){
            $this->intIDUser = $idUser;
            $this->strToken = $token;
            $update_at = date("Y-m-d H:i:s");

            $sql = "UPDATE user SET UserToken = ?, update_at = ? WHERE UserID = $this->intIDUser";
            $arrData = array($this->strToken,$update_at);
            $request = $this->update($sql,$arrData);
            $return = $request;
            if($request > 0){
                $details = '{
                    "table" : "user",
                    "UserID":"'.$this->intIDUser.'",
                    "UserToken": "'.$this->strToken.'",
                    "update_at": "'.$update_at.'"
                }';
                $query_insert = "INSERT INTO transcription (DescriptionTrans,Details,UserChange)
                                     VALUES(?,?,?)";
                $arrData = array('Se Actualizo El Token Del Usuario',$details,1);
                $request = $this->insert($query_insert,$arrData); 
            }
            return $return;
        }

        public function getUser(string $email, string $token){
            $this->strEmail = $email;
            $this->strToken = $token;
            $sql = "SELECT UserID FROM user WHERE UserEmail = '$this->strEmail' AND UserToken = '$this->strToken' AND UserStatus = 1";
            $request = $this->select($sql);
            return $request;
        }

        public function insertPassword(int $idUser, string $password){
            $this->intIDUser = $idUser;
            $this->strPassword = $password;
            $sql = "UPDATE user SET UserPassword = ?, UserToken = ? WHERE UserID = $this->intIDUser";
            $arrData = array($this->strPassword,"");
            $request = $this->update($sql,$arrData);
            return $request;
        }
    }
?>