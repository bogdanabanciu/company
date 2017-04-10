<?php
    include("../class/Employee.php");
    include("../class/Company.php");
    include("../class/Department.php");
    include("../class/Dependent.php");
    include("../class/Project.php");
    include("../class/Database.php");

    define("DB_HOST", "192.168.33.104");
    define("DB_USER", "root");
    define("DB_PASSWORD", "vagrant#123");
    define("DB_NAME", "company");
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