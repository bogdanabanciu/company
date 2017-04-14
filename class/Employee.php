<?php

require_once("Person.php");

class Employee extends Person
{
    private $departmentId;
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
        $departmentId,
        $supervisorId,
        $hiringDate,
        $hoursWorkedWeekly,
        $salary)
    {
        parent::__construct($id, $name, $surname, $cnp, $address, $sex, $birthDate);
        $this->departmentId = $departmentId;
        $this->supervisorId = $supervisorId;
        $this->hiringDate = $hiringDate;
        $this->hoursWorkedWeekly = $hoursWorkedWeekly;
        $this-> salary = $salary;
    }

    public function __toString()
    {
        $result = $this->getName() . " " . $this->getSurname();
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

    public function toSelectOption($selected, $disabled)
    {
        $result = '<option ';
        if ($this->getId() == $selected)
            $result .= 'selected ';
        if ($this->getId() == $disabled)
            $result .= 'disabled ';
        $result .= "value=\"" . $this->getId() . "\">" . $this->getName(). " " . $this->getSurname() . "</option>";
        return $result;
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
        if ( $this->department )
            return $this->department;

        $db = new Database();
        $this->department = $db->getDepartmentById($this->departmentId);

        return $this->department;
    }

    /**
     * @return mixed
     */
    public function getDepartmentId()
    {
        return $this->departmentId;
    }

    /**
     * @return mixed
     */
    public function getSupervisorId()
    {
        return $this->supervisorId;
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

        $db = new Database();
        $this->supervisor = $db->getEmployeeById($this->supervisorId);

        return $this->supervisor;
    }

   /* public function getSupervisorByName()
    {
        if ( $this->supervisor )
            return $this->supervisor;

        $db = new Database(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $db->connectToDatabase();

        $this->supervisor = $db->getEmployeeByName($this->getName(), $this->getSurname());

        return $this->supervisor;
    }*/


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