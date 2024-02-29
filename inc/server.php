<?php
    if (!isset($_SESSION)) 
    {
        session_start();
    }
    //error_reporting(0);
    $username = "";
    $email = "";
    $errors = array();

    $db = mysqli_connect('localhost', 'root', '', 'prj');

    if (isset($_POST['Register']))
    {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $filename = $_FILES["fileupload"]["name"];
        $tempname = $_FILES["fileupload"]["tmp_name"];
        $folder = "img/" . $filename;
        move_uploaded_file($tempname, $folder);

        if(empty($username))
        {
            array_push($errors, $username_error="Username is required");
        }

        if(empty($password))
        {
            array_push($errors, "Password is required");
        }

        if(empty($email) || (filter_var($email, FILTER_VALIDATE_EMAIL) === false))
        {
            array_push($errors, "Email is required");
        }

        if(empty($address))
        {
            array_push($errors, "Address is required");
        }

        if(empty($phone) || (filter_var($phone, FILTER_VALIDATE_INT) === false))
        {
            array_push($errors, "Phone Number is required");
        }

        if (count($errors) == 0) 
        {
            $password = md5($password);
            $sql_u = "SELECT * FROM user WHERE username='$username'";
            $sql_e = "SELECT * FROM user WHERE email='$email'";
            $res_u = mysqli_query($db, $sql_u);
            $res_e = mysqli_query($db, $sql_e);

            
            if (mysqli_num_rows($res_u) > 0 || mysqli_num_rows($res_e) > 0) 
            {
                if (mysqli_num_rows($res_u) > 0) 
                {
                    array_push($errors, $name_error = "Sorry, this username already exists. Please try a different username");
                }
                elseif (mysqli_num_rows($res_e) > 0) 
                {
                    array_push($errors, $email_error = "Sorry, this email already exists. Please try a different Email address");
                }         
            }     
            

            

            else
            {
                
                $sql = "INSERT INTO user (username, password, email, address, phone, avatar, user_role) 
                VALUES ('$username', '$password', '$email', '$address', '$phone', '$filename', '2')";

                $result = mysqli_query($db, $sql);

                if($result) {
                    $_SESSION['message'] = "User Created Successfully";                    
                }
                else {
                    echo "There were errors". mysqli_error($db);
                }
            }            
        }
    }

    /// For Login ////

    if (isset($_POST['login'])) 
    {
        $username = $_POST['username'];
        $password = $_POST['password'];        

        //Filling up fields accordingly (Validation)
        if(empty($username))
        {
            array_push($errors, "Username is required");
        }

        if(empty($password))
        {
            array_push($errors, "Password is required");
        }

        if (count($errors) ==0 ) 
        {
            $password = md5($password);
            $query= "SELECT * FROM user WHERE username='$username' AND password='$password'";
            $result= mysqli_query($db, $query);
            if (mysqli_num_rows($result) != 1) 
            {
                array_push($errors, "Incorrect Username or Password");                
            }
            else
            {
                $userrole = mysqli_fetch_array($result);
                $id = $userrole['id'];
                if($userrole['user_role'] == 1)
                {
                    $_SESSION['message'] = "Welcome $username";
                    $_SESSION['username'] = $username;
                    header("location: adminpan.php");
                }

                if($userrole['user_role'] == 2)
                {
                    $_SESSION['message'] = "Welcome $username";
                    $_SESSION['username'] = $username;
                    $_SESSION['id'] = $id;
                    header("location: index.php");
                }            
            
                if($userrole['user_role'] == 3)
                {
                    $_SESSION['message'] = "Welcome $username";
                    $_SESSION['id'] = $id;
                    $_SESSION['username'] = $username;
                    header("location: outletpan.php");
                }
            }
             
        }
    }

    /// ADMIN -- USER CRUDE ///

    if (isset($_POST['update_user'])) 
    {
        $user_id = $_POST['user_id'];
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        $email = $_POST['email'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];        
        $filename = $_FILES["fileupload"]["name"];
        $tempname = $_FILES["fileupload"]["tmp_name"];
        $folder = "../img/" . $filename;
        move_uploaded_file($tempname, $folder);
        $userrole = $_POST['user_role'];

        if(empty($username))
        {
            array_push($errors, "Username is required");
        }

        if(empty($password))
        {
            array_push($errors, "Password is required");
        }

        if(empty($email) || (filter_var($email, FILTER_VALIDATE_EMAIL) === false))
        {
            array_push($errors, "Email is required");
        }

        if(empty($address))
        {
            array_push($errors, "Address is required");
        }

        if(empty($phone) || (filter_var($phone, FILTER_VALIDATE_INT) === false))
        {
            array_push($errors, "Phone Number is required");
        }

        if(empty($userrole))
        {
            array_push($errors, "User Role is required");
        }

        if (count($errors) == 0) 
        {
            if (empty($filename) && empty($tempname)) 
            {
                $query = "UPDATE user SET username='$username', password='$password', email='$email', address='$address', phone='$phone', user_role='$userrole'
                WHERE id='$user_id'";
            }

            else 
            {
                $query = "UPDATE user SET username='$username', password='$password', email='$email', address='$address', phone='$phone', avatar='$filename', user_role='$userrole'
                WHERE id='$user_id'";
            }
            
            $query_run = mysqli_query($db, $query);

            if ($query_run) 
            {
                $_SESSION['message'] = "User Updated Successfully";
                header("Location: ../Adminpanel/admin-users.php");
                exit(0);
            }
        }
        
        else 
        {
            $_SESSION['message'] = "Something Went Wrong....!!!!";
            header("Location: ../Adminpanel/admin-users.php");
            exit(0);
        }

        
    }

    if (isset($_POST['add_user'])) 
    {
        $user_id = $_POST['user_id'];
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        $email = $_POST['email'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];        
        $filename = $_FILES["fileupload"]["name"];
        $tempname = $_FILES["fileupload"]["tmp_name"];
        $folder = "../img/" . $filename;
        move_uploaded_file($tempname, $folder);
        $userrole = $_POST['user_role'];

        if(empty($username))
        {
            array_push($errors, "Username is required");
        }

        if(empty($password))
        {
            array_push($errors, "Password is required");
        }

        if(empty($email) || (filter_var($email, FILTER_VALIDATE_EMAIL) === false))
        {
            array_push($errors, "Email is required");
        }

        if(empty($address))
        {
            array_push($errors, "Address is required");
        }

        if(empty($phone) || (filter_var($phone, FILTER_VALIDATE_INT) === false))
        {
            array_push($errors, "Phone Number is required");
        }

        if(empty($userrole))
        {
            array_push($errors, "User Role is required");
        }
        
        if(count($errors) == 0)
        {            
            $query = "INSERT INTO user (username, password, email, address, phone, avatar, user_role) 
            VALUES ('$username', '$password', '$email', '$address', '$phone', '$filename', '$userrole')";
            $query_run = mysqli_query($db, $query);
        }


        if ($query_run) {
            $_SESSION['message'] = "User Added Successfully";
            header("Location: ../Adminpanel/admin-users.php");
            exit(0);
        }
        else {
            $_SESSION['message'] = "Something Went Wrong....!!!!";
            header("Location: ../Adminpanel/admin-users.php");
            exit(0);
        }
    }

    if (isset($_POST['user_delete'])) 
    {
        $user_id = $_POST['user_delete'];

        $query = "DELETE FROM user WHERE id='$user_id'";
        $query_run=mysqli_query($db, $query);

        if ($query_run) {
            $_SESSION['message'] = "User Deleted Successfully";
            header("Location: ../Adminpanel/admin-users.php");
            exit(0);
        }
        else {
            $_SESSION['message'] = "Something Went Wrong....!!!!";
            header("Location: ../Adminpanel/admin-users.php");
            exit(0);
        }
    }

    /// ADMIN -- OUTLET CRUDE ///

    if (isset($_POST['update_outlet'])) 
    {
        $outlet_id = $_POST['outlet_id'];
        $name = $_POST['name'];
        $description = $_POST['description'];
        $address = $_POST['address'];
        $availability = $_POST['availability'];
        $phone = $_POST['phone'];        
        $filename = $_FILES["fileupload"]["name"];
        $tempname = $_FILES["fileupload"]["tmp_name"];
        $folder = "../img/" . $filename;
        move_uploaded_file($tempname, $folder);

        if (empty($filename) && empty($tempname)) 
        {
            $query = "UPDATE franchise SET name='$name', description='$description', address='$address', availability='$availability', phone='$phone'
            WHERE id='$outlet_id'";
        }

        else 
        {
            $query = "UPDATE franchise SET name='$name', description='$description', address='$address', availability='$availability', phone='$phone', logo='$filename'
            WHERE id='$outlet_id'";
        }

        $query_run = mysqli_query($db, $query);

        if ($query_run) {
            $_SESSION['message'] = "Outlet Updated Successfully";
            header("Location: ../Adminpanel/admin-outlets.php");
            exit(0);
        }
    }

    if (isset($_POST['add_outlet'])) 
    {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $address = $_POST['address'];
        $phone = $_POST['phone']; 
        $availability = $_POST['availability'];       
        $filename = $_FILES["fileupload"]["name"];
        $tempname = $_FILES["fileupload"]["tmp_name"];
        $folder = "../img/" . $filename;
        move_uploaded_file($tempname, $folder);
        $userid = $_POST['user_id'];

        $query = "INSERT INTO franchise (name, description, address, phone, availability, logo, user_id) 
        VALUES ('$name', '$description', '$address', '$phone', '$availability', '$filename', '$userid')";
        $query_run = mysqli_query($db, $query);

        if ($query_run) {
            $_SESSION['message'] = "Outlet Added Successfully";
            header("Location: ../Adminpanel/admin-outlets.php");
            exit(0);
        }
        else {
            $_SESSION['message'] = "Something Went Wrong....!!!!";
            header("Location: ../Adminpanel/admin-outlets.php");
            exit(0);
        }
    }

    if (isset($_POST['outlet_delete'])) 
    {
        $outlet_id = $_POST['outlet_delete'];

        $query = "DELETE FROM franchise WHERE id='$outlet_id'";
        $query_run=mysqli_query($db, $query);

        if ($query_run) {
            $_SESSION['message'] = "Outlet Deleted Successfully";
            header("Location: ../Adminpanel/admin-outlets.php");
            exit(0);
        }
        else {
            $_SESSION['message'] = "Something Went Wrong....!!!!";
            header("Location: ../Adminpanel/admin-outlets.php");
            exit(0);
        }
    }

    /// DELETING ITEMS FROM ADMIN PANEL ///

    if (isset($_POST['items_delete'])) 
    {
        $item_id = $_POST['items_delete'];

        $query = "DELETE FROM items WHERE id='$item_id'";
        $query_run=mysqli_query($db, $query);

        if ($query_run) {
            $_SESSION['message'] = "Item Deleted Successfully";
            header("Location: ../Adminpanel/admin-items.php");
            exit(0);
        }
        else {
            $_SESSION['message'] = "Something Went Wrong....!!!!";
            header("Location: ../Adminpanel/admin-items.php");
            exit(0);
        }
    }


    /// DELETING ORDER FROM ADMIN PANEL ///

    if (isset($_POST['order_delete'])) 
    {
        $order_id = $_POST['order_delete'];

        $query = "DELETE FROM `order` WHERE id='$order_id'";
        $query_run=mysqli_query($db, $query);

        if ($query_run) {
            $_SESSION['message'] = "Order Deleted Successfully";
            header("Location: ../Adminpanel/admin-orders.php");
            exit(0);
        }
        else {
            $_SESSION['message'] = "Something Went Wrong....!!!!";
            header("Location: ../Adminpanel/admin-orders.php");
            exit(0);
        }
    }


    /// DELETING User Roles FROM ADMIN PANEL ///

    if (isset($_POST['add_user_role'])) 
    {
        $user_role_name = $_POST['name'];
        $description = $_POST['description'];

        if (empty($user_role_name))
        {
            $_SESSION['message'] = "Name of the User Role is required";
            header("Location: ../Adminpanel/user_role-add.php");
            exit(0);
        }

        if (empty($description))
        {
            $_SESSION['message'] = "Description of the User Role is required";
            header("Location: ../Adminpanel/user_role-add.php");
            exit(0);
        }

        else {
            $query = "INSERT INTO `user_role` (name, description) VALUES ('$user_role_name','$description')";
            $query_run = mysqli_query($db, $query);

            if ($query_run) 
            {
                $_SESSION['message'] = "User Role Added Successfully";
                header("Location: ../Adminpanel/admin-user-roles.php");
                exit(0);
            }
            else 
            {
                $_SESSION['message'] = "Something Went Wrong....!!!!";
                header("Location: ../Adminpanel/admin-user-roles.php");
                exit(0);
            }
        }
    }


    if (isset($_POST['user_role_delete'])) 
    {
        $user_role_id = $_POST['user_role_delete'];

        $query = "DELETE FROM `user_role` WHERE id='$user_role_id'";
        $query_run=mysqli_query($db, $query);

        if ($query_run) {
            $_SESSION['message'] = "User Role Deleted Successfully";
            header("Location: ../Adminpanel/admin-user-roles.php");
            exit(0);
        }
        else {
            $_SESSION['message'] = "Something Went Wrong....!!!!";
            header("Location: ../Adminpanel/admin-user-roles.php");
            exit(0);
        }
    }

    /// DELETING ITEM REVIEWS FROM ADMIN PANEL ///

    if (isset($_POST['item_review_delete'])) 
    {
        $item_review_delete_id = $_POST['item_review_delete'];

        $query = "DELETE FROM `item_review` WHERE id='$item_review_delete_id'";
        $query_run=mysqli_query($db, $query);

        if ($query_run) {
            $_SESSION['message'] = "Item Review Deleted Successfully";
            header("Location: ../Adminpanel/admin-item-review.php");
            exit(0);
        }
        else {
            $_SESSION['message'] = "Something Went Wrong....!!!!";
            header("Location: ../Adminpanel/admin-item-review.php");
            exit(0);
        }
    }

    /// APPROVAL OR REJECTION OF REVIEWS FROM ADMIN PANEL ///

    if (isset($_POST['pending_review_approve']))
    {
        $pending_reviews_id = $_POST['pending_review_approve'];
        $query = "UPDATE `pending_review` SET `approval` = 'Approved' WHERE franchise_review='$pending_reviews_id'";
        $query_run = mysqli_query($db, $query);
        if ($query_run){
            $_SESSION['message'] = "Review approved successfully";
            header("Location: ../Adminpanel/admin-p-reviews.php");
            exit(0);
        }
        else {
            $_SESSION['message'] = "Something Went Wrong....!!!!";
            header("Location: ../Adminpanel/admin-p-review.php");
            exit(0);
        }
    }


    if (isset($_POST['pending_review_decline']))
    {
        $pending_reviews_id = $_POST['pending_review_decline'];
        $query = "UPDATE `pending_review` SET approval = 'Declined' WHERE franchise_review='$pending_reviews_id'";
        $query_run = mysqli_query($db, $query);
        if ($query_run){
            $_SESSION['message'] = "Review declined successfully";
            header("Location: ../Adminpanel/admin-p-reviews.php");
            exit(0);
        }
        else {
            $_SESSION['message'] = "Something Went Wrong....!!!!";
            header("Location: ../Adminpanel/admin-p-review.php");
            exit(0);
        }
    }


    /// DELETING OUTLET REVIEWS FROM ADMIN PANEL ///

    if (isset($_POST['outlet_review_delete'])) 
    {
        $outlet_review_delete_id = $_POST['outlet_review_delete'];

        $query = "DELETE FROM `franchise_review` WHERE id='$outlet_review_delete_id'";
        $query_run=mysqli_query($db, $query);

        if ($query_run) {
            $_SESSION['message'] = "Outlet Review Deleted Successfully";
            header("Location: ../Adminpanel/admin-outlet-review.php");
            exit(0);
        }
        else {
            $_SESSION['message'] = "Something Went Wrong....!!!!";
            header("Location: ../Adminpanel/admin-outlet-review.php");
            exit(0);
        }
    }



    /// LOGOUT ////

    if (isset($_GET['logout'])) 
    {
        session_destroy();
        unset($_SESSION['username']);
        header('location: login.php');
    }

    /// FRANCHISE PANEL -- OUTLET CRUDE ///

    if (isset($_POST['update_franchise'])) 
    {
        $outlet_id = $_POST['outlet_id'];
        $name = $_POST['name'];
        $description = $_POST['description'];
        $address = $_POST['address'];
        $availability = $_POST['availability'];
        $phone = $_POST['phone'];        
        $filename = $_FILES["fileupload"]["name"];
        $tempname = $_FILES["fileupload"]["tmp_name"];
        $folder = "../img/" . $filename;
        move_uploaded_file($tempname, $folder);

        if (empty($filename) && empty($tempname)) {
            $query = "UPDATE franchise SET name='$name', description='$description', address='$address', availability='$availability', phone='$phone' 
            WHERE id='$outlet_id'";
        }

        else {
            $query = "UPDATE franchise SET name='$name', description='$description', address='$address', availability='$availability', phone='$phone', logo='$filename' 
            WHERE id='$outlet_id'";
        }

        
        $query_run = mysqli_query($db, $query);

        if ($query_run) {
            $_SESSION['message'] = "Outlet Updated Successfully";
            header("Location: ../Outletpanel/franchise-view.php");
            exit(0);
        }
    }

    if (isset($_POST['add_franchise'])) 
    {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $address = $_POST['address'];
        $phone = $_POST['phone']; 
        $availability = $_POST['availability'];       
        $filename = $_FILES["fileupload"]["name"];
        $tempname = $_FILES["fileupload"]["tmp_name"];
        $folder = "../img/" . $filename;
        move_uploaded_file($tempname, $folder);
        $userid = $_SESSION['id'];

        $query = "INSERT INTO franchise (name, description, address, phone, availability, logo, user_id) 
        VALUES ('$name', '$description', '$address', '$phone', '$availability', '$filename', '$userid')";
        $query_run = mysqli_query($db, $query);

        if ($query_run) {
            $_SESSION['message'] = "Outlet Added Successfully";
            header("Location: ../Outletpanel/franchise-view.php");
            exit(0);
        }
        else {
            $_SESSION['message'] = "Something Went Wrong....!!!!";
            header("Location: ../Outletpanel/franchise-view.php");
            exit(0);
        }
    }

    if (isset($_POST['franchise_delete'])) 
    {
        $outlet_id = $_POST['franchise_delete'];

        $query = "DELETE FROM franchise WHERE id='$outlet_id'";
        $query_run=mysqli_query($db, $query);

        if ($query_run) {
            $_SESSION['message'] = "Outlet Deleted Successfully";
            header("Location: ../Outletpanel/franchise-view.php");
            exit(0);
        }
        else {
            $_SESSION['message'] = "Something Went Wrong....!!!!";
            header("Location: ../Outletpanel/franchise-view.php");
            exit(0);
        }
    }


    /// FRANCHISE PANEL -- ITEMS CRUDE ///

    if (isset($_POST['add_items'])) 
    {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $f_id = $_POST['fname'];
        $filename = $_FILES["fileupload"]["name"];
        $tempname = $_FILES["fileupload"]["tmp_name"];
        $folder = "../img/" . $filename;
        move_uploaded_file($tempname, $folder);

        if (empty($name))
        {
            $_SESSION['message'] = "Name of the Item is required";
            header("Location: ../Outletpanel/item-add.php");
            exit(0);
        }

        if (empty($description))
        {
            $_SESSION['message'] = "Description of the Item is required";
            header("Location: ../Outletpanel/item-add.php");
            exit(0);
        }

        if(empty($price) || (filter_var($price, FILTER_VALIDATE_INT) === false))
        {
            $_SESSION['message'] = "Price of the Item is required";
            header("Location: ../Outletpanel/item-add.php");
            exit(0);
        }

        if (empty($f_id))
        {
            $_SESSION['message'] = "Please Select Your Outlet";
            header("Location: ../Outletpanel/item-add.php");
            exit(0);
        }

        else
        {
            $query = "INSERT INTO `items` (name, description, price, image, franchise_id) 
            VALUES ('$name', '$description', '$price', '$filename', '$f_id')";
            $query_run = mysqli_query($db, $query);

            if ($query_run) 
            {
                $_SESSION['message'] = "Item Added Successfully";
                header("Location: ../Outletpanel/franchise-items.php");
                exit(0);
            }
            else 
            {
                $_SESSION['message'] = "Something Went Wrong....!!!!";
                header("Location: ../Outletpanel/franchise-items.php");
                exit(0);
            }
        }
    }

    if(isset($_POST['update_item']))
    {
        $item_id = $_POST['i_id'];
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $franchiseid = $_POST['franchname'];
        $filename = $_FILES["fileupload"]["name"];
        $tempname = $_FILES["fileupload"]["tmp_name"];
        $folder = "../img/" . $filename;
        move_uploaded_file($tempname, $folder);

        if (empty($name))
        {
            $_SESSION['message'] = "Name of the Item is required";
            header("Location: ../Outletpanel/item-edit.php?id=$item_id");
            exit(0);
        }

        if (empty($description))
        {
            $_SESSION['message'] = "Description of the Item is required";
            header("Location: ../Outletpanel/item-edit.php?id=$item_id");
            exit(0);
        }

        if(empty($price) || (filter_var($price, FILTER_VALIDATE_INT) === false))
        {
            $_SESSION['message'] = "Price of the Item is required";
            header("Location: ../Outletpanel/item-edit.php?id=$item_id");
            exit(0);
        }

        if (empty($franchiseid))
        {
            $_SESSION['message'] = "Please Select Your Outlet";
            header("Location: ../Outletpanel/item-edit.php?id=$item_id");
            exit(0);
        }

        

        else 
        {

            if (empty($filename) && empty($tempname)) 
            {
                $query = "UPDATE items SET name='$name', description='$description', price='$price', franchise_id='$franchiseid' WHERE id='$item_id'";
            }

            else 
            {
                $query = "UPDATE items SET name='$name', description='$description', price='$price', image='$filename', franchise_id='$franchiseid' WHERE id='$item_id'";
            }

            $query_run = mysqli_query($db, $query);

            if ($query_run) 
            {
                $_SESSION['message'] = "Item Updated Successfully";
                header("Location: ../Outletpanel/franchise-items.php");
                exit(0);
            }
            else 
            {
                $_SESSION['message'] = "Something Went Wrong....!!!!";
                header("Location: ../Outletpanel/franchise-items.php");
                exit(0);
            }
        }
    }

    if (isset($_POST['f_items_delete'])) 
    {
        $franch_item_id = $_POST['f_items_delete'];

        $query = "DELETE FROM items WHERE id='$franch_item_id'";
        $query_run=mysqli_query($db, $query);

        if ($query_run) 
        {
            $_SESSION['message'] = "Item Deleted Successfully";
            header("Location: ../Outletpanel/franchise-items.php");
            exit(0);
        }
        else 
        {
            $_SESSION['message'] = "Something Went Wrong....!!!!";
            header("Location: ../Outletpanel/franchise-items.php");
            exit(0);
        }
    }

    /// FRANCHISE PANEL --- DELETE ORDERS ///

    if (isset($_POST['f_order_delete'])) 
    {
        $franch_order_id = $_POST['f_order_delete'];

        $query = "DELETE FROM `order` WHERE id='$franch_order_id'";
        $query_run=mysqli_query($db, $query);

        if ($query_run) 
        {
            $_SESSION['message'] = "Order Deleted Successfully";
            header("Location: ../Outletpanel/franchise-orders.php");
            exit(0);
        }
        else 
        {
            $_SESSION['message'] = "Something Went Wrong....!!!!";
            header("Location: ../Outletpanel/franchise-order.php");
            exit(0);
        }
    }

    /// FRANCHISE PANEL --- COUPONS CRUDE ///

    if (isset($_POST['add_coupons'])) 
    {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $discount = $_POST['d_amount'];
        $e_date = $_POST['date'];
        $franchise = $_POST['fname'];

        if(empty($title))
        {
            $_SESSION['message'] = "Title of the coupon is required";
            header("Location: ../Outletpanel/coupon-add.php");
            exit(0);
        }
        
        if(empty($description))
        {
            $_SESSION['message'] = "Description of the coupon is required";
            header("Location: ../Outletpanel/coupon-add.php");
            exit(0);
        }

        if(empty($discount) || (filter_var($discount, FILTER_VALIDATE_INT) === false))
        {
            $_SESSION['message'] = "Discount amount is required";
            header("Location: ../Outletpanel/coupon-add.php");
            exit(0);
        }

        if(empty($e_date))
        {
            $_SESSION['message'] = "Expiration date is required";
            header("Location: ../Outletpanel/coupon-add.php");
            exit(0);
        }

        if(empty($franchise))
        {
            $_SESSION['message'] = "Please Select Your Outlet";
            header("Location: ../Outletpanel/coupon-add.php");
            exit(0);
        }

        else 
        {
            $query = "INSERT INTO coupons (title, description, discount_amount, expiration_date, franchise_id) 
            VALUES ('$title', '$description', '$discount', '$e_date', '$franchise')";
            $query_run = mysqli_query($db, $query);

            if ($query_run) 
            {
                $_SESSION['message'] = "Coupon Added Successfully";
                header("Location: ../Outletpanel/franchise-coupons.php");
                exit(0);
            }
            else 
            {
                $_SESSION['message'] = "Something Went Wrong....!!!!";
                header("Location: ../Outletpanel/franchise-coupons.php");
                exit(0);
            }
        }
    }

    if(isset($_POST['update_coupon']))
    {
        $coupon_id = $_POST['c_id'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $discount = $_POST['discount'];
        $exp_date = $_POST['date'];
        $franchiseid = $_POST['franchname'];

        if (empty($title))
        {
            $_SESSION['message'] = "Title of the coupon is required";
            header("Location: ../Outletpanel/coupon-edit.php?id=$coupon_id");
            exit(0);
        }

        if (empty($description))
        {
            $_SESSION['message'] = "Description of the coupon is required";
            header("Location: ../Outletpanel/coupon-edit.php?id=$coupon_id");
            exit(0);
        }

        if(empty($discount) || (filter_var($discount, FILTER_VALIDATE_INT) === false))
        {
            $_SESSION['message'] = "Discount amount of the coupon is required";
            header("Location: ../Outletpanel/coupon-edit.php?id=$coupon_id");
            exit(0);
        }

        if (empty($franchiseid))
        {
            $_SESSION['message'] = "Please Select Your Outlet";
            header("Location: ../Outletpanel/coupon-edit.php?id=$coupon_id");
            exit(0);
        }

        else 
        {
            $query = "UPDATE coupons SET title='$title', description='$description', discount_amount='$discount', expiration_date='$exp_date' WHERE id='$coupon_id'";
            $query_run = mysqli_query($db, $query);

            if ($query_run) 
            {
                $_SESSION['message'] = "Coupon Updated Successfully";
                header("Location: ../Outletpanel/franchise-coupons.php");
                exit(0);
            }
            else 
            {
                $_SESSION['message'] = "Something Went Wrong....!!!!";
                header("Location: ../Outletpanel/franchise-coupons.php");
                exit(0);
            }
        }
    }

    if (isset($_POST['coupon_delete'])) 
    {
        $franch_coupon_id = $_POST['coupon_delete'];

        $query = "DELETE FROM coupons WHERE id='$franch_coupon_id'";
        $query_run=mysqli_query($db, $query);

        if ($query_run) 
        {
            $_SESSION['message'] = "Coupon Deleted Successfully";
            header("Location: ../Outletpanel/franchise-items.php");
            exit(0);
        }
        else 
        {
            $_SESSION['message'] = "Something Went Wrong....!!!!";
            header("Location: ../Outletpanel/franchise-items.php");
            exit(0);
        }
    }

    /// FRANCHISE PANEL -- PROVIDING COUPONS TO USERS ////

    if (isset($_POST['outlet_coupon'])) 
    {
        $urID = $_POST['ur_id'];
        $userid = $_POST['u_id'];
        $coup_id = $_POST['coup'];

        if (empty($coup_id)) 
        {
            $_SESSION['message'] = "Please enter a coupon";
            header("Location: ../Outletpanel/franchise-outlet-coupon.php?id=$urID");
            exit(0);
        }

        else 
        {
            $query = "INSERT INTO user_coupons (user_id, coupon_id) VALUES ('$userid', '$coup_id')";
            $query_run = mysqli_query($db, $query);

            if ($query_run) 
            {
                $_SESSION['message'] = "Coupon Provided To User Successfully";
                header("Location: ../Outletpanel/franchise-outlet-review.php");
                exit(0);
            }
            else 
            {
                $_SESSION['message'] = "Something Went Wrong....!!!!";
                header("Location: ../Outletpanel/franchise-outlet-review.php");
                exit(0);
            }
        }
    }


    if (isset($_POST['item_coupon'])) 
    {
        $urID = $_POST['ur_id'];
        $userid = $_POST['u_id'];
        $coup_id = $_POST['coup'];

        if (empty($coup_id)) 
        {
            $_SESSION['message'] = "Please enter a coupon";
            header("Location: ../Outletpanel/franchise-item-coupon.php?id=$urID");
            exit(0);
        }

        else 
        {
            $query = "INSERT INTO user_coupons (user_id, coupon_id) VALUES ('$userid', '$coup_id')";
            $query_run = mysqli_query($db, $query);
            
            if ($query_run) 
            {
                $_SESSION['message'] = "Coupon Provided To User Successfully";
                header("Location: ../Outletpanel/franchise-items-review.php");
                exit(0);
            }
            else 
            {
                $_SESSION['message'] = "Something Went Wrong....!!!!";
                header("Location: ../Outletpanel/franchise-items-review.php");
                exit(0);
            }
        }
    }

    /// SUBMITTING OUTLET REVIEW AND RATING DATA ////

    if (isset($_POST["rating_data"])) {
        $rtn = $_POST["rating_data"];
        $cmt = $_POST["user_review"];
        $fr_id = $_POST["franch_id"];
        $us_id = $_POST["user_id"];

        $query = "INSERT INTO `franchise_review` (rating_number, comments, franchise_id, user_id) VALUES ('$rtn', '$cmt', '$fr_id', '$us_id')";
        $query_run = mysqli_query($db, $query);

        $reviewID = $db->insert_id;

        $queryPR = "INSERT INTO `pending_review` (franchise_review, approval) VALUES ('$reviewID','Pending')";
        $queryPR_run = mysqli_query($db, $queryPR);

        if ($query_run && $queryPR_run) {
            echo "Your Rating & Review has been added successfully !! Please wait for Approval";
            exit(0);
        }

        else {
            echo "Something went wrong";
        }
    }


    /// FETCHING REVIEW AND RATING DATA ///
        
    if (isset($_POST["action"])) 
    {
        $franchise_id = isset($_POST['franchise_id']) ? $_POST['franchise_id'] : null;
        $average_rating = 0;
        $total_review = 0;
        $five_star_review = 0;
        $four_star_review = 0;
        $three_star_review = 0;
        $two_star_review = 0;
        $one_star_review = 0;
        $total_user_rating = 0;
        $review_content = array();

        $query = "SELECT fr.*, u.username AS uname FROM `franchise_review` fr, `user` u, `pending_review` pr, `franchise` f 
        WHERE fr.franchise_id = f.id AND pr.franchise_review = fr.id AND pr.approval = 'approved' AND fr.user_id = u.id AND fr.franchise_id = $franchise_id ORDER BY id DESC";
        $query_run = mysqli_query($db, $query);
        $datafth = mysqli_num_rows($query_run) > 0;
        if ($datafth) {
            while ($row = mysqli_fetch_array($query_run))
            {
                $review_content[] = array(
                    'user_name'		=>	$row["uname"],
                    'user_review'	=>	$row["comments"],
                    'rating'		=>	$row["rating_number"]
                );
        
                if($row["rating_number"] == '5')
                {
                    $five_star_review++;
                }
        
                if($row["rating_number"] == '4')
                {
                    $four_star_review++;
                }
        
                if($row["rating_number"] == '3')
                {
                    $three_star_review++;
                }
        
                if($row["rating_number"] == '2')
                {
                    $two_star_review++;
                }
        
                if($row["rating_number"] == '1')
                {
                    $one_star_review++;
                }
        
                $total_review++;
        
                $total_user_rating = $total_user_rating + $row["rating_number"];
            }
        }
        $average_rating = $total_user_rating / $total_review;

        $output = array(
            'average_rating'	=>	number_format($average_rating, 1),
            'total_review'		=>	$total_review,
            'five_star_review'	=>	$five_star_review,
            'four_star_review'	=>	$four_star_review,
            'three_star_review'	=>	$three_star_review,
            'two_star_review'	=>	$two_star_review,
            'one_star_review'	=>	$one_star_review,
            'review_data'		=>	$review_content
        );

        echo json_encode($output);       
    }


    /// SUBMITTING ITEM REVIEW AND RATING DATA ////

    if (isset($_POST["rating_item_data"])) 
    {
        $rtn = $_POST["rating_item_data"];
        $cmt = $_POST["user_review"];
        $it_id = $_POST["item_id"];
        $us_id = $_POST["user_id"];
        $order = $_POST["order_id"];

        $check = "SELECT COUNT(*) as count FROM `order` WHERE id = '$order' AND user_id = '$us_id' AND item_id = '$it_id'";
        $result = mysqli_query($db, $check);
        $row = mysqli_fetch_assoc($result);
        $count = $row['count'];

        if ($count > 0)
        {
            $query = "INSERT INTO `item_review` (rating_number, comments, item_id, user_id, order_id) 
            VALUES ('$rtn', '$cmt', '$it_id', '$us_id', '$order')";
            $query_run = mysqli_query($db, $query);

            
            if ($query_run) 
            {
                echo"Your Rating & Review has been added successfully !!";
                exit(0);
            }

            else 
            {
                echo "Something went wrong";
            }
        }

        else 
        {
            echo "You must place an order and provide correct credentials !!!";
        }


        
    }


    /// FETCHING REVIEW AND RATING DATA ///
        
    if (isset($_POST["reaction"])) 
    {
        $item_id = isset($_POST['item_id']) ? $_POST['item_id'] : null;

        $average_rating = 0;
        $total_review = 0;
        $five_star_review = 0;
        $four_star_review = 0;
        $three_star_review = 0;
        $two_star_review = 0;
        $one_star_review = 0;
        $total_user_rating = 0;
        $review_content = array();

        $query = "SELECT ir.*, u.username AS uname FROM `item_review` ir, `user` u, `items` i 
        WHERE ir.user_id = u.id AND ir.item_id = i.id AND ir.item_id = $item_id ORDER BY id DESC";
        $query_run=mysqli_query($db, $query);
        $datafth = mysqli_num_rows($query_run) > 0;
        if ($datafth) {
            while ($row = mysqli_fetch_array($query_run))
            {
                $review_content[] = array(
                    'user_name'		=>	$row["uname"],
                    'user_review'	=>	$row["comments"],
                    'rating'		=>	$row["rating_number"]
                );
        
                if($row["rating_number"] == '5')
                {
                    $five_star_review++;
                }
        
                if($row["rating_number"] == '4')
                {
                    $four_star_review++;
                }
        
                if($row["rating_number"] == '3')
                {
                    $three_star_review++;
                }
        
                if($row["rating_number"] == '2')
                {
                    $two_star_review++;
                }
        
                if($row["rating_number"] == '1')
                {
                    $one_star_review++;
                }
        
                $total_review++;
        
                $total_user_rating = $total_user_rating + $row["rating_number"];
            }
        }
        $average_rating = $total_user_rating / $total_review;

        $output = array(
            'average_rating'	=>	number_format($average_rating, 1),
            'total_review'		=>	$total_review,
            'five_star_review'	=>	$five_star_review,
            'four_star_review'	=>	$four_star_review,
            'three_star_review'	=>	$three_star_review,
            'two_star_review'	=>	$two_star_review,
            'one_star_review'	=>	$one_star_review,
            'review_data'		=>	$review_content
        );

        echo json_encode($output);       
    }


    /// USER --- PLACING ORDER ///

    if (isset($_POST["item_p_id"]))
    {
        $itemID = $_POST["item_p_id"];
        $quantity = $_POST["quantity"];
        $userID = $_POST["user_id"];
        $couponID = $_POST["coupon"];

        $prc = "SELECT * FROM `items` WHERE id = $itemID";
        $prc_run = mysqli_query($db, $prc);

        if ($prc_run) 
        {
            $val = mysqli_fetch_assoc($prc_run);

            if ($val) 
            {
                $total_price = $quantity * $val['price'];
                if ($couponID) 
                {
                    $cp = "SELECT c.*, uc.id AS ucid FROM `coupons` c, `user_coupons` uc WHERE c.id = uc.coupon_id AND c.id = $couponID ";
                    $cp_run = mysqli_query($db, $cp);

                    if ($cp_run) 
                    {
                        $amt = mysqli_fetch_assoc($cp_run);

                        if ($amt) 
                        {
                            // Subtract the discount amount
                            $total_price -= $amt['discount_amount'];
                        } 
                        else 
                        {
                            echo "Coupon not found.";
                            exit;
                        }
                    }
                    
                    else 
                    {
                        echo "Error fetching coupon details.";
                        exit;
                    }
                    $query = "INSERT INTO `order` (quantity, price, item_id, user_id, coupon_id) VALUES ('$quantity', '$total_price', '$itemID', '$userID', '$couponID')";
                }
                else{
                    $query = "INSERT INTO `order` (quantity, price, item_id, user_id) VALUES ('$quantity', '$total_price', '$itemID', '$userID')";
                }

                $query_run = mysqli_query($db, $query);

                if ($query_run) 
                {
                    echo "Your order has been placed successfully!";
                    exit;
                } 
                else 
                {
                    echo "Something went wrong.";
                    exit;
                }
            } 
            else 
            {
                echo "Item not found.";
                exit;
            }
        } 
        else 
        {
            echo "Error fetching item details.";
            exit;
        }
    }



    /// USER --- ORDER DELETE /////

    if (isset($_POST['uorder_delete'])) 
    {
        $uorder_id = $_POST['uorder_delete'];

        $query = "DELETE FROM `order` WHERE id='$uorder_id'";
        $query_run=mysqli_query($db, $query);

        if ($query_run) 
        {
            $_SESSION['message'] = "Order Deleted Successfully";
            header("Location: ../Home/home-orders.php");
            exit(0);
        }
        else 
        {
            $_SESSION['message'] = "Something Went Wrong....!!!!";
            header("Location: ../Home/home-orders.php");
            exit(0);
        }
    }

?>