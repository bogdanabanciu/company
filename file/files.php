<?php
    require_once("../class/Employee.php");
    require_once("../class/Company.php");
    require_once("../class/Department.php");
    require_once("../class/Dependent.php");
    require_once("../class/Project.php");
    require_once("../class/Database.php");

    //action in forms
    define("ACTION_ADD_DEPARTMENT", 1);
    define("ACTION_EDIT_DEPARTMENT", 2);
    define("ACTION_DELETE_DEPARTMENT", 3);
    define("ACTION_ADD_EMPLOYEE", 4);
    define("ACTION_EDIT_EMPLOYEE", 5);
    define("ACTION_DELETE_EMPLOYEE", 6);
    define("ACTION_ADD_PROJECT", 7);
    define("ACTION_EDIT_PROJECT", 8);
    define("ACTION_DELETE_PROJECT", 9);
    define("ACTION_ADD_DEPENDENT", 10);
    define("ACTION_EDIT_DEPENDENT", 11);
    define("ACTION_DELETE_DEPENDENT", 12);
?>