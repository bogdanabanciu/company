<?php
    require_once("files.php");
    require_once('validation.php');

    $action = 0;
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']))
        $action = test_input($_POST['action']);

    try
    {
        switch ($action)
        {
            case ACTION_ADD_DEPARTMENT:
                if (isset($_POST['name']))
                {
                    $department_name = test_input($_POST['name']);
                    $db = new Database();
                    if ( $db->addDepartment($department_name) )
                        echo "Success";
                    else
                        echo "ERROR: ACTION ADD Department: INSERT problems";
                }
                else
                    echo "ERROR: ACTION EDIT Department: not all required parameters are set";
                break;
            case ACTION_EDIT_DEPARTMENT:
                if (isset($_POST['id']) && isset($_POST['department_name'])) {
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
                } else
                    echo "ERROR: ACTION EDIT Department: not all required parameters are set";

                break;
            case ACTION_DELETE_DEPARTMENT:

                break;
            case ACTION_ADD_EMPLOYEE:
                if (isset($_POST['id_department']) && isset($_POST['id_supervisor']) && isset($_POST['name']) &&
                    isset($_POST['surname']) && isset($_POST['cnp']) && isset($_POST['address']) && isset($_POST['sex'])
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

                    $db = new Database();
                    $result = $db->addEmployee($department, $supervisor, $name, $surname, $cnp, $address, $sex, $birthDate, $hiringDate, $salary, $hoursWorkedWeekly);

                    if ($result)
                        echo 'Success';
                    else
                        echo "ERROR: ACTION Add Employee: INSERT problems";
                }
                else
                    echo "ACTION Add Employee: not all required parameters set";
                break;
            case ACTION_EDIT_EMPLOYEE:
                if (isset($_POST['id']) && isset($_POST['id_department'])
                    && isset($_POST['id_supervisor']) && isset($_POST['name']) && isset($_POST['surname'])
                    && isset($_POST['cnp']) && isset($_POST['address']) && isset($_POST['sex'])
                    && isset($_POST['hiring_date']) && isset($_POST['birth_date']) && isset($_POST['salary'])
                    && isset($_POST['hours_worked_weekly'])
                ) {
                    $employee = new Employee(
                        test_input($_POST['id']),
                        test_input($_POST['name']),
                        test_input($_POST['surname']),
                        test_input($_POST['cnp']),
                        test_input($_POST['address']),
                        test_input($_POST['sex']),
                        test_input($_POST['birth_date']),
                        test_input($_POST['id_department']),
                        test_input($_POST['id_supervisor']),
                        test_input($_POST['hiring_date']),
                        test_input($_POST['hours_worked_weekly']),
                        test_input($_POST['salary']));

                    $db = new Database();

                    if ( $db->updateEmployee($employee) ) {
                        echo 'Success!';
                        header("location: ../interface/employeeList.php");
                    } else {
                        echo "ERROR: ACTION Edit Employee: UPDATE problems";
                    }
                } else {
                    echo "ERROR: ACTION Edit Employee: not all required parameters set";
                }
                break;
            case ACTION_DELETE_EMPLOYEE:
                if (isset($_POST['id']))
                {
                    $id = test_input($_POST['id']);
                    $db = new Database();
                    if ( $db->removeEmployeeById($id) )
                        echo 'Success';
                    else
                        echo 'ERROR: cannot remove employee';
                }
                else
                    echo 'ERROR: id not set';
                break;
            case ACTION_ADD_PROJECT:
                if (isset($_POST['name']) && isset($_POST['department']) && isset($_POST['manager']) && isset($_POST['deadline']) && isset($_POST['budget']))
                {
                    $name = test_input($_POST['name']);
                    $departmentId = test_input($_POST['department']);
                    $managerId = test_input($_POST['manager']);
                    $deadline = test_input($_POST['deadline']);
                    $budget = test_input($_POST['budget']);

                    $db = new Database();
                    if ( $db->addProject($name, $departmentId, $managerId, $deadline, $budget) )
                        echo 'Success';
                    else
                        echo 'ERROR: ACTION_ADD_PROJECT';
                }
                else
                    echo 'ERROR: not all parameters are set';
                break;
            case ACTION_EDIT_PROJECT:

                break;
            case ACTION_DELETE_PROJECT:
                if (isset($_POST['id']))
                {
                    $id = test_input($_POST['id']);
                    $db = new Database();
                    if ( $db->removeProjectById($id) )
                        echo 'Success';
                    else
                        echo 'ERROR: cannot remove project';
                }
                else
                    echo 'ERROR: id not set';
                break;
                break;
            case ACTION_ADD_DEPENDENT:

                break;
            case ACTION_EDIT_DEPENDENT:

                break;
            case ACTION_DELETE_DEPENDENT:

                break;
            default:
                echo 'Unknown action';
        }

    }
    catch(PDOException $ex)
    {
        echo 'ERROR: Database: ', $ex->getMessage();
    }
?>