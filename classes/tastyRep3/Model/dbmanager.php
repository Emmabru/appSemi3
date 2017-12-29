<?php
namespace tastyRep3\Model;
class dbmanager {
    
    private $conn;
    
   public function __construct() {
        $dbServername = "localhost:3306";
        $dbUsername = "app-course";
        $dbPassword = "AppDatabase.1";
        $dbName = "tastyRep";
        $conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);
        $this->conn = $conn;
    }
    
    public function getUsernameByName($username){  
        $usernameSafe = mysqli_real_escape_string($this->conn, $username);     
        $query = "SELECT username FROM user WHERE username ='".$usernameSafe."'";
        $result = mysqli_query($this->conn, $query);
        return $result;
    }
    public function getUserPasswordByName($username){
        $usernameSafe = mysqli_real_escape_string($this->conn, $username);     
        $query = "SELECT password FROM user WHERE username ='".$usernameSafe."';";
        echo $query;
        $result = mysqli_query($this->conn, $query);
        if($result == false || $result == FALSE){
            echo "FAIL!!!!";
        }
        $row = mysqli_fetch_assoc($result);
        echo $row['password'];
        return $row['password'];
    }

    public function createUser($username,$password){
        $usernameSafe = mysqli_real_escape_string($this->conn,$username);
        $passwordSafe = mysqli_real_escape_string($this->conn,$password);
        $query = "INSERT INTO user (username, password) VALUES ('".$usernameSafe."', '".$passwordSafe."');";
        mysqli_query($this->conn, $query);
    }

    public function createComment($username, $recipeID, $user_comment){
        
        $usernameSafe = mysqli_real_escape_string($this->conn, $username);
        $recipeSafe = mysqli_real_escape_string($this->conn,$recipeID);
        $commentTextSafe = mysqli_real_escape_string($this->conn,$user_comment);
       
        $query = "SELECT id_user FROM user WHERE username ='".$usernameSafe."';";
        //echo $query;
        $userid = mysqli_query($this->conn, $query);
        $userid = mysqli_fetch_assoc($userid);
        //echo "<br> DETTA " . $userid['id_user'];
        $idUser = $userid['id_user'];
        
        $query = "INSERT INTO comments (author, comment) VALUES ($idUser, '".$commentTextSafe."');";
        //echo $query. "<br>";
        mysqli_query($this->conn, $query);
        $idComm = $this->conn->insert_id;
        
        $query = "INSERT INTO recipeToComment (recipeID, commentid) VALUES ('".$recipeSafe."', '".$idComm."');";
        //echo $query;
        if(mysqli_query($this->conn, $query)){
            return 'okDB';
        }
       
    }
    
    public function getComment($recipe){
        /*$recipeSafe = mysqli_real_escape_string($this->conn,$recipe);
        $query = "SELECT * FROM recipecomment WHERE recipe = '".$recipeSafe."'";
        $queryResults = mysqli_query($this->conn, $query);
        return $queryResults;
        */
       
        $list_of_comments = array();
      $sql="SELECT commentID FROM recipeToComment WHERE recipeID = '" . $recipe . "';";
      $result = mysqli_query($this->conn,$sql);
          while($row= mysqli_fetch_assoc($result)){
             array_push($list_of_comments, $row);
          }
      foreach ($result as $link){
        $sql="SELECT c.comment,c.author, u.username, c.idcomments
                from recipeToComment as r
                inner join comments as c on c.idcomments= r.commentID
                left join user as u on c.author = u.id_user
                where r.commentID ='" . $link['commentID'] . "';";
       // echo $sql . "</br>";
        $result = mysqli_query($this->conn,$sql);
            while($row= mysqli_fetch_assoc($result)){
             array_push($list_of_comments, $row);
             //echo $row['comment'];
            }
      }
                 
      return $list_of_comments;
    }
  
   /* public function getCommentAuthor($recipe){
        $recipeSafe = mysqli_real_escape_string($this->conn,$recipe);
        $list_of_authors = array();
        // alla kommentarers id för ett recept
        $sql="SELECT commentID FROM recipeToComment WHERE recipeID = '" . $recipe . "'";
        echo $sql . "</br>";
        $result = mysqli_query($this->conn,$sql);
         while($row= mysqli_fetch_assoc($result)){
             array_push($list_of_comments, $row);
          }
    foreach ($result as $link){
        $sql = "SELECT c.comment,c.author, u.username, c.idcomments
                from recipeToComment as r
                inner join comments as c on c.idcomments= r.commentID
                left join user as u on c.author = u.id_user
                where r.commentID ='25';";
                echo $sql;
                $result = mysqli_query($this->conn,$sql);
            while($row= mysqli_fetch_assoc($result)){
             array_push($list_of_authors, $row);
             echo $row['username'];
            }
        }
            return $list_of_authors;  
/*
        foreach ($row as $authorid){
        $sql="SELECT author FROM comments WHERE idcomments = '" . $link['commentID'] . "'";
        echo $sql . "</br>";
        $result = mysqli_query($this->conn,$sql);
            while($row= mysqli_fetch_assoc($result)){
             array_push($list_of_comments, $row);
             echo $row['author'];
            }  
      
    }*/
    
    public function deleteComment($commentID){
        $commentIDSafe = mysqli_real_escape_string($this->conn,$commentID);
        $query = "DELETE FROM comments WHERE idcomments = '$commentIDSafe';";
        mysqli_query($this->conn, $query);
        $query = "DELETE FROM recipeToComment WHERE commentID = '$commentIDSafe';";
        mysqli_query($this->conn, $query);
    }
}