<?php

class Department
{
    private $id;
    private $departmentName;

    public function __construct($departmentName)
    {
        $this->departmentName = $departmentName;
    }

    /**
     * @return mixed
     */
    public function getDepartmentName()
    {
        return $this->departmentName;
    }

    public function getId()
    {
        return $this->id;
    }
}

?>