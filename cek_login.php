<?php
// $pass = password_hash('jewepe123',PASSWORD_DEFAULT);
// var_dump($pass);
// die;

include('admin/config_query.php');
$db = new database();

// Inisialisasi session
session_start();

//Cek session aktif
if(isset($_SESSION['username']) || isset($_SESSIION['id_users'])){
    header('Location: admin/index.php');
} else {

//Cek apakah form disubmit
if(isset($_POST['submit'])) {

    //Menghilangkan backshlases
    $username = stripcslashes($_POST['username']);
    $password = stripcslashes($_POST['password']);

//Cek nilai username password apakah kosong
if(!empty(trim($username)) && !empty(trim($password))) {
    //select data tb_users berdasarkan username

    $query = $db->get_data_users($username);

    if($query){
        $rows = mysqli_num_rows($query);
    } else {
        $rows = 0;
    }

    //Cek ketersediaan data username
    if($rows !=0){
        $getPassword = mysqli_fetch_assoc($query)['password'];

        // var_dump($getPassword);
        // die;
        if(password_verify($password,$getPassword)){
            $_SESSION['username']=$username;
            $_SESSION['id_users']=mysqli_fetch_assoc($query)['id_users'];

            header('location: admin/index.php');
        } else{
            header("location:login.php?pesan=gagal");
        }

    } else {
        header("location:login.php?pesan=notfound");
    }
} else {
    header("location:login.php?pesan=empty");
}
} else{
    header("location:login.php?pesan=empty");
}
}

