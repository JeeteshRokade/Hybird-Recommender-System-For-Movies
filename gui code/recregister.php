<!DOCTYPE html>
<html lang="en">

    <head>
  <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Bootstrap Login Form Template</title>
		

        <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="assets/css/form-elements.css">
        <link rel="stylesheet" href="assets/css/style.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="assets/ico/favicon.png">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">
    </head>

    <body
	
	
	
	<?php

   session_start();


   $con = mysqli_connect("localhost","root","root","movierecommender");
   
   if (mysqli_connect_errno()) 
   {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
   }
   
   if(isset($_POST['submit']))
   {
	
	  $name=$_POST['name'];
	  $gender=$_POST['gender'];
	  $age=intval(date('Y')-$_POST['dob']);
	  $dob=$_POST['dob'];
	  $country=$_POST['country'];
	  $occupation=$_POST['occupation'];
	  $zipcode=intval($_POST['zipcode']);
	  $emailid=$_POST['emailid'];
	  $password=$_POST['password'];
	$query1="INSERT INTO userinfo(name,emailid,gender,dob,country,occupation,zipcode,password,logincount) VALUES ('$name','$emailid','$gender','$dob','$country','$occupation','$zipcode','$password',1);";
	$result1 = mysqli_query($con,$query1)or die(mysqli_error());
	

	$query2="SELECT userid from userinfo WHERE name LIKE '%$name%';";
	$result2 = mysqli_query($con,$query2)or die(mysqli_error());
	$row=mysqli_fetch_array($result2);
	$userid=intval($row['userid']);
	
	
	  $service_url = 'http://localhost:8000/adduser?userid='.$userid.'&age='.$age.'&gen='.$gender.'&occup='.$occupation.'&zip='.$zipcode;
                          $curl = curl_init($service_url);
                          curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                          $curl_response = curl_exec($curl);
                          if ($curl_response === false) {
                          $info = curl_getinfo($curl);
                          curl_close($curl);
						  }
		header('Location: reclogin.php');			  
						  
						  
	  }
	
	mysqli_close($con);
?>


        <!-- Top content -->
        <div class="top-content">
        	
            <div class="inner-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text">
                            <h1><strong>Recommendation</strong> Signup Form</h1>
                            <div class="description">
                            	<p>
	                            	
                            	</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 form-box">
                        	<div class="form-top">
                        		<div class="form-top-left">
                        			<h3>Register to our site</h3>
                            		<p>Please Fill in the Following Details</p>
                        		</div>
                        		<div class="form-top-right">
                        			<i class="fa fa-key"></i>
                        		</div>
                            </div>
                            <div class="form-bottom">
			                    <form role="form" action="recregister.php" method="post" class="login-form">
			                    	<div class="form-group">
									<label class="sr-only" for="form-username">Name</label>
			                        	<input type="text" name="name" placeholder="Name..." class="form-username form-control" id="form-username">
										<br>
			                    		
										<label >Gender</label>
			                        	<select name="gender" class="form-username form-control" id="form-username">
										
										<option value="M">Male</option>
										<option value="F">Female</option>
										</select>
										<br>
										<label class="sr-only" for="form-username">Year of Birth</label>
			                        	<input type="text" name="dob" placeholder="1996" class="form-username form-control" id="form-username">
										<br>
										
										<label class="sr-only" for="form-username">Country</label>
			                        	<input type="text" name="country" placeholder="India" class="form-username form-control" id="form-username">
										<br>
										<label >Occupation</label>
			                        	<select name="occupation" class="form-username form-control" id="form-username">
<option value="none">none</option>
<option value="administrator">administrator</option>
<option value="artist">artist</option>
<option value="doctor">doctor</option>
<option value="educator">educator</option>
<option value="engineer">engineer</option>
<option value="entertainment">entertainment</option>
<option value="executive">executive</option>
<option value="healthcare">healthcare</option>
<option value="homemaker">homemaker</option>
<option value="lawyer">lawyer</option>
<option value="librarian">librarian</option>
<option value="marketing">marketing</option>
<option value="programmer">programmer</option>
<option value="retired">retired</option>
<option value="salesman">salesman</option>
<option value="scientist">scientist</option>
<option value="student">student</option>
<option value="technician">technician</option>
<option value="writer">writer</option>
<option value="other">other</option>


										</select>
										<br>
										<label class="sr-only" for="form-username">Zipcode</label>
			                        	<input type="text" name="zipcode" placeholder="400080" class="form-username form-control" id="form-username">
			                             <br>
			                        	<label class="sr-only" for="form-password">Password</label>
			                        	<input type="password" name="password" placeholder="Password..." class="form-password form-control" id="form-password">
										<br>
										<label class="sr-only" for="form-username">EmailID</label>
			                        	<input type="email" name="emailid" placeholder="Email ID..." class="form-username form-control" id="form-username">
			                        </div>
			                        <div align="center"><input  type="submit" name="submit" value= "Sign Up" class="btn"></div>
			                    </form>
		                    </div>
                        </div>
                    </div>
                    

      <!-- Javascript -->
        <script src="assets/js/jquery-1.11.1.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.backstretch.min.js"></script>
        <script src="assets/js/scripts.js"></script>
		
        
        <!--[if lt IE 10]>
            <script src="assets/js/placeholder.js"></script>
        <![endif]-->
       

    </body>

</html>