<?php include('../errors.php'); ?>
<html lang="en">
<head>
    <link rel="shortcut icon" href="../img/ReviewIT.png" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">    
    <link rel="stylesheet" href="../css/admin.css">
    <title>Outlet Panel - Create Coupon</title>
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
                <h2>Outlet Panel - Create Coupon</h2>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card">
                <?php include('../message.php');?><script>function closeAlert(){var alert = document.querySelector('.alert');  alert.style.display='none';}</script>
                <div class="card-header">
                    <h4>Create New Coupon
                        <a href="franchise-coupons.php" class="btn btn-danger float-end">BACK</a>
                    </h4>
                </div>
                
                <div class="card-body"> 

                    <?php
                        $id = $_SESSION['id'];
                        $query = "SELECT * FROM `franchise` WHERE user_id = '$id'";
                        $query_run = mysqli_query($db, $query);
                    ?>

                    <form action="../inc/server.php" method="POST" enctype="multipart/form-data">
                        <div class = "row">
                            <div class="col-md-6 mb-3">
                                <label for="">Coupon Title</label>
                                <input type="text" name="title" class="form-control">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="">Description</label>
                                <input type="text" name="description" class="form-control">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="">Discount Amount (BDT)</label>
                                <input type="text" name="d_amount" class="form-control">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="">Expiration Date</label>
                                <input type="date" name="date" class="form-control">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="">Franchise Name</label>
                                <select name="fname" id="" class="form-control">
                                    <option value="">--SELECT OUTLET--</option>
                                    <?php while($row = mysqli_fetch_array($query_run)):;?>
                                    <option value="<?= $row['id']?>"><?php echo $row['name'];?></option>
                                    <?php endwhile;?>
                                </select>
                            </div>
                            <div class="col-md-12 mb-3">
                                <button type="submit" name="add_coupons" class="btn btn-primary">Add Coupons</button>
                            </div>
                        </div>
                    </form>                          
                </div>
            </div>
        </div>
    </div>
</body>
</html>