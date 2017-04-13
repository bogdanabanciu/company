<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <!--  LINKS  -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/main.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="../js/buttons.js"></script>
        <!--  End of LINKS  -->
        <title>Zitec</title>
    </head>
    <body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60" style="padding: 85px">
    <nav class="navbar navbar-default navbar-fixed-top" style="background: url(bgmypage.jpg); border:none;">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="index.php#about">ABOUT</a></li>
                    <li><a href="employeeList.php">EMPLOYEES</a></li>
                    <li><a href="departmentList.php">DEPARTMENTS</a></li>
                    <li><a href="projectList.php">PROJECTS</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="row text-center">
            <form action="" method="post" class="employeeInfoForm" style="padding: 80px">
                <div>
                    <label>Name: </label>
                    <input type="text" name="name" value="" required autofocus/>
                </div>
                <div>
                    <label>Surname:</label>
                    <input type="text" name="surname" value="" required/>
                </div>
                <div>
                    <label>Department:</label>
                    <select id="editEmployeeDepartment" class="selectpicker" style="width: 600px; background-color: white; border-color: lightgrey;">
                    </select>
                </div>
                <div>
                    <label>Supervisor</label>
                    <select id="editEmployeeSupervisor" class="selectpicker" style="width: 600px; background-color: white; border-color: lightgrey;">
                    </select>
                </div>
                <div>
                    <label>CNP:</label>
                    <input type="text" name="cnp" value="" required/>
                </div>
                <div>
                    <label>Address:</label>
                    <input type="text" name="address" value="" required/>
                </div>
                <div>
                    <label>Sex:</label>
                    <input type="text" name="sex" value="" required/>
                </div>
                <div>
                    <label>Birth Date:</label>
                    <input type="datetime" name="birth_date" value="" required/>
                </div>
                <div class="div">
                    <label>Hiring Date:</label>
                    <input type="datetime" name="hiring_date" value="" required/>
                </div>
                <div>
                    <label>Hours worked weekly:</label>
                    <input type="number" name="hours_worked_weekly" value="" required/>
                </div>
                <div>
                    <label>Salary:</label>
                    <input type="number" name="salary" value="" required/>
                </div>
            </form>
    </body>
</html>
<?php
    include "../file/validation.php";
    include "../file/files.php";

    $name = '';
    $surname = '';
    $cnp = '';
    $address = '';
    $sex = '';
    $birthDate = '';
    $hiringDate = '';
    $hoursWorkedWeekly = '';
    $salary = '';


    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id']) && isset($_POST['id_department'])
        && isset($_POST['id_supervisor']) && isset($_POST['name']) && isset($_POST['surname'])
        && isset($_POST['cnp']) && isset($_POST['address']) && isset($_POST['sex']) && isset($_POST['birth_date'])
        && isset($_POST['hiring_date']) && isset($_POST['salary']) && isset($_POST['hours_worked_weekly']))
    {
        $department = test_input($_POST['id_department']);
        $supervisor = test_input($_POST['id_supervisor']);
        $name = test_input($_POST['name']);
        $surname = test_input($_POST['surname']);
        $cnp = test_input($_POST['cnp']);
        $address = test_input($_POST['address']);
        $sex = test_input($_POST['sex']);
        $birthDate = test_input($_POST['birth_date']);
        $hiringDate = test_input($_POST['hiring_date']);
        $salary = test_input($_POST['salary']);
        $hoursWorkedWeekly = test_input($_POST['hours_worked_weekly']);
    }
    else
        throw new Exception("Error: name and surname required");

    $db = new Database(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    $db->connectToDatabase();
    $employee = $db->getEmployeeByName($name, $surname);

    $db->__destruct();
?>
