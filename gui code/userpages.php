<!DOCTYPE html>
<html>

<head>
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
   
   if(isset($_GET['userid']))
   {
	  
	   $userid=$_GET['userid'];
	  
	$query="SELECT * FROM userinfo WHERE userid LIKE '%$userid%'";
	$result = mysqli_query($con,$query)or die(mysqli_error());
	$row=mysqli_fetch_assoc($result);
   }
   
   $moviesratedurl="moviesrated?userid=".$row['userid'];
   $watchlisturl="watchlist?userid=".$row['userid'];
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
    <div class="container">
        <div class="page-header">
            <h3>User Profile</h3></div>
        <p> </p>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th><em>Zip Code</em></th>
                        <th><strong><?php echo $row['zipcode']?></strong> </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Name </td>
                        <td><?php echo $row['name']?></td>
                    </tr>
                    <tr>
                        <td>Age </td>
                        <td><?php $age=date("Y")-$row['dob']; echo $age?></td>
                    </tr>
                    <tr>
                        <td>Nationality </td>
                        <td><?php echo $row['country']?></td>
                    </tr>
                    <tr>
                        <td>Gender </td>
                        <td><?php echo $row['gender']?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="media">
            <div class="media-body"></div>
        </div>
        <div class="media">
            <div class="media-body">
                <p> </p>
            </div>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>