<?php
session_start();

// Unset semua session variabel
unset($_SESSION['username']);
unset($_SESSION['id_users']);

// Unset All
session_unset();

//Destroy session
session_destroy();

// Arahkan ke halaman login 
header('location: ../login.php?pesan=logout');
exit;
