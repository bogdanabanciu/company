<?php

abstract class Person
{
    private $id;
    private $name;
    private $surname;
    private $cnp;
    private $address;
    private $sex;
    private $birthDate;

    public function __construct($id, $name, $surname, $cnp, $address, $sex, $birthDate)
    {
        $this->id = $id;
        $this->name = $name;
        $this->surname = $surname;
        $this->cnp = $cnp;
        $this->address = $address;
        $this->sex = $sex;
        $this->birthDate = $birthDate;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
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
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * @return mixed
     */
    public function getCnp()
    {
        return $this->cnp;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @return mixed
     */
    public function getSex()
    {
        return $this->sex;
    }

    /**
     * @return mixed
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }
}
?>
