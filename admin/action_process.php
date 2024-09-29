<?php
include('config_query.php');
$db = new database();
session_start();
$id_users = $_SESSION['id_users'];
$action = $_GET['action'];

if ($action == "add") {
    if ($_FILES["sampul"]["name"] != '') {

        $tmp = explode('.', $_FILES["sampul"]["name"]); 
        $ext = end($tmp); 
        $filename = $tmp[0];  
        $allowed_ext = array("jpg", "png", "jpeg");

        if (in_array($ext, $allowed_ext)) {

            if ($_FILES["sampul"]["size"] <= 5120000) { 
                $name = $filename . '_' . rand() . '.' . $ext;
                $path = "../files/" . $name; 
                $uploaded = move_uploaded_file($_FILES["sampul"]["tmp_name"], $path); 

                if ($uploaded) {
                    $insertData = $db->add_data($name, $_POST["judul"], $_POST["isi"],
                     $_POST["status_artikel"], $_POST["kategori"], $id_users); 

                    if ($insertData) {
                        echo "<script>alert('Data Berhasil Ditambahkan');</script>";
                        header('Location: index.php');
                        exit();
                    } else {
                        echo "<script>alert('Data Gagal Ditambahkan');</script>";
                        header('Location: tambah_data.php');
                        exit();
                    }
                } else {
                    echo "<script>alert('Gagal Upload file');document.location.href = 'tambah_data.php';</script>";
                }
            } else {
                echo "<script>alert('Ukuran Gambar lebih dari 5mb');document.location.href = 'tambah_data.php';</script>";
            }
        } else {
            echo "<script>alert('File salah ekstensi');document.location.href = 'tambah_data.php';</script>";
        }
    } else {
        echo "<script>alert('Gambar tidak boleh kosong');document.location.href = 'tambah_data.php';</script>";
    }
} elseif ($action == "update") {
    
    $id_artikel = $_GET['id_artikel'];

    if (isset($id_artikel)) {
        $artikel = $db->get_artikel_by_id($id_artikel);

        if ($artikel) {

            if ($_FILES["sampul"]["name"] != '') {
                $tmp = explode('.', $_FILES["sampul"]["name"]);
                $ext = end($tmp);
                $filename = $tmp[0];
                $allowed_ext = array("jpg", "png", "jpeg");

                if (in_array($ext, $allowed_ext)) {
                    if ($_FILES["sampul"]["size"] <= 5120000) {
                        $name = $filename . '_' . rand() . '.' . $ext;
                        $path = "../files/" . $name;
                        $uploaded = move_uploaded_file($_FILES["sampul"]["tmp_name"], $path);

                        if ($uploaded) {
                            $updateData = $db->update_data($id_artikel, $name, $_POST["judul"], $_POST["isi"], $_POST["status_artikel"], $_POST["kategori"]);
                            if ($updateData) {
                                echo "<script>alert('Data Berhasil Diupdate');</script>";
                                header('Location: index.php');
                                exit();
                            } else {
                                echo "<script>alert('Data Gagal Diupdate');</script>";
                                header("Location: update_data.php?id_artikel=$id_artikel");
                                exit();
                            }
                        } else {
                            echo "<script>alert('Gagal Upload file');document.location.href = 'update_data.php?id_artikel=$id_artikel';</script>";
                        }
                    } else {
                        echo "<script>alert('Ukuran Gambar lebih dari 5mb');document.location.href = 'update_data.php?id_artikel=$id_artikel';</script>";
                    }
                } else {
                    echo "<script>alert('File salah ekstensi');document.location.href = 'update_data.php?id_artikel=$id_artikel';</script>";
                }
            } else {
                $updateData = $db->update_data($id_artikel, $artikel['sampul'], $_POST["judul"], $_POST["isi"], $_POST["status_artikel"], $_POST["kategori"]);

                if ($updateData) {
                    echo "<script>alert('Data Berhasil Diupdate');</script>";
                    header('Location: index.php');
                    exit();
                } else {
                    echo "<script>alert('Data Gagal Diupdate');</script>";
                    header("Location: update_data.php?id_artikel=$id_artikel");
                    exit();
                }
            }
        } else {
            echo "<script>alert('Artikel tidak ditemukan');document.location.href = 'index.php';</script>";
        }
    } else {
        echo "<script>alert('ID Artikel tidak ditemukan');document.location.href = 'index.php';</script>";
    }

    $id_artikel = $_GET['id_artikel'];

    if (isset($id_artikel)) {
        $artikel = $db->get_artikel_by_id($id_artikel);

        if ($artikel) { 
            if ($_FILES["sampul"]["name"] != '') {
                $tmp = explode('.', $_FILES["sampul"]["name"]);
                $ext = end($tmp);
                $filename = $tmp[0];
                $allowed_ext = array("jpg", "png", "jpeg");

                if (in_array($ext, $allowed_ext)) {
                    if ($_FILES["sampul"]["size"] <= 5120000) {
                        $name = $filename . '_' . rand() . '.' . $ext;
                        $path = "../files/" . $name;
                        $uploaded = move_uploaded_file($_FILES["sampul"]["tmp_name"], $path);

                        if ($uploaded) {
                            $updateData = $db->update_data($id_artikel, $name, $_POST["judul"], $_POST["isi"], $_POST["status_artikel"], $_POST["kategori"]);

                            if ($updateData) {
                                echo "<script>alert('Data Berhasil Diupdate');</script>";
                                header('Location: index.php');
                                exit();
                            } else {
                                echo "<script>alert('Data Gagal Diupdate');</script>";
                                header("Location: update_data.php?id_artikel=$id_artikel");
                                exit();
                            }
                        } else {
                            echo "<script>alert('Gagal Upload file');document.location.href = 'update_data.php?id_artikel=$id_artikel';</script>";
                        }
                    } else {
                        echo "<script>alert('Ukuran Gambar lebih dari 5mb');document.location.href = 'update_data.php?id_artikel=$id_artikel';</script>";
                    }
                } else {
                    echo "<script>alert('File salah ekstensi');document.location.href = 'update_data.php?id_artikel=$id_artikel';</script>";
                }
            } else {
                $updateData = $db->update_data($id_artikel, $artikel['sampul'], $_POST["judul"], $_POST["isi"], $_POST["status_artikel"], $_POST["kategori"]);

                if ($updateData) {
                    echo "<script>alert('Data Berhasil Diupdate');</script>";
                    header('Location: index.php');
                    exit();
                } else {
                    echo "<script>alert('Data Gagal Diupdate');</script>";
                    header("Location: update_data.php?id_artikel=$id_artikel");
                    exit();
                }
            }
        } else {
            echo "<script>alert('Artikel tidak ditemukan');document.location.href = 'index.php';</script>";
        }
    } else {
        echo "<script>alert('ID Artikel tidak ditemukan');document.location.href = 'index.php';</script>";
    }
} elseif ($action == "delete") {
    $id_artikel = $_POST['id_artikel'];

    if (isset($id_artikel)) {
        $deleteData = $db->delete_data($id_artikel);
        if ($deleteData) {
            echo "<script>alert('Data Berhasil Dihapus');</script>";
            header('Location: index.php');
            exit();
        } else {
            echo "<script>alert('Data Gagal Dihapus');</script>";
            header('Location: index.php');
            exit();
        }
    } else {
        echo "<script>alert('ID Artikel tidak ditemukan');document.location.href = 'index.php';</script>";
    }
} else {
    echo "<script>alert('No Access operations');document.location.href = 'index.php';</script>";
}
