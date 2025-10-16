<?php 

class Forms{
    

    public function signup(){
        ?>
        <form  action ="Forms/signup_action.php" method="POST">
        <h1 style="text-align:center;">Sign up</h1>
            <div class="form-group">
                    <label  for="username">Full Name</label>
                    <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Email</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  name="email">
               
            </div>
            <div class="form-group">
                <label  for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1"  name="password">
                
            </div>
            <!--  -->
            <div style="text-align:center;">
            <button type="submit" class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-check-big-icon lucide-circle-check-big"><path d="M21.801 10A10 10 0 1 1 17 3.335"/><path d="m9 11 3 3L22 4"/></svg> Sign up</button>
            <div id="login-redirect-container">
                    <a href="?form=login">Already have an account? Login</a>
            </div>
            </div>
        </form>
        <?php
    }

    public function login() {
        ?>
        <form method="POST" action="Forms/login_action.php">
            <h1 style="text-align:center;">Login</h1>
            <div class="form-group">
                <label for="loginEmail">Email address</label>
                <input type="email" class="form-control" id="loginEmail" name="email"  required>
            </div>
    
            <div class="form-group">
                <label for="loginPassword">Password</label>
                <input type="password" class="form-control" id="loginPassword" name="password"  required>
            </div>
            <div style="text-align:center;">
                <button type="submit" class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-check-big-icon lucide-circle-check-big"><path d="M21.801 10A10 10 0 1 1 17 3.335"/><path d="m9 11 3 3L22 4"/></svg> Login</button>
                <div id="create-account-container">
                    <a href="?form=signup">Don't have an account? Create one</a><br><br>
                </div>
            </div>
        </form>
        <?php
    }

    public function twofa(){
        ?>
        <div>
            <form style="padding:40px;text-align:center;" method="POST" action="Forms/twofactor.php">
                <h1>Two-Factor authentication</h1>
                <p>Enter the code below</p>
                    <input style="height:80px;color:white;text-align:center;background-color:#23262b;border:none;font-size:30px;width:100%;" type="text" id="verification_code" name="verification_code" maxlength="6" placeholder="000 - 000" required>
                <button class="btn btn-primary" type="submit">Verify</button>
            </form>
            <?php if (!empty($error)) : ?>
                <p style="color:red;"><?= htmlspecialchars($error) ?></p>
            <?php endif; ?>
            </div>
        <?php
    }

    public function AddItemsForm($config){   
        $db = new Database($config);
        $categories = $db->getAllCategories();
      
        ?>
        <form  method="post" enctype="multipart/form-data">

        
            <h1 style="text-align:center;">Add Item</h1>
                    <div class="mb-3">
                    <label for="formFile" class="form-label">Add an image of the item</label>
                    <input class="form-control" type="file" id="item-image" name="item-image" accept="image/*">
                    </div>
        
                <div class="mb-3">
                <label for="item-name" class="form-label">Item Name</label>
                <input type="text" class="form-control" id="item-name" name="item_name" >
                </div>


                <div class="mb-3">
                <label for="item-description" class="form-label">Item Description</label>
                <textarea class="form-control" id="item-description" name="item-description" rows="3"></textarea>
                </div>
        
                <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Quantity</label>
                <input type="number" class="form-control" id="exampleFormControlInput1" name="quantity" min="1" max="30" value="1">
                </div>

                <label for="category" class="form-label">Category</label>
                <select id="category" name="category" class="form-select" aria-label="Default select example">
                    <option selected>Open this select menu</option>
                    <?php foreach ($categories as $category): ?>
                            <option style="padding:10px;" value="<?php echo htmlspecialchars($category['category_name']); ?>">
                                <?php echo htmlspecialchars($category['category_name']); ?>
                            </option>
                        <?php endforeach; ?>
                </select>
                </div>
            <button type="submit" name="submit_button" value="Submit" class="btn btn-primary">Add Item</button>
    </form>
            <?php
            if(isset($_POST['submit_button'])){
                $db = new Database($config);
                if(isset($_SESSION['user_id'])){
                    $db->addItem($_SESSION['user_id'], $_POST['item_name'], $_POST['quantity'], $_POST['item-description'], (int)array_search('food', array_column($categories, $_POST['category']))+1);
                    echo "
                    <div class=\"alert alert-success d-flex align-items-center\" role=\"alert\">
                    <svg class=\"bi flex-shrink-0 me-2\" width=\"24\" height=\"24\" role=\"img\" aria-label=\"Success:\"><use xlink:href=\"#check-circle-fill\"/></svg>
                    <div>
                        {$_POST['item_name']} added successfully!
                    </div>
                    </div>
                ";
                }   
                else{
                    echo "<div style=\"background-color:red;\" class=\"toast\" role=\"alert\" aria-live=\"assertive\" aria-atomic=\"true\">
                            <div class=\"toast-header\">
                                <img src=\"...\" class=\"rounded me-2\" alt=\"...\">
                                <strong class=\"me-auto\">Bootstrap</strong>
                                <small class=\"text-muted\">11 mins ago</small>
                                <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"toast\" aria-label=\"Close\"></button>
                            </div>
                            <div class=\"toast-body\">
                                Failed to add item
                            </div>
                            </div>
                ";
                }

            }

    }

}