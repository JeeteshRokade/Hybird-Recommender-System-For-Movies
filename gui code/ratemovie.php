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
   
  
	$userid=$_SESSION['userid'];
	$movieid=$_GET['movieid'];
	$rating=$_POST['rating'];
	
	
    $query1="SELECT * FROM movieinfo WHERE movieid LIKE '%$movieid%'";
	$result1 = mysqli_query($con,$query1)or die(mysqli_error());
	$row=mysqli_fetch_assoc($result1);
	$title=$row['Title'];
	$query2="INSERT INTO moviesrated(userid,movieid,movietitle,ratings) VALUES ('$userid','$movieid','$title','$rating');";
	$result2 = mysqli_query($con,$query2)or die(mysqli_error());
	
	
	    $query4="SELECT * FROM userinfo WHERE userid LIKE '%$userid%'";
	$result4 = mysqli_query($con,$query4)or die(mysqli_error());
	$row=mysqli_fetch_assoc($result4);
	
     $incratecount=$row['ratecount']+1;	
 
	$query5="UPDATE userinfo SET ratecount='$incratecount' WHERE userid = '$userid';";
	$result5 = mysqli_query($con,$query5)or die(mysqli_error());
           $service_url = 'http://localhost:8000/addrating?userid='.$_SESSION['userid'].'&movieid='.$movieid.'&rating='.$rating;
                          $curl = curl_init($service_url);
                          curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                          $curl_response = curl_exec($curl);
                          if ($curl_response === false) {
                          $info = curl_getinfo($curl);
                          curl_close($curl);
						  }
 if (isset($_SERVER["HTTP_REFERER"])) {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }


?>
</body>
</html>