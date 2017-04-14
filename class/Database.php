<?php

require_once("Employee.php");
require_once("Department.php");
require_once("Project.php");

define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASSWORD", "vagrant#123");
define("DB_NAME", "company");

class Database
{
    private $conn;

    public function __construct()
    {
        $this->conn = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASSWORD);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //set the PDO error mode to exception
    }

    /**
     * @param $name
     * @param $surname
     * @return Employee|null
     */

    //=============================== EMPLOYEES ==================================
    public function getEmployees()
    {
        $result = array();

        $sql = "SELECT * FROM employees";

        foreach($this->conn->query($sql) as $row)
        {
            $id = $row['id'];
            $name = $row['name'];
            $surname = $row['surname'];
            $cnp = $row['cnp'];
            $address = $row['address'];
            $sex = $row['sex'];
            $birthDate = $row['birth_date'];
            $hiringDate = $row['hiring_date'];
            $hoursWorkedWeekly = $row['hours_worked_weekly'];
            $salary = $row['salary'];

            $departmentId = $row['id_department'];
            $supervisorId = $row['id_supervisor'];

            $employee = new Employee($id, $name, $surname, $cnp, $address, $sex, $birthDate, $departmentId, $supervisorId, $hiringDate, $hoursWorkedWeekly, $salary);
            $this->loadDependents($employee);

            array_push($result, $employee);
        }

        return $result;
    }

    public function getEmployeeByName($name, $surname)
    {
        $employee = null;

        $sql = "SELECT * FROM employees WHERE name= :name AND surname= :surname";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(array(':name' => $name, ':surname' => $surname));
        $row = $stmt->fetch();
        $stmt = null;

        if($row)
        {
            $id = $row['id'];
            $name = $row['name'];
            $surname = $row['surname'];
            $cnp = $row['cnp'];
            $address = $row['address'];
            $sex = $row['sex'];
            $birthDate = $row['birth_date'];
            $hiringDate = $row['hiring_date'];
            $hoursWorkedWeekly = $row['hours_worked_weekly'];
            $salary = $row['salary'];

            $departmentId = $row['id_department'];
            //$department = $this->getDepartmentById($departmentId);
            $supervisorId = $row['id_supervisor'];
            //$supervisor = $this->getEmployeeById($supervisorId);

            $employee = new Employee($id, $name, $surname, $cnp, $address, $sex, $birthDate, $departmentId, $supervisorId, $hiringDate, $hoursWorkedWeekly, $salary);
            $this->loadDependents($employee);
        }

        return $employee;
    }

    public function searchEmployees($search)
    {
        $result = array();

        $searchStrings = explode(' ', $search, 2);

        if ( count($searchStrings) == 1 )
        {
            $sql = "SELECT * FROM employees WHERE name LIKE :search OR surname LIKE :search";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(array(':search' => $search . '%'));
        }
        else
        {
            $sql = "SELECT * FROM employees WHERE name LIKE :search0 AND surname LIKE :search1";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(array(':search0' => $searchStrings[0] . '%', ':search1' => $searchStrings[1] . '%'));
        }

        while ( $row = $stmt->fetch() )
        {
            $id = $row['id'];
            $name = $row['name'];
            $surname = $row['surname'];
            $cnp = $row['cnp'];
            $address = $row['address'];
            $sex = $row['sex'];
            $birthDate = $row['birth_date'];
            $hiringDate = $row['hiring_date'];
            $hoursWorkedWeekly = $row['hours_worked_weekly'];
            $salary = $row['salary'];
            $departmentId = $row['id_department'];
            $supervisorId = $row['id_supervisor'];

            $employee = new Employee($id, $name, $surname, $cnp, $address, $sex, $birthDate, $departmentId, $supervisorId, $hiringDate, $hoursWorkedWeekly, $salary);
            $this->loadDependents($employee);

            array_push($result, $employee);
        }

        return $result;
    }

    private function loadDependents(Employee $employee)
    {
        $stmt = null;
        $dependent = null;

        // select * from intretinuti where id_employee = $id
        $sql = "SELECT * FROM dependent WHERE id_employee = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(array(':id' => $employee->getId()));

        while($row_dependent = $stmt->fetch())
        {
            $id = $row_dependent['id'];
            $name = $row_dependent['name'];
            $surname = $row_dependent['surname'];
            $cnp = $row_dependent['cnp'];
            $address = $row_dependent['address'];
            $sex = $row_dependent['sex'];
            $birthDate = $row_dependent['birth_date'];

            $dependent = new Dependent($id, $name,$surname, $cnp, $address, $sex, $birthDate, $employee);
            $employee->addDependent($dependent);
        }
    }

    public function getEmployeeById($id)
    {
        $employee = null;

        $sql = "SELECT * FROM employees WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(array(':id' => $id));

        if($row = $stmt->fetch())
        {
            $id = $row['id'];
            $name = $row['name'];
            $surname = $row['surname'];
            $cnp = $row['cnp'];
            $address = $row['address'];
            $sex = $row['sex'];
            $birthDate = $row['birth_date'];
            $hiringDate = $row['hiring_date'];
            $hoursWorkedWeekly = $row['hours_worked_weekly'];
            $salary = $row['salary'];

            $departmentId = $row['id_department'];
            $supervisorId = $row['id_supervisor'];

            $employee = new Employee($id, $name, $surname, $cnp, $address, $sex, $birthDate, $departmentId, $supervisorId, $hiringDate, $hoursWorkedWeekly, $salary);
            $this->loadDependents($employee);
        }

        return $employee;
    }


    //TODO:
    public function addEmployee($department, $supervisor, $name, $surname,
                                $cnp, $address,$sex, $birthDate, $hiringDate,
                                $salary, $hoursWorkedWeekly)
    {
        $sql = "INSERT INTO employees(id_department, id_supervisor, name, surname, cnp, address, sex, hiring_date, birth_date, salary, hours_worked_weekly) VALUES(:id_department, :id_supervisor, :name, :surname, :cnp, :address, :sex, :hiring_date, :birth_date, :salary, :hours_worked_weekly)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_department', $department);
        $stmt->bindParam(':id_supervisor', $supervisor);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':surname', $surname);
        $stmt->bindParam(':cnp', $cnp);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':sex', $sex);
        $stmt->bindParam(':birth_date', $birthDate);
        $stmt->bindParam(':hiring_date', $hiringDate);
        $stmt->bindParam(':salary', $salary);
        $stmt->bindParam(':hours_worked_weekly', $hoursWorkedWeekly);

        return $stmt->execute();
    }

    public function removeEmployeeById($id)
    {
        $sql = 'DELETE FROM employees WHERE id = :id';
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }

    public function updateEmployee($employee)
    {
        $sql = "UPDATE employees SET id_department = :department, id_supervisor = :supervisor, name = :name,
                                           surname = :surname, cnp = :cnp, address = :address, sex = :sex,
                                           hiring_date = :hiring_date, birth_date = :birth_date, salary = :salary,
                                           hours_worked_weekly = :hours_worked_weekly 
                                       WHERE id = :id";
        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(':id', $employee->getId());
        $stmt->bindParam(':department', $employee->getDepartmentId());
        $stmt->bindParam(':supervisor', $employee->getSupervisorId());
        $stmt->bindParam(':name', $employee->getName());
        $stmt->bindParam(':surname', $employee->getSurname());
        $stmt->bindParam(':cnp', $employee->getCnp());
        $stmt->bindParam(':address', $employee->getAddress());
        $stmt->bindParam(':sex', $employee->getSex());
        $stmt->bindParam(':birth_date', $employee->getBirthDate());
        $stmt->bindParam(':hiring_date', $employee->getHiringDate());
        $stmt->bindParam(':salary', $employee->getSalary());
        $stmt->bindParam(':hours_worked_weekly', $employee->getHoursWorkedWeekly());

        return $stmt->execute();
    }

    //======================================= DEPARTMENT ==========================================

    public function addDepartment($name)
    {
        $sql = "INSERT INTO department(department_name) VALUES(:department_name)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':department_name', $name);

        return $stmt->execute();
    }

    public function searchDepartment($search)
    {
        $results = array();

        $sql = "SELECT * FROM department";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        if($row = $stmt->fetch()){
            $id = $row['id'];
            $name = $row['department_name'];

            $department = new Department($id, $name);
            array_push($results, $department);
        }

        return $results;
    }

    public function getDepartments()
    {
        $result = array();

        $sql = "SELECT * FROM department";

        foreach($this->conn->query($sql) as $row)
        {
            $id = $row['id'];
            $name = $row['department_name'];

            $department = new Department($id, $name);

            array_push($result, $department);
        }

        return $result;
    }

    public function getDepartmentById($id)
    {
        $stmt = null;
        $department = null;

        $sql = "SELECT * FROM department WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(array(':id' => $id));
        $row = $stmt->fetch();

        $stmt = null;

        if($row)
        {
            $id = $row['id'];
            $name = $row['department_name'];

            $department = new Department($id, $name);
        }

        return $department;
    }

    public function getDepartmentByName($name)
    {
        $stmt = null;
        $department = null;

        $sql = "SELECT * FROM deparment WHERE name = :name";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(array(':name' => $name));
        $row = $stmt->fetch();

        $stmt = null;

        if($row)
        {
            $id = $row['id'];
            $name = $row['department_name'];

            $department = new Department($id, $name);
        }

        return $department;
    }

    //======================================== PROJECT =============================================

    public function getProjects()
    {
        $result = array();
        $sql = "SELECT * FROM project";

        foreach($this->conn->query($sql) as $row)
        {
            $id = $row['id'];
            $name = $row['name'];
            $departmentId = $row['id_department'];
            $managerId = $row['id_manager'];
            $budget = $row['budget'];
            $deadline = $row['deadline'];
            $hoursWorked = $row['hours_worked'];

            $project = new Project($id, $name, $departmentId, $managerId);
            $project->setBudget($budget);
            $project->setDeadline($deadline);
            $project->setHoursWorked($hoursWorked);

            array_push($result, $project);
        }

        return $result;
    }

    public function getProjectById($id)
    {
        $project = null;

        $sql = "SELECT * FROM project WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(array(':id' => $id));

        if($row = $stmt->fetch())
        {
            $id = $row['id'];
            $name = $row['name'];
            $budget = $row['budget'];
            $deadline = $row['deadline'];
            $hoursWorked = $row['hours_worked'];
            $departmentId = $row['id_department'];
            $managerId = $row['id_manager'];

            $project = new Project($id, $name, $departmentId, $managerId);
            $project->setBudget($budget);
            $project->setDeadline($deadline);
            $project->setHoursWorked($hoursWorked);
        }

        return $project;
    }

    public function getProjectByName($name)
    {
        $stmt = null;
        $project = null;

        $sql = "SELECT * FROM project WHERE name = :name";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(array(':name' => $name));
        $row = $stmt->fetch();

        $stmt = null;

        if($row)
        {
            //$id = $row['id'];
            $name = $row['name'];
            $budget = $row['budget'];
            $deadline = $row['deadline'];
            $hoursWorked = $row['hours_worked'];

            $departmentId = $row['id_department'];
            $department = $this->getDepartmentById($departmentId);
            $managerId = $row['id_manager'];
            $manager = $this->getEmployeeById($managerId);

            $project = new Project($managerId, $name);
        }

        return $project;
    }

    public function addProject($name, $departmentId, $managerId, $deadline, $budget)
    {
        $sql = "INSERT INTO project(id_department, name, budget, deadline, id_manager) VALUES(:department, :name, :budget, :deadline, :manager)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':department', $departmentId);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':budget', $budget);
        $stmt->bindParam(':deadline', $deadline);
        $stmt->bindParam(':manager', $managerId);

        return $stmt->execute();
    }

    public function removeProjectById($id)
    {
        $sql = 'DELETE FROM project WHERE id = :id';
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }

    public function __destruct()
    {
        $this->conn = null;
    }
}
?>