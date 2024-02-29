<?php include ('../inc/server.php');?>
<html lang="en">
<head>
    <link rel="shortcut icon" href="../img/ReviewIT.png" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">    
    <link rel="stylesheet" href="../css/admin.css">
    <title>Outlet Panel - Add Coupons</title>
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
        <?php include('../message.php');?><script>function closeAlert(){var alert = document.querySelector('.alert');  alert.style.display='none';}</script>
        <div class="header--wrapper">
            <div class="header--title">
                <span>Welcome to,</span>
                <h2>Outlet Panel - Add Coupons</h2>
            </div>        
        </div>
        
        <div class="col-md-12">
            <?php include('../message.php');?><script>function closeAlert(){var alert = document.querySelector('.alert');  alert.style.display='none';}</script>
            <div class="card">
                <div class="card-header">
                    <h4>Your Coupons
                        <a href="coupon-add.php" class="btn btn-dark float-end">Create Coupons</a>
                    </h4>
                </div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Discount Amount (BDT)</th>
                                <th>Expiration Date</th>
                                <th>Outlet</th>
                                <th>Action</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $id = $_SESSION['id'];
                            $query = "SELECT c.*, f.name AS fname FROM `coupons` c, `franchise` f, `user` u WHERE c.franchise_id = f.id AND f.user_id = u.id AND u.id = $id";
                            $query_run = mysqli_query($db, $query);

                            if (mysqli_num_rows($query_run) > 0) 
                            {
                                foreach($query_run as $row) 
                                {
                                    ?>
                                        <tr>
                                            <td><?= $row['id'] ?></td>
                                            <td><?= $row['title'] ?></td>
                                            <td><?= $row['description'] ?></td>
                                            <td><?= $row['discount_amount'] ?></td>
                                            <td><?= $row['expiration_date'] ?></td>
                                            <td><?= $row['fname'] ?></td>
                                            <td><a href="coupon-edit.php?id=<?= $row['id'] ?>" class="btn btn-dark">Edit</a></td>
                                            <td>
                                                <form action="../inc/server.php" method="POST">
                                                    <button type="submit" name="coupon_delete" value="<?=$row['id'] ?>" class="btn btn-danger">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php
                                }
                            }
                            else 
                            { 
                                ?>
                                    <tr>
                                        <td colspan="8">No Record Found</td>
                                    </tr>
                                <?php
                                    
                            }
                                ?>
                                
                                
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    
</body>
</html>