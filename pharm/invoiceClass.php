<?php

namespace Pharm {
    require_once 'connection.php';
    require_once 'queryClass.php';
    require_once 'ProductClass.php';
    class Invoice
    {

        public function __construct()
        {
            $this->query = new \Database\Query;
        }

        public function create($customer_id, $served_by_id, $product_id, $quantity)
        {
            try {
                $params = array(
                    &$customer_id,
                    &$served_by_id,
                    &$product_id,
                    &$quantity
                );
                if (!$this->query->run(
                    \Database\Query::createInvoice(),
                    'ssss',
                    $params
                )) {
                    throw new errorException();
                }
            } catch (errorException $ex) {
                echo 'could not create invoice.';
            }
        }
        public function viewAll()
        {
            try {
                if ($run = $this->query->run(\Database\Query::fetchAllInvoice())) {
                    $run = $run->get_result();
                    $return = [];
                    $counter = 0;
                    while ($fetch = $run->fetch_assoc()) {
                        $return[$counter] = $fetch;
                        $counter++;
                    }
                    return $return;
                }
            } catch (errorException $th) {
                return 'Could not fetch managers. Please Try again!';
            }
        }
        public function viewByCustomer($customer) {
            try {
                $params = array(&$customer_name);

                $query = \Database\Query::fetchAllInvoice() 
                    . \Database\Query::fetchRealByCustomerName();

                $param_length = 's';

                if ($run = $this->query->run($query, $param_length, $params)) {
                    $run = $run->get_result();
                    $return = [];
                    $counter = 0;
                    while ($fetch = $run->fetch_assoc()) {
                        $return[$counter] = $fetch;
                        $counter++;
                    }
                    return $return;
                }
            } catch (errorException $th) {
                return 'Could not fetch invoice. Please Try again!';
            }
        }
        public function viewByParts($from, $to, $customer_name = 'All')
        {
            try {
                $params = ($customer_name == 'All') ? 
                    array( &$from, &$to) : 
                    array(&$from, &$to, &$customer_name);

                $query = ($customer_name == 'All') ? \Database\Query::fetchAllInvoice() .
                    \Database\Query::fetchAllInvoiceWithDates() :
                    \Database\Query::fetchAllInvoice() .
                    \Database\Query::fetchAllInvoiceWithDates() .
                    \Database\Query::fetchByCustomerName();

                $param_length = ($customer_name == 'All') ? 'ss': 'sss';

                if ($run = $this->query->run($query, $param_length, $params)) {
                    $run = $run->get_result();
                    $return = [];
                    $counter = 0;
                    while ($fetch = $run->fetch_assoc()) {
                        $return[$counter] = $fetch;
                        $counter++;
                    }
                    return $return;
                }
            } catch (errorException $th) {
                return 'Could not fetch managers. Please Try again!';
            }
        }
    }
}
