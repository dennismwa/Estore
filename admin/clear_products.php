<?php
    session_start();
    unset($_SESSION['products']);

    header('Location: index.php?page=manage_purchase');