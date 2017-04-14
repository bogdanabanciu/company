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

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addProjectModal" style="float:right;background-color: #885EAD; border-color: #885EAD;">
        Add Project
    </button>

    <div class="modal fade" id="addProjectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add project</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="addEmployeeForm">
                        <input id="addProjectAction" type="hidden" name="action" value="<?=ACTION_ADD_PROJECT?>"/>
                        <div>
                            <label>Name:</label>
                            <input id="addProjectName" type="text" required autofocus/>
                        </div>
                        <div>
                            <label>Department:</label>
                            <?php
                            $departments = $db->getDepartments();

                            if(count($departments) == 0)
                                echo "<select disabled ";
                            else
                                echo "<select ";

                            echo 'id="addProjectDepartment" class="selectpicker" style="width: 400px; background-color: white; border-color: lightgrey; padding: 10px">';

                            if (count($departments) == 0)
                                echo "<option>There are no departments</option>";
                            else
                            {
                                echo '<option value="-1">Select department</option>';
                                foreach($departments as $department)
                                    echo $department->toSelectOption();
                            }
                            ?>
                            </select>
                        </div>
                        <div>
                            <label>Manager:</label>
                            <select id="addProjectManager" class="selectpicker" style="width: 400px; background-color: white; border-color: lightgrey; padding: 10px">
                                <?php
                                $employees = $db->getEmployees();

                                echo '<option value="-1">Select manager</option>';
                                foreach($employees as $employee)
                                    echo $employee->toSelectOption();
                                ?>
                            </select>
                        </div>
                        <div>
                            <label>Deadline:</label>
                            <input id="addProjectDeadline" type="datetime" required/>
                        </div>
                        <div>
                            <label>Budget:</label>
                            <input id="addProjectBudget" type="number" required/>
                        </div>
                    </form>
                    <p></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="addProject()" style="background-color: #885EAD; border-color: #885EAD;">Save changes</button>
                </div>
            </div>
        </div>
    </div>

        <h1>Projects</h1>
        <br>
    <table class="table table-hover" style="margin-top: 50px">
        <thead>
        <tr style="font-weight: bold">
            <td>#</td>
            <td>Name</td>
            <td>Department</td>
            <td>Manager</td>
        </tr>
        </thead>
        <tbody>
        <?php
            $projects = $db->getProjects();

            if(count($projects) == 0)
                echo "There are no projects";
            else {
                for($i = 0; $i < count($projects); $i++)
                {
                    echo $projects[$i]->toTableRow($i + 1);
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