<?php
require_once __DIR__ . '/../ClassAutoLoad.php';
require_once __DIR__ . '/../DBConnection.php';

$components = new Components();
$db = new Database($conf);
$db->connect(); 

$whereClauses = [];
$params = [];


if (isset($_GET['category']) && $_GET['category'] !== 'All') {
    $whereClauses[] = "item_category = ?";
    $params[] = $_GET['category'];
}


if (isset($_GET['condition']) && $_GET['condition'] !== 'All') {
    $whereClauses[] = "item_condition = ?";
    $params[] = $_GET['condition'];
}

if (isset($_GET['price']) && $_GET['price'] !== 'All') {
    if ($_GET['price'] == '10000+') {
        $whereClauses[] = "item_price > ?";
        $params[] = 10000;
    } else {
        [$min, $max] = explode('-', $_GET['price']);
        $whereClauses[] = "item_price BETWEEN ? AND ?";
        $params[] = $min;
        $params[] = $max;
    }
}

$whereSQL = "";
if (!empty($whereClauses)) {
    $whereSQL = "WHERE " . implode(" AND ", $whereClauses);
}

$query = "SELECT * FROM items $whereSQL ORDER BY id DESC";
$items = $db->fetch($query, $params);


$items = $db->fetch("SELECT * FROM items"); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <title>StrathMart</title>
    <style>

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f5f5f5;
    color: #333;
}

/* Hero Section with Background */
.hero-container-div {
    background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('images/image.png');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    padding: 80px 20px;
    text-align: center;
    color: white;
    min-height: 500px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

.hero-container-div h1 {
    font-size: 3rem;
    margin-bottom: 10px;
    font-weight: 700;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
}

.hero-subtitle {
    font-size: 1.2rem;
    margin-bottom: 30px;
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
}

/* Search Bar */
.search-container {
    display: flex;
    max-width: 600px;
    width: 100%;
    margin-bottom: 30px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.search-bar {
    flex: 1;
    padding: 15px 20px;
    font-size: 16px;
    border: none;
    border-radius: 50px 0 0 50px;
    outline: none;
}

.search-btn {
    padding: 15px 25px;
    background-color: #007bff;
    border: none;
    border-radius: 0 50px 50px 0;
    cursor: pointer;
    color: white;
    transition: background-color 0.3s;
}

.search-btn:hover {
    background-color: #0056b3;
}

/* Filter Section */
.filter-div {
    display: flex;
    gap: 15px;
    flex-wrap: wrap;
    justify-content: center;
    max-width: 900px;
}

.filter-div select {
    padding: 12px 20px;
    font-size: 14px;
    border: 2px solid white;
    border-radius: 25px;
    background-color: rgba(255, 255, 255, 0.9);
    cursor: pointer;
    outline: none;
    transition: all 0.3s;
}

.filter-div select:hover {
    background-color: white;
    border-color: #007bff;
}

/* Items Display Grid */
.items-display {
    max-width: 1200px;
    margin: 50px auto;
    padding: 0 20px;
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 30px;
}

/* Item Card */
.item-card {
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s, box-shadow 0.3s;
    display: flex;
    flex-direction: column;
}

.item-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
}

.item-image-container {
    width: 100%;
    height: 220px;
    overflow: hidden;
    background-color: #e0e0e0;
}

.item-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s;
}

.item-card:hover .item-image {
    transform: scale(1.05);
}

.item-details {
    padding: 20px;
    display: flex;
    flex-direction: column;
    flex: 1;
}

.item-name {
    font-size: 1.2rem;
    font-weight: 600;
    margin-bottom: 10px;
    color: #333;
    line-height: 1.4;
}

.item-price {
    font-size: 1.4rem;
    font-weight: 700;
    color: #007bff;
    margin-bottom: 10px;
}

.item-description {
    font-size: 0.9rem;
    color: #666;
    line-height: 1.5;
    margin-bottom: 15px;
    flex: 1;
}

.view-details-btn {
    display: inline-block;
    padding: 10px 20px;
    background-color: #007bff;
    color: white;
    text-decoration: none;
    border-radius: 6px;
    text-align: center;
    transition: background-color 0.3s;
    font-weight: 500;
}

.view-details-btn:hover {
    background-color: #0056b3;
}


.no-items {
    grid-column: 1 / -1;
    text-align: center;
    padding: 60px 20px;
}

.no-items p {
    font-size: 1.2rem;
    color: #666;
    margin-bottom: 10px;
}

.no-items .subtitle {
    font-size: 1rem;
    color: #999;
}


footer {
    background-color: #333;
    color: white;
    text-align: center;
    padding: 40px 20px;
    margin-top: 60px;
}

footer h2 {
    font-size: 2rem;
    margin-bottom: 15px;
}

footer p {
    font-size: 1rem;
    max-width: 600px;
    margin: 0 auto;
    line-height: 1.6;
    color: #ccc;
}


@media (max-width: 768px) {
    .hero-container-div h1 {
        font-size: 2rem;
    }
    
    .hero-subtitle {
        font-size: 1rem;
    }
    
    .filter-div {
        flex-direction: column;
        width: 100%;
        max-width: 400px;
    }
    
    .filter-div select {
        width: 100%;
    }
    
    .items-display {
        grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
        gap: 20px;
    }
}
    </style>
</head>
<?php
$components->header();
?>
<body>
    <div class="hero-container-div">
        <h1>Find What You Need</h1>
        <p class="hero-subtitle">View Products from students around Strath</p>
        <div class="search-container">
            <input type="text" placeholder="Search for textbooks, electronics etc..." class="search-bar">
            <button class="search-btn">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="11" cy="11" r="8"></circle>
                    <path d="m21 21-4.35-4.35"></path>
                </svg>
            </button>
        </div>
        
        
        <div class="filter-div">
        <form>
            <select name="categories">
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
                <option value="All">Price Range</option>
                <option value="0-1000">Under Ksh.1,000</option>
                <option value="1000-5000">Ksh.1,000 to Ksh.5,000</option>
                <option value="5000-10000">Ksh.5,000 to Ksh.10,000</option>
                <option value="10000+">Over Ksh.10,000</option>
            </select>
        </form>
            <select name="sort">
                <option value="newest">Newest First</option>
                <option value="relevance">Relevance</option>
                <option value="price-low-high">Price: Low to High</option>
                <option value="price-high-low">Price: High to Low</option>
            </select>
        </div> 
    </div>
    
    <!-- <div class="items-display">
        <?php 
        if(!$items || count($items) == 0){
            echo '<div class="no-items">
                    <p>No items found.</p>
                    <p class="subtitle">Be the first to list an item!</p>
                  </div>';
        } else {
            foreach($items as $item){
                $itemImage = !empty($item['item_image']) ? $item['item_image'] : 'images/placeholder.png';
                $itemPrice = number_format($item['item_price'], 2);
                ?>
                <div class="item-card">
                    <div class="item-image-container">
                        <img src="<?php echo htmlspecialchars($itemImage); ?>" alt="<?php echo htmlspecialchars($item['item_name']); ?>" class="item-image">
                    </div>
                    <div class="item-details">
                        <h3 class="item-name"><?php echo htmlspecialchars($item['item_name']); ?></h3>
                        <p class="item-price">Ksh. <?php echo $itemPrice; ?></p>
                        <p class="item-description"><?php echo htmlspecialchars(substr($item['item_description'], 0, 80)) . (strlen($item['item_description']) > 80 ? '...' : ''); ?></p>
                        <a href="item-details.php?id=<?php echo $item['item_id']; ?>" class="view-details-btn">View Details</a>
                    </div>
                </div>
                <?php
            }
        }
        ?>
    </div> -->

    <div class="items-display">
    <?php 
    if (!$items || count($items) == 0) {
        echo '<div class="no-items">
                <p>No items found.</p>
                <p class="subtitle">Be the first to list an item!</p>
              </div>';
    } else {
        foreach ($items as $item) {
            // Match to actual DB columns
            $itemImage = !empty($item['ImageUrl']) ? $item['ImageUrl'] : 'images/placeholder.png';
            $itemPrice = number_format($item['Price'], 2);
            ?>
            <div class="item-card">
                <div class="item-image-container">
                    <img src="<?php echo htmlspecialchars($itemImage); ?>" 
                         alt="<?php echo htmlspecialchars($item['item_name']); ?>" 
                         class="item-image">
                </div>
                <div class="item-details">
                    <h3 class="item-name"><?php echo htmlspecialchars($item['item_name']); ?></h3>
                    <p class="item-price">Ksh. <?php echo $itemPrice; ?></p>
                    <p class="item-description">
                        <?php 
                        echo htmlspecialchars(substr($item['item_description'], 0, 80)) . 
                             (strlen($item['item_description']) > 80 ? '...' : ''); 
                        ?>
                    </p>
                    <a href="item_details.php?id=<?php echo $item['id']; ?>" class="view-details-btn">
                        View Details
                    </a>
                </div>
            </div>
            <?php
        }
    }
    ?>
</div>

    <footer>
        <h2>StrathMart</h2>
        <p>The trusted Marketplace for all Stratizens to quickly and conveniently buy and sell products within campus</p>
    </footer>
</body>
</html>