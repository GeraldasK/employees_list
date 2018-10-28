<?php session_start();
require "vendor/autoload.php";
use Classes\DevicesController;
use Classes\EmployeesController;

if(!isset($_SESSION['user'])){
    header("Location: login.php");
}
?>
<?php include_once 'inc/header.php'?>
<?php include_once 'inc/navbar.php'?>
<header>
    <div class="jumbotron text-center">
        <h1>Here's all emploeeys list</h1>
    </div>
</header>
<main>
    <section class="container-fluid">
    <?php if (isset($_SESSION['message'])): ?>
        <div class="alert alert-danger text-center">
            <?php   echo $_SESSION['message']; 
            unset($_SESSION['message']);?>
        </div>
    <?php endif; ?>
        <div class="row">
            <div class="col-sm-3">
            <div>
            <form action="action/addemployer.action.php" method="POST" class="jumbotron">
                <h3 class="pb-3">Add employer</h3>
                <div class="form-group">
                    <label for="full_name">Full Name</label>
                    <input type="text" name="full_name" class="form-control" id="full_name" placeholder="Enter your full name">
                </div>
                <div class="form-group">
                    <label for="birth_date">Date of birth</label>
                    <input type="date" name="birth_date" class="form-control" id="email" placeholder="Enter your birth date">
                </div>
                <div class="form-group">
                    <label for="city">Your city</label>
                    <input type="text" name="city" class="form-control" id="city" placeholder="Enter your city">
                </div>
                <div class="form-group">
                    <label for="phone">Phone number</label>
                    <input type="text" name="phone_number" class="form-control" id="phone" placeholder="Enter phone number">
                </div>
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="Enter email">
                </div>
                <button type="submit" name="add_employer" class="btn btn-primary">Submit</button>
            </form>
            </div>
            <form class="jumbotron" action="action/employees_devices.action.php" method="POST">
           <h3 class="pb-3">Add device for employee </h3>
                <div class="form-group">
                    <label for="device">Select Employee</label>
                    <select class="form-control" name="employeeId" id="device">
                    <?php $employees = new EmployeesController();
                        foreach($employees->showAllEmployees() as $employee):?>
                        <option value="<?php echo $employee['id'];?>"><?php echo $employee['full_name'];?></option>
                    <?php endforeach;?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="device">Select device</label>
                    <select class="form-control" name="deviceId" id="device">
                    <?php $devices = new DevicesController();
                        foreach($devices->showDevices() as $device):?>
                        <option value="<?php echo $device['id'];?>"><?php echo $device['device_name'];?></option>
                    <?php endforeach;?>
                    </select>
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            </form>
            </div>
            <div class="col-sm-8">
                <table class="table text-center">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Full Name</th>
                            <th scope="col">Birth Date</th>
                            <th scope="col">City</th>
                            <th scope="col">Phone number</th>
                            <th scope="col">E-mail</th>
                            <th scope="col">Devices</th>
                            <th scope="col">Actions</th>
                            <th></th>
                        </tr>
                    </thead>
                    <?php
                        if(isset($_GET['page'])){
                            $start_point = $employees->getStartPoint($_GET['page']);
                        }else{
                            $start_point = 1;
                        }
                        foreach($employees->showEmployees($start_point) as $employee):?>
                    <tbody>
                        <tr>
                            <td><?php echo $employee['full_name'];?></td>
                            <td><?php echo $employee['birth_date'];?></td>
                            <td><?php echo $employee['city'];?></td>
                            <td><?php echo $employee['phone_number'];?></td>
                            <td><?php echo $employee['email'];?></td>
                            <td>
                                <ul>
                                    <?php
                                    $devices = new DevicesController();
                                    foreach($devices->showOneDevice($employee['id']) as $device):?>
                                    <li><?php echo $device['device_name'];?></li>
                                    <?php endforeach;?>
                                </ul>
                            </td>
                            <td>
                                <a class="btn btn-warning btn-sm" href="edit_employees.php?id=<?php echo $employee['id'];?>">EDIT</a>
                            </td>
                            <td>
                                <form action="action/delete_employee.action.php" method="POST">
                                    <input type="hidden" name="id" value="<?php echo $employee['id'];?>">
                                    <button type="submit" name="delete" class="btn btn-danger btn-sm">Delet</button>   
                                </form>  
                            </td>
                        </tr>
                    </tbody>
                    <?php endforeach?>
                </table>
                <div>
                    <ul class="pagination">
                        <?php for($pages=1; $pages<= $employees->numberOfPages(); $pages++):?>
                            <li class="page-item"><a class="page-link" href="dashboard.php?page=<?php echo $pages;?>"><?php echo $pages;?></a></li>
                        <?php endfor;?>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <div class="jumbotron">
        <h2 class="text-center">This is all devices</h2>
    </div>
    <section class="container-fluid row" id="devices">
        <article class="col-md-3">
            <form class="jumbotron" action="action/add_device.action.php" method="POST">
            <h3 class="pb-3">Add device</h3>
                <div class="form-group">
                    <label for="device">Select device Category</label>
                    <select class="form-control" name="device_category" id="device">
                        <option value="phone">Phone</option>
                        <option value="computer">Computer</option>
                        <option value="car">Car</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="device_name">Device</label>
                    <input type="text" name="device_name" class="form-control" id="device_name" placeholder="Enter device name">
                </div>
                <div class="form-group">
                    <label for="device_code">Device Code</label>
                    <input type="text" name="device_code" class="form-control" id="device_code" placeholder="Enter device code">
                </div>
                <button type="submit" name="add_device" class="btn btn-primary">Submit</button>
            </form>
        </article>
        <article class="col-md-8">
            <table class="table text-center">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Category</th>
                        <th scope="col">Device Name</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <?php foreach($devices->showDevices() as $device):?>
                    <tbody>
                        <tr>
                            <td><?php echo $device['device_category'];?></td>
                            <td><?php echo $device['device_name'];?></td>
                            <td>
                                <form action="action/delete_device.action.php" method="POST">
                                    <input type="hidden" name="id" value="<?php echo $device['id'];?>">
                                    <button type="submit" name="delete" class="btn btn-danger btn-sm">Delet</button>   
                                </form>  
                            </td>
                        </tr>
                    </tbody>
                    <?php endforeach?>
                </table>
        </article>
    </section>
</main>
<?php include_once 'inc/footer.php'?>