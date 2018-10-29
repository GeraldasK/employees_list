<?php
session_start();
require "vendor/autoload.php";
use Classes\Users;
?>
<?php include_once 'inc/header.php'?>
<main class="container">
<?php if (isset($_SESSION['message'])): ?>
        <div class="alert alert-danger text-center">
            <?php   echo $_SESSION['message']; 
            unset($_SESSION['message']);?>
        </div>
<?php endif; ?>
    <section class="text-center mt-5">
        <form class="form-signin" action="action/login.action.php" method="POST">
            <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
            <label for="inputEmail" class="sr-only">Email address</label>
            <input type="email" id="inputEmail" class="form-control" placeholder="Email address" name="email">
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="password">
            <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Sign in</button>
            <p class="mt-5 mb-3 text-muted">&copy; 2018</p>
        </form>
    </section>
</main>
<?php include_once 'inc/footer.php'?>