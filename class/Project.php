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

    public function __construct($name, $managerID)
    {
        $this->name = $name;
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

        $db = new Database(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $db->connectToDatabase();

        $this->manager = $db->getEmployeeById($this->managerId);

        return $this->managerId;
    }

    public function toTableRow($rowIndex)
    {
        $row = "<tr onclick=\"location.href='projectInfo.php?id=" . $this->getId() . "';\"><td>
                    $rowIndex</td><td>".
            $this->name . "</td><td>";
            if($this->getManager())
                $row .= $this->getManager()->getName() . ' ' . $this->getManager()->getSurname() . "</td>";
            else
                $row .= "No manager</td>";

        return $row;
    }
}
