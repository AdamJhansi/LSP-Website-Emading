<?php
class database
{
    var $host = "127.0.0.1:3306";
    var $username = "root";
    var $password = "";
    var $database = "db_mading";
    var $koneksi;

    function __construct()
    {
        $this->koneksi = mysqli_connect($this->host, $this->username, $this->password, $this->database);
        if (mysqli_connect_errno()) {
            echo "Error Database Connection : " . mysqli_connect_error();
        }
    }

    public function get_data_users($username)
    {
        $data = mysqli_query(mysql: $this->koneksi, query: "SELECT * FROM tb_users WHERE username = '$username'");
        return $data;
    }

    public function show_data()
    {
        $hasil = array();
        $data = mysqli_query(
            $this->koneksi,
            "SELECT id_artikel, sampul, judul, isi, status_artikel, kategori, tba.id_users FROM tb_artikel tba JOIN tb_users tbu ON tba.id_users = tbu.id_users"
        );
        if ($data) {
            if (mysqli_num_rows($data) > 0) {
                while ($row = mysqli_fetch_array($data)) {
                    $hasil[] = $row;
                }
            } else {
                $hasil = "0";
            }
        }
        return $hasil;
    }

    public function add_data($sampul, $judul, $isi, $status_artikel, $kategori, $id_users)
    {
        $datetime = date("Y-m-d H:i:s");
        $insert = mysqli_query($this->koneksi, "INSERT into tb_artikel (sampul, judul, isi,
         status_artikel, id_users, created_at, kategori) values ('$sampul', '$judul', '$isi', '$status_artikel', '$id_users', '$datetime', '$kategori')");

        return $insert;
    }

    public function get_artikel_by_id($id_artikel)
    {
        $data = mysqli_query($this->koneksi, "SELECT tba.*, tbu.* FROM tb_artikel tba JOIN tb_users tbu ON tba.id_users = tbu.id_users WHERE tba.id_artikel = $id_artikel");
        return $data ? mysqli_fetch_assoc($data) : null;
    }

    public function update_data($id_artikel, $sampul, $judul, $isi, $status_artikel, $kategori)
    {
        $datetime = date("Y-m-d H:i:s");
        $update = mysqli_query($this->koneksi, "UPDATE tb_artikel SET 
            sampul = '$sampul',
            judul = '$judul',
            isi = '$isi',
            status_artikel = '$status_artikel',
            kategori = '$kategori',
            updated_at = '$datetime'
            WHERE id_artikel = $id_artikel");
        return $update;
    }

    public function delete_data($id_artikel)
    {
        $delete = mysqli_query($this->koneksi, "DELETE FROM tb_artikel WHERE id_artikel = $id_artikel");
        return $delete;
    }

    // Get data table artikel status publish
    public function show_publish_data()
    {
        $artikel = array();
        $data = mysqli_query($this->koneksi, "SELECT tba.id_artikel, tba.sampul, tba.judul, tba.isi, tba.status_artikel, tba.kategori, tba.created_at, tba.id_users, tbu.name FROM tb_artikel tba JOIN tb_users tbu ON tba.id_users = tbu.id_users WHERE tba.status_artikel = 'publish'");
        if ($data) {
            if (mysqli_num_rows($data) > 0) {
                while ($row = mysqli_fetch_array($data)) {
                    $artikel[] = $row;
                }
            } else {
                $artikel = "0";
            }
        }
        return $artikel;
    }
}
