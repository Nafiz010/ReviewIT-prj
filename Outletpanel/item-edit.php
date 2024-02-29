<?php include('../errors.php'); ?>
<html lang="en">
<head>
    <link rel="shortcut icon" href="../img/ReviewIT.png" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">    
    <link rel="stylesheet" href="../css/admin.css">
    <title>Outlet Panel - Edit Item</title>
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
                <h2>Outlet Panel - Edit Item</h2>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card">
                <?php include('../message.php');?><script>function closeAlert(){var alert = document.querySelector('.alert');  alert.style.display='none';}</script>
                <div class="card-header">
                    <h4>Edit Item Info
                        <a href="franchise-items.php" class="btn btn-danger float-end">BACK</a>
                    </h4>
                </div>
                <div class="card-body">

                    <?php
                    if (isset($_GET['id'])) {
                        $item_id = $_GET['id'];
                        $item = "SELECT i.*,f.id AS fid, f.name AS fname FROM items i, franchise f WHERE i.id='$item_id' AND f.id=i.franchise_id";
                        $item_run = mysqli_query($db, $item);

                        if (mysqli_num_rows($item_run) > 0) 
                        {
                            foreach($item_run as $fitem)
                            {                            
                            ?>                                
                            <form action="../inc/server.php" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="i_id" value="<?=$fitem['id'];?>">
                                <div class = "row">
                                    <div class="col-md-6 mb-3">
                                        <label for="">Item Name</label>
                                        <input type="text" name="name" value="<?= $fitem['name']?>" class="form-control">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="">Description</label>
                                        <input type="text" name="description" value="<?= $fitem['description']?>" class="form-control">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="">Price</label>
                                        <input type="text" name="price" value="<?= $fitem['price']?>" class="form-control">
                                    </div>

                                    <div class="col-md-2 mb-3">
                                        <label for="">Current Item Image</label>
                                        <img src="../img/<?php echo $fitem['image']; ?>"alt=" Alt img" style="max-width: 80%; height: 80%;">
                                    </div>

                                    
                                    <div class="col-md-6 mb-3">
                                        <label for="">Franchise Name</label>
                                        <select name="franchname" class="form-control">
                                            <option value="">--SELECT OUTLET--</option>
                                            <option value="<?= $fitem['fid']?>"><?= $fitem['fname']?></option>
                                        </select>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="">Item Picture</label>
                                        <input type="file" name="fileupload" class="form-control">
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <button type="submit" name="update_item" class="btn btn-primary">Update Item</button>
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