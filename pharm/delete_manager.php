<?php
include 'ManagerClass.php';
use Pharm\Manager;
extract($_REQUEST);
$manager = new Manager;
if(!empty($password)) {
    if(array_key_exists('error', $manager->update($staff_id, $phone, $address, $email, $username, $password, $id))) {
        echo 'Could not edit manager details last time out!';
    }
}
?>