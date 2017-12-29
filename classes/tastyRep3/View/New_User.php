<?php
namespace tastyRep3\View;

use Id1354fw\View\AbstractRequestHandler;
use tastyRep3\Util\Constants;
use tastyRep3\Controller;
use tastyRep3\Model;
// USE DB MODEL??
//require_once('classes/tastyRep3/Model/User.php');

class New_User extends AbstractRequestHandler {
    
    private $theUsername;
    private $thePassword;
    
    public function setUsername($uid){
        $this->theUsername = $uid;
    }
    
    public function setPassword($pwd){
        $this->thePassword = $pwd;
    }


    protected function doExecute() {
       	 


       
        //$contr = $this->session->get(Constants::CONTR_KEY_NAME);
        
        if(empty($this->theUsername) || empty($this->thePassword)){  
            return 'newUserPage';
        }
        elseif(!preg_match("/^[a-zA-Z]*$/", $this->theUsername)){
            $status = 'Invalid';
              echo 2;
            return 'newUserPage';
        }
        elseif(strlen($this->theUsername) > 15 || strlen($this->thePassword) > 15){
            $status = 'Invalid';
             echo 3;
            return 'newUserPage';
        }

            $filtPassword = filter_var($this->thePassword, FILTER_SANITIZE_STRING);
            $filtUsername = filter_var($this->theUsername, FILTER_SANITIZE_STRING);
         $control = new \tastyRep3\Controller\login_control();
        if('ok' == $control->signUpUser($filtUsername,$filtPassword)) {
            //$this->session->restart();
            $this->session->set(Constants::USER_LOGGED_IN, $filtUsername);
            return 'index';
        } else {
             return 'newUserPage';
        }    
    }    
}