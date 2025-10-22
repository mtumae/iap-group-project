<?php

require_once __DIR__ . '/../ClassAutoLoad.php';
$form = new Forms();
$forms = new Forms();

class Components{
    public function header(){
        ?>
         <!DOCTYPE html>
        <html lang="en" data-bs-theme="auto">
        <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
        </head>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Student Marketplace</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
            <style>
  a.nav-link {
    color: #9C9C9C;
    text-decoration: none;
  }

  a.nav-link:hover {
    color: white;
  }
</style>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                <li class="nav-item">
                <a class="nav-link"  href="/iap-group-project/Pages/Home.php">Home</a>
                </li>
                <li class="nav-item">
                <a class="nav-link"  href="#">Buy</a>
                </li>
                <li>
                    <a class="nav-link"  href="/iap-group-project/Pages/sell.php">Sell</a>
                </li>
               
            </ul>
            <span class="navbar-text">
                <a href="?form=login"><button class="btn btn-primary" type="button">Browse</button></a>
                <a href="?form=signup"><button class="btn btn-primary" type="button" style="background-color:black">Sell Now</button></a>
        </div>
        </div>
        </nav>
        <?php

    }
   public function form_content() {
    global $forms;
    $formType = $_GET['form'] ?? 'login';
    
    // Start the session here if it hasn't been started in index.php
    // session_start(); 
    // ^ IMPORTANT: Ensure session_start() is at the very top of index.php

    ?>
    <div style="display:grid; gap:20px; justify-content: center; padding:15px;" id="page-content">
        <div id="form-section">
            <?php

            switch ($formType) {
                case 'signup':
                    $forms->signup();
                    break;
                case 'login':
                    $forms->login();
                    break;
                case 'twofa':
                    $forms->twofa();
                    break;
                
                // START: NEW PASSWORD RESET CASES
                case 'forgot_password':
                    $forms->forgotPassword();
                    break;
                case 'resetcode':
                    $forms->resetCodeForm();
                    break;
                case 'newpassword':
                    // Authorization check: Must have successfully verified the code in the previous step
                    if (!isset($_SESSION['pending_reset_user_id'])) {
                        // Redirect to login if unauthorized access is attempted
                        header("Location: index.php?form=login&error=UnauthorizedAccess");
                        exit();
                    }
                    $forms->newPasswordForm();
                    break;
                // END: NEW PASSWORD RESET CASES

                default:
                    echo "Unknown form type.";
            }
            ?>
        </div>
            <!-- <div id="info-section">
                <h2>Extra Content</h2>
                <p>
                    This is an additional section where you can place text, 
                    images, or instructions for your users.  
                    Since this version doesn’t use Bootstrap, 
                    you can style <code>#info-section</code> and <code>#form-section</code> 
                    in your own CSS.
                </p>
                <button type="button">Example button</button>
            </div> -->
        </div>
        <?php
    }
    public function footer(){

        ?>
        <footer style="width:98%;">
            <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
            <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
            </symbol>
            <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
            </symbol>
            <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
            </symbol>
            </svg>
            <div class="footer">
            <div class="row">
            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-instagram"></i></a>
            <a href="#"><i class="fa fa-youtube"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            </div>

            <div class="row">
            <ul>
            <li><a href="#">Contact us</a></li>
            <li><a href="#">Privacy Policy</a></li>
            <li><a href="#">Terms & Conditions</a></li>
            </ul>
            </div>

            <!--  -->
            </div>
        </footer>
        <?php
    }


//--------------------------Items components---------------------------------------------------------//
    public function ItemCard($item, $db){
        //<img src="<?php echo $item['image_url'];
        ?>
        <div class="card" style="width: 18rem; background-color:#e0e0e0; align-items: center; ">
        
        <div class="card-body" style="text-align: center;">
            <p style="font-size: 13px;" class="card-text"><?php echo $item['item_description']; ?></p>
            <a  class="btn btn-primary" style="background-color: black;">Buy <?php echo $item['item_name']; ?></a>
        </div>
        </div>
<?php

    if(isset($_POST['submit_button'])){
        // Handle form submission
        $item_id = $_POST['item_id'];
        $user_id = $_SESSION['user_id']; // Assuming user ID is stored in session
        $quantity = $_POST['quantity'];

        // Call a method to add the item to the user's cart or process the order
        $result = $db->addOrder($user_id, $item_id, $quantity);

        // Display the result
        echo $result;
    }
}





//--------------------------Orders components---------------------------------------------------------//
public function OrderCard($order, $db){
    ?>
     <a href="#" class="list-group-item list-group-item-action active" aria-current="true">
    <div class="d-flex w-100 justify-content-between">
      <h5 class="mb-1"><?php echo $order['item_name']; ?></h5>
      <small><?php echo $order['order_date']; ?></small>
    </div>
    <p class="mb-1">Quantity: <?php echo $order['quantity']; ?></p>
    <small>Status: <?php echo $order['status']; ?></small>

    <select name="status" id="status">
        <option value="Pending" <?php if($order['status'] == 'Pending') echo 'selected'; ?>>Pending</option>
        <option value="Shipped" <?php if($order['status'] == 'Shipped') echo 'selected'; ?>>Shipped</option>
        <option value="Delivered" <?php if($order['status'] == 'Delivered') echo 'selected'; ?>>Delivered</option>
    </select>

  </a>
<?php
        if(isset($_POST['submit_button'])){
            $result = $db->updateOrderStatus($order['order_id'], $_POST['status']);
            echo "
                <div class=\"toast\" role=\"alert\" aria-live=\"assertive\" aria-atomic=\"true\">
                <div class=\"toast-header\">
                    <img src=\"...\" class=\"rounded me-2\" alt=\"...\">
                    <strong class=\"me-auto\">Bootstrap</strong>
                    <small class=\"text-muted\">11 mins ago</small>
                    <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"toast\" aria-label=\"Close\"></button>
                </div>
                <div class=\"toast-body\">
                    $result
                    Status successfully updated!
                </div>
                </div>";
        }
    }






}