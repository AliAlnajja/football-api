<?php

/**
 * A wrapper class for the PDO MySQL API.
 * This class can be extended for further customization.
 */
class BaseModel {

    /**
     * holds a database connection.
     */
    protected $db;

    /**
     * The index of the current page.
     * @var int
     */
    private $current_page = 1;

    /**
     * Holds the number of records per page.
     * @var int
     */
    private $records_per_page = 10;
    
    /**
     * Instantiates the BaseModel.
     * @global array $db_options    database connection options.
     * @param array $options        Optional array of PDO options
     * @throws Exception 
     */
    public function __construct($options=[]) {
        // Global array defined in includes/app_constants.php
        global $db_options;
        if (!isset($db_options['database'])) {
            throw new Exception('&args[\'database\'] is required');
        }

        if (!isset($db_options['username'])) {
            throw new Exception('&args[\'username\']  is required');
        }
        $default_options = [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ];
        $options = array_replace($default_options, $options);
        //var_dump($args);exit;
        $type = isset($db_options['type']) ? $db_options['type'] : 'mysql';
        $host = isset($db_options['host']) ? $db_options['host'] : 'localhost';
        $charset = isset($db_options['charset']) ? $db_options['charset'] : 'utf8';
        $port = isset($args['port']) ? 'port=' . $args['port'] . ';' : '';
        $password = isset($db_options['password']) ? $db_options['password'] : '';
        $database = $db_options['database'];
        $username = $db_options['username'];

        $dsn = "mysql:host=$host;dbname=$database;port=$port;charset=utf8mb4";
        $this->db = new PDO($dsn, $username, $password, $options);
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->db->query("SET NAMES utf8mb4");
    }
    
    /**
     * Paginates a result set given a page number and number of records per page.
     * 
     * @param string $sql the SQL query to be executed.
     * @param array $args fields filtering options.
     * @param int $fetchMode 
     * @return array An array containing the fetched set of records.
     */
    protected function paginate($sql, $args = [], $fetchMode = PDO::FETCH_ASSOC) {
        // 1) Get the number of records that might be returned by the provided query.
        $total_no_of_records = $this->count($sql, $args);
        
        // 2) Configure the paginator.
        $paginator = new Paginator($this->current_page, $this->records_per_page, $total_no_of_records);
        $offset = $paginator->getOffset();
        
        // 3) Add the LIMIT clause to the query.
        $sql .= " LIMIT ${offset}, $this->records_per_page";
        // 4) Get the pagination information.
        $data = $paginator->getPaginationInfo();
        // 5) Add the fetched data from the query with the pagination settings. 
        // The result records are available via the data key in the JSON array. 
        $data["data"] = $this->run($sql, $args)->fetchAll($fetchMode);
        return $data;
    }

    /**
     * get PDO instance
     * 
     * @return $db PDO instance
     */
    protected function getPdo() {
        return $this->db;
    }

    /**
     * Run raw sql query 
     * 
     * @param  string $sql       sql query
     * @return void
     */
    protected function raw($sql) {
        $this->db->query($sql);
    }

    /**
     * Run sql query
     * 
     * @param  string $sql       sql query
     * @param  array  $args      params
     * @return object            returns a PDO object
     */
    protected function run($sql, $args = []) {
        if (empty($args)) {
            return $this->db->query($sql);
        }

        $stmt = $this->db->prepare($sql);
        $stmt->execute($args);

        return $stmt;
    }

    /**
     * Get arrrays of records
     * 
     * @param  string $sql       sql query
     * @param  array  $args      params
     * @param  object $fetchMode set return mode ie object or array
     * @return object            returns multiple records
     */
    protected function rows($sql, $args = [], $fetchMode = PDO::FETCH_ASSOC) {
        return $this->run($sql, $args)->fetchAll($fetchMode);
    }

    /**
     * Get arrray of records
     * 
     * @param  string $sql       sql query
     * @param  array  $args      params
     * @param  object $fetchMode set return mode ie object or array
     * @return object            returns single record
     */
    protected function row($sql, $args = [], $fetchMode = PDO::FETCH_ASSOC) {
        return $this->run($sql, $args)->fetch($fetchMode);
    }

    /**
     * Get record by id
     * 
     * @param  string $table     name of table
     * @param  integer $id       id of record
     * @param  object $fetchMode set return mode ie object or array
     * @return object            returns single record
     */
    protected function getById($table, $id, $fetchMode = PDO::FETCH_ASSOC) {
        return $this->run("SELECT * FROM $table WHERE id = ?", [$id])->fetch($fetchMode);
    }

    /**
     * Get number of records
     * 
     * @param  string $sql       sql query
     * @param  array  $args      params
     * @param  object $fetchMode set return mode ie object or array
     * @return integer           returns number of records
     */
    protected function count($sql, $args = []) {
        return $this->run($sql, $args)->rowCount();
    }

    /**
     * Get primary key of last inserted record
     */
    protected function lastInsertId() {
        return $this->db->lastInsertId();
    }

    /**
     * insert record
     * 
     * @param  string $table table name
     * @param  array $data  array of columns and values
     */
    protected function insert($table, $data) {
        //add columns into comma seperated string
        $columns = implode(',', array_keys($data));

        //get values
        $values = array_values($data);

        $placeholders = array_map(function ($val) {
            return '?';
        }, array_keys($data));

        //convert array into comma seperated string
        $placeholders = implode(',', array_values($placeholders));

        $this->run("INSERT INTO $table ($columns) VALUES ($placeholders)", $values);

        return $this->lastInsertId();
    }

    /**
     * update record
     * 
     * @param  string $table table name
     * @param  array $data  array of columns and values
     * @param  array $where array of columns and values
     */
    protected function update($table, $data, $where) {
        //merge data and where together
        $collection = array_merge($data, $where);

        //collect the values from collection
        $values = array_values($collection);

        //setup fields
        $fieldDetails = null;
        foreach ($data as $key => $value) {
            $fieldDetails .= "$key = ?,";
        }
        $fieldDetails = rtrim($fieldDetails, ',');

        //setup where 
        $whereDetails = null;
        $i = 0;
        foreach ($where as $key => $value) {
            $whereDetails .= $i == 0 ? "$key = ?" : " AND $key = ?";
            $i++;
        }

        $stmt = $this->run("UPDATE $table SET $fieldDetails WHERE $whereDetails", $values);

        return $stmt->rowCount();
    }

    /**
     * Delete records
     * 
     * @param  string $table table name
     * @param  array $where array of columns and values
     * @param  integer $limit limit number of records
     */
    protected function delete($table, $where, $limit = 1) {
        //collect the values from collection
        $values = array_values($where);

        //setup where 
        $whereDetails = null;
        $i = 0;
        foreach ($where as $key => $value) {
            $whereDetails .= $i == 0 ? "$key = ?" : " AND $key = ?";
            $i++;
        }

        //if limit is a number use a limit on the query
        if (is_numeric($limit)) {
            $limit = "LIMIT $limit";
        }

        $stmt = $this->run("DELETE FROM $table WHERE $whereDetails $limit", $values);

        return $stmt->rowCount();
    }

    /**
     * Delete all records records
     * 
     * @param  string $table table name
     */
    protected function deleteAll($table) {
        $stmt = $this->run("DELETE FROM $table");

        return $stmt->rowCount();
    }

    /**
     * Delete record by id
     * 
     * @param  string $table table name
     * @param  integer $id id of record
     */
    protected function deleteById($table, $id) {
        $stmt = $this->run("DELETE FROM $table WHERE id = ?", [$id]);

        return $stmt->rowCount();
    }

    /**
     * Delete record by ids
     * 
     * @param  string $table table name
     * @param  string $column name of column
     * @param  string $ids ids of records
     */
    protected function deleteByIds(string $table, string $column, string $ids) {
        $stmt = $this->run("DELETE FROM $table WHERE $column IN ($ids)");

        return $stmt->rowCount();
    }

    /**
     * truncate table
     * 
     * @param  string $table table name
     */
    protected function truncate($table) {
        $stmt = $this->run("TRUNCATE TABLE $table");

        return $stmt->rowCount();
    }
    
    public function setPaginationOptions(int $current_page, int $records_per_page): void {
        $this->current_page = $current_page;
        $this->records_per_page = $records_per_page;
    }

    /**
     * Create a new record      
     * @param array $data an array that has the values of the new record 
     * @return array An array containing the new record.
     */
    public function create($table, $data) {
        $data = $this->insert($table, $data);
        return $data;
    }

    /**
     * Update an existing record.       
     * @param array $data an array that has the new values of the existing record
     * @param array $where an array that holds the conditions about a specific record 
     * @return array An array containing the returned data
     */
    public function updateTable($table, $data, $where) {
        $data = $this->update($table, $data, $where);
        return $data;
    }
}
