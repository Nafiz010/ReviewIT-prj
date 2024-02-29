<?php include ('../inc/server.php');
    if (!isset($_SESSION['username'])) 
    {
        header('location: ../login.php');
    }
    $usname = $_SESSION['username'];
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
    <script type="text/javascript" src="../js/item_review_submit.js"></script>
    <title>Home - Items</title>    
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

    <div class="container">
        <h1 class="text-center"><hr>View Item <hr></h1>
    </div>

    <?php
    if (isset($_GET['id'])) 
    {
        $item_id = $_GET['id'];
        $query = "SELECT * FROM `items` WHERE id='$item_id'";
        $query_run = mysqli_query($db, $query);
        $check_outlet = mysqli_num_rows($query_run) > 0;

        if ($check_outlet) {
            while($row = mysqli_fetch_array($query_run))
            {
                ?>

                <div class="container mt-5">
                    <div class="row">
                        <div class="col-md-4">
                            <img src="../img/<?= $row['image'];?>" style="width:100%; height:100%" alt="Outlet Image">
                        </div>
                        <div class="col-md-7 ml-5">
                            <h2 class="fw-bold">Item Name : <?= $row['name']; ?></h2>
                            <hr>
                            <h4>Description : <?= $row['description'];?></h4>
                            <hr>
                            <hr><h4>Price (BDT) : <?= $row['price'];?></h4>
                            <hr>
                            <button type="button" class="btn btn-dark" name="purchase" id="purchase" style="color: white"><i class="fa fa-shopping-cart me-2"></i> Purchase Item</button>
                        </div>
                    </div><br><hr>
                </div>

                <?php
            }
            }
            else {?><br>
                <div class="msg" style="text-align:center">
                    <h2><?php echo "No Items Available";?></h2>
                </div>
                <?php
            }
    }
    else {
        echo "Something went wrong";
    }    
   ?>
    <br>
    <div class="container">
    	<div class="card">
    		<div class="card-header">Review Us !!!!</div>
    		<div class="card-body">
    			<div class="row">
    				<div class="col-sm-4 text-center">
    					<h1 class="text-warning mt-4 mb-4">
    						<b><span id="average_rating">0.0</span> / 5</b>
    					</h1>
    					<div class="mb-3">
    						<i class="fas fa-star star-light mr-1 main_star"></i>
                            <i class="fas fa-star star-light mr-1 main_star"></i>
                            <i class="fas fa-star star-light mr-1 main_star"></i>
                            <i class="fas fa-star star-light mr-1 main_star"></i>
                            <i class="fas fa-star star-light mr-1 main_star"></i>
	    				</div>
    					<h3><span id="total_review">0</span> Review</h3>
    				</div>
    				<div class="col-sm-4">
    					<p>
                            <div class="progress-label-left"><b>5</b> <i class="fas fa-star text-warning"></i></div>

                            <div class="progress-label-right">(<span id="total_five_star_review">0</span>)</div>
                            <div class="progress">
                                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="five_star_progress"></div>
                            </div>
                        </p>
    					<p>
                            <div class="progress-label-left"><b>4</b> <i class="fas fa-star text-warning"></i></div>
                            
                            <div class="progress-label-right">(<span id="total_four_star_review">0</span>)</div>
                            <div class="progress">
                                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="four_star_progress"></div>
                            </div>               
                        </p>
    					<p>
                            <div class="progress-label-left"><b>3</b> <i class="fas fa-star text-warning"></i></div>
                            
                            <div class="progress-label-right">(<span id="total_three_star_review">0</span>)</div>
                            <div class="progress">
                                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="three_star_progress"></div>
                            </div>               
                        </p>
    					<p>
                            <div class="progress-label-left"><b>2</b> <i class="fas fa-star text-warning"></i></div>
                            
                            <div class="progress-label-right">(<span id="total_two_star_review">0</span>)</div>
                            <div class="progress">
                                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="two_star_progress"></div>
                            </div>               
                        </p>
    					<p>
                            <div class="progress-label-left"><b>1</b> <i class="fas fa-star text-warning"></i></div>
                            
                            <div class="progress-label-right">(<span id="total_one_star_review">0</span>)</div>
                            <div class="progress">
                                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="one_star_progress"></div>
                            </div>               
                        </p>
    				</div>
    				<div class="col-sm-4 text-center">
    					<h3 class="mt-4 mb-3">Write Review Here</h3>
    					<button type="button" name="add_item_review" id="add_item_review" class="btn btn-dark" style="align:center">Review</button>
    				</div>
    			</div>
    		</div>
    	</div>
    	<div class="mt-5" id="review_content"></div>
    </div>


    <!-- REVIEW MODAL -->
    <div id="review_item_modal" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Write Your Experience</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4 class="text-center mt-2 mb-4">
                        <i class="fas fa-star star-light submit_star mr-1" id="submit_star_1" data-rating="1"></i>
                        <i class="fas fa-star star-light submit_star mr-1" id="submit_star_2" data-rating="2"></i>
                        <i class="fas fa-star star-light submit_star mr-1" id="submit_star_3" data-rating="3"></i>
                        <i class="fas fa-star star-light submit_star mr-1" id="submit_star_4" data-rating="4"></i>
                        <i class="fas fa-star star-light submit_star mr-1" id="submit_star_5" data-rating="5"></i>
                    </h4>
                    <input type="hidden" name="it_id" id="it_id" value="<?= $item_id ?>">
                    <input type="hidden" name="usr_id" id="usr_id" value="<?= $usr_id ?>">
                    <div class="form-group"><label>Enter Your Order ID</label>
                        <input type="text" name="order_id" id="order_id" class="form-control" placeholder="Order Number" />
                    </div>
                    <div class="form-group"><label>Enter Your Username</label>
                        <input type="text" name="user_name" id="user_name" class="form-control" placeholder="Username" value="<?= $usname ?>" />
                    </div>
                    <div class="form-group"><label>Your Review</label>
                        <textarea name="user_review" id="user_review" class="form-control" placeholder="Type Your Review Here !"></textarea>
                    </div>
                    <div class="form-group text-center mt-4">
                        <button type="button" class="btn btn-dark" id="save_item_review">Submit Your Review</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- PURCHASE MODAL -->
    <div id="purchase_modal" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" style="text-align:center">Order Now !</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="it_id" id="it_id" value="<?= $item_id ?>">
                    <input type="hidden" name="usr_id" id="usr_id" value="<?= $usr_id ?>">                    
                    <div class="form-group"><label>Quantity</label>
                        <input type="text" name="quantity" id="quantity" class="form-control" placeholder="Quantity" />
                    </div>
                    <?php
                        $query = "SELECT uc.*, c.id AS id, c.title AS title FROM `coupons` c, `user_coupons` uc, `franchise` f, `items` i 
                        WHERE c.franchise_id = f.id AND i.franchise_id = f.id AND i.id = $item_id AND c.id = uc.coupon_id AND uc.user_id = $usr_id";
                        $query_run = mysqli_query($db, $query);
                    ?>
                    <div class="col-md-6 mb-3">
                        <label for="">Coupons</label>
                        <select name="coupon" id="coupon" class="form-control">
                            <option value="">--SELECT COUPON--</option>
                            <?php while($row = mysqli_fetch_array($query_run)):;?>
                            <option value="<?= $row['id']?>"><?php echo $row['title'];?></option>
                            <?php endwhile;?>
                        </select>
                    </div>
                    <div class="form-group text-center mt-4">
                        <button type="button" class="btn btn-dark" id="order">Place Your Order</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
    <?php
    include ('../inc/footer.php');
    ?>
</body>
</html>