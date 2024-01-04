<?php
// membuat class dengan nama database

class database
{
    var $host = 'localhost';
    var $username = "root";
    var $password = "";
    var $database = "db_emading";
    var $koneksi = "";

    function __construct()
    {
        $this->koneksi = mysqli_connect($this->host,$this->username,$this->password,$this->database);
        if(mysqli_connect_error()){
            echo "Koneksi database gagal : ". mysqli_connect_error();
        }
    }

    // Get data tb_users
    public function get_data_users($username)
    {
        $data = mysqli_query($this->koneksi, "SELECT * FROM tb_users WHERE username = '$username'");

        return $data;
    }

    //Get data tb_artikel
    public function tampil_data()
    {
        $hasil = null; //dari ai
    
        $data = mysqli_query($this->koneksi, "SELECT id_artikel, header, judul_artikel, isi_artikel, status_publish, tba.created_at, tba.updated_at, name, tba.id_users FROM tb_artikel tba join tb_users tbu on tba.id_users = tbu.id_users");
    
        if ($data) {
            if (mysqli_num_rows($data) > 0) {
                while ($row = mysqli_fetch_array($data)) {
                    $hasil[] = $row;
                }
            } else {
                $hasil = '0';
            }
        }
    
        return $hasil;
    }
}    
