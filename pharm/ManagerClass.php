<?php
namespace Pharm {
    
    require_once 'connection.php';
    require_once 'queryClass.php';
    require_once 'ProductClass.php';

    class Manager {
        public function __construct() {
            $this->query = new \Database\Query;
        }

        public function add ($staff_id, $phone, $location, $email, $username, $password) {
            try {
                $params = array(
                    &$staff_id,
                    &$phone,
                    &$location,
                    &$email,
                    &$username,
                    &$password
                );
                $run = $this->query->run(
                    \Database\Query::addManager(),
                    'ssssss',
                    $params
                );
                if (!$run) {
                    throw new errorException();
                } else {
                    return array(
                        'message' => 'It is done!'
                    );
                }
            } catch (errorException $th) {
                return array(
                    'message'=> 'Could not add manager, database error!',
                    'error' => 'true'
                );
            }
        }
        
        public function fetchId ($name) {
            try {
                $params = array(&$name);
                if($run = $this->query->run(
                    \Database\Query::fetchManagerIdByName(),
                    's',
                    $params
                    )
                ) {
                    $run = $run->get_result();
                    $return = $run->fetch_assoc()['id'];
                    return $return;
                }
            } catch (errorException $th) {
                return 'Could not fetch managers. Please Try again!';
            }
        }

        public function check ($name, $pass) {
            try {
                $params = array(
                    &$name,
                    &$pass
                );
                $run = $this->query->run(
                    \Database\Query::checkManager(),
                    'ss',
                    $params
                );
                if (!$run) {
                    throw new errorException();
                } else {
                    
                    if(is_array($run->get_result()->fetch_assoc())) {return true;} else {return false;}
                }
            } catch (errorException $th) {
                return false;
            }
        }
        public function fetch () {
            try {
                if($run = $this->query->run(\Database\Query::fetchManagers())) {
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
        public function delete ($id) {
            try {
                $params = array(&$id);
                $run = $this->query->run(\Database\Query::deleteManager(), 's', $params);
                if(!$run) {
                    throw new errorException();
                }
            }catch(errorException $th) {
                return 'Could not fetch managers. Please Try again!';
            }
        }
        public function update ($staff_id, $phone, $address, $email, $username, $password, $id) {
            try {
                //code
                $params  = array(
                    &$staff_id, 
                    &$phone, 
                    &$address, 
                    &$email, 
                    &$username,
                    &$password, 
                    &$id
                );
                if ($this->query->run(
                    \Database\Query::updateManager(),
                    'sssssss',
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
?>