<?php
session_start();
include 'ManagerClass.php';
include 'messageClass.php';
include 'customerClass.php';

use Pharm\Customer;

if (isset($_REQUEST['user'])) {
    extract($_REQUEST, EXTR_PREFIX_ALL, 'r');
    if (
        isset($r_user) && !empty($r_user)
        && isset($r_phone) && !empty($r_phone)
        && isset($r_location) && !empty($r_location)
    ) {
        $manager = new Customer($r_user, $r_phone, $r_location);
        if ($manager->add())
        {
            echo 'done';
        } else {
            echo 'successful!';
        }
    }
}
?>