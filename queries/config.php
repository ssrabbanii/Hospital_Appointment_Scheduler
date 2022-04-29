<?php
    $db = "(DESCRIPTION = (ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)(Host = studora.comp.polyu.edu.hk)(Port = 1521))) (CONNECT_DATA = (SID=DBMS)))"; //One Single Line
    $conn = oci_connect('"20100594D"', 'lhkkzdis', $db);
    $conn = ocilogon('"20100594D"', 'lhkkzdis', $db);
?>