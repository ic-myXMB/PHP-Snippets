<!DOCTYPE html>
<html lang="en">
<head>
<meta charset=UTF-8>
<title>Simple PHP Generated Captcha</title>
<style>
	.captcha-form {
		 padding: 6px;  
	}
	.captcha-body {
		 padding: 6px;
	}	
	.captcha-image {
		 padding: 6px;
	}
	.captcha-request-text {
		 color: teal;
		 font-weight: 400;
	}
</style>
</head>
<body>
	<h1>Simple PHP Generated Captcha...</h1>
	<div class="captcha-form">
	   <div class="captcha-body">		
	         <span class="captcha-request-text">Please Enter the Captcha Text:</span>	    
	     <div class="captcha-image">
	         <!-- captcha image -->	
	         <img src="gen_captcha.php" alt="CAPTCHA">	    
	     </div>
	     <form name="form" method="POST" action="">
	       <?php
	         // start session
	         session_start();
	         // define captcha current
	         $_POST['captcha_current'] = $_SESSION['captcha_current'];
	           // if captcha challenge and captcha current is true
	           if (isset($_POST['captcha_challenge']) && isset($_POST['captcha_current'])) {
	               // if captcha challenge is equal to captcha current
	               if ($_POST['captcha_challenge'] === $_POST['captcha_current']) { 	
	                 // echo submitted captcha is correct
	                 echo "<span style=\"color:green;\"><b>Captcha is CORRECT!</b></span><br>";
	                } else {
	                 //echo submitted captcha is wrong
	                 echo "<span style=\"color:red;\"><b>Captcha is WRONG! Try again.</b></span><br>";
	                }
	            } 
	        ?> 
	         <input type="text" id="captcha_challenge" name="captcha_challenge">
	         <input type="submit" value="Submit">
	      </form>
	    </div>
	</div>
</body>
</html>
