<?php
require_once __DIR__.'/../connections/Connections.php';

class ControllerUsers extends Connections {
    public function __construct(){}

    public function authenticationUser($loginUsername, $password){
        try {
            $query_login = "SELECT intUserID FROM users WHERE strUserLogin = :userLogin AND strUserPassword = :userPassword AND strUserStatus = 'on'";
            $stmt_login = $this->getConnectionBd()->prepare($query_login);
            $stmt_login->bindValue(':userLogin', $loginUsername, PDO::PARAM_STR);
            $stmt_login->bindValue(':userPassword', $password, PDO::PARAM_STR);
            $stmt_login->execute();

            if($stmt_login->rowCount()){
                $data_login = $stmt_login->fetch(PDO::FETCH_ASSOC);

                return $data_login['intUserID'];
            }

            return NULL;

        }catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getUserData($idUser){
        try {
            $query_user = "SELECT * FROM users WHERE intUserID = :idUser";
            $stmt_user = $this->getConnectionBd()->prepare($query_user);
            $stmt_user->bindValue(':idUser', $idUser, PDO::PARAM_INT);
            $stmt_user->execute();

            if($stmt_user->rowCount()){
                $data_user = $stmt_user->fetch(PDO::FETCH_ASSOC);

                return $data_user;
            }

            return NULL;

        }catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}