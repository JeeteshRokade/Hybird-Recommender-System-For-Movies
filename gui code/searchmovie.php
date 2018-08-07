<html>
<head>
<title>
Search Movies...
</title>

 <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UserInfo</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/user.css">
</head>
<body>
<?php
session_start();
if(!isset($_SESSION['logged_in']) && $_SESSION['logged_in']==false)
{
	header('Location: reclogin.php');
}
?>
    <nav class="navbar navbar-default">
        <div class="container">
            
                <button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
            </div>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="nav navbar-nav">
				   <li role="presentation"><a href="buildmodel.php">Home</a></li>
				     <li role="presentation"><a href="<?php $moviesratedurl="moviesrated?userid=".$_SESSION['userid'];echo $moviesratedurl ;?>">Movies Rated </a></li>
                    <li role="presentation"><a href="<?php $watchlisturl="watchlist?userid=".$_SESSION['userid'];echo $watchlisturl; ?>">Wishlist </a></li>
                     <li role="presentation"><a href="<?php $advsearchurl="searchmovie.php";echo $advsearchurl; ?>">Advanced Search</a></li>      
                    <li role="presentation"><a href="<?php $nomsearchurl="generalsearch.php";echo $nomsearchurl; ?>">Normal Search</a></li> 	
					 <li role="presentation"><a href="<?php $userpgurl="userpages.php?userid=".$_SESSION['userid'];echo $userpgurl; ?>">Profile </a></li>
                    <li role="presentation"><a href="<?php $logouturl="logout.php";echo $logouturl; ?>">Logout </a></li>
                </ul>
            </div>
        </div>
    </nav>
	
<div align="center">	
<form action="searchmovie.php" method="post">

<label>Title</label><br>
<input type="text" name="title"><br>


<label>Genre</label><br>
<select name="genre" >
  <option value=""></option>
  <option value="Action" >Action</option>
  <option value="Adventure">Adventure</option>
  <option value="Animation">Animation</option>
  <option value="Children's">Children's</option>
   <option value="Comedy">Comedy</option>
  <option value="Crime">Crime</option>
  <option value="Documentary">Documentary</option>
  <option value="Drama">Drama</option>
   <option value="Fantasy">Fantasy</option>
  <option value="Film-Noir">Film-Noir</option>
  <option value="Horror">Horror</option>
  <option value="Musical">Musical</option>
   <option value="Mystery">Mystery</option>
  <option value="Romance">Romance</option>
  <option value="Sci-Fi">Sci-Fi</option>
  <option value="Thriller">Thriller</option>
   <option value="War">War</option>
  <option value="Western">Western</option>
</select><br>

<label>Country</label><br>
<input type="text" name="country"><br>


<label>Director</label><br>
<input type="text" name="director"><br>


<label>Year</label><br>
<input type="text" name="year"><br>


<label>Cast</label><br>
<input type="text" name="cast"><br>


<label>Writer</label><br>
<input type="text" name="writer"><br>


<input type="reset">
<input type="submit" name="Submit" value="Search">

</form>

<?php
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
   
   if(isset($_POST['Submit']))
   {
   $title=mysqli_real_escape_string($con,$_POST['title']);
 
      $genres=$_POST['genre'];
  
  
 
   $director=mysqli_real_escape_string($con,$_POST['director']);
   $nwsdirector = str_replace(' ', '', $director);
   $year=mysqli_real_escape_string($con,$_POST['year']);
   $cast=mysqli_real_escape_string($con,$_POST['cast']);
   $nwscast = str_replace(' ', '', $cast);
  
   $writer=mysqli_real_escape_string($con,$_POST['writer']);
   $nwswriter = str_replace(' ', '', $writer);
   $country=mysqli_real_escape_string($con,$_POST['country']);
   

		
   	$query="SELECT * FROM movieinfo WHERE  Title LIKE '%$title%' AND Genre LIKE '%$genres%' AND Stars LIKE '%$nwscast%' AND Directors LIKE '%$nwsdirector%' AND Writers LIKE '%$nwswriter%' AND RYear LIKE '%$year%' AND Country LIKE '%$country%'";
	$result = mysqli_query($con,$query)or die(mysqli_error());
	
	

 if (mysqli_num_rows($result) != 0  )
   {
   
    echo "<table  cellpadding='3' cellspacing='5' style='padding:5px'>";
	echo "<th> NO. </th>";
	echo "<th> Title </th>";
	$index=1;
    while ($row=mysqli_fetch_assoc($result))
	{
		$url="moviepage?movieid=".$row['movieid']."&userid=".$_SESSION['userid'];
		echo "<tr>";
		echo "<td>".$index."</td>";
	     echo "<td>"."<a href=".$url.">".$row['Title']."</a>"."</td>";
	   echo "</tr>";
	    $index=$index+1;
	}
	
	echo "</table>";
   } 
   
   else {
    echo "No Matches Found.";
   }
 

   }
		mysqli_close($con);
?>
</div>
</body>
</html>