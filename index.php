<?php
session_start();

require_once 'utilities/user.php';

$user_name = "";
$login_fail_message = ""; 

if(isset($_POST['user-name'])) {
	$user_name = $_POST['user-name'];
	$user_pass = $_POST['user-pass'];

	$user = do_login($user_name, $user_pass);
	
	if($user != null) {
		$_SESSION["_user"] = $user;
		header("Location: home.php");
	}
	$login_fail_message = "Username or password mismatched";
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<link rel="stylesheet" href="style.css">
		<title>Main</title>
	</head>
	<body>
		<?php include "header.php";?>
		<div style="text-align: center" class="Login">
			<h1>BLOGGER LOG IN</h1>
			<?php if($login_fail_message):?>
			<div class="error-message"><?=$login_fail_message;?></div>
			<?php endif;?>

			<form method="POST" action="<?=$_SERVER['PHP_SELF']?>">
				<div>
					<label
						>User Name
						<input type="text" name="user-name" value="<?=$user_name?>" required />
					</label>
				</div>
				<div>
					<label
						>User Password
						<input type="password" name="user-pass" required />
					</label>
				</div>
				<div>
					<input type="submit" value="Submit" />
				</div>
			</form>
		</div>
	</body>
</html>


<style>
/* CSS code */
.Login {
  width: 300px;
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  margin: 20px auto;
  text-align: center;
  background: linear-gradient(to bottom, #3498db, #2980b9);
  color: #ffffff;
}

.Login input {
  width: 100%;
  padding: 10px;
  margin-bottom: 10px;
  box-sizing: border-box;
}

.Login button {
  background-color: #2ecc71;
  color: white;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

.Login button:hover {
  background-color: #27ae60;
}


</style>