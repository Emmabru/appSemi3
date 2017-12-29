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
	<h2>Pancakes</h2>

	<div class="recipe-top-section">
		<div class="ingredienser"> 
			<h3>Ingredients</h3>
			<ul>
			  <li><b>1 1/2 cups (195 grams) all-purpose flour</b></li>
			  <li><b>2 tablespoons sugar</b></li>
			  <li><b>1 tablespoon baking powder</b></li>
			  <li><b>3/4 teaspoon kosher salt</b></li>
			  <li><b>1 1/4 cups (295 ml) milk, dairy and non-dairy both will work</b></li>
			  <li><b>1 large egg</b></li>
			  <li><b>4 tablespoons butter, melted, plus more for skillet</b></li>
			  <li><b>1 teaspoon vanilla extract</b></li>

			</ul> 
		</div>

		<div class="meal-pic" >
			<img src="/seminar-3/resources/images/pannkakor.jpg" alt="Pancakes" style="width:50%; height:50%;"> 
		</div>
	</div>

	<div class="recipe-description">
		<h3>HOW TO DO</h3>
		<p>

		Heat a large skillet (or use griddle) over medium heat. The pan is ready if when you splatter a little water onto the pan surface, the water dances around the pan and eventually evaporates.

		Make a well in the center of the flour mixture, pour milk mixture into the well and use a fork to stir until you no longer see clumps of flour. It is okay if the batter has small lumps, in fact you want that – it is important not to over-mix the batter.
		Lightly brush skillet with melted butter. Use a 1/4-cup measuring cup to spoon batter onto skillet. Gently spread the batter into a 4-inch circle.

		When edges look dry and bubbles start to appear and pop on the top surfaces of the pancake, turn over. This takes about 2 minutes. Once flipped, cook another 1 to 2 minutes or until lightly browned and cooked in the middle. Serve immediately with warm syrup, butter and/or berries.

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

		          echo '<a href="Pancakes?delete=' . $comment['idcomments'] . '"> Delete </a>';

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
			 	<form action='Pancakes' method='post'>
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