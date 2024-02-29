<?php include('../inc/server.php'); ?>
<html lang="en">
<head>
    <link rel="shortcut icon" href="../img/ReviewIT.png" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">    
    <link rel="stylesheet" href="../css/admin.css">
    <title>Admin Panel - Orders</title>
</head>
<body>
    <div class="sidebar">
        <div class="logo">
            <ul class="menu">
                <li class="active">
                    <a href="../adminpan.php">
                        <i class="fas fa-tachometer-alt">
                            <span>Dashboard</span>
                        </i>
                    </a>
                </li>
                <li>
                    <a href="admin-users.php">
                        <i class="fas fa-solid fa-circle-user">
                            <span>Users</span>
                        </i>
                    </a>
                </li>
                <li>
                    <a href="admin-user-roles.php">
                        <i class="fa-solid fa-users">
                            <span>User Roles</span>
                        </i>
                    </a>
                </li>
                <li>
                    <a href="admin-outlets.php">
                        <i class="fas fa-solid fa-shop">
                            <span>Outlets</span>
                        </i>
                    </a>
                </li>
                <li>
                    <a href="admin-items.php">
                        <i class="fa-solid fa-utensils">
                            <span>Items</span>
                        </i>
                    </a>
                </li>
                <li>
                    <a href="admin-orders.php">
                        <i class="fas fa-cart-shopping">
                            <span>Orders</span>
                        </i>
                    </a>
                </li>                
                <li>
                    <a href="admin-p-reviews.php">
                        <i class="fa-solid fa-star-half-stroke">
                            <span>Pending Reviews</span>
                        </i>
                    </a>
                </li>
                <li>
                    <a href="admin-outlet-review.php">
                        <i class="fa-solid fa-star">
                            <span>Outlet Reviews</span>
                        </i>
                    </a>
                </li>
                <li>
                    <a href="admin-item-review.php">
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
                    <h2>Admin Panel - Orders</h2>
                </div>
            </div>

            <div class="col-md-12">
                <?php include('message.php');?><script>function closeAlert(){var alert = document.querySelector('.alert');  alert.style.display='none';}</script>
                <div class="card">
                    <div class="card-header">
                        <h4>User Purchases</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Item Name</th>
                                    <th>Outlet</th>
                                    <th>Quantity</th>
                                    <th>Price(BDT)</th>
                                    <th>Username</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT o.id, o.quantity, o.price, f.name AS fname, i.name AS iname, u.username AS uname FROM `order` o, `items` i, `franchise` f, `user` u WHERE i.id = o.item_id AND i.franchise_id = f.id AND u.id = o.user_id ORDER BY o.id";
                                $query_run = mysqli_query($db, $query);

                                if (mysqli_num_rows($query_run) > 0) {
                                    foreach($query_run as $row) 
                                    {
                                        ?>
                                            <tr>
                                                <td><?= $row['id'] ?></td>
                                                <td><?= $row['iname'] ?></td>
                                                <td><?= $row['fname'] ?></td>
                                                <td><?= $row['quantity'] ?></td>
                                                <td><?= $row['price'] ?></td>
                                                <td><?= $row['uname'] ?></td>                                            
                                                <td>
                                                    <form action="../inc/server.php" method="POST">
                                                        <button type="submit" name="order_delete" value="<?=$row['id'] ?>" class="btn btn-danger">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php
                                    }
                                }
                                else { 
                                ?>
                                    <tr>
                                        <td colspan="7">No Record Found</td>
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