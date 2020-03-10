<?php

namespace Pharm {

    require_once 'connection.php';
    require_once 'queryClass.php';
    require_once 'ProductClass.php';

    class Customer
    {
        private $name;
        private $phone;
        private $location;
        public function __construct($name = '', $phone = '', $location = '')
        {
            $this->query = new \Database\Query;
            $this->name = $name;
            $this->phone = $phone;
            $this->location = $location;
        }
        public function add()
        {
            try {
                $params = array(
                    &$this->name,
                    &$this->phone,
                    &$this->location
                );
                $run = $this->query->run(
                    \Database\Query::addCustomer(),
                    'sss',
                    $params
                );
                if (!$run) {
                    throw new errorException();
                }
            } catch (errorException $th) {
                echo 'Could not add customer, database error!';
            }
        }
        public function remove($customer_id)
        {
            try {
                $params = array(
                    &$customer_id
                );
                if (!$this->query->run(
                    \Database\Query::removeCustomer(),
                    's',
                    $params
                )) {
                    throw new errorException();
                }
            } catch (errorException $ex) {
                echo 'Could not remove customer! try again';
            }
        }

        public function fetch () {
            try {
                if($run = $this->query->run(\Database\Query::fetchCustomers())) {
                    $run = $run->get_result();
                    $return = [];
                    $counter = 0;
                    while ($fetch = $run->fetch_assoc()) {
                        $return[$counter] = $fetch;
                        $counter++;
                    }
                    return $return;
                }
            }catch(errorException $th) {
                return 'Could not fetch managers. Please Try again!';
            }
        }

        public function fetchId ($name) {
            try {
                $params = array(&$name);
                if($run = $this->query->run(
                    \Database\Query::fetchCustomerIdByName(),
                    's',
                    $params
                    )
                ) {
                    $run = $run->get_result();
                    $return = $run->fetch_assoc()['id'];
                    return $return;
                }
            }catch(errorException $th) {
                return 'Could not fetch managers. Please Try again!';
            }
        }
        public function update($name, $phone, $location, $id) {
            try {
                //code
                $params  = array(
                    &$name, 
                    &$phone,
                    &$location, 
                    &$id
                );
                if ($this->query->run(
                    \Database\Query::updateCustomer(),
                    'ssss',
                    $params
                )) {
                    return array('message' => 'done');
                } else {
                    throw new errorException();
                }
            } catch (errorException $ex) {
                return array(
                    'error' => array('message' => 'All Products are currently unavailable')
                );
            }
        }
    }
}
