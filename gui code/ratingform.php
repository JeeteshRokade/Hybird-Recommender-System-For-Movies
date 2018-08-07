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
		
            <form action="generalsearch.php" method="post">
              <input type="text" name="searchstring">
              <input type="submit" name="search" value="Search">
             </form>
         
	
	</ul>
	
	
<form action="ratingform.php" method="POST">
<label> Select Genre </label>
<select name="genre">


<option name="Action"> Action</option>
<option name="Adventure"> Adventure</option>
<option name="Animation"> Animation</option>
<option name="Children's">Children's </option>
<option name="Comedy"> Comedy</option>
<option name="Crime">Crime </option>
<option name="Documentary">Documentary </option>
<option name="Drama"> Drama</option>
<option name="Fantasy"> Fantasy</option>
<option name="Film-Noir"> Film-Noir</option>
<option name="Horror"> Horror</option>
<option name="Musical">Musical </option>
<option name="Mystery"> Mystery</option>
<option name="Romance"> Romance</option>
<option name="Sci-Fi">Sci-Fi </option>
<option name="Thriller"> Thriller</option>
<option name="War"> War</option>
<option name="Western">Western </option>

</select>
<input type="submit" name="submit" value= "Go">
</form>

<form action="buildmodel.php",method="POST"> 
<input type="submit" name="submit" value="Get Recommendations">
</form>
<p style="font-family: 'Roboto', sans-serif; font-size: 25px; color: #000010;"><?php  ?></p>






<?php
                          if(isset($_POST['genre']))
						  {
							  $genre=$_POST['genre'];
						  }
                          else
						  {
						 $genre="Action";
						  }
						 echo '<p style="font-family: , sans-serif; font-size: 25px; color: #000010;">Top '.$genre.'</p>';
                        $query="SELECT movieid,Title,Ratings FROM movieinfo WHERE Genre LIKE '%$genre%' AND Ratings >5 ORDER BY Ratings DESC";

                         $result = mysqli_query($con,$query)or die(mysqli_error());
                         echo "<table> ";
						 echo "<th> Movie </th>";
						 echo "<th> Imdb Rating </th>";
						 echo "<th> Rate </th>";
   
                           while ($row=mysqli_fetch_assoc($result))
	                        {
								
								$mid=$row['movieid'];
					     $query4="SELECT posterlink FROM movieposter WHERE movieid LIKE '%$mid%'";

                         $result4 = mysqli_query($con,$query4)or die(mysqli_error());
						 $rowt=mysqli_fetch_assoc($result4);
						 $poster=$rowt['posterlink'];
						 $url="moviepage?movieid=".$row['movieid']."&userid=".$_SESSION['userid'];
						echo '<tr><td><img height="60px" width="40px" src="'.$poster.'" alt="Smiley face" ></td>';
                         echo "<td> <a href=".$url.">".$row['Title']."</a></td>";
                         echo "<td><p>".$row['Ratings']."</p></td>";
						 $movieid=$row['movieid'];
						$userid=$_SESSION['userid'];
						
						
						
						$query5="SELECT * FROM moviesrated WHERE movieid LIKE '%$movieid%' AND userid LIKE '%$userid%'";
	                  $result5 = mysqli_query($con,$query5)or die(mysqli_error());
								if (mysqli_num_rows($result5) != 0)
								{
						echo "<td><p style='padding:0 45px;'>Movie Rated</p></td></tr>";
								 }
								 else
								 {
									 
								 $rateurl="ratemovie?movieid=".$row['movieid'];
					 echo "<td><form class='movrating' action='$rateurl' method='POST'>";
					echo "<input type='number' name='rating' min='1' max='5' class='ratings'> / 5";
					echo "<input class='btn' type='submit' name='submit' value='>' style='margin-left: 32px;'>";
					echo "</form></td></tr>";
								 }
							}
					echo "</table>";
							
?>

</body>
</html>