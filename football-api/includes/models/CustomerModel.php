<?php

class CustomerModel extends BaseModel {

    private $table_name = "customer";

    /**
     * A model class for the `customer` database table.
     * It exposes operations that can be performed on customer records.
     */
    function __construct() {
        // Call the parent class and initialize the database connection settings.
        parent::__construct();
    }
    
    /**
     * Gets all the customers
     * @return array $data with all the customers 
     */
    public function getAllCustomers() {
        $sql = "SELECT * FROM customer";
        $data = $this->rows($sql);
        return $data;
    }
    
    /**
     * Get the list of all tracks purchased by a given customer
     * @return array $data list of all tracks 
     */
    public function getTracksPurchased($customer_id) {
        $sql = "SELECT invoice.InvoiceId, invoice.CustomerId, invoiceline.TrackId, track.AlbumId, track.name
         FROM invoice INNER JOIN invoiceline ON invoice.InvoiceId = invoiceline.InvoiceId 
         INNER JOIN track ON invoiceline.TrackId = track.TrackId WHERE CustomerId = ?";
        $data = $this->run($sql, [$customer_id])->fetchall();
        return $data;
    }
    
    /**
     * Delets a specific customer
     * @return array $data the results of the sql statement
     */
    public function deleteCustomer($customer_id) {
        $sql = "DELETE FROM customer WHERE CustomerId = :CustomerId";
        $data = $this->run($sql, [":CustomerId" => $customer_id . "%"])->execute();
        return $data;
    }
    
    /**
     * Filter method to get a the customers by country
     * @param string $Country the country name
     * @return array $data list of all customers with the given country 
     */
    public function getByCountry($Country) {
        $sql = "SELECT * FROM customer WHERE Country LIKE :Country";
        $data = $this->run($sql, [":Country" => $Country . "%"])->fetchAll();
        return $data;
    }

    /**
     * Get a specific customer
     * @param int $customer_id the specific customer id 
     * @return array $data the info for the specific customer 
     */
    public function getCustomerId($customer_id) {
        $sql = "SELECT * FROM customer WHERE CustomerId = ?";
        $data = $this->run($sql, [$customer_id])->fetch();
        return $data;
    }
}