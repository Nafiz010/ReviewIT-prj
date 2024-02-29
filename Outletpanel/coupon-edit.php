<?php include('../errors.php'); ?>
<html lang="en">
<head>
    <link rel="shortcut icon" href="../img/ReviewIT.png" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">    
    <link rel="stylesheet" href="../css/admin.css">
    <title>Outlet Panel - Edit Coupon</title>
</head>
<body>
    <div class="sidebar">
        <div class="logo">
            <ul class="menu">
                <li class="active">
                    <a href="../outletpan.php">
                        <i class="fas fa-tachometer-alt">
                            <span>Dashboard</span>
                        </i>
                    </a>
                </li>
                <li>
                    <a href="franchise-view.php">
                        <i class="fas fa-solid fa-shop">
                            <span>Your Outlets</span>
                        </i>
                    </a>
                </li>
                <li>
                    <a href="franchise-items.php">
                        <i class="fa-solid fa-utensils">
                            <span>Add Items</span>
                        </i>
                    </a>
                </li>
                <li>
                    <a href="franchise-orders.php">
                        <i class="fas fa-cart-shopping">
                            <span>User Orders</span>
                        </i>
                    </a>
                </li>
                <li>
                    <a href="franchise-coupons.php">
                        <i class="fa-solid fa-star-half-stroke">
                            <span>Add Coupons</span>
                        </i>
                    </a>
                </li>                
                <li>
                    <a href="franchise-outlet-review.php">
                        <i class="fa-solid fa-star">
                            <span>Outlet Reviews</span>
                        </i>
                    </a>
                </li>
                <li>
                    <a href="franchise-items-review.php">
                        <i class="fa-solid fa-star">
                            <span>Item Reviews</span>
                        </i>
                    </a>
                </li>
                <li class="logout">
                    <a href="../login.php?logout='1'">
                        <i class="fas fa-sign-out-alt">
                            <span>Logout</span>
                        </i>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="main--content">
        <div class="header--wrapper">
            <div class="header--title">
                <span>Welcome to,</span>
                <h2>Outlet Panel - Edit Coupon</h2>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card">
                <?php include('../message.php');?><script>function closeAlert(){var alert = document.querySelector('.alert');  alert.style.display='none';}</script>
                <div class="card-header">
                    <h4>Edit Coupon Info
                        <a href="franchise-coupons.php" class="btn btn-danger float-end">BACK</a>
                    </h4>
                </div>
                <div class="card-body">

                    <?php
                    $id = $_SESSION['id'];
                    if (isset($_GET['id'])) {
                        $coupon_query_id = $_GET['id'];
                        $coupon_query = "SELECT c.*, f.id AS fid, f.name AS fname FROM `coupons` c, `franchise` f WHERE c.id = $coupon_query_id AND c.franchise_id = f.id AND f.user_id = $id";
                        $coupon_query_run = mysqli_query($db, $coupon_query);
                        
                        if (mysqli_num_rows($coupon_query_run) > 0) 
                        {
                            foreach($coupon_query_run as $coupon)
                            {                        
                                ?>                                
                                    <form action="../inc/server.php" method="POST" enctype="multipart/form-data">
                                        <input type="hidden" name="c_id" value="<?=$coupon['id'];?>">
                                        <div class = "row">
                                            <div class="col-md-6 mb-3">
                                                <label for="">Coupon Title</label>
                                                <input type="text" name="title" value="<?= $coupon['title']?>" class="form-control">
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label for="">Description</label>
                                                <input type="text" name="description" value="<?= $coupon['description']?>" class="form-control">
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label for="">Discount Amount (BDT)</label>
                                                <input type="text" name="discount" value="<?= $coupon['discount_amount']?>" class="form-control">
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label for="">Expiration Date</label>
                                                <input type="date" name="date" value="<?= $coupon['expiration_date']?>" class="form-control">
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label for="">Franchise Name</label>
                                                <select name="franchname" class="form-control">
                                                    <option value="">--SELECT OUTLET--</option>
                                                    <option value="<?= $coupon['fid']?>"><?= $coupon['fname']?></option>
                                                </select>
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <button type="submit" name="update_coupon" class="btn btn-primary">Update Coupon</button>
                                            </div>
                                        </div>
                                    </form>
                                <?php
                            }
                        }
                        else {
                            ?>
                                <h4>No Records Found</h4>
                            <?php
                        }
                    }
                        
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>