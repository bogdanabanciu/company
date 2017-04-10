<?php

class Project
{
    private $id;
    protected $name;
    private $budget;
    private $deadline;
    private $hoursWorked;

    public function __construct($name)
    {
        $this->name = $name;
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
}

?>