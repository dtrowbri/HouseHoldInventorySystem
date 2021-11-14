<?php
namespace cst323;
session_start();
require_once 'header.php';
?>
  <div class="d-flex text-center bg-secondary">  
    <form class="form-login" action="userHandler.php" method="post">
        <img src="bootstrap-icons/icons/person-circle.svg" class="mb-4" height="72" width="72" id="icon" alt="User Icon" />
        <h1 class="h3 mb-3 font-weight-normal">Login Form:</h1>
          <input type="text" class="form-control mb-2 ip-2" id="email" name="email" placeholder="login email" required autofocus />
          <input type="password" class="form-control mb-2" id="password" name="password" placeholder="password" required />
          <button class="btn btn-lg btn-primary btn-block mt-2" type="submit" name="login" id="login">Log In</button>
        <div id="formFooter mb-2">
        	<hr>
        	<p><a class="underlineHover" href="register.php">Register?</a></p>	
        </div>
    </form>
  </div>

<?php require_once 'footer.php'; ?>