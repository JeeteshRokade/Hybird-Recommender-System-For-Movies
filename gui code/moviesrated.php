<html>
<head>
<title> Movies Rated </title>
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
	                <li role="presentation"><a href="<?php $profileurl="userpages.php?userid=".$_SESSION['userid'];echo $profileurl; ?>">Profile </a></li>				
                     <li role="presentation"><a href="<?php $logouturl="logout.php";echo $logouturl; ?>">Logout </a></li>
                </ul>
            </div>
        </div>
    </nav>

	<p height="32px"><strong> Movies Rated By you</strong> </p>
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
   

   
   

	$userid=$_GET['userid'];
   	$query="SELECT * FROM `moviesrated` WHERE userid LIKE '%$userid%'";
	$result = mysqli_query($con,$query)or die(mysqli_error());
	
	

 if (mysqli_num_rows($result) != 0)
   { 
   
    echo "<table cellpadding=10>";
	echo "<th  cellspacing='10' >No. </th>";
	echo "<th  cellspacing='10'> Title </th>";
	echo "<th  cellspacing='10'> Rating </th>";
	$index=1;
    while ($row=mysqli_fetch_assoc($result))
	{
		$url="moviepage?movieid=".$row['movieid'];
		
		echo "<tr>";
		echo "<td>".$index."</td>";
		
		   echo "<td>"."<a href=".$url.'&userid='.$_SESSION['userid'].">".$row['movietitle']."</a>"."</td>";
	        echo "<td>".$row['ratings']."</td>";
	   echo "</tr>";
	    $index=$index+1;
	}
	
	echo "</table>";
   } 
   
   else {
    echo "No Movies Rated";
   }
 

   
		mysqli_close($con);
?>
</body>
</html>