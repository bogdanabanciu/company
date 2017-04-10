<!DOCTYPE html>
<html>
<head>
    <title>Employee Information</title>
    <!--  CSS  -->
    <link rel="stylesheet" href="../css/main.css">
    <!--  End of CSS  -->

</head>
<body>
            <form action="" method="post" class="form" >
                         <div class="div">
                             <label>Name: </label>
                             <input class="input" type="text" name="name" value="<?php print $name ?>"
                                    placeholder="" required autofocus style="margin-left: 33px"/>
                         </div>
                         <div class="div">
                             <label>Surname: </label>
                             <input class="input" type="text" name="surname" value="<?php echo $surname ?>"
                                    placeholder="" required autofocus/>
                         </div>
                         <div class="div">
                             <label>CNP: </label>
                             <input class="input" type="text" name="cnp" value="<?php echo $cnp ?>"
                                    placeholder="" required autofocus/>
                         </div>
                         <div class="div">
                             <label>Address: </label>
                             <input class="input" type="text" name="address" value="<?php echo $address ?>"
                                    placeholder="" required autofocus/>
                         </div>
                         <div class="div">
                             <label>Sex: </label>
                             <input class="input" type="text" name="sex" value="<?php echo $sex ?>"
                                    placeholder="" required autofocus/>
                         </div>
                         <div class="div">
                             <label>Birth Date: </label>
                             <input class="input" type="datetime" name="birth_date"
                                    value="<?php echo date_format($birthDate, 'Y-m-d H:i:s'); ?>" placeholder=""
                                    required autofocus/>
                         </div>
                         <div class="div">
                             <label>Hiring Date: </label>
                             <input class="input" type="datetime" name="hiring_date"
                                    value="<?php echo date_format($hiringDate, 'Y-m-d H:i:s'); ?>"
                                    placeholder="" required autofocus/>
                         </div>
                         <div class="div">
                             <label>Hours worked weekly: </label>
                             <input class="input" type="number" name="hours_worked_weekly"
                                    value="<?php echo $hoursWorkedWeekly ?>" placeholder="" required
                                    autofocus/>
                         </div>
                         <div class="div">
                             <label>Salary: </label>
                             <input class="input" type="number" name="salary" value="<?php echo $salary ?>"
                                    placeholder="" required autofocus/>
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


    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['name']) && isset($_POST['surname'])
        && isset($_POST['cnp']) && isset($_POST['address']) && isset($_POST['sex'])
        && isset($_POST['birth_date']) && isset($_POST['hiring_date']) && isset($_POST['salary'])
        && isset($_POST['hours_worked_weekly']))
    {
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
