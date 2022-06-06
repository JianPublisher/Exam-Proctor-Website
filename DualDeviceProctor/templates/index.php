<?php

// Include config file
require_once "config.php";

?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>

        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial;
            padding: 10px;
            background: #f1f1f1;
        }

        /* Header */
        .header {
            padding: 100px;
            text-align: center;
            background: white;
        }

            .header h1 {
                font-size: 50px;
            }

        /* Style the top navigation bar */
        .topnav {
            overflow: hidden;
            background-color: #00aeff;
        }

            /* Style the topnav links */
            .topnav a {
                float: left;
                display: block;
                color: #f2f2f2;
                text-align: center;
                padding: 14px 16px;
                text-decoration: none;
            }

                /* Change color on hover */
                .topnav a:hover {
                    background-color: #ddd;
                    color: black;
                }
    </style>
</head>
<body>

    <div class="header">
        <h1>DDTP: Dual Device Test Proctor</h1>
        <p>DDTP provides remote test proctoring service with the assistance of a secondary device.</p>
    </div>

    <div class="topnav">
        <a href="login.php" style="float:right">Login</a>
        <a href="register.php" style="float:right">Register</a>
    </div>


</body>
</html>

