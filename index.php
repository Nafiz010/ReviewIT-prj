<?php include ('inc/server.php');
    if (!isset($_SESSION['username'])) 
    {
        header('location: login.php');
    }


?>
<html lang="en">
<head>
    <link rel="shortcut icon" href="img/ReviewIT.png" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">   
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/home.css">
    <title>Home</title>    
</head>
<body style="display: flex;flex-direction: column; position: relative; padding-bottom: 120px;">
    <?php include('message.php');?><script>function closeAlert(){var alert = document.querySelector('.alert');  alert.style.display='none';}</script>
    <div class="hed">
        <nav>
            <a href = "index.php"><img src="img/ReviewIT.png" alt="logo" class="logo"></a>
            <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="Home/home-restaurants.php">Restaurants</a></li>
            <li><a href="Home/home-orders.php">Orders</a></li>
            </ul>
            <button class="btn"><a href="login.php?logout='1'"><img src="img/logout.png" alt="Signup">Logout</a></button>
        </nav>
    </div>

    <div class="home">
        <div class="main_slide">
            <div>
                <h1>Let the world know, <span>Review & Rate</span> Your Favourite Places</h1>
                <p>Write your experiences and your feedback. How and what you like or disliked, Your preferences and feedback means alot to us and everyone around you. Make an impact and make things better. Your reviews and ratings matter !!!! </p>
            </div>
            <div>
                <img src="img/R.png" alt="icon">
            </div>
        </div>
    </div>
    <div class="container">
        <h1 class="text-center"><hr>View Our Available Restaurants <hr></h1>
    </div>

    <div class="container py-5">
        <div class="row gy-4">

            <?php
            
            $query = "SELECT * FROM franchise ORDER BY name ASC";
            $query_run = mysqli_query($db, $query);
            $check_outlet = mysqli_num_rows($query_run) > 0;

            if ($check_outlet) {
                while($row = mysqli_fetch_array($query_run))
                {
                    ?>

                    <div class="col-md-3">
                        <div class="card h-100 w-100" style="box-shadow: 0 0 15px rgba(0, 0, 0, 0.4)">
                            <img src="img/<?php echo $row['logo']; ?>" style="width:100%; height: 50%" class="card-img-top" alt="outlet images">
                            <div class="card-body">                                
                                <h3 class="card-title"> <?php echo $row['name']; ?></h3>
                                <h4 class="card-title"> <?php echo $row['address']; ?></h4>
                                <h6 class="card-text"> <?php echo $row['description']; ?></h6>
                                <h6 class="card-text"> Available @ : <?php echo $row['availability']; ?></h6><br><br>
                                <button class="btn btn-dark"><a href="Home/home-outlet-info.php?id=<?= $row['id']; ?>" style="color: white; text-decoration:none">View Outlet</a></button>
                            </div>
                        </div>
                    </div>

                    <?php
                }
            }
            else {
                echo "No Outlets Available";
            }
            
            ?>


            
        </div>
    </div>
    
   
    <?php
    include ('inc/footer.php');
    ?>
</body>
</html>