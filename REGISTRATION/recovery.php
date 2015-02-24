<?php
session_start();
require 'connect.php';
$email=$password="";


function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
if(!isset($_SESSION['email']))
{
if(isset($_POST['login']))
{
	if(empty($_POST['email']))
	{
		$emailErr = "Please enter your email.";
	}
	else 
	{
		$email = test_input($_POST['email']);
		
		 // check if e-mail address is well-formed
    if(!preg_match('/^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.([a-zA-Z]{2,4})$/', $email))
	 {
		 $emailErr = "Please enter a valid email address.";
	 }
	  else
	  {
	  
	  $querry1=mysql_query("select * from users where email='$email'");
	  while($row=mysql_fetch_array($querry1))
	  {
	  	$check=$row['check_value'];
	  	$displayname=$row['first'];
	  	$password=$row['password'];
	  	}
	  if($check==1)	
	  {
		 $querry=mysql_query("select * from users where email='$email'");
         $narrow= mysql_num_rows($querry);
         if($narrow > 0){
               $message="YOUR PASSWORD: ".$password;
               $headers = 'From: technoshine.ca@gmail.com';
         if (mail($email,'Recovery Password',$message,$headers))
                             {
                              
                              header("location: http://cadnitd.co.in/REGISTRATION/prompt.php?email=$email&x=4");
                              
                             }  
         
	     }
	     else
		 {
			 $emailErr = "email_id does not exist.";
		 }
		} else
		 {
			 $emailErr = "You have not verified your email id";
		 }
	   }
	
     }
}
}

?>




<!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6 lt8"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7 lt8"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8 lt8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="UTF-8" />
        <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">  -->
        <title>Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <meta name="keywords" content="html5, css3, form, switch, animation, :target, pseudo-class" />
        <link rel="shortcut icon" href="images/tsfevicon.jpg"> 
        <link rel="stylesheet" type="text/css" href="css/demo.css" />
        <link rel="stylesheet" type="text/css" href="css/style2.css" />
        
        <script type="text/javascript">
		function validate()
		{
			x=document.forms["log"]["email"].value
			var atpos=x.indexOf("@");
			var dotpos=x.lastIndexOf(".");
			var letters = /^[a-zA-Z0-9]+[a-zA-Z0-9_.-]+[a-zA-Z0-9_-]+@[a-zA-Z0-9]+[a-zA-Z0-9.-]+[a-zA-Z0-9]+.[a-z]{2,4}$/;
			if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length)
		  {
			  alert("Not a valid e-mail address");
			  return false;
		  }
			else if(!x.test(letters))
			{
				alert("Not a valid e-mail address");
  				return false;
			}
		}
		</script>
        
        
        
        
        
        
		 </head>
    <body>
    
  <div id="techno">
  <h1 style="font-size:60px;font-weight:900;margin-top:20px;margin-left:450px;">Technoshine X.4</h1>
  </div>         
            	<div id="errors" style="width:350px;height:150px;position:absolute;top:230px;left:900px;">
                
				<p style="color:white;font-size:18px;"><?php echo $emailErr; ?> </p>
				
				
                
                </div>			
                <div id="container_demo" >
                
                    <div id="wrapper">
                        <div id="login" class="animate form">
                            <form onSubmit="return validate();" action="" method="post" id="log" > 
                                <h1>Forgot Password</h1> 
                                <p> 
                                    <label for="username" class="uname" data-icon="u" > Your Email</label>
                                    <input id="username" name="email" required type="email" placeholder="Email"/>
                                </p>
                                
                               
                                <p class="login button"> 
                                    <input type="submit" value="Submit" name="login" /> 
								</p>
                                </form>
                                <p class="change_link" style="color:white;">
									Not Joined ?
									<a href="http://cadnitd.co.in/REGISTRATION/registration.php" >Join us</a>
								</p>
                       
			<p class="login button" style="position:relative;left:250px;bottom:320px;width:500px;"> 
                                <a href="http://cadnitd.co.in" > <input type="button" value="Home" /> </a>
			   </p>			
                    </div>
                </div>  
                     
                        
        </div>
    </body>
</html>