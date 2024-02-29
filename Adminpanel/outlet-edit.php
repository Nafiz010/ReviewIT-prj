<?php include('../inc/server.php'); ?>
<?php include('../errors.php'); ?>
<html lang="en">
<head>
    <link rel="shortcut icon" href="../img/ReviewIT.png" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">    
    <link rel="stylesheet" href="../css/admin.css">
    <title>Admin Panel - Edit Outlets</title>
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

    <div class="main--content">
        <div class="header--wrapper">
            <div class="header--title">
                <span>Welcome to,</span>
                <h2>Admin Panel - Edit Outlet</h2>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Outlet Info
                        <a href="admin-outlets.php" class="btn btn-danger float-end">BACK</a>
                    </h4>
                </div>
                <div class="card-body">

                    <?php
                    if (isset($_GET['id'])) {
                        $outlet_id = $_GET['id'];
                        $outlet = "SELECT * FROM franchise WHERE id='$outlet_id'";
                        $outlet_run = mysqli_query($db, $outlet);

                        if (mysqli_num_rows($outlet_run) > 0) 
                        {
                            foreach($outlet_run as $outlet)
                            {                            
                            ?>                                
                            <form action="../inc/server.php" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="outlet_id" value="<?=$outlet['id'];?>">
                                <div class = "row">
                                    <div class="col-md-6 mb-3">
                                        <label for="">Outlet Name</label>
                                        <input type="text" name="name" value="<?= $outlet['name']?>" class="form-control" required>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="">Description</label>
                                        <input type="text" name="description" value="<?= $outlet['description']?>" class="form-control" required>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="">Address</label>
                                        <input type="text" name="address" value="<?= $outlet['address']?>" class="form-control" required>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="">Availability</label>
                                        <input type="text" name="availability" value="<?= $outlet['availability']?>" class="form-control" required>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="">Phone Number</label>
                                        <input type="text" name="phone" value="<?= $outlet['phone']?>" class="form-control" required>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <label for="">Current Outlet Logo</label>
                                        <img src="../img/<?php echo $outlet['logo']; ?>"alt=" Current Outlet Logo" style="max-width: 40%; height: 40%;">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="">Outlet Logo</label>
                                        <input type="file" name="fileupload" value="<?= $outlet['logo']?>" class="form-control">
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <button type="submit" name="update_outlet" class="btn btn-primary">Update Outlet</button>
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