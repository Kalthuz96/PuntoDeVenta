<?php

    class UsersModel extends Mysql{
        
        private $intIDUser;
        private $strNickName;
        private $strName;
        private $strLastName;
        private $strEmail;
        private $intTelephone;
        private $intStatus;
        private $strPassword;
        private $strToken;
        private $intIDUserChange;

        public function __construct(){
            parent::__construct();
        }

        public function insertUser(string $nickname, string $name, string $lastname, string $email, int $telephone,int $status, string $password){
            $this->strNickName = $nickname;
            $this->strName = $name;
            $this->strLastName = $lastname;
            $this->strEmail = $email;
            $this->intTelephone = $telephone;
            $this->intStatus = $status;
            $this->strPassword = $password;
            $this->intIDUserChange = $_SESSION['idUser']; 

            $return = 0;

            $sql = "SELECT * FROM user WHERE UserEmail = '{$this->strEmail}' or UserNickName = '{$this->strNickName}'";
            $request = $this->select_all($sql);
            if(empty($request)){
                $query_insert = "INSERT INTO user (UserName, UserLastName, UserEmail, UserTelephone, UserNickname, UserPassword, UserStatus,UserChange)
                                VALUES(?,?,?,?,?,?,?,?)";
                $arrData = array($this->strName, $this->strLastName,$this->strEmail,$this->intTelephone,$this->strNickName,$this->strPassword,$this->intStatus,$this->intIDUserChange);
                $request_insert = $this->insert($query_insert,$arrData);
                $return = $request_insert;
                if($request_insert > 0){
                    $details = '{
                                    "table" : "user",
                                    "UserName" : "'.$this->strName.'",
                                    "UserLastName" : "'.$this->strLastName.'",
                                    "UserEmail" : "'.$this->strEmail.'",
                                    "UserTelephone" : '.$this->intTelephone.',
                                    "UserNickName" : "'.$this->strNickName.'",
                                    "UserPassword" : "'.$this->strPassword.'",
                                    "UserStatus" : '.$this->intStatus.',
                                    "UserChange" : '.$this->intIDUserChange.'
                                }';
                    $query_insert = "INSERT INTO transcription (DescriptionTrans,Details,UserChange)
                                         VALUES(?,?,?)";
                    $arrData = array('Se Inserto Un Dato',$details,$this->intIDUserChange);
                    $request_insert = $this->insert($query_insert,$arrData); 
                }
            }else{
                $return = "exist";
            }
            
            return $return;
        }

        public function selectUsers(){
            $sql = "SELECT UserID, UserName, UserLastName, UserEmail, UserTelephone, UserStatus FROM user WHERE UserStatus != 0 AND deleted_at IS NULL";
            $request = $this->select_all($sql);
            return $request;
        }

        public function selectUser(int $idUser){
            $this->intIDUser = $idUser;
            $sql = "SELECT UserID, UserName,UserLastName,UserEmail,UserTelephone,UserNickName,UserStatus,DATE_FORMAT(created_at,'%d-%m-%Y') AS dateRegister FROM user WHERE UserID = $this->intIDUser";
            $request = $this->select($sql);
            return $request;
        }

        public function updateUser(int $idUser, string $nickname, string $name, string $lastname, string $email, int $telephone,int $status, string $password){
            $this->intIDUser = $idUser;
            $this->strNickName = $nickname;
            $this->strName = $name;
            $this->strLastName = $lastname;
            $this->strEmail = $email;
            $this->intTelephone = $telephone;
            $this->intStatus = $status;
            $this->strPassword = $password;
            $this->intIDUserChange = $_SESSION['idUser']; 
            
            $sql = "SELECT * FROM user WHERE (UserEmail = '{$this->strEmail}' AND UserID != '{$this->intIDUser}') OR (UserNickName = '{$this->strNickName}' AND UserID != '{$this->intIDUser}')";
            $request = $this->select_all($sql);
            if(empty($request)){
                $update_at = date("Y-m-d H:i:s");
                if($this->strPassword != ""){
                    $sql = "UPDATE user SET UserName = ?, UserLastName = ?, UserEmail = ?, UserTelephone = ?, UserNickName = ?, UserPassword = ?, UserStatus = ?, update_at = ?, UserChange = ? WHERE UserID = $this->intIDUser";
                    $arrData = array($this->strName, 
                                    $this->strLastName,
                                    $this->strEmail,
                                    $this->intTelephone,
                                    $this->strNickName,
                                    $this->strPassword,
                                    $this->intStatus,
                                    $update_at,
                                    $this->intIDUserChange);                    
                }else{
                    $sql = "UPDATE user SET UserName = ?, UserLastName = ?, UserEmail = ?, UserTelephone = ?, UserNickName = ?,
                    UserStatus = ?, update_at = ?, UserChange = ?
                    WHERE UserID = '{$this->intIDUser}'";
                    $arrData = array($this->strName, 
                                    $this->strLastName,
                                    $this->strEmail,
                                    $this->intTelephone,
                                    $this->strNickName,
                                    $this->intStatus,
                                    $update_at,
                                    $this->intIDUserChange);
                }
                $request = $this->update($sql,$arrData);
                $return = $request;
                if($request > 0){
                    $details = '{
                                    "table" : "user",
                                    "UserName" : "'.$this->strName.'",
                                    "UserLastName" : "'.$this->strLastName.'",
                                    "UserEmail" : "'.$this->strEmail.'",
                                    "UserTelephone" : '.$this->intTelephone.',
                                    "UserNickName" : "'.$this->strNickName.'",
                                    "UserPassword" : "'.$this->strPassword.'",
                                    "UserStatus" : '.$this->intStatus.',
                                    "UserChange" : '.$this->intIDUserChange.'
                                }';
                    $query_insert = "INSERT INTO transcription (DescriptionTrans,Details,UserChange)
                                         VALUES(?,?,?)";
                    $arrData = array('Se Actualizo Un Dato',$details,$this->intIDUserChange);
                    $request = $this->insert($query_insert,$arrData); 
                }
            }else{
                $return = 'exist';
            }
            return $return;
        }

        public function deleteUser(int $idUser){
            $delete_at = date("Y-m-d H:i:s");
            $this->intIDUser = $idUser;
            $this->intIDUserChange = $_SESSION['idUser']; 
            $sql = "UPDATE user SET UserStatus = ?, deleted_at = ?, UserChange = ? WHERE UserID = $this->intIDUser";
            $arrData = array(0,$delete_at,$this->intIDUserChange);
            $request = $this->update($sql, $arrData);
            $return = $request;
            if($request > 0){
                $details = '{
                                "table" : "user",
                                "UserID" : "'.$this->intIDUser.'",
                                "UserStatus" : 0,
                                "deleted_at" : "'.$delete_at.'"
                            }';
                $query_insert = "INSERT INTO transcription (DescriptionTrans,Details,UserChange)
                                     VALUES(?,?,?)";
                $arrData = array('Se Elimino Un Dato',$details,$this->intIDUserChange);
                $request = $this->insert($query_insert,$arrData); 
            }
            return $return;
        }
    }
?>