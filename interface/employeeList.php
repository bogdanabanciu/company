<!DOCTYPE html>
<html lang="en">
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

<?php
    require_once('../file/files.php');
    require_once('../file/validation.php');

    try {
        $db = new Database();
?>

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addEmployeeModal" style="float:right;background-color: #885EAD; border-color: #885EAD;">
        Add Employee
    </button>

    <div class="modal fade" id="addEmployeeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add employee</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="../file/actions.php" method="post" class="addEmployeeForm">
                        <input id="addEmployeeAction" type="hidden" name="action" value="<?=ACTION_ADD_EMPLOYEE?>"/>
                        <div>
                            <label>Name:</label>
                            <input id="addEmployeeName" type="text" name="name" required autofocus/>
                        </div>
                        <div>
                            <label>Surname:</label>
                            <input id="addEmployeeSurname" type="text" name="surname" required/>
                        </div>
                        <div>
                            <label>CNP:</label>
                            <input id="addEmployeeCNP" type="text" name="cnp" required/>
                        </div>
                        <div>
                            <label>Address:</label>
                            <input id="addEmployeeAddress" type="text" name="address" required/>
                        </div>
                        <div>
                            <label>Sex:</label>
                            <input id="addEmployeeSex" type="text" name="sex" required/>
                        </div>
                        <div>
                            <label>Birth Date:</label>
                            <input id="addEmployeeBirthDate" type="datetime" name="birth_date" required/>
                        </div>
                        <div>
                            <label>Department:</label>
                            <?php
                                $departments = $db->getDepartments();

                                if(count($departments) == 0)
                                    echo "<select disabled ";
                                else
                                    echo "<select ";

                                echo 'id="addEmployeeDepartment" class="selectpicker" style="width: 400px; background-color: white; border-color: lightgrey; padding: 10px">';

                                if (count($departments) == 0)
                                    echo "<option>There are no departments</option>";
                                else
                                {
                                    echo '<option value="-1">Select department</option>';
                                    foreach($departments as $department)
                                        echo $department->toSelectOption(-1);
                                }
                            ?>
                            </select>
                        </div>
                        <div>
                            <label>Supervisor:</label>
                            <select id="addEmployeeSupervisor" class="selectpicker" style="width: 400px; background-color: white; border-color: lightgrey; padding: 10px">
                            <?php
                                $employees = $db->getEmployees();

                                echo '<option value="-1">Select supervisor</option>';
                                foreach($employees as $employee)
                                    echo $employee->toSelectOption(-1, -1);
                            ?>
                            </select>
                        </div>
                        <div>
                            <label>Hiring Date:</label>
                            <input id="addEmployeeHiringDate" type="datetime" name="hiring_date" required/>
                        </div>
                        <div class="div">
                            <label>Hours worked weekly:</label>
                            <input id="addEmployeeHoursWorkedWeekly" type="number" name="hours_worked_weekly" required/>
                        </div>
                        <div>
                            <label>Salary:</label>
                            <input id="addEmployeeSalary" type="number" name="salary" required/>
                        </div>
                    </form>
                    <p></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="addEmployee()" style="background-color: #885EAD; border-color: #885EAD;">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <br>
    <h1>Employees</h1>
    <br>
    <form action="?" method="get">
        <div class="input-group">
            <input type="text" name="search" class="form-control" size="75" placeholder="Name and Surname" required>
            <div class="input-group-btn">
                <button type="submit" class="btn btn-danger" style="background-color: #885EAD; border-color: #885EAD;">Submit</button>
            </div>
        </div>
    </form>
    <table class="table table-hover" style="margin-top:50px">
        <thead>
        <tr style="font-weight: bold">
            <th>#</th>
            <th>Name</th>
            <th>Surname</th>
            <th>Department</th>
        </tr>
        </thead>
        <tbody>

<?php
     if ( isset($_GET['search']) )
         $employees = $db->searchEmployees(test_input($_GET['search']));
    else
        $employees = $db->getEmployees();

    if(count($employees) == 0)
        echo "There are no employees!";
    else {
        for ($i = 0; $i < count($employees); $i++)
        {
            echo $employees[$i]->toTableRow($i + 1);
        }
    }
?>

        </tbody>
    </table>

<?php
    }
    catch(PDOException $ex)
    {
        ?>
        <p color="red">Database error!</p>
        <?php
    }
?>

</body>
</html>