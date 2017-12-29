<?php
namespace tastyRep3\Model;
use tastyRep3\Model\dbmanager;
class Comment {
    
    private $username;
    private $recipeID;
    private $user_comment;
    
    public function __construct($username, $recipeID, $user_comment) {
        $this->dbmanager = new dbmanager();  
        $this->username = $username;
        $this->recipeID = $recipeID;
        $this->user_comment = $user_comment;
    }
    public function addComment(){
        //echo " <br> inne i Comment! <br> ";
        //echo "<br>          " . $this->username;
        if('okDB' == $this->dbmanager->createComment($this->username, $this->recipeID, $this->user_comment)) {
            return 'commentOk';
        } else {
            echo " error in Comment";
        }
        //return 
    }
}