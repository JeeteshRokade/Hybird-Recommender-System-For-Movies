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
   
   if(isset($_GET[' userid']))
   {
	  
	   $ userid=$_GET['userid'];
	  
	$query="SELECT * FROM userinfo WHERE userid LIKE '%$ userid%'";
	$result = mysqli_query($con,$query)or die(mysqli_error());
	$row=mysqli_fetch_assoc($result);
   }
?>

    <nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header"><a class="navbar-brand navbar-link" href="#">JAR </a>
                <button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
            </div>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="nav navbar-nav">
                    <li role="presentation"><a href="#">Movies Rated </a></li>
                    <li role="presentation"><a href="#">Wishlist </a></li>
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
                        <td>Cell</td>
                    </tr>
                    <tr>
                        <td>Age </td>
                        <td>Cell</td>
                    </tr>
                    <tr>
                        <td>Nationality </td>
                        <td>Cell</td>
                    </tr>
                    <tr>
                        <td>Gender </td>
                        <td>Text</td>
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