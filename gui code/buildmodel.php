<html>
<head>
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
   
  

           $service_url = 'http://localhost:8000/buildmodel';
                          $curl = curl_init($service_url);
                          curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                          $curl_response = curl_exec($curl);
                          if ($curl_response === false) {
                          $info = curl_getinfo($curl);
                          curl_close($curl);
						  }
header("Location:homepage.php")
?>
</body>
</html>