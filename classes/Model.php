<?php
/**
 * Created by PhpStorm.
 * User: EngAm
 * Date: 2/20/2018
 * Time: 11:12 AM
 *
 * This is a Model class that has two instances
 *      - $dbh
 *      - $stmt
 * , constructor that connect to database
 * , and has five function
 *      - Prepare Query
 *      - Bind Statement
 *      - execute Query
 *      - Fetch Result Set of records
 *      - Fetch Single record
 */

abstract class Model{

    protected $dbh;                     // Database Handler
    protected $stmt;                    // Database Statement

    /**
     * Model constructor.
     * Connect to database
     *
     * This construct connects to database
     */
    public function __construct()
    {
        $this->dbh = new PDO('mysql:host=' . HOST . ';dbname=' .DATABASE, USERNAME, PASSWORD);
    }

    /**
     * Prepare database query
     *
     * @param $query
     */
    public function query($query)
    {
        $this->stmt = $this->dbh->prepare($query);
    }

    /**
     * Bind the prepare statement
     *
     * @param $param
     * @param $value
     * @param null $type
     */
    public function bind($param, $value, $type = null)
    {
        if ($type === null):
            switch (true):
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case $value === null:
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            endswitch;
        endif;
        $this->stmt->bindValue($param, $value, $type);
    }

    /**
     * execute the database query
     */
    public function execute()
    {
        $this->stmt->execute();
    }


    /**
     * Fetch all records form any database table
     *
     * @return mixed
     */
    public function resultSet()
    {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Fetch a single record from any database table
     *
     * @return mixed
     */
    public function single()
    {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

}