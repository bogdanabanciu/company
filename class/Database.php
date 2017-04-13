<?php

require_once("Employee.php");
require_once("Department.php");
require_once("Project.php");

class Database
{
    private $host;
    private $user;
    private $password;
    private $db;
    private $conn;

    public function __construct($host, $user, $pass, $db)
    {
        $this->host = $host;
        $this->user = $user;
        $this->password = $pass;
        $this->db = $db;
        $this->conn = null;
    }

    public function connectToDatabase()
    {
        $this->conn = new PDO("mysql:host=$this->host;dbname=$this->db", $this->user, $this->password);
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
            $department = $this->getDepartmentById($departmentId);
            $supervisorId = $row['id_supervisor'];
            //$supervisor = $this->getEmployeeById($supervisorId);

            $employee = new Employee($id, $name, $surname, $cnp, $address, $sex, $birthDate, $department, $supervisorId, $hiringDate, $hoursWorkedWeekly, $salary);
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
            $department = $this->getDepartmentById($departmentId);
            $supervisorId = $row['id_supervisor'];
            //$supervisor = $this->getEmployeeById($supervisorId);

            $employee = new Employee($id, $name, $surname, $cnp, $address, $sex, $birthDate, $department, $supervisorId, $hiringDate, $hoursWorkedWeekly, $salary);
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
            $department = $this->getDepartmentById($departmentId);
            $supervisorId = $row['id_supervisor'];
            //$supervisor = $this->getEmployeeById($supervisorId);

            $employee = new Employee($id, $name, $surname, $cnp, $address, $sex, $birthDate, $department, $supervisorId, $hiringDate, $hoursWorkedWeekly, $salary);
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
        $stmt = null;
        $employee  = null;

        $sql = "SELECT * FROM employees WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(array(':id' => $id));
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
            $department = $this->getDepartmentById($departmentId);
            $supervisorId = $row['id_supervisor'];
            $supervisor = $this->getEmployeeById($supervisorId);

            $employee = new Employee($id, $name, $surname, $cnp, $address, $sex, $birthDate, $department, $supervisor,$hiringDate, $hoursWorkedWeekly, $salary);
            $this->loadDependents($employee);
        }

        return $employee;
    }


    //TODO:
    public function addEmployee($department, $supervisor, $name, $surname,
                                $cnp, $address,$sex, $birthDate, $hiringDate,
                                $salary, $hoursWorkedWeekly)
    {
        $sql = "INSERT INTO employees(department, supervisor, name, 
                                              surname, cnp, address, sex, hiringDate,
                                              birthDate, salary, hoursWorkedWeekly) 
                               VALUES(':id_department', ':id_supervisor', ':name',
                                      ':surname', ':cnp', ':address', ':sex',
                                      ':hiring_date', ':birth_date',':salary',
                                      ':hours_worked_weekly')";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_department', $department, PDO::PARAM_INT);
        $stmt->bindParam(':id_supervisor', $supervisor, PDO::PARAM_INT);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':surname', $surname, PDO::PARAM_STR);
        $stmt->bindParam(':cnp', $cnp, PDO::PARAM_STR);
        $stmt->bindParam(':address', $address, PDO::PARAM_STR);
        $stmt->bindParam(':sex', $sex, PDO::PARAM_STR);
        $stmt->bindParam(':birth_date', $birthDate, PDO::PARAM_STR);
        $stmt->bindParam(':hiring_date', $hiringDate, PDO::PARAM_STR);
        $stmt->bindParam(':salary', $salary, PDO::PARAM_INT);
        $stmt->bindParam(':hours_worked_weekly', $hoursWorkedWeekly, PDO::PARAM_INT);

        return $stmt->execute();
    }

    //======================================= DEPARTMENT ==========================================

    /*public function addDepartment($add)
    {
        require_once('../file/actions.php');
    }*/

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

    public function getProject()
    {
        $result = array();
        $sql = "SELECT * FROM project";

        foreach($this->conn->query($sql) as $row)
        {
            $id = $row['id'];
            $name = $row['name'];
            $departmentId = $row['id_department'];
            $department = $this->getDepartmentById($departmentId);
            $managerId = $row['id_manager'];
            $manager = $this->getEmployeeById($managerId);

            $project = new Project($name, $manager);

            array_push($result, $project);
        }

        return $result;
    }

    public function getProjectById($id)
    {
        $stmt = null;
        $project = null;

        $sql = "SELECT * FROM project WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(array(':id' => $id));
        $row = $stmt->fetch();

        $stmt = null;

        if($row)
        {
            $id = $row['id'];
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

    public function __destruct()
    {
        $this->conn = null;
    }
}
?>