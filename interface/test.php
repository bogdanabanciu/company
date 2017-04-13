<?php
/**
 * Created by PhpStorm.
 * User: bogdanabanciu
 * Date: 11/04/2017
 * Time: 23:32
 */

require_once('../file/files.php');

$db = new Database(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
$db->connectToDatabase();

$employees = $db->searchEmployees("Bogdana");

//$deparments = $db->searchDepartment("Development");

$departments = $db->getDepartments();

foreach($departments as $department)
{

}