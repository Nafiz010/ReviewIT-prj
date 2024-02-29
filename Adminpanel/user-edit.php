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
    <title>Admin Panel - Edit User</title>
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
                <h2>Admin Panel - Edit User</h2>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Edit User Info
                        <a href="admin-users.php" class="btn btn-danger float-end">BACK</a>
                    </h4>
                </div>
                <div class="card-body">

                    <?php
                    if (isset($_GET['id'])) {
                        $user_id = $_GET['id'];
                        $user = "SELECT * FROM user WHERE id='$user_id'";
                        $user_run = mysqli_query($db, $user);

                        if (mysqli_num_rows($user_run) > 0) 
                        {
                            foreach($user_run as $user)
                            {                            
                            ?>                                
                            <form action="../inc/server.php" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="user_id" value="<?=$user['id'];?>">
                                <div class = "row">
                                    <div class="col-md-6 mb-3">
                                        <label for="">Username</label>
                                        <input type="text" name="username" value="<?= $user['username']?>" class="form-control" required>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="">Password</label>
                                        <input type="password" name="password" class="form-control" required>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="">Email</label>
                                        <input type="text" name="email" value="<?= $user['email']?>" class="form-control" required>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="">Address</label>
                                        <input type="text" name="address" value="<?= $user['address']?>" class="form-control" required>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="">Phone Number</label>
                                        <input type="text" name="phone" value="<?= $user['phone']?>" class="form-control" required>
                                    </div>

                                    <div class="col-md-2 mb-3">
                                        <label for="">Current Profile Picture</label>
                                        <img src="../img/<?php echo $user['avatar']; ?>"alt=" Alt img" style="max-width: 60%; height: 60%;">
                                    </div>

                                    
                                    <div class="col-md-6 mb-3">
                                        <label for="">User Role</label>
                                        <select name="user_role" required class="form-control">
                                            <option value="">--SELECT ROLE--</option>
                                            <option value="1" <?= $user['user_role'] == '1' ? 'selected':'' ?>>Admin</option>
                                            <option value="2" <?= $user['user_role'] == '2' ? 'selected':'' ?>>Customer</option>
                                            <option value="3" <?= $user['user_role'] == '3' ? 'selected':'' ?>>Outlet Owner</option>
                                        </select>
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label for="">Profile Picture</label>
                                        <input type="file" name="fileupload" class="form-control">
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <button type="submit" name="update_user" class="btn btn-primary">Update User</button>
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