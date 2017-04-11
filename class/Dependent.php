<?php

require_once("Person.php");

class Dependent extends Person
{
    private $employee;


    public function __construct($id, $name, $surname, $cnp, $address, $sex, $birthDate, Employee $employee)
    {
        parent::__construct($id, $name, $surname, $cnp, $address, $sex, $birthDate);
        $this->employee = $employee;
    }

    /**
     * @return Employee
     */
    public function getEmployee()
    {
        return $this->employee;
    }
}
