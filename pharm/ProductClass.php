<?php

namespace Pharm {
    require_once 'connection.php';
    require_once 'queryClass.php';

    use \Database\Connection as Connection;
    use Exception;

    class errorException extends \Exception{};
    class wrongInput extends \Exception{};

    class Product
    {
        private $name = '';
        private $description;
        private $quantity_in;
        private $quantity_out;
        private $quantity_remaining;
        private $cost_price;
        private $damaged;
        private $selling_price;
        private $NAFDAC;
        public function __construct(
            $name = '',
            $description = '',
            $category = '',
            $quantity_in = 0,
            $quantity_out = 0,
            $quantity_damaged = 0,
            $cost_price = 0,
            $selling_price = 0,
            $damaged = 0,
            $NAFDAC = ''
        ) {
            $this->query = new \Database\Query;
            $this->name = $name;
            $this->description = $description;
            $this->category = $category;
            $this->quantity_in = $quantity_in;
            $this->quantity_out = $quantity_out;
            $this->quantity_remaining = $this->quantity_in - $this->quantity_out - $this->damaged;
            $this->cost_price = $cost_price;
            $this->selling_price = $selling_price;
            $this->NAFDAC = $NAFDAC;
            $this->damaged = $damaged;
            $this->profit = $this->quantity_in - $this->quantity_out;
            $this->expenses = $this->quantity_in * $this->cost_price;
            $this->balance = $this->expenses;
        }

        public function addProduct()
        {
            try {
                //code...
                $params = array(
                    &$this->name,
                    &$this->description,
                    &$this->category,
                    &$this->quantity_in,
                    &$this->quantity_out,
                    &$this->damaged,
                    &$this->quantity_remaining,
                    &$this->cost_price,
                    &$this->selling_price,
                    &$this->NAFDAC
                );
                if (!$this->query->run(
                    \Database\Query::addProduct(),
                    'ssssssssss',
                    $params
                )) {
                    throw new \Exception();
                } else {
                    return array('message' => 'Product was added successfuly Last time out.');
                }
            } catch (\Exception $th) {
                return array('message' => 'An error has occured!', 'error' => 1);
            }
        }

        public function removeProduct($product_id = '')
        {   
            try {
                $params = array(
                    &$product_id
                );
                switch ($product_id) {
                    case '':
                        throw new wrongInput();
                        break;
                    default:
                        $run = $this->query->run(
                            \Database\Query::deleteProduct(),
                            's',
                            $params
                        );
                        if (!$run) {
                            throw new errorException();
                        } else {
                            return "Your last delete was successful!";
                        }
                }
            } catch (wrongInput $ex) {
                return 'Your last delete was not successful! You\'d have to try that again';
            } catch (errorException $th) {
                echo 'Your last delete was not successful! Try again.';
            }
        }

        public function viewProductsByCategories($category)
        {
            try {
                //code
                $params = array(
                    &$category
                );
                if ($run = $this->query->run(
                    \Database\Query::viewProductByCategory(),
                    's',
                    $params
                )) {
                    $run = $run->get_result();
                    $return = [];
                    $counter = 0;
                    while ($fetch = $run->fetch_assoc()) {
                        $return[$counter] = $fetch;
                        $counter++;
                    }
                    return $return;
                } else {
                    throw new errorException();
                }
            } catch (errorException $ex) {
                return 'All Products are currently unavailable.';
            }
        }
        public function search($key) {
             //code
             try {
                $key = "%".$key."%";
                $params = array(
                    &$key
                );
                if ($run = $this->query->run(
                    \Database\Query::search(),
                    's',
                    $params
                )) {
                    $run = $run->get_result();
                    $return = [];
                    $counter = 0;
                    while ($fetch = $run->fetch_assoc()) {
                        $return[$counter] = $fetch;
                        $counter++;
                    }
                    return $return;
                } else {
                    throw new errorException();
                }

            } catch (errorException $ex) {
                return 'All Products are currently unavailable.';
            }
        }
        public function viewProductsCategories()
        {
            try {
                //code
                if ($run = $this->query->run(
                    \Database\Query::viewProductsCategories()
                )) {
                    $run = $run->get_result();
                    $return = [];
                    while ($fetch = $run->fetch_assoc()) {
                        $return[] = $fetch;
                    }
                    return $return;
                } else {
                    throw new errorException();
                }
            } catch (errorException $ex) {
                return 'There are currently no categories.';
            }
        }

        public function viewProductsById($id)
        {
            try {
                //code
                $params = array(
                    &$id
                );
                if ($run = $this->query->run(
                    \Database\Query::viewProductsById(),
                    's',
                    $params
                )) {
                    $run = $run->get_result();
                    while ($fetch = $run->fetch_assoc()) {
                        $return= $fetch;
                    }
                    return $return;
                } else {
                    throw new errorException();
                }
            } catch (errorException $ex) {
                return 'There are currently no categories.';
            }
        }

        public function addProductsCategory($id)
        {
            try {
                //code
                $params = array(
                    &$id
                );
                if ($this->query->run(
                    \Database\Query::addProductsCategory(),
                    's',
                    $params
                )) {
                    return array(
                        'message' => 'Category added successfully last time out!'
                    );
                } else {
                    throw new errorException();
                }
            } catch (errorException $ex) {
                return 'Category was not added last time out.';
            }
        }

        public function renameProductsCategory($newName, $id)
        {
            try {
                //code
                $params = array(
                    &$newName,
                    &$id
                );
                if ($this->query->run(
                    \Database\Query::renameProductsCategory(),
                    'ss',
                    $params
                )) {
                    return array(
                        'message' => 'Product renamed Successfully!'
                    );
                } else {
                    throw new errorException();
                }
            } catch (errorException $ex) {
                return 'Category was not renamed last time out.';
            }
        }

        public function viewAllProducts()
        {
            try {
                //code
                if ($run = $this->query->run(
                    \Database\Query::viewAllProducts()
                )) {
                    $run = $run->get_result();
                    $return = [];
                    $counter = 0;
                    while ($fetch = $run->fetch_assoc()) {
                        $return[$counter] = $fetch;
                        $counter++;
                    }
                    return $return;
                } else {
                    throw new errorException();
                }
            } catch (errorException $ex) {
                return 'All Products are currently unavailable.';
            }
        }

        public function removeAccordingly ($id, $number) {
            try {
                //code...
                $params = array(
                    &$number,
                    &$id
                );
                if (!$this->query->run(
                    \Database\Query::productSale(),
                    'ss',
                    $params
                )) {
                    throw new \Exception();
                } else {
                    return array('message' => 'Successful!');
                }
            } catch (\Exception $th) {
                return array('message' => 'An error has occured!', 'error' => 1);
            }
        }

        public function updateProducts(
            $name,
            $description,
            $category,
            $quantity_in,
            $quantity_out,
            $quantity_damaged,
            $quantity_remaining,
            $cost_price,
            $selling_price,
            $nafdac,
            $id
        ) {
            try {
                //code...
                try {
                    //code
                    $params  = array(
                        &$name, &$description, &$category, &$quantity_in,
                        &$quantity_out, &$quantity_damaged,
                        &$quantity_remaining, &$cost_price, &$selling_price, &$nafdac, &$id
                    );
                    if ($this->query->run(
                        \Database\Query::updateProductDetails(),
                        'sssssssssss',
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
            } catch (errorException $th) {
                return array(
                    'error' => array('message' => 'Products details did not update. Try again.')
                );
            }
        }

        public function setExpiry($name, $quantity, $date)
        {
            try {
                //code...
                $params = array(
                    &$name,
                    &$quantity,
                    &$date,
                );
                if (!$this->query->run(
                    \Database\Query::setExpiry(),
                    'sss',
                    $params
                )) {
                    throw new \Exception();
                } else {
                    return array('message' => 'Product was added successfuly Last time out.');
                }
            } catch (\Exception $th) {
                return array('message' => 'An error has occured!', 'error' => 1);
            }
        }

        public function notify() {
            try {
                //code...
                if (!$run = $this->query->run(
                    \Database\Query::notify()
                )) {
                    throw new \Exception();
                } else {
                    $run = $run->get_result();
                    $return = [];
                    while ($fetch = $run->fetch_assoc()) {
                        $return[] = $fetch;
                    }
                    return $return;
                }
            } catch (\Exception $th) {
                return 'An error has occured!';
            }            
            
        }

        public function expired() {
            try {
                //code...
                if (!$run = $this->query->run(
                    \Database\Query::expired()
                )) {
                    throw new \Exception();
                } else {
                    $run = $run->get_result();
                    $return = [];
                    while ($fetch = $run->fetch_assoc()) {
                        $return[] = $fetch;
                    }
                    return $return;
                }
            } catch (\Exception $th) {
                return 'An error has occured!';
            }            
        }

        public function delete($id) {
            try {
                $params = array(&$id);
                if (!$run = $this->query->run(
                    \Database\Query::delete(),
                    's',
                    $params
                )) {
                    throw new \Exception();
                } else {
                    return true;
                }
            } catch (\Exception $th) {
                return false;
            }    
        }
    }
}
