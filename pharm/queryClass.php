<?php
namespace Database {

class Query {
    // Product Class
    public static function addProduct() {
        return "INSERT INTO products(name, description, category, quantity_in, quantity_out, quantity_damaged, \n
		quantity_remaining, cost_price, selling_price) \n
		VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
	}
	
    public static function deleteProduct () {
        return 'DELETE FROM products WHERE id = ?';
	}

	public static function removeExpired () {
		return 'DELETE FROM expiry_table WHERE id = ?';
	}

	public static function removeTotallyFromExpired () {
		return 'DELETE FROM expiry_table WHERE product_id = ?';
	}

	public static function subtractExpired () {
		return 'UPDATE products SET quantity_remaining = quantity_remaining - ?, quantity_in = quantity_in - ? WHERE id = ?';
	}

	public static function viewAllProducts () {
		return 'SELECT products.*, expiry_table.* FROM products RIGHT JOIN (SELECT *, id as exp_id, MIN(DATEDIFF(expiry_date, NOW())) as exp FROM expiry_table GROUP BY product_id) AS expiry_table ON products.id = expiry_table.product_id';
	}

	public static function updateProductDetails () {
		return "UPDATE products SET name = ?, description = ?, category = ?,  \n
		 cost_price=?, selling_price=? WHERE id = ?";
	}

	public static function setExpiry () {
		return "INSERT into products_expiry (name, quantity, expirydate) VALUES (?, ?, ?)";
	}

	
	public static function notify () {
		return "SELECT * FROM products_expiry WHERE DATEDIFF(expirydate, NOW()) < 60 AND DATEDIFF(expirydate, NOW()) >= 1";
	}
	
	public static function insertProductIntoExpiryTable () {
		return "INSERT INTO expiry_table (product_id, quantity, expiry_date) values (?, ?, 	?)";
	}
	
	public static function updateProductQuantity () {
		return "UPDATE products SET quantity_in = quantity_in + ?, quantity_remaining = quantity_remaining + ? WHERE id = ?";
	}

	public static function delete () {
		return "DELETE FROM products_expiry WHERE id = ?";
	}
	
	public static function expired () {
		return "SELECT * FROM products_expiry WHERE DATEDIFF(expirydate, NOW()) <= 0";
	}

	public static function deleteExpiredProduct () {
		return "DELETE FROM expiry_table WHERE id = ?";
	}

	public static function notifyAboutToExpire () {
		return "SELECT * FROM products_expory WHERE DATEDIFF(expiry_date, NOW()) < 60 AND DATEDIFF(expiry_date, NOW()) >= 1";
	}
	// Product Categories

	public static function viewProductsCategories () {
		return "SELECT id, category FROM categories";
	}

	public static function fetchCategory () {
		return "SELECT * FROM categories WHERE category = ?";
	}

	public static function addProductsCategory () {
		return 'INSERT INTO categories(category) VALUES (?)';
	}

	public static function renameProductsCategory () {
		return 'UPDATE categories SET category = ? WHERE id = ?';
	}

	public static function viewProductByCategory () {
		return 'SELECT * FROM products WHERE category = ?';
	}

	public static function viewProductsById () {
		return 'SELECT * FROM products WHERE id = ?';
	}

	public static function search () {
		return 'SELECT products.*, expiry_table.* FROM products RIGHT JOIN (SELECT *, id as exp_id, MIN(DATEDIFF(expiry_date, NOW())) as exp FROM expiry_table GROUP BY product_id) AS expiry_table ON products.id = expiry_table.product_id WHERE name LIKE ?';
	}

	public static function productSale () {
		return 'UPDATE products SET quantity_remaining = quantity_remaining - ? WHERE id = ?';
	}

	// Manager
	public static  function addManager () {
		return 'INSERT INTO manager(staff_id, phone, address, email, username, password) VALUES (?, ?, ?, ?, ?, ?)';
	}

	public static function checkManager () {
		return 'SELECT * FROM manager WHERE (username = ? AND password = ?)';
	}
	public function fetchManagers () {
		return 'SELECT * FROM manager';
	}

	public function deleteManager () {
		return 'DELETE FROM manager WHERE id = ?';
	}

	public static function updateManager () {
		return "UPDATE manager SET staff_id = ?, phone=?, address = ?, email = ?, username = ?, \n
		password = ? WHERE id = ?";
	}
	
	public static function fetchManagerIdByName () {
		return "SELECT id FROM manager WHERE username = ?";
	}

	//Customer Class
	public static function addCustomer () {
		return 'INSERT INTO customer(name, phone, location) VALUES(?, ?, ?)';
	}

	public static function removeCustomer () {
		return 'DELETE FROM customer WHERE id = ?';
	}

	public static function fetchCustomers () {
		return 'SELECT * FROM customer';
	}
	public static function fetchCustomerIdByName () {
		return 'SELECT id FROM customer WHERE name = ?';
	}

	public static function updateCustomer () {
		return "UPDATE customer SET name = ?, phone = ?, location = ? \n
		WHERE id = ?";
	}
	// Invoice Class
	public static function createInvoice() {
		return 'INSERT INTO invoice(customer_id, served_by_id, product_id, quantity) VALUES (?,?,?,?)';
	}

	public static function fetchAllInvoice () {
		return "SELECT invoice.id, products.name, products.description, products.category, invoice.quantity, \n
		products.selling_price, manager.username, customer.name AS customer_name, \n
		CONCAT(DAYNAME(invoice.date), ', ', DATE_FORMAT(invoice.date, \"%M %d %Y\")) as date FROM invoice \n
		LEFT JOIN products ON products.id = invoice.product_id \n
		LEFT JOIN customer ON customer.id = invoice.customer_id \n
		LEFT JOIN manager ON manager.id = invoice.served_by_id";
	}

	public static function fetchAllInvoiceWithDates () {
		return " WHERE (invoice.date BETWEEN ? AND ?)";
	}

	public static function fetchByCustomerName () {
		return " AND customer.name = ?";
	}

	public static function fetchRealByCustomerName () {
		return " WHERE customer.name = ?";
	}

	/**
	 * Class constructor
	 */
	public function __construct ()
	{
		$connect = new Connection();
		$this->conn = $connect->connect();
	}
	
	
	/**
	 * Run any query
	 *
	 * @param String $query
	 * @param String $string
	 * @param Array $params
	 * @return Mixed
	 */
	public function run (
		String $query, 
		String $string=NULL,
		Array $params=NULL
	) 
	{
		/**
		 * count the number of strings available,
		 * check if it matches the number of parameters provided.
		 */
		$pQuery = $this->conn->prepare($query);
		
		if ($string!=null) {
			if (strlen($string) != sizeof($params)) {
				return 'Number of variables doesn\'t match number of parameters';
			}
			call_user_func_array(
				array($pQuery, "bind_param"), 
				array_merge(array($string), $params)
			);
		}
		$pQuery->execute();
		return $pQuery;
	}
	
	public function close ()
	{
		$this->conn->close();
	}
}
}