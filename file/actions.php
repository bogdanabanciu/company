<?php
    require_once("files.php");

    $action = 0;
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']))
        $action = $_POST['action'];

    switch ($action){
        case ACTION_ADD_DEPARTMENT:
            if(isset($_POST['id']) && isset($_POST['department_name'])) {
                $department_id = test_input($_POST['id']);
                $department_name = test_input($_POST['department_name']);

                $sql = "INSERT INTO department(id, name) VALUES(':id', ':department_name')";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindParam(':id', $department_id, PDO::PARAM_INT);
                $stmt->bindParam(':department_name', $department_name, PDO::PARAM_STR);

                if ($stmt->execute()) {
                    echo "Success";
                } else {
                    echo "ERROR: ACTION ADD Department: INSERT problems";
                }
            }
            else{
               echo "ERROR: ACTION EDIT Department: not all required parameters are set";
            }

            break;
        case ACTION_EDIT_DEPARTMENT:
            if(isset($_POST['id']) && isset($_POST['department_name'])){
                $department_id = test_input($_POST['id']);
                $department_name = test_input($_POST['department_name']);

                $sql = "UPDATE department SET name=':name' WHERE id=':id'";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindParam(':id', $department_id, PDO::PARAM_INT);
                $stmt->bindParam(':department_name', $department_name, PDO::PARAM_STR);

                if ($stmt->execute()) {
                    echo "Success";
                } else {
                    echo "ERROR: ACTION ADD Department: INSERT problems";
                }
            }
            else
                echo "ERROR: ACTION EDIT Department: not all required parameters are set";

            break;
        case ACTION_DELETE_DEPARTMENT:

            break;
        case ACTION_ADD_EMPLOYEE:
            if(isset($_POST['id']) && isset($_POST['id_department'])
                && isset($_POST['id_supervisor']) && isset($_POST['name']) && isset($_POST['surname'])
                && isset($_POST['cnp']) && isset($_POST['address']) && isset($_POST['sex'])
                && isset($_POST['hiring_date']) && isset($_POST['birth_date']) && isset($_POST['salary'])
                && isset($_POST['hours_worked_weekly']))
            {
                $department = test_input($_POST['id_department']);
                $supervisor = test_input($_POST['id_supervisor']);
                $name = test_input($_POST['name']);
                $surname = test_input($_POST['surname']);
                $cnp = test_input($_POST['cnp']);
                $address = test_input($_POST['address']);
                $sex = test_input($_POST['sex']);
                $birthDate = test_input($_POST['birth_date']);
                $hiringDate = test_input($_POST['hiring_date']);
                $salary = test_input($_POST['salary']);
                $hoursWorkedWeekly = test_input($_POST['hours_worked_weekly']);

                try {
                    $db = new Database(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                    $db->connectToDatabase();

                    $result = $db->addEmployee($department, $supervisor, $name, $surname, $cnp, $address, $sex, $birthDate, $hiringDate, $salary, $hoursWorkedWeekly);

                    if ( $result )
                        echo 'Success';
                    else
                        echo "ERROR: ACTION Add Employee: INSERT problems";
                }
                catch (PDOException $ex)
                {
                    echo "ERROR: database exception: ", $ex->getMessage();
                }
            }
            else
                echo "ACTION Add Employee: not all required parameters set";
            break;

        case ACTION_EDIT_EMPLOYEE:
            if(isset($_POST['id']) && isset($_POST['id_department'])
                && isset($_POST['id_supervisor']) && isset($_POST['name']) && isset($_POST['surname'])
                && isset($_POST['cnp']) && isset($_POST['address']) && isset($_POST['sex'])
                && isset($_POST['hiring_date']) && isset($_POST['birth_date']) && isset($_POST['salary'])
                && isset($_POST['hours_worked_weekly'])) {
                $employee_id = test_input($_POST['id']);
                $employee_department = test_input($_POST['id_department']);
                $employee_supervisor = test_input($_POST['id_supervisor']);
                $employee_name = test_input($_POST['name']);
                $employee_surname = test_input($_POST['surname']);
                $employee_cnp = test_input($_POST['cnp']);
                $employee_address = test_input($_POST['address']);
                $employee_sex = test_input($_POST['sex']);
                $employee_birthDate = test_input($_POST['birth_date']);
                $employee_hiringDate = test_input($_POST['hiring_date']);
                $employee_salary = test_input($_POST['salary']);
                $employee_hoursWorkedWeekly = test_input($_POST['hours_worked_weekly']);

                $sql="UPDATE employees SET department=?, supervisor=?, name=?,
                                           surname=?, cnp=?, address=?, sex=?,
                                           hiringDate=?, birthDate=?, salary=?,
                                           hoursWorkedWeekly=? 
                                       WHERE id=?";
                $stmt = $this->conn->prepare($sql);

                $stmt->bindParam(':id', $employee_id, PDO::PARAM_INT);
                $stmt->bindParam(':id_department', $employee_department, PDO::PARAM_INT);
                $stmt->bindParam(':id_supervisor', $employee_supervisor, PDO::PARAM_INT);
                $stmt->bindParam(':name', $employee_name, PDO::PARAM_STR);
                $stmt->bindParam(':surname', $employee_surname, PDO::PARAM_STR);
                $stmt->bindParam(':cnp', $employee_cnp, PDO::PARAM_STR);
                $stmt->bindParam(':address', $employee_address, PDO::PARAM_STR);
                $stmt->bindParam(':sex', $employee_sex, PDO::PARAM_STR);
                $stmt->bindParam(':birth_date', $employee_birthDate, PDO::PARAM_STR);
                $stmt->bindParam(':hiring_date', $employee_hiringDate, PDO::PARAM_STR);
                $stmt->bindParam(':salary', $employee_salary, PDO::PARAM_INT);
                $stmt->bindParam(':hours_worked_weekly', $employee_hoursWorkedWeekly, PDO::PARAM_INT);

                if($stmt->execute())
                {
                    echo 'Success!';
                }
                else
                {
                    throw new Exception("ERROR: ACTION Edit Employee: UPDATE problems");
                }
            }
            else
            {
                throw new Exception("ERROR: ACTION Edit Employee: not all required parameters set");
            }

            break;
        case ACTION_DELETE_EMPLOYEE:

            break;
        case ACTION_ADD_PROJECT:

            break;
        case ACTION_EDIT_PROJECT:

            break;
        case ACTION_DELETE_PROJECT:

            break;
        case ACTION_ADD_DEPENDENT:

            break;
        case ACTION_EDIT_DEPENDENT:

            break;
        case ACTION_DELETE_DEPENDENT:

            break;

    }

?>