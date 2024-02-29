<html lang="en">
<head>
    <link rel="shortcut icon" href="img/ReviewIT.png" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>    
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Login</title>
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
        <form action="login.php" method="post" > 
            <div class="login">         
            <?php include('errors.php'); ?> 
                <div class="container">
                    <h1>Login</h1>
                    <p>Enter Your Credentials</p>
                    <hr class="mb-3">
                        <div >
                            <label class="header">Username</label>
                            <input id="username" type="text" name="username" placeholder="Username">
                        </div><br>
                        <div>
                            <label class="header">Password</label>
                            <input id="password" type="password" name="password" placeholder="Password">
                        </div><br>        
                        <p>
                            Not a member yet ? Register Now ! <a href="registration.php">Sign Up</a>
                        </p>                
                    <hr class="mb-3">
                    <input type="submit" class="signin" id="signin" name="login" value="Login">
                </div>
            </div>  
        </form>
    </div>
</body>
</html>