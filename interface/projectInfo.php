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
require_once("../file/files.php");
require_once('../file/validation.php');

if( $_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id']) ) {
$id = test_input($_GET['id']);
$db = new Database();
$project = $db->getProjectById($id);

if ($project) {
?>

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#deleteProjectModal" style="float:right;background-color: #885EAD; border-color: #885EAD;">
        Delete project
    </button>

    <div class="modal fade" id="deleteProjectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete project</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="button" class="btn btn-primary" onclick="executeAction(<?=ACTION_DELETE_PROJECT?>,<?=$id?>, 'projectList.php')" style="background-color: #885EAD; border-color: #885EAD;">Yes</button>
                </div>
            </div>
        </div>
    </div>

    <div class="row text-center">
        <form action="../file/actions.php" method="post" class="employeeInfoForm" style="padding: 80px">
            <input type="hidden" name="action" value="<?= ACTION_EDIT_PROJECT ?>"/>
            <input type="hidden" name="id" value="<?=$id?>"/>
            <div>
                <label>Name: </label>
                <input type="text" name="name" value="<?= $project->getName() ?>" required autofocus/>
            </div>
            <div>
                <label>Department:</label>
                <?php
                $departments = $db->getDepartments();

                if(count($departments) == 0)
                    echo "<select disabled ";
                else
                    echo "<select ";

                echo 'name="id_department" class="selectpicker" style="width:600px; background-color: white; border-color: lightgrey; padding: 10px">';

                if (count($departments) == 0)
                    echo "<option>There are no departments</option>";
                else
                {
                    echo '<option value="-1">Select department</option>';
                    foreach($departments as $department)
                        echo $department->toSelectOption($project->getDepartmentId());
                }
                ?>
                </select>
            </div>
            <div>
                <label>Manager:</label>
                <select name="manager" class="selectpicker" style="width: 600px; background-color: white; border-color: lightgrey; padding: 10px">
                    <?php
                    $employees = $db->getEmployees();

                    echo '<option value="-1">Select manager</option>';
                    foreach($employees as $manager)
                        echo $manager->toSelectOption($project->getManagerId(), -1);
                    ?>
                </select>
            </div>
            <div>
                <label>Budget:</label>
                <input type="number" name="budget" value="<?=$project->getBudget()?>" required/>
            </div>
            <div>
                <label>Hours worked:</label>
                <input type="number" name="hours_worked" value="<?=$project->getHoursWorked()?>" required/>
            </div>
            <div>
                <label>Deadline:</label>
                <input type="datetime" name="deadline" value="<?=$project->getDeadline()?>" required/>
            </div>
            <input type="submit" class="btn btn-primary" value="Save changes" style="background-color: #885EAD; border-color: #885EAD; float: right"/>
        </form>
    </div>

<?php
} else // if project
{
    ?>
    <p style="margin-top:100px;width:100%;text-align:center;">Invalid project id!</p>
    <?php
}
}
else // if GET && isset
{
    header('location: index.php');
}
?>

</body>
</html>
