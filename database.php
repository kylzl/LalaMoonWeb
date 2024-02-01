<?php

    $servername = "localhost";
    $dbusername = "dfoiwidm_roa";
    $dbpassword = "liezlkaye72317";
    $dbname = "dfoiwidm_lalamoon";

    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
