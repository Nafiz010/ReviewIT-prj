<?php include ('inc/server.php');
    if (!isset($_SESSION['username'])) 
    {
        header('location: login.php');
    }
?>
<html lang="en">
<head>
    <link rel="shortcut icon" href="img/ReviewIT.png" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">    
    <link rel="stylesheet" href="css/bootstrap.min.css"> 
    <link rel="stylesheet" href="css/admin.css">
    <title>Admin Panel</title>
</head>
<body>
    <div class="sidebar">
        <div class="logo">
            <ul class="menu">
                <li class="active">
                    <a href="adminpan.php">
                        <i class="fas fa-tachometer-alt">
                            <span>Dashboard</span>
                        </i>
                    </a>
                </li>
                <li>
                    <a href="Adminpanel/admin-users.php">
                        <i class="fas fa-solid fa-circle-user">
                            <span>Users</span>
                        </i>
                    </a>
                </li>
                <li>
                    <a href="Adminpanel/admin-user-roles.php">
                        <i class="fa-solid fa-users">
                            <span>User Roles</span>
                        </i>
                    </a>
                </li>
                <li>
                    <a href="Adminpanel/admin-outlets.php">
                        <i class="fas fa-solid fa-shop">
                            <span>Outlets</span>
                        </i>
                    </a>
                </li>
                <li>
                    <a href="Adminpanel/admin-items.php">
                        <i class="fa-solid fa-utensils">
                            <span>Items</span>
                        </i>
                    </a>
                </li>
                <li>
                    <a href="Adminpanel/admin-orders.php">
                        <i class="fas fa-cart-shopping">
                            <span>Orders</span>
                        </i>
                    </a>
                </li>                
                <li>
                    <a href="Adminpanel/admin-p-reviews.php">
                        <i class="fa-solid fa-star-half-stroke">
                            <span>Pending Reviews</span>
                        </i>
                    </a>
                </li>
                <li>
                    <a href="Adminpanel/admin-outlet-review.php">
                        <i class="fa-solid fa-star">
                            <span>Outlet Reviews</span>
                        </i>
                    </a>
                </li>
                <li>
                    <a href="Adminpanel/admin-item-review.php">
                        <i class="fa-solid fa-star">
                            <span>Item Reviews</span>
                        </i>
                    </a>
                </li>
                <li id="admin_logout" class="logout">
                    <a href="login.php?logout='1'">
                        <i class="fas fa-sign-out-alt">
                            <span>Logout</span>
                        </i>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="main--content">
        <?php include('message.php');?><script>function closeAlert(){var alert = document.querySelector('.alert');  alert.style.display='none';}</script>
        <div class="header--wrapper">
            <div class="header--title">
                <span>Welcome to,</span>
                <h2>Admin Panel - <?php echo $_SESSION['username']; ?></h2>
            </div>        
        </div>
        <div class ="row">
            <div class="col-xl-3 col-md-6">
                <div class="card bg-danger text-white mb-4">
                    <div class="card-body">Number of Users
                        <?php
                            $dash_user_query = "SELECT * FROM `user`";
                            $dash_user_query_run = mysqli_query($db, $dash_user_query);
                            if ($user_total = mysqli_num_rows($dash_user_query_run)) 
                            {
                                echo '<h4 class="mb-0">'.$user_total.'</h4>';
                            }
                            else 
                            {
                                echo '<h4 class="mb-0"> 0 </h4>';
                            }
                        ?>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="Adminpanel/admin-users.php">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card bg-danger text-white mb-4">
                    <div class="card-body">Total Types of User
                        <?php
                            $dash_user_role_query = "SELECT * FROM `user_role`";
                            $dash_user_role_run = mysqli_query($db, $dash_user_role_query);
                            if ($user_role_total = mysqli_num_rows($dash_user_role_run)) 
                            {
                                echo '<h4 class="mb-0">'.$user_role_total.'</h4>';
                            }
                            else 
                            {
                                echo '<h4 class="mb-0"> 0 </h4>';
                            }
                        ?>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="Adminpanel/admin-user-roles.php">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card bg-danger text-white mb-4">
                    <div class="card-body">Total Orders Placed
                        <?php
                            $dash_order_query = "SELECT * FROM `order`";
                            $dash_order_query_run = mysqli_query($db, $dash_order_query);
                            if ($order_total = mysqli_num_rows($dash_order_query_run)) 
                            {
                                echo '<h4 class="mb-0">'.$order_total.'</h4>';
                            }
                            else 
                            {
                                echo '<h4 class="mb-0"> 0 </h4>';
                            }
                        ?>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="Adminpanel/admin-orders.php">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card bg-danger text-white mb-4">
                    <div class="card-body">Pending Reviews
                        <?php
                            $dash_p_review_query = "SELECT * FROM `pending_review` WHERE Approval='Pending'";
                            $dash_p_review_query_run = mysqli_query($db, $dash_p_review_query);
                            if ($p_review_total = mysqli_num_rows($dash_p_review_query_run)) 
                            {
                                echo '<h4 class="mb-0">'.$p_review_total.'</h4>';
                            }
                            else 
                            {
                                echo '<h4 class="mb-0"> 0 </h4>';
                            }
                        ?>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="Adminpanel/admin-p-reviews.php">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card bg-danger text-white mb-4">
                    <div class="card-body">Registered Outlets
                        <?php
                            $dash_outlet_query = "SELECT * FROM `franchise`";
                            $dash_outlet_query_run = mysqli_query($db, $dash_outlet_query);
                            if ($outlet_total = mysqli_num_rows($dash_outlet_query_run)) 
                            {
                                echo '<h4 class="mb-0">'.$outlet_total.'</h4>';
                            }
                            else 
                            {
                                echo '<h4 class="mb-0"> 0 </h4>';
                            }
                        ?>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="Adminpanel/admin-outlets.php">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card bg-danger text-white mb-4">
                    <div class="card-body">Outlet Reviews
                        <?php
                            $dash_outlet_review_query = "SELECT * FROM `pending_review` WHERE approval = 'Approved'";
                            $dash_outlet_review_query_run = mysqli_query($db, $dash_outlet_review_query);
                            if ($outlet_review_total = mysqli_num_rows($dash_outlet_review_query_run)) 
                            {
                                echo '<h4 class="mb-0">'.$outlet_review_total.'</h4>';
                            }
                            else 
                            {
                                echo '<h4 class="mb-0"> 0 </h4>';
                            }
                        ?>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="Adminpanel/admin-outlet-review.php">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-3 col-md-6">
                <div class="card bg-danger text-white mb-4">
                    <div class="card-body">Number of Outlet Items
                        <?php
                            $dash_items_query = "SELECT * FROM `items`";
                            $dash_items_query_run = mysqli_query($db, $dash_items_query);
                            if ($items_total = mysqli_num_rows($dash_items_query_run)) 
                            {
                                echo '<h4 class="mb-0">'.$items_total.'</h4>';
                            }
                            else 
                            {
                                echo '<h4 class="mb-0"> 0 </h4>';
                            }
                        ?>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="Adminpanel/admin-items.php">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-3 col-md-6">
                <div class="card bg-danger text-white mb-4">
                    <div class="card-body">Item Reviews
                        <?php
                            $dash_item_review_query = "SELECT * FROM `item_review`";
                            $dash_item_review_query_run = mysqli_query($db, $dash_item_review_query);
                            if ($item_review_total = mysqli_num_rows($dash_item_review_query_run)) 
                            {
                                echo '<h4 class="mb-0">'.$item_review_total.'</h4>';
                            }
                            else 
                            {
                                echo '<h4 class="mb-0"> 0 </h4>';
                            }
                        ?>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="Adminpanel/admin-item-review.php">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>

            
        </div>
    </div>
    
    
</body>
</html>