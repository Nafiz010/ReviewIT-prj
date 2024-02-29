<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="shortcut icon" href="img/ReviewIT.png" type="image/x-icon">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>User Registration</title>    
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    </head>
    <body>
        <div class="hed" >
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
        <div>
            <form action="registration.php" method="post" enctype="multipart/form-data">  
                <div class="signup"><?php include('errors.php'); ?><?php include('message.php');?><script>function closeAlert(){var alert = document.querySelector('.alert');  alert.style.display='none';}</script>        
                    <div class="container">
                        <h1>Registration</h1>
                        <p>Fill up the form with correct values</p>
                        <hr class="mb-3">
                            <div <?php if (isset($name_error)): ?>  <?php endif ?>>
                                <label class="header">Username</label>
                                <input id="username" type="text" name="username" placeholder="Username" >
                                <?php if (isset($name_error)): ?>	  	        
	                            <?php endif ?>
                            </div><br>

                            <div>
                                <label class="header">Password</label>
                                <input id="password" type="password" name="password" placeholder="Password" >
                            </div><br>

                            <div <?php if (isset($email_error)): ?>  <?php endif ?>>
                                <label class="header">Email</label>
                                <input id="email" type="text" name="email" placeholder="Email" >
                                <?php if (isset($email_error)): ?>	  	        
	                            <?php endif ?>
                            </div><br>

                            <div>
                                <label class="header">Address</label>
                                <input id="address" type="text" name="address" placeholder="Address" >
                            </div><br>

                            <div>
                                <label class="header">Phone Number</label>
                                <input id="phone" type="text" name="phone" placeholder="Phone Number" >
                            </div><br>

                            <div>
                                <label class="header">Profile Picture</label>
                                <input id="image" type="file" name="fileupload">
                            </div><br>
                            <p>
                                Already a member ? <a href="login.php">Login</a>
                            </p>
                        <hr class="mb-3">
                        <input type="submit" class="register" id="register" name="Register" value="Register">
                    </div>
                </div>  
            </form>            
        </div>
    </body>
</html>