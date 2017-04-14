<?php

class Department
{
    private $id;
    private $departmentName;

    public function __construct($id, $departmentName)
    {
        $this->id = $id;
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

    public function __toString()
    {
        $result = "Department name: " . $this->getDepartmentName() . "<br>";

        return $result;
    }

    public function toTableRow($rowIndex)
    {
        $row = "<tr onclick=\"location.href='departmentInfo.php?id=" . $this->getId() . "';\"><td>
                    $rowIndex</td><td style='text-align: center;'>".
                    $this->getDepartmentname() . "</td>";
        return $row;
    }

    public function toSelectOption($selected)
    {
        $row = '<option ';
        if ( $this->id == $selected )
            $row .= 'selected ';
        $row .= "value=\"$this->id\">" . $this->departmentName . "</option>";

        return $row;
    }
}

?>