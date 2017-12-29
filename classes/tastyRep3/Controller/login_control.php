<?php 
namespace tastyRep3\Controller;

use tastyRep3\Util\Constants;
use tastyRep3\Model;

      define('DB_SERVER', 'localhost:3306');
      define('DB_USERNAME', 'app-course');
      define('DB_PASSWORD', 'AppDatabase.1');
      define('DB_DATABASE', 'tastyRep');


class login_control {

   public function __construct(){

   }

   public function dbConn() {
      $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

      if(!$db){
         die("Connection failed: ".mysqli_connect_error());
      }
         return $db;
      }

   public function loginUser($username, $password) {
     
        $user = new \tastyRep3\Model\User($username,$password);
        $login = $user->loginUser();

        if($login == 'Invalid'){
            echo 4;
            //return 'login_page';
        }else if($login == 'loginOk'){
            
            return 'ok';
            
        }else {
            echo 5;
            //return 'login_page';
        }
   }

   public function signUpUser($username, $password){
    
      $user = new \tastyRep3\Model\User($username,$password);
      $login = $user->signUpUser();
      if( $login == 'signUpComplete'){
        return 'ok';
      } else {
      }

   }
}



