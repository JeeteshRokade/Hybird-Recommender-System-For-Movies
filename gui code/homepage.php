<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="referrer" content="no-referrer">
	<title>Home</title>
	
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
	
    <div class="container">
	<div class="row">
	
	<div class="form-top">
	<div class="form-top-left">
		<div class="MultiCarousel" data-items="1,3,5,6" data-slide="5" id="MultiCarousel"  data-interval="1000">
		<p style="font-family: 'Roboto', sans-serif; font-size: 25px; color: #000010;">Recommended For You</p>
            <div class="MultiCarousel-inner">
				<?php
                 $service_url = 'http://localhost:8000/generaterecommendations?userid='.$_SESSION['userid'];
                 $curl = curl_init($service_url);
                 curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                 $curl_response = curl_exec($curl);
                 if ($curl_response === false) {
                 $info = curl_getinfo($curl);
                 curl_close($curl);
				 
                 die('error occured during curl exec. Additioanl info: ' . var_export($info));
                 }	
                 curl_close($curl);
                 $decoded = json_decode($curl_response);
                 if (isset($decoded->response->status) && $decoded->response->status == 'ERROR') {
                 die('error occured: ' . $decoded->response->errormessage);
                 }

				
				 for ($x = 0; $x <= (sizeof($decoded)-1); $x++)
					 {
						 
						 		$mid=$decoded[$x]->recid;
								$query4="SELECT posterlink FROM movieposter WHERE movieid LIKE '%$mid%'";

                         $result4 = mysqli_query($con,$query4)or die(mysqli_error());
						 $rowt=mysqli_fetch_assoc($result4);
						 $poster=$rowt['posterlink'];
                         echo "<div class='item'>";
		                 echo "<div class='pad15'>";
		                   echo '<img src="'.$poster.'" alt="Smiley face" >';
		                 $recurl="moviepage?userid=".$_SESSION['userid']."&movieid=".$decoded[$x]->recid;
					
						 echo "<p>"."<a href=".$recurl.">". $decoded[$x]->rectitles."</a>"."</p>";
	
	                     echo "</div>";
	                    echo "</div>";
                       } 
                
                 ?>
                
            </div>
            <button class="btn btn-primary leftLst"><</button>
            <button class="btn btn-primary rightLst">></button>
        </div>
		<div class="MultiCarousel" data-items="1,3,5,6" data-slide="5" id="MultiCarousel"  data-interval="1000">
		<p style="font-family: 'Roboto', sans-serif; font-size: 25px; color: #000010;">Top Adventure Movies For You</p>
            <div class="MultiCarousel-inner">
				<?php
                 $service_url = 'http://localhost:8000/generaterecommendations?userid='.$_SESSION['userid'];
                 $curl = curl_init($service_url);
                 curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                 $curl_response = curl_exec($curl);
                 if ($curl_response === false) {
                 $info = curl_getinfo($curl);
                 curl_close($curl);
				 
                 die('error occured during curl exec. Additioanl info: ' . var_export($info));
                 }	
                 curl_close($curl);
                 $decoded = json_decode($curl_response);
                 if (isset($decoded->response->status) && $decoded->response->status == 'ERROR') {
                 die('error occured: ' . $decoded->response->errormessage);
                 }

				
				 for ($x = 0; $x <= (sizeof($decoded)-1); $x++)
					 {
						 	$mid=$decoded[$x]->advrecid;
								$query4="SELECT posterlink FROM movieposter WHERE movieid LIKE '%$mid%'";

                         $result4 = mysqli_query($con,$query4)or die(mysqli_error());
						 $rowt=mysqli_fetch_assoc($result4);
						 $poster=$rowt['posterlink'];
                         echo "<div class='item'>";
		                 echo "<div class='pad15'>";
		 echo '<img src="'.$poster.'" alt="Smiley face" >';
		                 $recurl="moviepage?userid=".$_SESSION['userid']."&movieid=".$decoded[$x]->advrecid;
					
						 echo "<p>"."<a href=".$recurl.">". $decoded[$x]->advrectitles."</a>"."</p>";
	
	                     echo "</div>";
	                    echo "</div>";
                       } 
                
                 ?>
                
            </div>
            <button class="btn btn-primary leftLst"><</button>
            <button class="btn btn-primary rightLst">></button>
        </div>
			<div class="MultiCarousel" data-items="1,3,5,6" data-slide="5" id="MultiCarousel"  data-interval="1000">
		<p style="font-family: 'Roboto', sans-serif; font-size: 25px; color: #000010;">Top Action Movies For You</p>
            <div class="MultiCarousel-inner">
				<?php
                 $service_url = 'http://localhost:8000/generaterecommendations?userid='.$_SESSION['userid'];
                 $curl = curl_init($service_url);
                 curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                 $curl_response = curl_exec($curl);
                 if ($curl_response === false) {
                 $info = curl_getinfo($curl);
                 curl_close($curl);
				 
                 die('error occured during curl exec. Additioanl info: ' . var_export($info));
                 }	
                 curl_close($curl);
                 $decoded = json_decode($curl_response);
                 if (isset($decoded->response->status) && $decoded->response->status == 'ERROR') {
                 die('error occured: ' . $decoded->response->errormessage);
                 }

				
				 for ($x = 0; $x <= (sizeof($decoded)-1); $x++)
					 {
						 	$mid=$decoded[$x]->actrecid;
								$query4="SELECT posterlink FROM movieposter WHERE movieid LIKE '%$mid%'";

                         $result4 = mysqli_query($con,$query4)or die(mysqli_error());
						 $rowt=mysqli_fetch_assoc($result4);
						 $poster=$rowt['posterlink'];
                         echo "<div class='item'>";
		                 echo "<div class='pad15'>";
		 echo '<img src="'.$poster.'" alt="Smiley face" >';
		                 $recurl="moviepage?userid=".$_SESSION['userid']."&movieid=".$decoded[$x]->actrecid;
					
						 echo "<p>"."<a href=".$recurl.">". $decoded[$x]->actrectitles."</a>"."</p>";
	
	                     echo "</div>";
	                    echo "</div>";
                       } 
                
                 ?>
                
            </div>
            <button class="btn btn-primary leftLst"><</button>
            <button class="btn btn-primary rightLst">></button>
        </div>
			<div class="MultiCarousel" data-items="1,3,5,6" data-slide="5" id="MultiCarousel"  data-interval="1000">
		<p style="font-family: 'Roboto', sans-serif; font-size: 25px; color: #000010;">Top Drama Movies For You</p>
            <div class="MultiCarousel-inner">
				<?php
                 $service_url = 'http://localhost:8000/generaterecommendations?userid='.$_SESSION['userid'];
                 $curl = curl_init($service_url);
                 curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                 $curl_response = curl_exec($curl);
                 if ($curl_response === false) {
                 $info = curl_getinfo($curl);
                 curl_close($curl);
				 
                 die('error occured during curl exec. Additioanl info: ' . var_export($info));
                 }	
                 curl_close($curl);
                 $decoded = json_decode($curl_response);
                 if (isset($decoded->response->status) && $decoded->response->status == 'ERROR') {
                 die('error occured: ' . $decoded->response->errormessage);
                 }

				
				 for ($x = 0; $x <= (sizeof($decoded)-1); $x++)
					 {
						 	$mid=$decoded[$x]->drmrecid;
								$query4="SELECT posterlink FROM movieposter WHERE movieid LIKE '%$mid%'";

                         $result4 = mysqli_query($con,$query4)or die(mysqli_error());
						 $rowt=mysqli_fetch_assoc($result4);
						 $poster=$rowt['posterlink'];
                         echo "<div class='item'>";
		                 echo "<div class='pad15'>";
		 echo '<img src="'.$poster.'" alt="Smiley face" >';
		                 $recurl="moviepage?userid=".$_SESSION['userid']."&movieid=".$decoded[$x]->drmrecid;
					
						 echo "<p>"."<a href=".$recurl.">". $decoded[$x]->drmrectitles."</a>"."</p>";
	
	                     echo "</div>";
	                    echo "</div>";
                       } 
                
                 ?>
                
            </div>
            <button class="btn btn-primary leftLst"><</button>
            <button class="btn btn-primary rightLst">></button>
        </div>
			<div class="MultiCarousel" data-items="1,3,5,6" data-slide="5" id="MultiCarousel"  data-interval="1000">
		<p style="font-family: 'Roboto', sans-serif; font-size: 25px; color: #000010;">Top Sci-Fi Movies For You</p>
            <div class="MultiCarousel-inner">
				<?php
                 $service_url = 'http://localhost:8000/generaterecommendations?userid='.$_SESSION['userid'];
                 $curl = curl_init($service_url);
                 curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                 $curl_response = curl_exec($curl);
                 if ($curl_response === false) {
                 $info = curl_getinfo($curl);
                 curl_close($curl);
				 
                 die('error occured during curl exec. Additioanl info: ' . var_export($info));
                 }	
                 curl_close($curl);
                 $decoded = json_decode($curl_response);
                 if (isset($decoded->response->status) && $decoded->response->status == 'ERROR') {
                 die('error occured: ' . $decoded->response->errormessage);
                 }

				
				 for ($x = 0; $x <= (sizeof($decoded)-1); $x++)
					 {
						 	$mid=$decoded[$x]->scirecid;
								$query4="SELECT posterlink FROM movieposter WHERE movieid LIKE '%$mid%'";

                         $result4 = mysqli_query($con,$query4)or die(mysqli_error());
						 $rowt=mysqli_fetch_assoc($result4);
						 $poster=$rowt['posterlink'];
                         echo "<div class='item'>";
		                 echo "<div class='pad15'>";
		 echo '<img src="'.$poster.'" alt="Smiley face" >';
		                 $recurl="moviepage?userid=".$_SESSION['userid']."&movieid=".$decoded[$x]->scirecid;
					
						 echo "<p>"."<a href=".$recurl.">". $decoded[$x]->scirectitles."</a>"."</p>";
	
	                     echo "</div>";
	                    echo "</div>";
                       } 
                
                 ?>
                
            </div>
            <button class="btn btn-primary leftLst"><</button>
            <button class="btn btn-primary rightLst">></button>
        </div>
			<div class="MultiCarousel" data-items="1,3,5,6" data-slide="5" id="MultiCarousel"  data-interval="1000">
		<p style="font-family: 'Roboto', sans-serif; font-size: 25px; color: #000010;">Top Horror Movies For You</p>
            <div class="MultiCarousel-inner">
				<?php
                 $service_url = 'http://localhost:8000/generaterecommendations?userid='.$_SESSION['userid'];
                 $curl = curl_init($service_url);
                 curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                 $curl_response = curl_exec($curl);
                 if ($curl_response === false) {
                 $info = curl_getinfo($curl);
                 curl_close($curl);
				 
                 die('error occured during curl exec. Additioanl info: ' . var_export($info));
                 }	
                 curl_close($curl);
                 $decoded = json_decode($curl_response);
                 if (isset($decoded->response->status) && $decoded->response->status == 'ERROR') {
                 die('error occured: ' . $decoded->response->errormessage);
                 }

				
				 for ($x = 0; $x <= (sizeof($decoded)-1); $x++)
					 {
						 	$mid=$decoded[$x]->horrecid;
								$query4="SELECT posterlink FROM movieposter WHERE movieid LIKE '%$mid%'";

                         $result4 = mysqli_query($con,$query4)or die(mysqli_error());
						 $rowt=mysqli_fetch_assoc($result4);
						 $poster=$rowt['posterlink'];
                         echo "<div class='item'>";
		                 echo "<div class='pad15'>";
		 echo '<img src="'.$poster.'" alt="Smiley face" >';
		                 $recurl="moviepage?userid=".$_SESSION['userid']."&movieid=".$decoded[$x]->horrecid;
					
						 echo "<p>"."<a href=".$recurl.">". $decoded[$x]->horrectitles."</a>"."</p>";
	
	                     echo "</div>";
	                    echo "</div>";
                       } 
                
                 ?>
                
            </div>
            <button class="btn btn-primary leftLst"><</button>
            <button class="btn btn-primary rightLst">></button>
        </div>
			<div class="MultiCarousel" data-items="1,3,5,6" data-slide="5" id="MultiCarousel"  data-interval="1000">
		<p style="font-family: 'Roboto', sans-serif; font-size: 25px; color: #000010;">Top Comedy Movies For You</p>
            <div class="MultiCarousel-inner">
				<?php
                 $service_url = 'http://localhost:8000/generaterecommendations?userid=1';
                 $curl = curl_init($service_url);
                 curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                 $curl_response = curl_exec($curl);
                 if ($curl_response === false) {
                 $info = curl_getinfo($curl);
                 curl_close($curl);
				 
                 die('error occured during curl exec. Additioanl info: ' . var_export($info));
                 }	
                 curl_close($curl);
                 $decoded = json_decode($curl_response);
                 if (isset($decoded->response->status) && $decoded->response->status == 'ERROR') {
                 die('error occured: ' . $decoded->response->errormessage);
                 }

				
				 for ($x = 0; $x <= (sizeof($decoded)-1); $x++)
					 {
						 	$mid=$decoded[$x]->comrecid;
								$query4="SELECT posterlink FROM movieposter WHERE movieid LIKE '%$mid%'";

                         $result4 = mysqli_query($con,$query4)or die(mysqli_error());
						 $rowt=mysqli_fetch_assoc($result4);
						 $poster=$rowt['posterlink'];
                         echo "<div class='item'>";
		                 echo "<div class='pad15'>";
		 echo '<img src="'.$poster.'" alt="Smiley face" >';
		                 $recurl="moviepage?userid=".$_SESSION['userid']."&movieid=".$decoded[$x]->comrecid;
					
						 echo "<p>"."<a href=".$recurl.">". $decoded[$x]->comrectitles."</a>"."</p>";
	
	                     echo "</div>";
	                    echo "</div>";
                       } 
                
                 ?>
                
            </div>
            <button class="btn btn-primary leftLst"><</button>
            <button class="btn btn-primary rightLst">></button>
            </div>
		
	</div>
	</div>
	</div>
	</div>

	
    <script src="assetsr/js/jquery.min.js"></script>
    <script src="assetsr/bootstrap/js/bootstrap.min.js"></script>
    <script src="assetsr/js/carojs.js"></script>
	<script src="assetsr/js/jquery.backstretch.min.js"></script>
	<script src="assetsr/js/scripts.js"></script>
</body>

</html>