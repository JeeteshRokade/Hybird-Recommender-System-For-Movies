<html>
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
   
  
	$userid=$_GET['userid'];
	$movieid=$_GET['movieid'];
	
	
    $query1="SELECT * FROM movieinfo WHERE movieid LIKE '%$movieid%'";
	$result1 = mysqli_query($con,$query1)or die(mysqli_error());
	$row=mysqli_fetch_assoc($result1);
	$title=$row['Title'];
	$query2="INSERT INTO watchlist(userid,movieid,moviename) VALUES ('$userid','$movieid','$title');";
	$result2 = mysqli_query($con,$query2)or die(mysqli_error());
    
 if (isset($_SERVER["HTTP_REFERER"])) {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }


?>
</body>
</html>