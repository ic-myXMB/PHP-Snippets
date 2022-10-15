<!DOCTYPE html>
<html lang="en">
<head>
<meta charset=UTF-8>
<title>Simple PHP Generated Captcha</title>
</head>
<body>
	<h1>Simple PHP Generated Captcha...</h1>
	<div>		
	    <label>Please Enter the Captcha Text:</label>	    
	    <br />
	    <br />
	    <!-- captcha image -->	
	    <img src="gen_captcha.php" alt="CAPTCHA">	    
	    <br />
	    <form name="form" method="POST" action="">
	    <?php
	    // start session
	    session_start();
	    // safe captcha challenge
	    $safe_captcha_challenge = htmlspecialchars($_POST['captcha_challenge']);
	    // define captcha test
	    $_POST['captcha_current'] = $_SESSION['captcha_current'];
	    // if captcha challenge and captcha test is true
	    if (isset($safe_captcha_challenge) && isset($_POST['captcha_current'])) {
	        // if captcha challenge is equal to captcha test
	        if ($safe_captcha_challenge === $_POST['captcha_current']) { 	
	            // echo submitted captcha is correct
	            echo "<span style=\"color:green;\"><b>Captcha is CORRECT!</b></span><br>";
	        } else {
	        	//echo submitted captcha is wrong
	            echo "<span style=\"color:red;\"><b>Captcha is WRONG! Try again.</b></span><br>";
	        }
	    } 
	    ?> 
	    <br />
	        <input type="text" id="captcha_challenge" name="captcha_challenge">
	        <input type="submit" value="Submit">
	    </form>
	</div>
</body>
</html>
