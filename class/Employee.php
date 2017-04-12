<?php

require_once("Person.php");

class Employee extends Person
{
    private $department = null;
    private $supervisorId;
    private $supervisor = null;
    private $hiringDate;
    private $hoursWorkedWeekly;
    private $salary;
    private $dependents = array();

    public function __construct(
        $id,
        $name,
        $surname,
        $cnp,
        $address,
        $sex,
        $birthDate,
        $department,    //de tip Department
        $supervisorId,
        $hiringDate,
        $hoursWorkedWeekly,
        $salary)
    {
        parent::__construct($id, $name, $surname, $cnp, $address, $sex, $birthDate);
        $this->department = $department;
        $this->supervisorId = $supervisorId;
        $this->hiringDate = $hiringDate;
        $this->hoursWorkedWeekly = $hoursWorkedWeekly;
        $this-> salary = $salary;
    }

    public function __toString()
    {
        $result = "Name: " . $this->getName() . ", Surname: " . $this->getSurname() . ", CNP: " . $this->getCnp() ;
        return $result;
    }

    public function toTableRow($rowIndex)
    {
        $row = "<tr onclick=\"location.href='employeeInfo.php?id=" . $this->getId() . "';\">".
            "<td>$rowIndex</td><td>" .
            $this->getName() . "</td><td>" .
            $this->getSurname() . "</td><td>" .
           // $this->getCnp() . "</td><td>" .
          //  $this->getAddress() . "</td><td>" .
          //  $this->getSex() . "</td><td>" .
           // $this->getBirthDate() . "</td><td>" .
           // $this->getHiringDate() . "</td><td>" .
            $this->getDepartment()->getDepartmentName() . "</td><td>";
           /* if ( $this->getSupervisor() )
                $row .= $this->getSupervisor()->getName() . ' ' . $this->getSupervisor()->getSurname() . "</td><td>";
            else
                $row .= "No supervisor</td><td>";
            $row .= $this->getHoursWorkedWeekly() . "</td><td>" .
            $this->getSalary() . "</td></tr>";*/

            return $row;
    }

    /*public function toTableRow($rowIndex)
    {
        $row = "<tr>" .
            "<td>$rowIndex</td><td>" .
            $this->getName() . "</td><td>" .
            $this->getSurname() . "</td><td>" .
            $this->getCnp() . "</td><td>" .
            $this->getAddress() . "</td><td>" .
            $this->getSex() . "</td><td>" .
            $this->getBirthDate() . "</td><td>" .
            $this->getHiringDate() . "</td><td>" .
            $this->getDepartment()->getDepartmentName() . "</td><td>";
            if ( $this->getSupervisor() )
                $row .= $this->getSupervisor()->getName() . ' ' . $this->getSupervisor()->getSurname() . "</td><td>";
            else
                $row .= "No supervisor</td><td>";
            $row .= $this->getHoursWorkedWeekly() . "</td><td>" .
            $this->getSalary() . "</td></tr>";

            return $row;
    }*/

    /**
     * @return Department|null
     */
    public function getDepartment()
    {
        return $this->department;
    }

    public function addDependent(Dependent $dependent)
    {
        $this->dependents.array_push($dependent);
    }


    /**
     * @return Employee|null
     */
    public function getSupervisor()
    {
        if ( $this->supervisor )
            return $this->supervisor;

        $db = new Database(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $db->connectToDatabase();

        $this->supervisor = $db->getEmployeeById($this->supervisorId);

        return $this->supervisorId;
    }

    /**
     * @return mixed
     */
    public function getHiringDate()
    {
        return $this->hiringDate;
    }

    /**
     * @return mixed
     */
    public function getHoursWorkedWeekly()
    {
        return $this->hoursWorkedWeekly;
    }

    /**
     * @return mixed
     */
    public function getSalary()
    {
        return $this->salary;
    }

    /**
     * @param mixed $hoursWorkedWeekly
     */
    public function setHoursWorkedWeekly($hoursWorkedWeekly)
    {
        $this->hoursWorkedWeekly = $hoursWorkedWeekly;
    }

    /**
     * @param mixed $salary
     */
    public function setSalary($salary)
    {
        $this->salary = $salary;
    }
}
?>