<?php

class Database {
    private $conn;
    public function __construct($config) {
        $this->conn = new mysqli(
            $config['db_host'],
            $config['db_user'],
            $config['db_pass'],
            $config['db_name']
        );

        if ($this->conn->connect_error) {
            die("Database connection failed: " . $this->conn->connect_error);
        }
    }

    // return raw connection
    public function getConnection() {
        return $this->conn;
    }   

//------------------------------Items-------------------------------------------------------

    public function addItem($user_id, $item_name, $quantity, $item_description, $category_id){
        if($user_id==null || $item_name==null || $quantity==null || $item_description==null || $category_id==null){
            return "Error empty fields found!";
        }else{
            $sql = "INSERT INTO items (user_id, item_name, quantity, item_description, category_id) VALUES (?, ?, ?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            
            $stmt->bind_param("isisi", $user_id, $item_name, $quantity, $item_description, $category_id);
            $stmt->execute();
            $result = $stmt->execute();
            if($result){
                return $this->conn->insert_id."  has been addded to the items table.";
            } else {
                return "Error adding category to database: " . $stmt->error;
            }
        }
    }

    public function getAllItems(){
        $sql = "SELECT * from items";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getItemByCategory($category_id){
        $sql = "SELECT * from items where category_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $category_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }


    public function getItemsByUser($user_id){
        $sql = "SELECT * from items where user_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }


//------------------------------Categories-------------------------------------------------------

    public function getAllCategories(){
        $sql = "SELECT * from categories";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getCategoryByName($category_name){
        $sql = "SELECT * from categories where category_name = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $category_name);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function addCategory($category_name){
        $sql = "INSERT INTO categories (category_name) VALUES (?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $category_name);
        $result = $stmt->execute();
        if($result){
            return $this->conn->insert_id." has been added to the category table";
        } else {
            return "Error adding category to database: " . $stmt->error;
        }
    }

    public function categoryExists($newCategoryName){
        $sql = "SELECT FROM categories where category_name = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $newCategoryName);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result){
            return $result->fetch_all(MYSQLI_ASSOC)['id'];
        }else{
            return [];
        };
    }


    public function getCategoryById($id){
        $sql = "SELECT * from categories where id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }


//------------------------------Orders--------------------------------------------------------

    public function addOrder($user_id, $item_id, $quantity, $status = 'pending'){
        //First check if quantity is available
        $sql = "UPDATE items set quantity = quantity - ? where id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $quantity, $item_id);
        $result = $stmt->execute();
        if($result){
            return "Item quantity updated successfully.";
            $sql2 = "INSERT INTO orders (user_id, item_id, quantity, status) VALUES (?, ?, ?, ?)";
            $stmt2 = $this->conn->prepare($sql2);
            $stmt2->bind_param("iiis", $user_id, $item_id, $quantity, $status);
            $result2 = $stmt2->execute();
            if($result2){
                return $this->conn->insert_id."  has been added to the orders table.";
            } else {
                return "Error adding order to database: " . $stmt2->error;
            }
        } else {
            return "Error updating item quantity: " . $stmt->error;
        }    
    }



    public function getOrdersByUser($user_id){
        $sql = "SELECT * from orders where user_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }


    public function getAllOrders(){
        $sql = "SELECT * from orders";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function updateOrderStatus($order_id, $new_status){
        $sql = "UPDATE orders set status = ? where id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("si", $new_status, $order_id);
        $result = $stmt->execute();
        if($result){
            return "Status has been updated to: ".$new_status;
        } else {
            return "Error updating order status: " . $stmt->error;
        }
    }


    public function getOrderByStatus($status){
        $sql = "SELECT * from orders where status = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $status);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }


    public function deleteOrder($order_id){
        $sql = "DELETE from orders where id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $order_id);
        $result = $stmt->execute();
        if($result){
            return "Order ID: ".$order_id." has been deleted.";
        } else {
            return "Error deleting order: " . $stmt->error;
        }
    }



}
