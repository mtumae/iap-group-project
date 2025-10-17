<?php
require_once __DIR__ . '/../ClassAutoLoad.php';
require_once __DIR__ . '/../DBConnection.php';

$components = new Components();
$db = new Database($conf);
$db->connect(); 

$items = $db->fetch("SELECT * FROM items"); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="home.css">
    <title>StrathMart</title>
</head>
<?php
$components->header();
?>
<body>
    <div class="hero-container-div">
        <p>Find What You Need</p>
        <p>View Products From Students Around Strath</p>
        <input style = "width:300px" type = "text" placeholder="Search for textbooks, electronics, etc..." class="search-bar">
        <div class="filter-div">
            <select name = "categories">
                <option value="All">All Categories</option>
                <option value="Textbooks">Textbooks</option>
                <option value="Laptops">Laptops</option>
                <option value="Clothing">Clothing</option>
                <option value="Accessories">Tech Accessories</option>
                <option value="Tickets">Concert Tickets</option>
                <option value="Jewellery">Jewellery</option>
            </select>
            <select name="conditions">
                <option value="All">All Conditions</option>
                <option value="New">New</option>
                <option value="Used">Used</option>
            </select>
            <select name="prices">
                <option value="All">All Prices</option>
                <option value="0-1000">Under Ksh.1,000</option>
                <option value="1000-5000">Ksh.1,000 to Ksh.5,000</option>
                <option value="5000-10000">Ksh.5,000 to Ksh.10,000</option>
                <option value="10000+">Over Ksh.10,000</option>
            </select>
            <select name="sort">
                <option value="relevance">Relevance</option>
                <option value="newest">Newest First</option>
                <option value="price-low-high">Price: Low to High</option>
                <option value="price-high-low">Price: High to Low</option>
            </select>
        </div> 
    </div>
    
    <div class="items-display">
        <?php 
        if(!$items){
            echo "<p>No items found.</p>";
        }

        foreach($items as $item){
            

            echo "<p>".$item['item_name']. " - ". $item["item_description"]. "</p>";

        }?>
        
    </div>

    <footer>

        <h2>StrathMart</h2>
        <p>The trusted Marketplace for all Stratizens to quickly and conveniently buy and sell products within campus</p>
    </footer>
   
</body>
