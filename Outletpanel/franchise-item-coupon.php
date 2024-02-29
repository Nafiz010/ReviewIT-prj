<?php include('../errors.php'); ?>
<html lang="en">
<head>
    <link rel="shortcut icon" href="../img/ReviewIT.png" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">    
    <link rel="stylesheet" href="../css/admin.css">
    <title>Outlet Panel - item Coupon</title>
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
                <h2>Outlet Panel - item Coupon</h2>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card">
                <?php include('../message.php');?><script>function closeAlert(){var alert = document.querySelector('.alert');  alert.style.display='none';}</script>
                <div class="card-header">
                    <h4>Provide User Coupon
                        <a href="franchise-items-review.php" class="btn btn-danger float-end">BACK</a>
                    </h4>
                </div>
                <div class="card-body">

                    <?php
                        if (isset($_GET['id'])) 
                        {
                            $cid = $_GET['id'];
                            $uname = "SELECT user_id FROM item_review WHERE id = $cid";
                            $uname_run = mysqli_query($db, $uname);
                            $col = mysqli_fetch_array($uname_run);
                            $col_id = $col['user_id'];
                        }
                        $id = $_SESSION['id'];
                        $query = "SELECT DISTINCT c.* FROM `coupons` c, `franchise` f, `items` i, `item_review` ir WHERE ir.item_id = i.id AND i.franchise_id = f.id AND f.id = c.franchise_id AND ir.user_id = $col_id AND f.user_id = $id";
                        // Adding DISTINCT ensures that only unique rows are returned.
                        $query_run = mysqli_query($db, $query); 
                    ?>

                    <form action="../inc/server.php" method="POST" enctype="multipart/form-data">
                        <div class = "row">
                            <input type="hidden" name="ur_id" value="<?= $cid ?>">
                            <input type="hidden" name="u_id" value="<?= $col_id ?>">

                            <div class="col-md-6 mb-3">
                                <label for="">Coupons</label>
                                <select name="coup" id="" class="form-control">
                                    <option value="">--SELECT COUPON--</option>
                                    <?php while($row = mysqli_fetch_array($query_run)):;?>
                                    <option value="<?= $row['id']?>"><?php echo $row['title'];?></option>
                                    <?php endwhile;?>
                                </select>
                            </div>
                            <div class="col-md-12 mb-3">
                                <button type="submit" name="item_coupon" class="btn btn-primary">Give User Coupon</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>