<?php
/**
 * Created by PhpStorm.
 * User: EngAm
 * Date: 2/20/2018
 * Time: 6:57 PM
 *
 * This is a Product Class that extends from Model Class and has a function
 *      - Select all products from data base
 */

class Product extends Model {


    /**
     * This methods returns all records of products that are in the product database table joined by rating products table
     *
     * @return mixed
     */
    public function selectAllProducts() {
        // Select all products table that are joined with rating products table on their ids
        $this->query('SELECT products.prod_id, products.prod_title, products.prod_image, products.prod_price, avg(products_ratings.rating) as rating 
              FROM products LEFT JOIN products_ratings on products.prod_id = products_ratings.prod_id
              GROUP BY products.prod_id');
        $this->execute();
       return $this->resultSet();
    }

}