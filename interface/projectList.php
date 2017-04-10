<!DOCTYPE html>
<html>
    <head>
        <title>Project List</title>
        <!--  CSS  -->
        <link rel="stylesheet" href="../css/main.css">
        <!--  END of CSS  -->
    </head>
    <body>
        <?php
            include "../file/validation.php";
            include "../file/files.php";

            $name = '';

            if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['name']))
            {
                $name = test_input($_POST['name']);
            }
            else
                throw new Exception("Error: name and surname required");

            $db = new Database(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
            $db->connectToDatabase();
            $project = $db->getProjectByName($name);

            foreach($project as $row)
            {?>
                <ul>
                    <li><a href="projectInfo.php/id=<?echo $row['id']?>"><?php echo $row['name']?></a></li>
                </ul>
                <?php
            }
        ?>
    </body>
</html>