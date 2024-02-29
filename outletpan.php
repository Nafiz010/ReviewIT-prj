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
    <title>Outlet Panel</title>
</head>
<body>
    <div class="sidebar">
        <div class="logo">
            <ul class="menu">
                <li class="active">
                    <a href="outletpan.php">
                        <i class="fas fa-tachometer-alt">
                            <span>Dashboard</span>
                        </i>
                    </a>
                </li>
                <li>
                    <a href="Outletpanel/franchise-view.php">
                        <i class="fas fa-solid fa-shop">
                            <span>Your Outlets</span>
                        </i>
                    </a>
                </li>
                <li>
                    <a href="Outletpanel/franchise-items.php">
                        <i class="fa-solid fa-utensils">
                            <span>Add Items</span>
                        </i>
                    </a>
                </li>
                <li>
                    <a href="Outletpanel/franchise-orders.php">
                        <i class="fas fa-cart-shopping">
                            <span>User Orders</span>
                        </i>
                    </a>
                </li>
                <li>
                    <a href="Outletpanel/franchise-coupons.php">
                        <i class="fa-solid fa-star-half-stroke">
                            <span>Add Coupons</span>
                        </i>
                    </a>
                </li>                
                <li>
                    <a href="Outletpanel/franchise-outlet-review.php">
                        <i class="fa-solid fa-star">
                            <span>Outlet Reviews</span>
                        </i>
                    </a>
                </li>
                <li>
                    <a href="Outletpanel/franchise-items-review.php">
                        <i class="fa-solid fa-star">
                            <span>Item Reviews</span>
                        </i>
                    </a>
                </li>
                <li class="logout">
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
                <h2>Outlet Panel - <?php echo $_SESSION['username']; ?></h2>
            </div>        
        </div>
        
        <div class ="row">
            <div class="col-xl-3 col-md-6">
                <div class="card bg-danger text-white mb-4">
                    <div class="card-body">Your Outlets
                        <?php
                            $id = $_SESSION['id'];
                            $dash_outlet_query = "SELECT * FROM `franchise` WHERE user_id = $id";
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
                        <a class="small text-white stretched-link" href="Outletpanel/franchise-view.php">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card bg-danger text-white mb-4">
                    <div class="card-body">Number of Outlet Items
                        <?php
                            $dash_items_query = "SELECT * FROM `items` i, `franchise` f, `user` u WHERE f.id = i.franchise_id AND u.id = f.user_id AND u.id = $id";
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
                        <a class="small text-white stretched-link" href="Outletpanel/franchise-items.php">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card bg-danger text-white mb-4">
                    <div class="card-body">Total Orders Placed
                        <?php
                            $dash_order_query = "SELECT * FROM `order` o, items i, franchise f, user u WHERE o.item_id = i.id AND f.id = i.franchise_id AND u.id = f.user_id AND u.id = $id";
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
                        <a class="small text-white stretched-link" href="Outletpanel/franchise-orders.php">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card bg-danger text-white mb-4">
                    <div class="card-body">Total Number of Coupons
                        <?php
                            $dash_coupons_query = "SELECT * FROM `coupons` c, `franchise` f, `user` u WHERE c.franchise_id = f.id AND f.user_id = u.id AND u.id = $id";
                            $dash_coupons_run = mysqli_query($db, $dash_coupons_query);
                            if ($coupons_total = mysqli_num_rows($dash_coupons_run)) 
                            {
                                echo '<h4 class="mb-0">'.$coupons_total.'</h4>';
                            }
                            else 
                            {
                                echo '<h4 class="mb-0"> 0 </h4>';
                            }
                        ?>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="Outletpanel/franchise-coupons.php">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card bg-danger text-white mb-4">
                    <div class="card-body">Outlet Reviews
                        <?php
                            $dash_outlet_review_query = "SELECT * FROM `franchise_review` fr, `franchise` f, `user` u, `pending_review` pr WHERE pr.franchise_review = fr.id AND fr.franchise_id = f.id AND pr.approval = 'Approved' AND f.user_id = u.id AND u.id = $id";
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
                        <a class="small text-white stretched-link" href="Outletpanel/franchise-outlet-review.php">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card bg-danger text-white mb-4">
                    <div class="card-body">Item Reviews
                        <?php
                            $dash_item_review_query = "SELECT * FROM `item_review` ir, `items` i, `franchise` f, `user` u WHERE ir.item_id = i.id AND i.franchise_id = f.id AND f.user_id = u.id AND u.id = $id";
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
                        <a class="small text-white stretched-link" href="Outletpanel/franchise-items-review.php">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    
    
</body>
</html>