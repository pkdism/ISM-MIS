<?php $ui = new UI(); ?>
    <body class="skin-blue">
		<div class="center">
<?php
		$errorHead = "Error";
		$uiType = "error";
		$errorMessage = "An error occured while logging in. Please try again.";
		if($error_code == 1) {
			$errorMessage = "Invalid username or password. Please try again.";
		}
		else if($error_code == 2) {
			$errorMessage = "You do not have access to that location.";
		}
		else if($error_code == 0) {
			$errorHead = "Login";
			$uiType = "info";
			$errorMessage = "Please enter your username and password";
		}
		else if($error_code == 4) {
			$errorHead = "Password Changed";
			$errorMessage = "Your Password has been changed. Please login again to continue.";
			$uiType = "info";
		}
		else if($error_code == 5) {
			$errorHead = "Account created";
			$errorMessage = "Your account has been created. Please enter your username and password to login.";
			$uiType = "info";
		}


		$logoImg = '<img class="big-logo" src="'.base_url().'assets/images/mis-logo-big.png" height="40" style="padding-right: 5px"/>';
		$formBox = $ui->box()->title($logoImg . " Please login to continue")->containerClasses("form-box")->open();
			$ui->callout()
			   ->uiType($uiType)
			   ->desc($errorMessage)
			   ->show();
			$form = $ui->form()->id("login")->action("login/login_user")->open();
				$username = $ui->input()
							   ->type("text")
							   ->name("username")
							   ->placeholder("Username")
							   ->required()
							   ->label("Username");

				$password = $ui->input()
							   ->type("password")
							   ->name("password")
							   ->placeholder("Password")
							   ->required()
							   ->label("Password");
							   
				if($error_code == 1) {
						$password->uiType("error");
				}
				
				$username->show();
				$password->show();
			
				$ui->button()
				   ->type("submit")
				   ->value("Login")
				   ->icon($ui->icon("sign-in"))
				   ->uiType("primary")
				   ->id("submit")
				   ->block()
				   ->show();
?>
				<hr />
				<center>
				<a href="#">Forgot Password</a> &bull;
				<a href="#">Online Help</a> &bull;
				<a href="#">Wiki</a> &bull;
                <a href="#">Developers</a>
				</center>
<?
		
			$form->close();
		$formBox->close();

?>
	</div>
</body>
</html>