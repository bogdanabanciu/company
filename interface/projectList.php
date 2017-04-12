<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <!--  LINKS  -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/main.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
    <h1>Projects</h1>
    <br>
    <form action="?" method="post">
        <div class="input-group">
            <input type="text" class="form-control" size="75" placeholder="Add project" required>
            <div class="input-group-btn">
                <button type="button" class="btn btn-danger" style="background-color: #885EAD; border-color: #885EAD;">Submit</button>
            </div>
        </div>
    </form>
    <?php
    require_once('../file/files.php');
    require_once('../file/validation.php');
    ?>

    <table class="table table-hover" style="margin-top: 50px">
        <thead>
        <tr style="font-weight: bold">
            <td>#</td>
            <td>Name</td>
            <td>Manager</td>
        </tr>
        </thead>
        <tbody>
        <?php
        try
        {
            $db = new Database(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
            $db->connectToDatabase();

            $projects = $db->getProject();

            if(count($projects) == 0)
                echo "There are no projects";
            else {
                for($i = 0; $i < count($projects); $i++)
                {
                    echo $projects[$i]->toTableRow($i + 1);
                }
            }
        }
        catch(PDOException $exception)
        {
            echo "Error: Connection failed: " . $exception->getMessage();
        }
        ?>
        </tbody>
    </table>

    </body>
</html>