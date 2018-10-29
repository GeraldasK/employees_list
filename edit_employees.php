<?php
session_start();
require "vendor/autoload.php";
use Classes\EmployeesPagination;

if(!isset($_SESSION['user'])){
    header("Location: login.php");
}
?>
<?php include_once 'inc/header.php'?>
<main class="container">
    <form action="action/edit_employees.action.php" method="POST" class="jumbotron">
    <h3 class="pb-3">Add employer</h3>
    <?php 
    $employees = new EmployeesPagination();
    $id = htmlspecialchars($_GET['id']);
    foreach($employees->getOneEmployee($id) as $employee):?>
        <div class="form-group">
            <label for="full_name">Full Name</label>
            <input type="text" name="full_name" value="<?php echo $employee['full_name'];?>" class="form-control" id="full_name" placeholder="Enter your full name">
        </div>
        <div class="form-group">
            <label for="birth_date">Date of birth</label>
            <input type="date" name="birth_date" value="<?php echo $employee['birth_date'];?>" class="form-control" id="email" placeholder="Enter your birth date">
        </div>
        <div class="form-group">
            <label for="city">Your city</label>
            <input type="text" name="city" value="<?php echo $employee['city'];?>" class="form-control" id="city" placeholder="Enter your city">
        </div>
        <div class="form-group">
            <label for="phone">Phone number</label>
            <input type="text" name="phone_number" value="<?php echo $employee['phone_number'];?>" class="form-control" id="phone" placeholder="Enter phone number">
        </div>
        <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" name="email" value="<?php echo $employee['email'];?>" class="form-control" id="email" placeholder="Enter email">
            <input type="hidden" name="id" value="<?php echo $employee['id'];?>">
        </div>
            <?php endforeach;?>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>
    </main>
<?php include_once 'inc/footer.php'?>