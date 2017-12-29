<html lang="en">
<head>
<meta charset="utf-8">
<title>Emma</title>
<link rel="stylesheet" type="text/css" href="/seminar-3/resources/css/reset.css">

</head>

<body>
<h1>Tasty recipe</h1>
<p> All in one bite</p>
<div class="menu">
	<nav>
	 <ul>
	  <li><a class="active" href="/seminar-3/tastyRep3/View/FirstPage">Home</a></li>
	  <li><a href="/seminar-3/tastyRep3/View/Pancakes">Pancakes</a></li>
	  <li><a href="/seminar-3/tastyRep3/View/Meatballs">Meatballs</a></li>
	  <li><a href="/seminar-3/tastyRep3/View/Calendar">Calendar</a></li>
	 	<?php
		use tastyRep3\Util\Constants;
	  	$this->session->restart();
	  	
	  	if($this->session->get(Constants::USER_LOGGED_IN) == "notLoggedIn" || $this->session->get(Constants::USER_LOGGED_IN) == null){
	  		echo "<li><a href='/seminar-3/tastyRep3/View/Login_view'>Login</a></li>";
	  	}else{
	  		echo "<li><a href='#''>".$this->session->get(Constants::USER_LOGGED_IN)."</a></li>";
		}
		?>
	</ul>
	</nav>

</div>


<section class="recipe">
	<h2>Meatballs</h2>

	<div class="recipe-top-section">
		<div class="ingredienser"> 
			<h3>Ingredients</h3>
			<ul>
				<li><b>1 lb lean (at least 80%) ground beef</b></li>
				<li><b>1/2 cup Progresso™ Italian-style bread crumbs</b></li>
				<li><b>1/4 cup milk</b></li>
				<li><b>1/2 teaspoon salt</b></li>
				<li><b>1/2 teaspoon Worcestershire sauce</b></li>
				<li><b>1/4 teaspoon pepper</b></li>
				<li><b>1 small onion, finely chopped (1/4 cup)</b></li>
				<li><b>1 egg</b></li> 
			</ul> 
		</div>

		<div class="meal-pic" >
			<img src="/seminar-3/resources/images/kottbullar.jpg" alt="Meatballs" style="width:50%; height:50%;"> 
		</div>
	</div>

	<div class="recipe-description">
		<h3>HOW TO DO</h3>
		<p>
		 Heat oven to 400°F. Line 13x9-inch pan with foil; spray with cooking spray. In large bowl, mix all ingredients. Shape mixture into 20 to 24 (1 1/2-inch) meatballs. Place 1 inch apart in pan. Bake uncovered 18 to 22 minutes or until no longer pink in center.
		 </p>
	</div>

	
	<div class="comments_section">
	 	<h3>Comments</h3>
	 	<div class="comment">
        <?php
	
		foreach ($comments as $comment)
		{
		  ?>
		    <div class="c1">
		      <p>
		        <?php echo $comment['username']; ?><br />
		        <?php echo $comment['comment']; ?><br />
		        <?php echo nl2br($comment['message']);
		       if($this->session->get(Constants::USER_LOGGED_IN) == "notLoggedIn" || $this->session->get(Constants::USER_LOGGED_IN) == null){
			  		echo " not logged in";
			  	}elseif( $this->session->get(Constants::USER_LOGGED_IN) ==$comment['username']){

		          echo '<a class="delete" href="Meatballs?delete=' . $comment['idcomments'] . '"> Delete </a>';

		        }
		        
		        ?>
		      </p>
		    </div>
		  <?php
		}
		?>

	 	</div>

	 	<?php
	  	$this->session->restart();
	  	
	  	if($this->session->get(Constants::USER_LOGGED_IN) == "notLoggedIn" || $this->session->get(Constants::USER_LOGGED_IN) == null){
	  		
	  	} else {
	  		echo 
	  		" <div class='comment_new'>
		 		<br>
			 	<form action='Meatballs' method='post'>
				  <input type='text' name='user_comment' value='Write your comment here'/>
				  <input type='hidden' id='recipeID' name='recipeID' value='1'/>
				  <input type='submit' value='Submit'>
				</form>
			</div>
		
			";}
		?>
		</div>
</section>

</body>
</html>