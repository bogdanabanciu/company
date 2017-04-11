<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <!--  LINKS  -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <!--  End of LINKS  -->
        <title>Zitec</title>
    </head>
    <body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">
        <nav class="navbar navbar-default navbar-fixed-top" style="background-color: #2b669a">
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
                        <li><a href="#about">ABOUT</a></li>
                        <li><a href="#employee">EMPLOYEES</a></li>
                        <li><a href="#department">DEPARTMENTS</a></li>
                        <li><a href="#project">PROJECTS</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="jumbotron text-center" style="background-color: #2b669a">
            <h1>Zitec</h1>
            <p>We enjoy finding solutions for challenging business problems and making our customers happy, all while having fun!</p>
        </div>
        <div id="about" class="container" style="padding: 50px 50px">
            <div class="row">
                <div class="col-sm-8" style="text-align: center; margin-left: 200px">
                    <h2> About us</h2>
                    <br>
                    <h4>We are committed to meeting the expectations of our customers and delivering a high standard
                    of services. We attain these goals through the expertise of a qualified team that is able to perform
                    complex analysis of projects.</h4>
                    <p>Our main service is the development of integrated software solutions that are personalized to cover in the best possible way
                        the increasingly specific and specialized needs of our customers.
                        We strive to make our solutions easily adaptable to changes in the various fields of activity.
                        The applications we develop benefit from the latest technologies, distributed implementation and
                        remote control features, so that even a company with many presence points, mobile or not, can benefit
                        by using the same application.</p>
                </div>
            </div>
        </div>
        <br>
        <div id="employee" class="container">
            <div class="row">
                <form>
                    <div class="input-group">
                        <input type="search" class="form-control" size="75" placeholder="Name" required>
                        <input type="search" class="form-control" size="75" placeholder="Surname" required>
                    </div>
                    <div class="input-group-btn">
                        <button type="button" class="btn btn-danger">Submit</button>
                    </div>
                </form>
                <table class="table table-hover">
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
                            while($row = $result->fetch()){
                        ?>
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <td><?= $row['name'] ?></td>
                            <td><?= $row['surname'] ?></td>
                            <td><?= $row['cnp'] ?></td>
                            <td><?= $row['address'] ?></td>
                            <td><?= $row['sex'] ?></td>
                            <td><?= $row['birth_date'] ?></td>
                            <td><?= $row['hiring_date'] ?></td>
                            <td><?= $row['id_department'] ?></td>
                            <td><?= $row['id_supervisor'] ?></td>
                            <td><?= $row['hours_worked_weekly'] ?></td>
                            <td><?= $row['salary'] ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <?php
                $sql = "SELECT COUNT(id) FROM employees";
                $result = $this->conn->query($sql);
                $row = $result->fetchAll(PDO::FETCH_ASSOC);
                $totalRecords = $row[0];
                $totalPages = ceil($totalRecords / $limit);
                $paginationLink = "<div class='pagination'>";

                for($i = 0; $i <= $totalPages; $i++){
                    $paginationLink .= "<a href=index.php?page=". $i . "'>" . $i . "</a>";
                }

                echo $paginationLink . "</div>";
            ?>
            </div>
        </div>

    </body>
</html>
<?php
    $db = new Database(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    $db->connectToDatabase();

    $limit =  5;

    if(isset($_GET['page'])){
        $page = $_GET['page'];
    }
    else {
        $page = 1;
    }

    $startRow = ($page - 1) * $limit;

    $sql ="SELECT * FROM employees LIMIT $startRow, $limit";
    $result = $this->conn->query($sql);
?>