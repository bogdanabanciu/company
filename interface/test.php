<?php
/**
 * Created by PhpStorm.
 * User: bogdanabanciu
 * Date: 11/04/2017
 * Time: 23:32
 */

require_once('../file/files.php');

$db = new Database();

$employees = $db->searchEmployees("Bogdana");

$departments = $db->getDepartments();

foreach($departments as $department){
    echo $department;
}

$employee = $db->getEmployeeById(1);
echo $employee->getSupervisor();