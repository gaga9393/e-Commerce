<?php

class Product {

    protected $conn;
    //kada se kreira objekat, odmah treba da se napravi konekcija
    public function __construct(){
        global $conn; //pristupamo varijabli $conn iz config.php
        $this->conn = $conn;
    }

    //funkcija koja ce da ispise sve proizvode
    public function fetch_all(){
        $sql = "SELECT * FROM products";
        $result = $this->conn->query($sql);

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // CRUD - create, read, update, delete

    public function create($name,$price,$size,$image){
        $query = "INSERT INTO products (name,price,size,image) VALUES (?,?,?,?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('ssss',$name,$price,$size,$image);
        $stmt->execute();
    }

    public function read($product_id){
        $stmt = $this->conn->prepare("SELECT * FROM products WHERE product_id = ? ");
        $stmt->bind_param("i",$product_id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }

    public function update($product_id, $name,$price,$size,$image){
        $query = "UPDATE products SET name= ?, price = ?, size = ?, image= ? WHERE product_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('ssssi',$name,$price,$size,$image,$product_id);
        $stmt->execute();
    }

    public function delete($product_id){
        $query = "DELETE FROM products WHERE product_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('i',$product_id);
        $stmt->execute();
    }
}