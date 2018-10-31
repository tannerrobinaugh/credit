<?php

    function openDB() {
        $servername = "localhost";
        $username = "root";
        $password = NULL;
        $dbname = "users";

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: ". $conn->connect_error);
        }
        return $conn;
    }

    function closeDB($conn) {
        mysqli_close($conn);
    }

?>