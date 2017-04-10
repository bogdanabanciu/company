<!DOCTYPE html>
<html>
    <head>
        <!-- CSS -->
        <link rel="stylesheet" href="../css/main.css">
        <!-- End of CSS -->

        <!--  JS  -->
        <script src="../js/jquery-2.1.3.min.js"
        <script src="../js/buttons.js"></script>
        <!-- END of JS  -->

        <title>Search for employee</title>
    </head>
    <body>
        <h1>Zitec</h1>
        <h3>Search employee</h3>

        <form action="employeeInfo.php" method="post" class="form" > <!-- action?? employeeInfo.php sau save.php -->
            <div class="div">
                <label>Name: </label>
                <input class="input" type="text" name="name" value="" placeholder="Name" required autofocus style="margin-left: 33px"/>
                <br>
                <label>Surname: </label>
                <input class="input" type="text" name="surname" value="" placeholder="Surname" required autofocus/>
            </div>
            <div class="button">
                <button type="button" onclick="showPopup('addEmployeePopup')">Add</button>
                <input type="submit">
            </div>
        </form>
        <div id="addEmployeePopup" class="popup-background">
            <div class="popup-container"></div>
            <p class="popup-title">Add Employee</p>
            <form id="addEmployeeForm" class="form">
                <input id="addEmployeeAction" type="hidden" value="<?=ACTION_ADD_EMPLOYEE?>">
                <div class="div"><label>Name: </label><input id="addEmployeeName" type="text" maxlength="128"></div>
                <div class="div"><label>Surname: </label><input id="addEmployeeSurname" type="text" maxlength="128"></div>
                <div class="div"><label>CNP: </label><input id="addEmployeeCNP", type="text", maxlength="12"></div>
                <div class="div"><label>Address: </label><input id="addEmployeeAddress", type="text", maxlength="128"></div>
                <div class="div"><label>Sex: </label><input id="addEmployeeSex", type="text", maxlength="1"></div>
                <div class="div"><label>Hiring Date: </label><input id="addEmployeeHiringDate", type="datetime"></div>
                <div class="div"><label>Birth Date: </label><input id="addEmployeeBirthDate", type="datetime"></div>
                <div class="div"><label>Salary: </label><input id="addEmployeeSalary", type="number"></div>
                <div class="div"><label>Hours Worked Weekly: </label><input id="addEmployeeHoursWorkedWeekly" type="number"></div>
                <div class="popup-buttons">
                    <div class="popup-loading"></div>
                    <input id="addEmployee" type="button" value="OK">
                    <button type="button" onclick="closePopup('addEmployeePopup')">Cancel</button>
                </div>
            </form>
        </div>
</body>
</html>
<?php
    include "../file/validation.php";
    include "../file/files.php";

    $name = '';
    $surname = '';

    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['name']) && isset($_POST['surname']))
    {
        $name = test_input($_POST['name']);
        $surname = test_input($_POST['surname']);
    }
    else
        throw new Exception("Error: name and surname required");

    $db = new Database(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    $db->connectToDatabase();
    $employee = $db->getEmployeeByName($name, $surname);

    $db->__destruct();
?>