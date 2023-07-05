<?php
    $conn = mysqli_connect("localhost", "root", "", "store");
    if (!$conn)
        echo "Database not connected";