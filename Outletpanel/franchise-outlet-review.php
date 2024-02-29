<?php include('../inc/server.php'); ?>
<html lang="en">
<head>
    <link rel="shortcut icon" href="../img/ReviewIT.png" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">    
    <link rel="stylesheet" href="../css/admin.css">
    <title>Outlet Panel - Outlet Reviews</title>
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

    <div class="container">
        <div class="main--content">
            <div class="header--wrapper">
                <div class="header--title">
                    <span>Welcome to,</span>
                    <h2>Outlet Panel - Outlet Reviews</h2>
                </div>
            </div>

            <div class="col-md-12">
                <?php include('../message.php');?><script>function closeAlert(){var alert = document.querySelector('.alert');  alert.style.display='none';}</script>
                <div class="card">
                    <div class="card-header">
                        <h4>User Reviews</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Ratings</th>
                                    <th>Reviews</th>
                                    <th>Outlet</th>
                                    <th>Username</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $uid = $_SESSION['id'];
                                $query = "SELECT fr.*, f.name AS fname, u.username AS uname FROM `franchise_review` fr, `franchise` f, `user` u, `pending_review` pr WHERE pr.franchise_review = fr.id AND pr.approval = 'Approved' AND fr.user_id = u.id AND fr.franchise_id = f.id AND f.user_id = $uid";
                                $query_run = mysqli_query($db, $query);

                                if (mysqli_num_rows($query_run) > 0) 
                                {
                                    foreach($query_run as $row) 
                                    {
                                        ?>
                                            <tr>
                                                <td><?= $row['id'] ?></td>
                                                <td><?= $row['rating_number'] ?></td>
                                                <td><?= $row['comments'] ?></td>
                                                <td><?= $row['fname'] ?></td>
                                                <td><?= $row['uname'] ?></td>                                            
                                                <td><a href="franchise-outlet-coupon.php?id=<?= $row['id'] ?>" class="btn btn-danger">Provide Coupon</a></td>
                                            </tr>
                                        <?php
                                    }
                                }
                                else 
                                { 
                                ?>
                                    <tr>
                                        <td colspan="6">No Record Found</td>
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
    </div>
</body>
</html>