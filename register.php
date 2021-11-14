<?php
namespace cst323;
session_start();
require_once 'header.php';
?>
	<div class="d-flex text-center bg-secondary">  
    	<form class="form-login" action="userHandler.php" method="post" oninput="password2.setCustomValidity(password2.value != password.value ? 'Passwords do not match.' : '')">
            <img src="bootstrap-icons/icons/person-circle.svg" class="mb-4" height="72" width="72" id="icon" alt="User Icon" />
            <h1 class="h3 mb-3 font-weight-normal">Registration Form:</h1>
            <input type="email" id="email" name="email" class="form-control mb-2 ip-2" placeholder="Email" required autofocus />
            <input type="password" class="form-control mb-2" id="password" name="password" placeholder="Password" required />
            <input type="password" class="form-control mb-2" id="password2" name="password2" placeholder="Re-enter Password" required /><br>
            <input type="text" id="first_name" name="first_name" class="form-control mb-2" placeholder="First Name" required />
            <input type="text" id="last_name" name="last_name" class="form-control mb-2" placeholder="Last Name" required />
            <button class="btn btn-lg btn-primary btn-block mb-2 mt-2" type="submit" name="register" id="register">Register</button>
            
            <div id="formFooter mb-3">
        		<hr><p><a class="underlineHover" href="login.php">Log In?</a></p>
            </div>
    	</form>
  	</div>

<?php require_once 'footer.php'; ?>