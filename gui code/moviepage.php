<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MoviesInfo</title>
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
   
   if(isset($_GET['movieid']))
   {
	  
	   $movieid=$_GET['movieid'];
	   $userid=$_GET['userid'];
	$query="SELECT * FROM movieinfo WHERE  movieid LIKE '%$movieid%'";
	$result = mysqli_query($con,$query)or die(mysqli_error());
	$row=mysqli_fetch_assoc($result);
   }
   
   
   $watchlisturl="watchlist?userid=".$_GET['userid'];
   $moviesratedurl="moviesrated?userid=".$_GET['userid'];
?>



    <nav class="navbar navbar-default">
        <div class="container">
        
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="nav navbar-nav">
				   <li role="presentation"><a href="buildmodel.php">Home</a></li>
				 <li role="presentation"><a href="<?php $moviesratedurl="moviesrated?userid=".$_SESSION['userid'];echo $moviesratedurl ;?>">Movies Rated </a></li>
                    <li role="presentation"><a href="<?php $watchlisturl="watchlist?userid=".$_SESSION['userid'];echo $watchlisturl; ?>">Wishlist </a></li>
				      <li role="presentation"><a href="<?php $advsearchurl="searchmovie.php";echo $advsearchurl; ?>">Advanced Search</a></li>      
                    <li role="presentation"><a href="<?php $nomsearchurl="generalsearch.php";echo $nomsearchurl; ?>">Normal Search</a></li> 
	                <li role="presentation"><a href="<?php $profileurl="userpages.php?userid=".$_SESSION['userid'];echo $profileurl; ?>">Profile </a></li>				
                     <li role="presentation"><a href="<?php $logouturl="logout.php";echo $logouturl; ?>">Logout </a></li>
                        <a href="#"> </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="row product">
		<?php
						$query4="SELECT posterlink FROM movieposter WHERE movieid LIKE '%$movieid%'";
                         $result4 = mysqli_query($con,$query4)or die(mysqli_error());
						 $rowt=mysqli_fetch_assoc($result4);
		                    $poster=$rowt['posterlink'];
		?>
		
            <div class="col-md-5 col-md-offset-0"><img class="img-responsive" src="<?php echo $poster; ?>" width="150" height="100"></div>
			
            <div class="col-md-7">
                <h2><?php echo $row['Title']?></h2><a href="http://www.imdb.com/title/<?php echo $row['tmdbid']?>">http://www.imdb.com/title/<?php echo $row['tmdbid']?> </a>
                <h3>IMDB Rating:<?php echo $row['Ratings']?></h3>
                <form action=" <?php $watchurl="watchmovie?userid=".$_GET['userid']."&movieid=".$_GET['movieid']; echo $watchurl;?>" method="post">
				<?php 
				$query4="SELECT * FROM watchlist WHERE  movieid LIKE '%$movieid%' AND userid LIKE '%$userid%'";
	                  $result4 = mysqli_query($con,$query4)or die(mysqli_error());
					  if (mysqli_num_rows($result4) != 0)
					  {
						  echo "Added to watchlist";
					  }  
					  else
					  {
					  $msg="<input type='submit' name='watched' value='Add to watchlist'>";
					  echo $msg;
					  }
					  
				?>
					  
				
                </form>
				<form action=" <?php $rateurl="ratemovie?userid=".$_GET['userid']."&movieid=".$_GET['movieid']; echo $rateurl;?>" method="post">
				<?php 
				$query5="SELECT * FROM moviesrated WHERE  movieid LIKE '%$movieid%' AND userid LIKE '%$userid%'";
	                  $result5 = mysqli_query($con,$query5)or die(mysqli_error());
					  if (mysqli_num_rows($result5) != 0)
					  {
						  echo "Movie Rated";
					  }  
					  else
					  {
					     echo"<label>Rate this movie: </label>";
				         echo"<input type='text' name='rating' placeholder='Search this site'>";
				         echo"<input type='submit' name='rate' value='Rate'>";
					  }
					  
				?>
			
				</form>
            </div>
        </div>
        <div class="page-header">
            <h3>Plot </h3></div>
        <p> <?php echo $row['Story']?> </p>
        <div class="table-responsive">
            <table class="table table-striped">
               
                <tbody>
				    
                    <tr>
                        <td><strong>Country</strong> </td>
                        <td> <?php echo $row['Country']?></td>
                    </tr>
                    <tr>
                        <td><strong>Genre</strong> </td>
                        <td><?php echo $row['Genre']?> </td>
                    </tr>
                    <tr>
                        <td><strong>Directors</strong> </td>
                        <td><?php echo $row['Directors']?> </td>
                    </tr>
                    <tr>
                        <td><strong>Cast</strong> </td>
                        <td><?php echo $row['Stars']?> </td>
                    </tr>
					
					 <tr>
                        <td><strong>Year</strong> </td>
                        <td><?php echo $row['RYear']?> </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="page-header">
            <h3>Similar Movies<small> </small></h3></div>
        <div class="table-responsive">
            <table class="table">
               
                <tbody>
				
				<?php
                 $service_url = 'http://localhost:8000/similarmovies?itemid='.$movieid;
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

				 $index=1;
				 for ($x = 0; $x <= (sizeof($decoded)-1); $x++)
					 {
                         echo "<tr>";
		                 echo "<td>".$index."</td>";
		
		                 $recurl="moviepage?userid=".$_GET['userid']."&movieid=".$decoded[$x]->mid;
						 echo "<td>"."<a href=".$recurl.">". $decoded[$x]->Title."</a>"."</td>";
	
	                     echo "</tr>";
	                     $index=$index+1;
                       } 
                
                 ?>
              
                </tbody>
            </table>
        </div>
        <div class="page-header"></div>
        <div class="media">
            <div class="media-body"></div>
        </div>
        <div class="media">
            <div class="media-body"></div>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>