<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
	<title>Rate Movies</title>
	
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
    <link rel="stylesheet" href="assetsq/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assetsq/css/styles.css">
	
</head>

<body>
<?php

session_start();
if(!isset($_SESSION['logged_in']) && $_SESSION['logged_in']==false)
{
	header('Location: reclogin.php');
}
  $con = mysqli_connect("localhost","root","root","movierecommender");
   
   if (mysqli_connect_errno()) 
   {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
   }

   
    $con = mysqli_connect("localhost","root","root","movierecommender");
   
   if (mysqli_connect_errno()) 
   {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
   }

   $ratecount=0;
 ?>
	<ul>
<li role="presentation"><a href="<?php $moviesratedurl="moviesrated?userid=".$_SESSION['userid'];echo $moviesratedurl ;?>">Movies Rated </a></li>
 <li role="presentation"><a href="<?php $watchlisturl="watchlist?userid=".$_SESSION['userid'];echo $watchlisturl; ?>">Wishlist </a></li>
 <li role="presentation"><a href="<?php $advsearchurl="searchmovie.php";echo $advsearchurl; ?>">Advanced Search</a></li>      
 <li role="presentation"><a href="<?php $nomsearchurl="generalsearch.php";echo $nomsearchurl; ?>">Normal Search</a></li> 
<li role="presentation"><a href="<?php $profileurl="userpages.php?userid=".$_SESSION['userid'];echo $profileurl; ?>">Profile </a></li>				
 <li role="presentation"><a href="<?php $logouturl="logout.php";echo $logouturl; ?>">Logout </a></li>
		

         
	
	</ul>
	
    <div class="container">
	<div class="row">
	
	<div class="form-top">
	<div class="form-top-left">
		<div class="MultiCarousel" data-items="1,3,5,6" data-slide="5" id="MultiCarousel"  data-interval="1000">
		 <p style="font-family: 'Roboto', sans-serif; font-size: 25px; color: #000010;">Top Action</p>
            <div class="MultiCarousel-inner">
                
                      <?php
						 $genre="Action";
                        $query="SELECT movieid,Title,Ratings FROM movieinfo WHERE Genre LIKE '%$genre%' ORDER BY Ratings DESC";

                         $result = mysqli_query($con,$query)or die(mysqli_error());
                         
   
                           while ($row=mysqli_fetch_assoc($result))
	                        {
								
								$mid=$row['movieid'];
					     $query4="SELECT posterlink FROM movieposter WHERE movieid LIKE '%$mid%'";

                         $result4 = mysqli_query($con,$query4)or die(mysqli_error());
						 $rowt=mysqli_fetch_assoc($result4);
						 $poster=$rowt['posterlink'];
						 $url="moviepage?movieid=".$row['movieid']."&userid=".$_SESSION['userid'];
								  echo "<div class='item' >";
                                 echo "<div class='pad15' >";
								 echo '<img src="'.$poster.'" alt="Smiley face" >';
                                 echo "<a href=".$url.">".$row['Title']."</a>";
                                 echo "<p>".$row['Ratings']."</p>";
								 
								 echo "</div>";
								 $movieid=$row['movieid'];
								 $userid=$_SESSION['userid'];
								 
					 $query5="SELECT * FROM moviesrated WHERE movieid LIKE '%$movieid%' AND userid LIKE '%$userid%'";
	                  $result5 = mysqli_query($con,$query5)or die(mysqli_error());
								if (mysqli_num_rows($result5) != 0)
								{
						echo "<p style='padding:0 45px;'>Movie Rated</p>";
								 }
								 else
								 {
									   echo "<div class='rat'>";
								 $rateurl="ratemovie?movieid=".$row['movieid'];
					           echo "<form class='movrating' action='$rateurl' method='POST'>";
					echo "<input type='number' name='rating' min='1' max='5' class='ratings'> / 5";
					echo "<input class='btn' type='submit' name='submit' value='>' style='margin-left: 32px;'>";
					echo "</form>";
                               echo " </div>";
									$ratecount=$ratecount+1;
								 }
							   echo "</div>";
								
							}
						?>
					
               
            </div>
            <button class="btn btn-primary leftLst"><</button>
            <button class="btn btn-primary rightLst">></button>
        </div>
		
		
		
		
				<div class="MultiCarousel" data-items="1,3,5,6" data-slide="5" id="MultiCarousel"  data-interval="1000">
		 <p style="font-family: 'Roboto', sans-serif; font-size: 25px; color: #000010;">Top Adventure</p>
            <div class="MultiCarousel-inner">
                
                      <?php
						 $genre="Adventure";
                        $query="SELECT movieid,Title,Ratings FROM movieinfo WHERE Genre LIKE '%$genre%' ORDER BY Ratings DESC";

                         $result = mysqli_query($con,$query)or die(mysqli_error());
                         
   
                           while ($row=mysqli_fetch_assoc($result))
	                        {
								$mid=$row['movieid'];
								$query4="SELECT posterlink FROM movieposter WHERE movieid LIKE '%$mid%'";

                         $result4 = mysqli_query($con,$query4)or die(mysqli_error());
						 $rowt=mysqli_fetch_assoc($result4);
						 $poster=$rowt['posterlink'];
								 $url="moviepage?movieid=".$row['movieid']."&userid=".$_SESSION['userid'];
								  echo "<div class='item'>";
                                 echo "<div class='pad15'>";
								 echo '<img src="'.$poster.'" alt="Smiley face" >';
                                echo "<a href=".$url.">".$row['Title']."</a>";
                                 echo "<p>".$row['Ratings']."</p>";
								 
								 echo "</div>";
								 $movieid=$row['movieid'];
								 $userid=$_SESSION['userid'];
								 
					 $query5="SELECT * FROM moviesrated WHERE movieid LIKE '%$movieid%' AND userid LIKE '%$userid%'";
	                  $result5 = mysqli_query($con,$query5)or die(mysqli_error());
								if (mysqli_num_rows($result5) != 0)
								{
						echo "<p style='padding:0 45px;'>Movie Rated</p>";
								 }
								 else
								 {
									   echo "<div class='rat'>";
								 $rateurl="ratemovie?movieid=".$row['movieid'];
					           echo "<form class='movrating' action='$rateurl' method='POST'>";
					echo "<input type='number' name='rating' min='1' max='5' class='ratings'> / 5";
					echo "<input class='btn' type='submit' name='submit' value='>' style='margin-left: 32px;'>";
					echo "</form>";
                               echo " </div>";
										$ratecount=$ratecount+1;
								 }
							   echo "</div>";
								
							}
						?>
					
               
            </div>
            <button class="btn btn-primary leftLst"><</button>
            <button class="btn btn-primary rightLst">></button>
        </div>
	
	
	
			<div class="MultiCarousel" data-items="1,3,5,6" data-slide="5" id="MultiCarousel"  data-interval="1000">
		 <p style="font-family: 'Roboto', sans-serif; font-size: 25px; color: #000010;">Top Animation</p>
            <div class="MultiCarousel-inner">
                
                      <?php
						 $genre="Animation";
                        $query="SELECT movieid,Title,Ratings FROM movieinfo WHERE Genre LIKE '%$genre%' ORDER BY Ratings DESC";

                         $result = mysqli_query($con,$query)or die(mysqli_error());
                         
   
                           while ($row=mysqli_fetch_assoc($result))
	                        {
								$mid=$row['movieid'];
								$query4="SELECT posterlink FROM movieposter WHERE movieid LIKE '%$mid%'";

                         $result4 = mysqli_query($con,$query4)or die(mysqli_error());
						 $rowt=mysqli_fetch_assoc($result4);
						 $poster=$rowt['posterlink'];
								 $url="moviepage?movieid=".$row['movieid']."&userid=".$_SESSION['userid'];
								  echo "<div class='item'>";
                                 echo "<div class='pad15'>";
								 echo '<img src="'.$poster.'" alt="Smiley face" >';
                               echo "<a href=".$url.">".$row['Title']."</a>";
                                 echo "<p>".$row['Ratings']."</p>";
								 
								 echo "</div>";
								 $movieid=$row['movieid'];
								 $userid=$_SESSION['userid'];
								 
					 $query5="SELECT * FROM moviesrated WHERE movieid LIKE '%$movieid%' AND userid LIKE '%$userid%'";
	                  $result5 = mysqli_query($con,$query5)or die(mysqli_error());
								if (mysqli_num_rows($result5) != 0)
								{
						echo "<p style='padding:0 45px;'>Movie Rated</p>";
								 }
								 else
								 {
									   echo "<div class='rat'>";
								 $rateurl="ratemovie?movieid=".$row['movieid'];
					           echo "<form class='movrating' action='$rateurl' method='POST'>";
					echo "<input type='number' name='rating' min='1' max='5' class='ratings'> / 5";
					echo "<input class='btn' type='submit' name='submit' value='>' style='margin-left: 32px;'>";
					echo "</form>";
                               echo " </div>";
										$ratecount=$ratecount+1;
								 }
							   echo "</div>";
								
							}
						?>
					
               
            </div>
            <button class="btn btn-primary leftLst"><</button>
            <button class="btn btn-primary rightLst">></button>
        </div>
		
		
					<div class="MultiCarousel" data-items="1,3,5,6" data-slide="5" id="MultiCarousel"  data-interval="1000">
		 <p style="font-family: 'Roboto', sans-serif; font-size: 25px; color: #000010;">Top Comedy</p>
            <div class="MultiCarousel-inner">
                
                      <?php
						 $genre="Comedy";
                        $query="SELECT movieid,Title,Ratings FROM movieinfo WHERE Genre LIKE '%$genre%' ORDER BY Ratings DESC";

                         $result = mysqli_query($con,$query)or die(mysqli_error());
                         
   
                           while ($row=mysqli_fetch_assoc($result))
	                        {
								$mid=$row['movieid'];
								$query4="SELECT posterlink FROM movieposter WHERE movieid LIKE '%$mid%'";

                         $result4 = mysqli_query($con,$query4)or die(mysqli_error());
						 $rowt=mysqli_fetch_assoc($result4);
						 $poster=$rowt['posterlink'];
								 $url="moviepage?movieid=".$row['movieid']."&userid=".$_SESSION['userid'];
								  echo "<div class='item'>";
                                 echo "<div class='pad15'>";
								 echo '<img src="'.$poster.'" alt="Smiley face" >';
                                echo "<a href=".$url.">".$row['Title']."</a>";
                                 echo "<p>".$row['Ratings']."</p>";
								 
								 echo "</div>";
								 $movieid=$row['movieid'];
								 $userid=$_SESSION['userid'];
								 
					 $query5="SELECT * FROM moviesrated WHERE movieid LIKE '%$movieid%' AND userid LIKE '%$userid%'";
	                  $result5 = mysqli_query($con,$query5)or die(mysqli_error());
								if (mysqli_num_rows($result5) != 0)
								{
						echo "<p style='padding:0 45px;'>Movie Rated</p>";
								 }
								 else
								 {
									   echo "<div class='rat'>";
								 $rateurl="ratemovie?movieid=".$row['movieid'];
					           echo "<form class='movrating' action='$rateurl' method='POST'>";
					echo "<input type='number' name='rating' min='1' max='5' class='ratings'> / 5";
					echo "<input class='btn' type='submit' name='submit' value='>' style='margin-left: 32px;'>";
					echo "</form>";
                               echo " </div>";
										$ratecount=$ratecount+1;
								 }
							   echo "</div>";
								
							}
						?>
					
               
            </div>
            <button class="btn btn-primary leftLst"><</button>
            <button class="btn btn-primary rightLst">></button>
        </div>
		
		
		
		
		
		
						<div class="MultiCarousel" data-items="1,3,5,6" data-slide="5" id="MultiCarousel"  data-interval="1000">
		 <p style="font-family: 'Roboto', sans-serif; font-size: 25px; color: #000010;">TopCrime</p>
            <div class="MultiCarousel-inner">
                
                      <?php
						 $genre="Crime";
                        $query="SELECT movieid,Title,Ratings FROM movieinfo WHERE Genre LIKE '%$genre%' ORDER BY Ratings DESC";

                         $result = mysqli_query($con,$query)or die(mysqli_error());
                         
   
                           while ($row=mysqli_fetch_assoc($result))
	                        {
								$mid=$row['movieid'];
								$query4="SELECT posterlink FROM movieposter WHERE movieid LIKE '%$mid%'";

                         $result4 = mysqli_query($con,$query4)or die(mysqli_error());
						 $rowt=mysqli_fetch_assoc($result4);
						 $poster=$rowt['posterlink'];
								 $url="moviepage?movieid=".$row['movieid']."&userid=".$_SESSION['userid'];
								  echo "<div class='item'>";
                                 echo "<div class='pad15'>";
								 echo '<img src="'.$poster.'" alt="Smiley face" >';
                                 echo "<a href=".$url.">".$row['Title']."</a>";
                                 echo "<p>".$row['Ratings']."</p>";
								 
								 echo "</div>";
								 $movieid=$row['movieid'];
								 $userid=$_SESSION['userid'];
								 
					 $query5="SELECT * FROM moviesrated WHERE movieid LIKE '%$movieid%' AND userid LIKE '%$userid%'";
	                  $result5 = mysqli_query($con,$query5)or die(mysqli_error());
								if (mysqli_num_rows($result5) != 0)
								{
						echo "<p style='padding:0 45px;'>Movie Rated</p>";
								 }
								 else
								 {
									   echo "<div class='rat'>";
								 $rateurl="ratemovie?movieid=".$row['movieid'];
					           echo "<form class='movrating' action='$rateurl' method='POST'>";
					echo "<input type='number' name='rating' min='1' max='5' class='ratings'> / 5";
					echo "<input class='btn' type='submit' name='submit' value='>' style='margin-left: 32px;'>";
					echo "</form>";
                               echo " </div>";
										$ratecount=$ratecount+1;
								 }
							   echo "</div>";
								
							}
						?>
					
               
            </div>
            <button class="btn btn-primary leftLst"><</button>
            <button class="btn btn-primary rightLst">></button>
        </div>
		
		
		
		
								<div class="MultiCarousel" data-items="1,3,5,6" data-slide="5" id="MultiCarousel"  data-interval="1000">
		 <p style="font-family: 'Roboto', sans-serif; font-size: 25px; color: #000010;">Top Drama</p>
            <div class="MultiCarousel-inner">
                
                      <?php
						 $genre="Drama";
                        $query="SELECT movieid,Title,Ratings FROM movieinfo WHERE Genre LIKE '%$genre%' ORDER BY Ratings DESC";

                         $result = mysqli_query($con,$query)or die(mysqli_error());
                         
   
                           while ($row=mysqli_fetch_assoc($result))
	                        {
								$mid=$row['movieid'];
								$query4="SELECT posterlink FROM movieposter WHERE movieid LIKE '%$mid%'";

                         $result4 = mysqli_query($con,$query4)or die(mysqli_error());
						 $rowt=mysqli_fetch_assoc($result4);
						 $poster=$rowt['posterlink'];
								 $url="moviepage?movieid=".$row['movieid']."&userid=".$_SESSION['userid'];
								  echo "<div class='item'>";
                                 echo "<div class='pad15'>";
								 echo '<img src="'.$poster.'" alt="Smiley face" >';
                                 echo "<a href=".$url.">".$row['Title']."</a>";
                                 echo "<p>".$row['Ratings']."</p>";
								 
								 echo "</div>";
								 $movieid=$row['movieid'];
								 $userid=$_SESSION['userid'];
								 
					 $query5="SELECT * FROM moviesrated WHERE movieid LIKE '%$movieid%' AND userid LIKE '%$userid%'";
	                  $result5 = mysqli_query($con,$query5)or die(mysqli_error());
								if (mysqli_num_rows($result5) != 0)
								{
						echo "<p style='padding:0 45px;'>Movie Rated</p>";
								 }
								 else
								 {
									   echo "<div class='rat'>";
								 $rateurl="ratemovie?movieid=".$row['movieid'];
					           echo "<form class='movrating' action='$rateurl' method='POST'>";
					echo "<input type='number' name='rating' min='1' max='5' class='ratings'> / 5";
					echo "<input class='btn' type='submit' name='submit' value='>' style='margin-left: 32px;'>";
					echo "</form>";
                               echo " </div>";
										$ratecount=$ratecount+1;
								 }
							   echo "</div>";
								
							}
						?>
					
               
            </div>
            <button class="btn btn-primary leftLst"><</button>
            <button class="btn btn-primary rightLst">></button>
        </div>
		

		
       <div class="MultiCarousel" data-items="1,3,5,6" data-slide="5" id="MultiCarousel"  data-interval="1000">
		 <p style="font-family: 'Roboto', sans-serif; font-size: 25px; color: #000010;">Top Horro</p>
            <div class="MultiCarousel-inner">
                
                      <?php
						 $genre="Horror";
                        $query="SELECT movieid,Title,Ratings FROM movieinfo WHERE Genre LIKE '%$genre%' ORDER BY Ratings DESC";

                         $result = mysqli_query($con,$query)or die(mysqli_error());
                         
   
                           while ($row=mysqli_fetch_assoc($result))
	                        {
								$mid=$row['movieid'];
								$query4="SELECT posterlink FROM movieposter WHERE movieid LIKE '%$mid%'";

                         $result4 = mysqli_query($con,$query4)or die(mysqli_error());
						 $rowt=mysqli_fetch_assoc($result4);
						 $poster=$rowt['posterlink'];
								 $url="moviepage?movieid=".$row['movieid']."&userid=".$_SESSION['userid'];
								  echo "<div class='item'>";
                                 echo "<div class='pad15'>";
								 echo '<img src="'.$poster.'" alt="Smiley face" >';
                                echo "<a href=".$url.">".$row['Title']."</a>";
                                 echo "<p>".$row['Ratings']."</p>";
								 
								 echo "</div>";
								 $movieid=$row['movieid'];
								 $userid=$_SESSION['userid'];
								 
					 $query5="SELECT * FROM moviesrated WHERE movieid LIKE '%$movieid%' AND userid LIKE '%$userid%'";
	                  $result5 = mysqli_query($con,$query5)or die(mysqli_error());
								if (mysqli_num_rows($result5) != 0)
								{
						echo "<p style='padding:0 45px;'>Movie Rated</p>";
								 }
								 else
								 {
									   echo "<div class='rat'>";
								 $rateurl="ratemovie?movieid=".$row['movieid'];
					           echo "<form class='movrating' action='$rateurl' method='POST'>";
					echo "<input type='number' name='rating' min='1' max='5' class='ratings'> / 5";
					echo "<input class='btn' type='submit' name='submit' value='>' style='margin-left: 32px;'>";
					echo "</form>";
                               echo " </div>";
										$ratecount=$ratecount+1;
								 }
							   echo "</div>";
								
							}
						?>
					
               
            </div>
            <button class="btn btn-primary leftLst"><</button>
            <button class="btn btn-primary rightLst">></button>
        </div>		
		
		
				
		<div class="MultiCarousel" data-items="1,3,5,6" data-slide="5" id="MultiCarousel"  data-interval="1000">
		 <p style="font-family: 'Roboto', sans-serif; font-size: 25px; color: #000010;">Top Mystery</p>
            <div class="MultiCarousel-inner">
                
                      <?php
						 $genre="Mystery";
                        $query="SELECT movieid,Title,Ratings FROM movieinfo WHERE Genre LIKE '%$genre%' ORDER BY Ratings DESC";

                         $result = mysqli_query($con,$query)or die(mysqli_error());
                         
   
                           while ($row=mysqli_fetch_assoc($result))
	                        {
								$mid=$row['movieid'];
								$query4="SELECT posterlink FROM movieposter WHERE movieid LIKE '%$mid%'";

                         $result4 = mysqli_query($con,$query4)or die(mysqli_error());
						 $rowt=mysqli_fetch_assoc($result4);
						 $poster=$rowt['posterlink'];
								 $url="moviepage?movieid=".$row['movieid']."&userid=".$_SESSION['userid'];
								  echo "<div class='item'>";
                                 echo "<div class='pad15'>";
								 echo '<img src="'.$poster.'" alt="Smiley face" >';
                                 echo "<a href=".$url.">".$row['Title']."</a>";
                                 echo "<p>".$row['Ratings']."</p>";
								 
								 echo "</div>";
								 $movieid=$row['movieid'];
								 $userid=$_SESSION['userid'];
								 
					 $query5="SELECT * FROM moviesrated WHERE movieid LIKE '%$movieid%' AND userid LIKE '%$userid%'";
	                  $result5 = mysqli_query($con,$query5)or die(mysqli_error());
								if (mysqli_num_rows($result5) != 0)
								{
						echo "<p style='padding:0 45px;'>Movie Rated</p>";
								 }
								 else
								 {
									   echo "<div class='rat'>";
								 $rateurl="ratemovie?movieid=".$row['movieid'];
					           echo "<form class='movrating' action='$rateurl' method='POST'>";
					echo "<input type='number' name='rating' min='1' max='5' class='ratings'> / 5";
					echo "<input class='btn' type='submit' name='submit' value='>' style='margin-left: 32px;'>";
					echo "</form>";
                               echo " </div>";
										$ratecount=$ratecount+1;
								 }
							   echo "</div>";
								
							}
						?>
					
               
            </div>
            <button class="btn btn-primary leftLst"><</button>
            <button class="btn btn-primary rightLst">></button>
        </div>
		
		
		
				<div class="MultiCarousel" data-items="1,3,5,6" data-slide="5" id="MultiCarousel"  data-interval="1000">
		 <p style="font-family: 'Roboto', sans-serif; font-size: 25px; color: #000010;">Top Romance</p>
            <div class="MultiCarousel-inner">
                
                      <?php
						 $genre="Romance";
                        $query="SELECT movieid,Title,Ratings FROM movieinfo WHERE Genre LIKE '%$genre%' ORDER BY Ratings DESC";

                         $result = mysqli_query($con,$query)or die(mysqli_error());
                         
   
                           while ($row=mysqli_fetch_assoc($result))
	                        {
								$mid=$row['movieid'];
								$query4="SELECT posterlink FROM movieposter WHERE movieid LIKE '%$mid%'";

                         $result4 = mysqli_query($con,$query4)or die(mysqli_error());
						 $rowt=mysqli_fetch_assoc($result4);
						 $poster=$rowt['posterlink'];
								 $url="moviepage?movieid=".$row['movieid']."&userid=".$_SESSION['userid'];
								  echo "<div class='item'>";
                                 echo "<div class='pad15'>";
								 echo '<img src="'.$poster.'" alt="Smiley face" >';
                                 echo "<a href=".$url.">".$row['Title']."</a>";
                                 echo "<p>".$row['Ratings']."</p>";
								 
								 echo "</div>";
								 $movieid=$row['movieid'];
								 $userid=$_SESSION['userid'];
								 
					 $query5="SELECT * FROM moviesrated WHERE movieid LIKE '%$movieid%' AND userid LIKE '%$userid%'";
	                  $result5 = mysqli_query($con,$query5)or die(mysqli_error());
								if (mysqli_num_rows($result5) != 0)
								{
						echo "<p style='padding:0 45px;'>Movie Rated</p>";
								 }
								 else
								 {
									   echo "<div class='rat'>";
								 $rateurl="ratemovie?movieid=".$row['movieid'];
					           echo "<form class='movrating' action='$rateurl' method='POST'>";
					echo "<input type='number' name='rating' min='1' max='5' class='ratings'> / 5";
					echo "<input class='btn' type='submit' name='submit' value='>' style='margin-left: 32px;'>";
					echo "</form>";
                               echo " </div>";
										$ratecount=$ratecount+1;
								 }
							   echo "</div>";
								
							}
						?>
					
               
            </div>
            <button class="btn btn-primary leftLst"><</button>
            <button class="btn btn-primary rightLst">></button>
        </div>
		
		
		
		<div class="MultiCarousel" data-items="1,3,5,6" data-slide="5" id="MultiCarousel"  data-interval="1000">
		 <p style="font-family: 'Roboto', sans-serif; font-size: 25px; color: #000010;">Top Sci-Fi</p>
            <div class="MultiCarousel-inner">
                
                      <?php
						 $genre="Sci-Fi";
                        $query="SELECT movieid,Title,Ratings FROM movieinfo WHERE Genre LIKE '%$genre%' ORDER BY Ratings DESC";

                         $result = mysqli_query($con,$query)or die(mysqli_error());
                         
   
                           while ($row=mysqli_fetch_assoc($result))
	                        {
								$mid=$row['movieid'];
								$query4="SELECT posterlink FROM movieposter WHERE movieid LIKE '%$mid%'";

                         $result4 = mysqli_query($con,$query4)or die(mysqli_error());
						 $rowt=mysqli_fetch_assoc($result4);
						 $poster=$rowt['posterlink'];
								 $url="moviepage?movieid=".$row['movieid']."&userid=".$_SESSION['userid'];
								  echo "<div class='item'>";
                                 echo "<div class='pad15'>";
								 echo '<img src="'.$poster.'" alt="Smiley face" >';
                               echo "<a href=".$url.">".$row['Title']."</a>";
                                 echo "<p>".$row['Ratings']."</p>";
								 
								 echo "</div>";
								 $movieid=$row['movieid'];
								 $userid=$_SESSION['userid'];
								 
					 $query5="SELECT * FROM moviesrated WHERE movieid LIKE '%$movieid%' AND userid LIKE '%$userid%'";
	                  $result5 = mysqli_query($con,$query5)or die(mysqli_error());
								if (mysqli_num_rows($result5) != 0)
								{
						echo "<p style='padding:0 45px;'>Movie Rated</p>";
								 }
								 else
								 {
									   echo "<div class='rat'>";
								 $rateurl="ratemovie?movieid=".$row['movieid'];
					           echo "<form class='movrating' action='$rateurl' method='POST'>";
					echo "<input type='number' name='rating' min='1' max='5' class='ratings'> / 5";
					echo "<input class='btn' type='submit' name='submit' value='>' style='margin-left: 32px;'>";
					echo "</form>";
                               echo " </div>";
										$ratecount=$ratecount+1;
								 }
							   echo "</div>";
								
							}
						?>
					
               
            </div>
            <button class="btn btn-primary leftLst"><</button>
            <button class="btn btn-primary rightLst">></button>
        </div>		
		
		
				<div class="MultiCarousel" data-items="1,3,5,6" data-slide="5" id="MultiCarousel"  data-interval="1000">
		 <p style="font-family: 'Roboto', sans-serif; font-size: 25px; color: #000010;">Top Thriller</p>
            <div class="MultiCarousel-inner">
                
                      <?php
						 $genre="Thriller";
                        $query="SELECT movieid,Title,Ratings FROM movieinfo WHERE Genre LIKE '%$genre%' ORDER BY Ratings DESC";

                         $result = mysqli_query($con,$query)or die(mysqli_error());
                         
   
                           while ($row=mysqli_fetch_assoc($result))
	                        {
								$mid=$row['movieid'];
								$query4="SELECT posterlink FROM movieposter WHERE movieid LIKE '%$mid%'";

                         $result4 = mysqli_query($con,$query4)or die(mysqli_error());
						 $rowt=mysqli_fetch_assoc($result4);
						 $poster=$rowt['posterlink'];
								 $url="moviepage?movieid=".$row['movieid']."&userid=".$_SESSION['userid'];
								  echo "<div class='item'>";
                                 echo "<div class='pad15'>";
								 echo '<img src="'.$poster.'" alt="Smiley face" >';
                                echo "<a href=".$url.">".$row['Title']."</a>";
                                 echo "<p>".$row['Ratings']."</p>";
								 
								 echo "</div>";
								 $movieid=$row['movieid'];
								 $userid=$_SESSION['userid'];
								 
					 $query5="SELECT * FROM moviesrated WHERE movieid LIKE '%$movieid%' AND userid LIKE '%$userid%'";
	                  $result5 = mysqli_query($con,$query5)or die(mysqli_error());
								if (mysqli_num_rows($result5) != 0)
								{
						echo "<p style='padding:0 45px;'>Movie Rated</p>";
								 }
								 else
								 {
									   echo "<div class='rat'>";
								 $rateurl="ratemovie?movieid=".$row['movieid'];
					           echo "<form class='movrating' action='$rateurl' method='POST'>";
					echo "<input type='number' name='rating' min='1' max='5' class='ratings'> / 5";
					echo "<input class='btn' type='submit' name='submit' value='>' style='margin-left: 32px;'>";
					echo "</form>";
                               echo " </div>";
										$ratecount=$ratecount+1;
								 }
							   echo "</div>";
								
							}
						?>
					
               
            </div>
            <button class="btn btn-primary leftLst"><</button>
            <button class="btn btn-primary rightLst">></button>
        </div>
		
		
		
				<div class="MultiCarousel" data-items="1,3,5,6" data-slide="5" id="MultiCarousel"  data-interval="1000">
		 <p style="font-family: 'Roboto', sans-serif; font-size: 25px; color: #000010;">Top War</p>
            <div class="MultiCarousel-inner">
                
                      <?php
						 $genre="War";
                        $query="SELECT movieid,Title,Ratings FROM movieinfo WHERE Genre LIKE '%$genre%' ORDER BY Ratings DESC";

                         $result = mysqli_query($con,$query)or die(mysqli_error());
                         
   
                           while ($row=mysqli_fetch_assoc($result))
	                        {
								
								$mid=$row['movieid'];
								$query4="SELECT posterlink FROM movieposter WHERE movieid LIKE '%$mid%'";

                         $result4 = mysqli_query($con,$query4)or die(mysqli_error());
						 $rowt=mysqli_fetch_assoc($result4);
						 $poster=$rowt['posterlink'];
								 $url="moviepage?movieid=".$row['movieid']."&userid=".$_SESSION['userid'];
								  echo "<div class='item'>";
                                 echo "<div class='pad15'>";
								 echo '<img src="'.$poster.'" alt="Smiley face" >';
                                echo "<a href=".$url.">".$row['Title']."</a>";
                                 echo "<p>".$row['Ratings']."</p>";
								 
								 echo "</div>";
								 $movieid=$row['movieid'];
								 $userid=$_SESSION['userid'];
								 
					 $query5="SELECT * FROM moviesrated WHERE movieid LIKE '%$movieid%' AND userid LIKE '%$userid%'";
	                  $result5 = mysqli_query($con,$query5)or die(mysqli_error());
								if (mysqli_num_rows($result5) != 0)
								{
						echo "<p style='padding:0 45px;'>Movie Rated</p>";
								 }
								 else
								 {
									   echo "<div class='rat'>";
								 $rateurl="ratemovie?movieid=".$row['movieid'];
					           echo "<form class='movrating' action='$rateurl' method='POST'>";
					echo "<input type='number' name='rating' min='1' max='5' class='ratings'> / 5";
					echo "<input class='btn' type='submit' name='submit' value='>' style='margin-left: 32px;'>";
					echo "</form>";
                               echo " </div>";
										$ratecount=$ratecount+1;
								 }
							   echo "</div>";
								
							}
						?>
					
               
            </div>
            <button class="btn btn-primary leftLst"><</button>
            <button class="btn btn-primary rightLst">></button>
        </div>
	</div>
	
		<?php
		
		
		
	    $query7="SELECT * FROM userinfo WHERE userid LIKE '%$userid%'";
	$result7 = mysqli_query($con,$query7)or die(mysqli_error());
	$rows=mysqli_fetch_assoc($result7);
		if($rows['ratecount']>4)
		{
     echo "<form align='center' action='buildmodel.php' method='POST'>";
	echo "<input type='submit' name='submit' value='Get Recommendations'>";
	 echo "</form>";
		}
		else{
			echo "<p align='center'>Rate 5 movies to unlock Recomnedations</p>";
		}
	?>
	</div>

	</div>

	</div>


	
    <script src="assetsq/js/jquery.min.js"></script>
    <script src="assetsq/bootstrap/js/bootstrap.min.js"></script>
    <script src="assetsq/js/carojs.js"></script>
	<script src="assetsq/js/jquery.backstretch.min.js"></script>
	<script src="assetsq/js/scripts.js"></script>
</body>

</html>