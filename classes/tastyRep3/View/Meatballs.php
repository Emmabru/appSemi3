<?php
namespace tastyRep3\View;
use Id1354fw\View\AbstractRequestHandler;
use tastyRep3\Util\Constants;
use tastyRep3\Controller;
use tastyRep3\Model;
/*
 * Shows the index page of the application
 */
class Meatballs extends AbstractRequestHandler {
    
    private $user_comment;
    private $recipeID;
    private $delete = null;
    
    public function setDelete($delete){
        $this->delete=$delete;
    }
    
    public function setUser_comment($user_comment){
        $this->user_comment = $user_comment;
    }
    
    public function setRecipeID($recipeID){
        $this->recipeID = $recipeID;
    } 
    protected function doExecute() {
         
        $this->session->restart();
        $control = new \tastyRep3\Controller\addComment();
        if($this->delete!==null && preg_match('/^[0-9]{1,10}$/', $this->delete)){  
            $control->deleteComment($this->session->get(Constants::USER_LOGGED_IN), $this->delete);
        }
        
        if(empty($this->user_comment)) {
            $list_of_comments = $control->getComments('2');
            $this->addVariable('comments', $list_of_comments);
            return 'recipe2';
        } else {
            
        
            if('ok' == $newComment = $control->newComment($this->session->get(Constants::USER_LOGGED_IN), $this->recipeID,$this->user_comment)) {
                return 'recipe2';
            } else {
                echo "<br> error i Meatballs";
            }
            
            

            }
        }
    }