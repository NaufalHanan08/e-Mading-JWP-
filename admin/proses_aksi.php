<?php
include('config_query.php');
$db = new database();
session_start();
$id_users = $_SESSION['id_users'];
$aksi = $_GET['aksi'];

if ($aksi == "add"){
    // Cek file sudah dipilih atau belum

    // echo "<pre>";
    // print_r($_FILES);
    // echo "</PRE>";
    // die;

    if ($_FILES["header"]["name"]!=''){

        $tmp = explode('.',$_FILES["header"]["name"]); //memecah nama file dan extension
        $ext = end($tmp); //menganmbil extension
        $filename = $tmp[0]; //mengambil nilai nama file tanpa extension
        $allow_extension = array("jpg","png","jpeg"); //extension file yang diizinkan

        if(in_array($ext,$allow_extension)){ //cek validasi extension

            if($_FILES["header"]["size"] <= 5120000){ //cek ukuran gambar, maks 5mb
                $name = $filename.'_'.rand().'.'.$ext; //rename nama file gambar
                $path = "../files/".$name; //lokasi upload file
                $uploaded = move_uploaded_file($_FILES["header"]["tmp_name"],$path); //memindahkan file

                if($uploaded){
                    $insertData = $db->tambah_data($name, $_POST["judul_artikel"], $_POST["isi_artikel"], $_POST["status_publish"], $id_users); //query insert data

                    if($insertData){
                        echo "<script>alert('Data berhasil ditambahkan!');document.location.href = 'index.php';</script>";
                    }else{
                        echo "<script>alert('Upss!! Data gagal ditambahkan!');document.location.href = 'index.php';</script>";
                    }  
                }else{
                    echo "<script>alert('Upss!! Upload file gagal!');document.location.href = 'tambah_data.php';</script>";
                }
            } else {
                echo "<script>alert('Ukuran gambar lebih dari 5Mb!');document.location.href = 'tambah_data.php';</script>";
            }
        }else {
            echo "<script>alert('File yang diupload bukan extension yang diizinkan!');document.location.href = 'tambah_data.php';</script>";
        }
    }else {
        echo "<script>alert('Silahkan pilih file gambar');document.location.href = 'tambah_data.php';</script>";
    }


} elseif ($aksi == "edit"){
    // Operasi edit data
} elseif ($aksi == "delete"){
    // Operasi delete data
} else {
    echo "<script>alert('Anda tidak mendapatkan akses untuk operasi ini!');document.location.href = 'index.php';</script>";
}
