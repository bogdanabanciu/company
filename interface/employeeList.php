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
    <!-- MODAL Neterminat .. trebuie legat cu JS -->
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
                            <label>Address: </label>
                            <input id="addEmployeeAddress" type="text" name="address" required/>
                        </div>
                        <div>
                            <label>Sex: </label>
                            <input id="addEmployeeSex" type="text" name="sex" required/>
                        </div>
                        <div>
                            <label>Birth Date: </label>
                            <input id="addEmployeeBirthDate" type="datetime" name="birth_date" required/>
                        </div>
                        <!-- TODO: departament dropdown list -->
                        <div class="dropdown">
                            <label>Department</label>
                            <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown"
                                    style="width: 400px; text-align: right; background-color: white; border-color: lightgrey;">
                                <span class="caret"></span></button>
                            <input type="hidden" name="search">
                            <ul class="dropdown-menu" style="width: 400px; padding: 15px">
                                <?php

                                require_once('../file/files.php');
                                require_once('../file/validation.php');

                                try {
                                    $db = new Database(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                                    $db->connectToDatabase();

                                    $departments = $db->getDepartments();

                                    if(count($departments) == 0)
                                        echo "There are no departments";
                                    else {
                                        for($i = 0; $i < count($departments); $i++)
                                        {
                                            echo $departments[$i]->toTableName($i + 1);
                                        }
                                    }
                                }
                                catch(PDOException $exception)
                                {
                                    echo "Error: connection failed" . $exception->getMessage();
                                }
                                ?>
                            </ul>
                        </div>
                        <!-- TODO: supervisor dropdown list: all employees (name and surname only) -->
                        <div>
                            <label>Hiring Date: </label>
                            <input id="addEmployeeHiringDate" type="datetime" name="hiring_date" required/>
                        </div>
                        <div class="div">
                            <label>Hours worked weekly: </label>
                            <input id="addEmployeeHoursWorkedWeekly" type="number" name="hours_worked_weekly" required/>
                        </div>
                        <div>
                            <label>Salary: </label>
                            <input id="addEmployeeSalary" type="number" name="salary" required/>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="addEmployee()">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <!--
    <div class="modal fade">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Employee</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Modal body text goes here.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" style="background-color: #885EAD; border-color: #885EAD;">Save changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" style="background-color: #885EAD; border-color: #885EAD;">Close</button>
                </div>
            </div>
        </div>
    </div>-->
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

try
{
    $db = new Database(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    $db->connectToDatabase();

     if ( isset($_GET['search']) ) {
         $employees = $db->searchEmployees(test_input($_GET['search']));
     }
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

}
catch(PDOException $exception)
{
    echo "Error: connection failed" . $exception->getMessage();
}

?>

        </tbody>
    </table>
</body>
</html>