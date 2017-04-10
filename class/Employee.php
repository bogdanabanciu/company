<?php

class Employee extends Person
{
    private $department = null;
    private $supervisor = null;   //nu toti angajatii sunt supervisori
    private $hiringDate;
    private $hoursWorkedWeekly;
    private $salary;
    private $dependents = array();
    //TODO: do the same for projects
   /* function __toString()
    {

    }
*/
    public function __construct(
        $id,
        $name,
        $surname,
        $cnp,
        $address,
        $sex,
        $birthDate,
        Department $department,
        Employee $supervisor,
        $hiringDate,
        $hoursWorkedWeekly,
        $salary)
    {
        parent::__construct($id, $name, $surname, $cnp, $address, $sex, $birthDate);
        $this->department = $department;
        $this->supervisor = $supervisor;
        $this->hiringDate = $hiringDate;
        $this->hoursWorkedWeekly = $hoursWorkedWeekly;
        $this-> salary = $salary;
    }

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

    public function removeDependent(Dependent $dependent)
    {
        //TODO: remove if $this->dependents[$i]->getId() == $dependent->getId()
        /* not sure */
        /*if($this->dependents->getId() == $dependent->getId())
        {
            $this->dependents = array_diff($this->dependents, array($dependent->getId()));  //source: http://stackoverflow.com/questions/2448964/php-how-to-remove-specific-element-from-an-array
        }*/

    }


    /**
     * @return Employee|null
     */
    public function getSupervisor()
    {
        return $this->supervisor;
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