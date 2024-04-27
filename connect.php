<?php
        $db_host = "localhost";
        $db_username = "root";
        $db_password = "";
        $db_name = "susmarketplace";

        $conn = new mysqli($db_host, $db_username, $db_password, $db_name);
        
        if ($conn -> connect_error)
        {
            die("Connection failed: ". $conn -> connect_error);
        }

        // $db_host = "103.56.204.76";
        // $db_username = "erwinyon_bohit";
        // $db_password = "J@2XnOqWAO81";
        // $db_name = "erwinyon_bohit";