<?php
    include 'admin/connection.php';
    session_start();

    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
        $qry = $conn->query("SELECT * FROM users WHERE username='$username'")->fetch_array();
        foreach ($qry as $k => $v) {
            $m[$k] = $v;
        }

    }