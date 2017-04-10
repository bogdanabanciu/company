<?php
function test_input($data)
{
    $data = trim($data);              //inlatura spatiile de la inceputul si sf stringului
    $data = stripslashes($data);      //transforma backslash
    $data = htmlspecialchars($data);  //transforma caracterele speciale in expresii precum &lt; sau &gt;
    return $data;
}
?>