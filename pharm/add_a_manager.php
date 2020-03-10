<?php
session_start();
include 'ManagerClass.php';
include 'messageClass.php';

use Pharm\Manager;


$manager = new Manager;


if (!isset($_SESSION['username'])) {
    if (isset($_REQUEST['user'])) {
        extract($_REQUEST, EXTR_PREFIX_ALL, 'r');
        if (
            isset($r_user) && !empty($r_user)
            && isset($r_pass) && !empty($r_pass)
            && isset($r_phone) && !empty($r_phone)
            && isset($r_email) && !empty($r_textarea)
        ) {

            $staff_id = 'pharm/' . $r_user;
            if (
                array_key_exists(
                    'error',
                    $manager->add(
                        $staff_id,
                        $r_phone,
                        $r_textarea,
                        $r_email,
                        $r_user,
                        $r_pass
                    )
                )
            ) {
                header('location: manager_login.php?message=Could not add Manager last time out! Try a different username&error=true');
            } else {
                echo 'Manager successfully added last time out.';
            }
        }
    }
}

$man = $manager->fetch();

extract($_REQUEST);

if (isset($message)) {
    $type = (!isset($error)) ? 0 : 1;
    $msg = new \UserInterface\message;
    $msg->show($message, $type);
}
?>