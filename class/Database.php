<?php
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
        try
        {
            $this->conn = new PDO("mysql:host= $this->host;dbname=$this->db", $this->user, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //set the PDO error mode to exception

        }
        catch(PDOException $e)
        {
            echo "Connection failed: " , $e->getMessage();
        }
    }

    /**
     * @param $name
     * @param $surname
     * @return Employee|null
     */

    public function getEmployeeByName($name, $surname)
    {
        $stmt = null;
        $employee = null;

        $sql = "SELECT * FROM employees WHERE name= :name AND surname= :surname";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(array(':name' => $name, ':surname' => $surname));
        $row = $stmt->fetch();
        $stmt = null;

        if($row)
        { //TODO:  write all the attributes for Employee + $row[...]  == DONE
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

            $employee = new Employee($id, $name, $surname, $cnp, $address, $sex, $birthDate, $department, $supervisor, $hiringDate, $hoursWorkedWeekly, $salary);
            //TODO + instead of department id, use the variables above   == DONE
        }
        $this->loadDependents($employee);
        return $employee;
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
        //TODO SELECT as above for id == DONE
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
        }

        return $employee;
    }

    public function getDepartmentById($id)
    {
        //TODO SELECT as above for id  == DONE
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

            $department = new Department($name);
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

            $department = new Department($name);
        }

        return $department;
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

            $project = new Project($name);
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

            $project = new Project($name);
        }

        return $project;
    }

    public function __destruct()
    {
        $this->conn = null;
    }
}
?>