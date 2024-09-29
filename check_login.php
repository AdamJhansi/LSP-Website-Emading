<?php
include('admin/config_query.php');
$db = new database();

session_start();
if (isset($_SESSION['username']) || isset($_SESSION['id_users'])) {
    header('location: admin/index.php');
} else {
    if (isset($_POST['submit'])) {
        $username = stripslashes($_POST['username']);
        $password = stripslashes($_POST['password']);

        if (!empty(trim($username)) && !empty(trim($password))) {
            $query = $db->get_data_users($username);
            if ($query) {
                $rows = mysqli_num_rows($query);
            } else {
                $rows = 0;
            }
            if ($rows != 0) {
                $getData = $query->fetch_assoc();
                if (password_verify($password, $getData['password'])) {
                    $_SESSION['username'] = $username;
                    $_SESSION['id_users'] = $getData['id_users'];

                    header('location: admin/index.php');
                } else {
                    header("location: login.php?pesan=gagal");
                }
            } else {
                header("location: login.php?pesan=notfound");
            }
        } else {
            header("location:login.php?pesan=empty");
        }
    } else {
        header("location: login.php?pesan=empty");
    }
}
