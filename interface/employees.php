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
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">
    <nav class="navbar navbar-default navbar-fixed-top" style="background: url(bgmypage.jpg); border:none;">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#myPage"><img src="../images/logo-zitec.png"></a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="index.php#about">ABOUT</a></li>
                    <li><a href="index.php#employee">EMPLOYEES</a></li>
                    <li><a href="index.php#department">DEPARTMENTS</a></li>
                    <li><a href="index.php#project">PROJECTS</a></li>
                </ul>
            </div>
        </div>
    </nav>

<?php

require_once('../file/files.php');

?>

    <table class="table table-hover" style="margin-top:50px">
        <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Surname</th>
            <th>CNP</th>
            <th>Address</th>
            <th>Sex</th>
            <th>Birth Date</th>
            <th>Hiring Date</th>
            <th>Department</th>
            <th>Supervisor</th>
            <th>Hours Worked Weekly</th>
            <th>Salary</th>
        </tr>
        </thead>
        <tbody>

<?php

try
{
    $db = new Database(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    $db->connectToDatabase();

     if ( isset($_GET['search']) )//TODO: validate input
      $employees = $db->searchEmployees($_GET['search']);
    else
        $employees = $db->getEmployees();

    if(count($employees) == 0)
        echo "Nu avem angajati";
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