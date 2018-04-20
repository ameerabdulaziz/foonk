<?php
/**
 * Created by PhpStorm.
 * User: EngAm
 * Date: 1/19/2018
 * Time: 1:15 AM
 */

class Category extends Model {

    /**
    * @return array of all records in categories table
    */
    public function selectCategories() {
        $this->query('SELECT * FROM `categories`');
        return $this->resultSet();
    }

    /**
     * @param $category
     * @return array of all products for special category
     */
    public function categoryProducts($catID) {
        $this->query("SELECT products.prod_id, products.prod_title, products.prod_image, products.prod_price, avg(products_ratings.rating) as rating 
              FROM products LEFT JOIN products_ratings on products.prod_id = products_ratings.prod_id
              where cat_id = '$catID'
              GROUP BY products.prod_id ");
        return $this->resultSet();
    }

}