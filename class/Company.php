<?php

abstract class Company
{
    private $companyName;
    private $employeeNumber;

    public function __construct($companyName, $employeeNumber)
    {
        $this->companyName = $companyName;
        $this->employeeNumber = $employeeNumber;
    }

    public function getCompanyName()
    {
        return $this->companyName;
    }

    public function getEmployeeNumber()
    {
        return $this->employeeNumber;
    }

    public function setCompanyName($name)
    {     //initial
        $this->companyName = $name;
    }

    public function setEmployeeNumber($number)
    {    //initial
        $this->employeeNumber = $number;
    }
}

?>