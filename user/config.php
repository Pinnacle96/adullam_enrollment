<?php

$conn = mysqli_connect("localhost", "root", "", "camsdb");

if (!$conn) {
    echo "Connection Failed";
}