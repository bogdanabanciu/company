<?php
require_once("Person.php");
class Project
{
    private $id;
    protected $name;
    private $budget;
    private $deadline;
    private $hoursWorked;
    private $managerId;
    private $manager = null;
    private $departmentId;
    private $department = null;

    public function __construct($id, $name, $departmentID, $managerID)
    {
        $this->id = $id;
        $this->name = $name;
        $this->departmentId = $departmentID;
        $this->managerId = $managerID;
    }

    public function __toString()
    {
        $result = "Name: " . $this->name . ", Deadline " . $this->getDeadline();
        return $result;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setBudget($budget)
    {
        $this->budget = $budget;
    }

    public function getBudget()
    {
        return $this->budget;
    }

    public function setDeadline($deadline)
    {
        $this->deadline = $deadline;
    }

    public function getDeadline()
    {
        return $this->deadline;
    }

    public function setHoursWorked($hoursWorked)
    {
        $this->hoursWorked = $hoursWorked;
    }

    public function getHoursWorked()
    {
        return $this->hoursWorked;
    }

    public function getManager()
    {
        if($this->manager){
            return $this->manager;
        }

        $db = new Database();
        $this->manager = $db->getEmployeeById($this->managerId);

        return $this->manager;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getManagerId()
    {
        return $this->managerId;
    }

    /**
     * @return mixed
     */
    public function getDepartmentId()
    {
        return $this->departmentId;
    }

    public function getDepartment()
    {
        if ($this->department)
            return $this->department;

        $db = new Database();
        $this->department = $db->getDepartmentById($this->departmentId);

        return $this->department;
    }

    public function toTableRow($rowIndex)
    {
        $row = "<tr onclick=\"location.href='projectInfo.php?id=" . $this->getId() .
            "';\"><td>$rowIndex</td><td>" .
            $this->name . "</td><td>" .
            $this->getDepartment()->getDepartmentName() . '</td><td>' .
            $this->getManager()->getName() . ' ' . $this->getManager()->getSurname() . "</td></tr>";

        return $row;
    }
}
