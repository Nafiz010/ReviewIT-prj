<?php include ('../inc/server.php');
    if (!isset($_SESSION['username'])) 
    {
        header('location: ../login.php');
    }
    $usr_id = $_SESSION['id'];
    
?>
<html lang="en">
<head>
    <link rel="shortcut icon" href="../img/ReviewIT.png" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>  
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../css/home.css">
    <script type="text/javascript" src="../js/outlet_review_submit.js"></script>
    <title>Home - Orders</title>    
</head>
<body style="display: flex;flex-direction: column; position: relative; padding-bottom: 120px;">
    <div class="hed" >
        <nav>
            <a href = "../index.php"><img src="../img/ReviewIT.png" alt="logo" class="logo"></a>
            <ul>
            <li><a href="../index.php">Home</a></li>
            <li><a href="home-restaurants.php">Restaurants</a></li>
            <li><a href="home-orders.php">Orders</a></li>
            </ul>
            <button class="btn"><a href="../login.php?logout='1'"><img src="../img/logout.png" alt="Signup">Logout</a></button>
        </nav>
    </div>

    <div class="container"><?php include('../message.php');?><script>function closeAlert(){var alert = document.querySelector('.alert');  alert.style.display='none';}</script>
        <h1 class="text-center"><hr>View Your Orders <hr></h1>
    </div>

    <?php
    
        $query = "SELECT o.*, i.name AS iname, i.image AS images, f.name AS fname FROM `order` o, `items` i, `franchise` f WHERE o.item_id = i.id AND i.franchise_id = f.id AND o.user_id = '$usr_id'";
        $query_run = mysqli_query($db, $query);
        $check_outlet = mysqli_num_rows($query_run) > 0;

        if ($check_outlet) {
            while($row = mysqli_fetch_array($query_run))
            {
                ?>

                <div class="container mt-5">
                    <div class="row">
                        <div class="col-md-4">
                            <img src="../img/<?= $row['images'];?>" style="width:255px; height:250px" alt="Outlet Image">
                        </div>
                        <div class="col-md-7 ml-5">
                            <h2 class="fw-bold">Order ID : <?= $row['id']; ?></h2>
                            <hr>
                            <hr>
                            <h2 class="fw-bold">Item Name : <?= $row['iname']; ?></h2>
                            <hr>
                            <hr>
                            <h4>Outlet Name : <?= $row['fname'];?></h4>
                            <hr>
                            <hr><h4>Quantity : <?= $row['quantity'];?></h4>
                            <hr>
                            <hr><h4>Price (BDT) : <?= $row['price'];?></h4>
                            <hr>
                            <form action="../inc/server.php" method="POST">
                                <button class="btn btn-danger" type="submit" name="uorder_delete" value="<?=$row['id'] ?>" style="color: white"><i class="fa-solid fa-trash"></i> Delete Order</button>
                            </form>
                        </div>
                    </div><br><hr>
                </div>

                <?php
            }
            }
            else {?><br>
                <div class="msg" style="text-align:center">
                    <h1><?php echo "You Have Placed No Orders !";?></h1>
                </div>
                <?php
            }
       
   ?>    


</div>
    <?php
    include ('../inc/footer.php');
    ?>
</body>
</html>