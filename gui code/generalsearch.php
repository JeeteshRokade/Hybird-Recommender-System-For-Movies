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
	<br>
<form action="generalsearch.php" method="post">

<div align="center">
<input type="text" style="font-size:16pt;width:500px;" placeholder="Search using Keyword,Genre,Cast,etc." name="searchstring">
<input style="font-size:16pt;" type="submit" name="search" value="Search">
</div>
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
   
   if(isset($_POST['search']))
   {
   $string=mysqli_real_escape_string($con,$_POST['searchstring']);
   
   

		
   	$query="SELECT * FROM `movieinfo` WHERE MATCH (Country,Directors,Genre,RYear,Title,Stars,Writers) AGAINST ( '$string' IN NATURAL LANGUAGE MODE)";
	$result = mysqli_query($con,$query)or die(mysqli_error());
	
	

 if (mysqli_num_rows($result) != 0)
   {
   
    echo "<table style='' align='center'  cellpadding= 3>";
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

</body>
</html>