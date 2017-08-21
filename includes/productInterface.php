<?php
require_once 'db.php';

class Product{
    static function seoUrl($string) {
        //Lower case everything
        $string = strtolower($string);
        //Make alphanumeric (removes all other characters)
        $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
        //Clean up multiple dashes or whitespaces
        $string = preg_replace("/[\s-]+/", " ", $string);
        //Convert whitespaces and underscore to dash
        $string = preg_replace("/[\s_]/", "-", $string);
        return $string;
    }

    static function search($search_term){
        $conn = new DB();
        $sql = "SELECT * FROM `products` WHERE name LIKE '$search_term' or productid LIKE '$search_term' ORDER BY productid DESC";
        $result = $conn->query($sql);
        $conn->close();
        if (!$result) {
            return FALSE;
        } else {
            return Product::extractRows($result);
        }
    }

    static function unqiue_search($unqiue){
        $conn = new DB();
        $sql = "SELECT * FROM `products` WHERE productid = '$unqiue'";
        $result = $conn->query($sql);
        $conn->close();

        if (!$result) {
            return FALSE;
        } elseif ($result->num_rows > 1) {
            return FALSE;
        } else {
            return Product::extractRows($result)[0];
        }
    }

    static function extractRows($result){
        $return_arr = array();
        while ($row = $result->fetch_assoc()) {
            $row_array['id'] = $row['productid'];
            $row_array['name'] = $row['name'];
            $row_array['url'] = Product::seoURL($row['name']);
            $row_array['description'] = $row['description'];
            $row_array['price'] = number_format($row['price'], 2);
            $row_array['quantity'] = $row['quantity'];
            array_push($return_arr, $row_array);
        }
        return $return_arr;
    }
}
?>
