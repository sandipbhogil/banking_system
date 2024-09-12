<?php
session_start();
// Set connection variables
$server = 'localhost';
$username = 'root';
$password = '';
$database = 'project';

// Create database connection
$con = mysqli_connect($server, $username, $password, $database);

// Check for connection success
if (!$con)
 {
    die("Connection to database failed due to " . mysqli_connect_error());
}

if (isset($_SESSION['user']) && isset($_SESSION['pass'])) 
{
    //access session variables
    $uname=$_SESSION['user'];
    $up=$_SESSION['pass'];

    //fetch user from database
    $query="select * from user where email='$uname' && password='$up'";
    $result=mysqli_query($con,$query);
    $row=mysqli_fetch_assoc($result);
    $name=$row['name'];
    $email=$row['email'];
    $phno=$row['phno'];
    $balance=$row['balance'];

    if($_SERVER['REQUEST_METHOD']== 'POST')
    {
    //accept user entered pin for check balance
    $upin=$_POST['pin'];
            
    //checking pin is right for check balance
    $dpin=$row['pin'];

    //checking pin match
    $pmatch1=false;
    if($upin==$dpin)
    {
        $pmatch1=true;
    }
    else
    {
        $pmatch1=false; 
    }
 }
   
}
else
{
    header("location: index.php");
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile</title>
    <!-- Include Bootstrap CSS and Font Awesome for icons -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="profile.css"></link>
  </head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
        <!-- Toggle button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Collapsible wrapper -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Navbar brand -->
            <a class="navbar-brand" href="home.php">
                <img src="bank.png" height="30" alt="Logo" loading="lazy" />
            </a>
            <!-- Left links -->
            <ul class="navbar-nav mr-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="home.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="customer.php">Contacts</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="transfer.php">Transfer</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="history.php">History</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about_us.php">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact_us.php">Contact Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">My Profile</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

    <section class="bg-light">
     <div class="container">
        <div class="row">
            <div class="col-lg-12 mb-4 mb-sm-5">
                <div class="card card-style1 border-0">
                    <div class="card-body p-1-9 p-sm-2-3 p-md-6 p-lg-7">
                        <div class="row align-items-center">
                            <div class="col-lg-6 mb-4 mb-lg-0">
                                <img src="user avtar.png" alt="user" height="200" width="200">
                            </div>
                            <div class="col-lg-6 px-xl-10">
                                <div class="bg-secondary d-lg-inline-block py-1-9 px-1-9 px-sm-6 mb-1-9 rounded">
                                    <h3 class="h2 text-white mb-0">
                                        <?php
                                        if (isset($_SESSION['user']) && isset($_SESSION['pass'])) 
                                        {
                                             echo "$name";
                                        }
                                        ?>
                                        </h3>
                                    <span class="text-primary">user</span>
                                </div>
                                <ul class="list-unstyled mb-1-9">
                                    <li class="mb-2 mb-xl-3 display-28"><span class="display-26 text-secondary me-2 font-weight-600">User Status : </span> Active</li>
                                    <li class="mb-2 mb-xl-3 display-28"><span class="display-26 text-secondary me-2 font-weight-600">Email:</span> 
                                    <?php
                                    if (isset($_SESSION['user']) && isset($_SESSION['pass'])) 
                                    {
                                      echo "$email";
                                    }
                                    ?>
                                    </li>
                                    <li class="display-28"><span class="display-26 text-secondary me-2 font-weight-600">Phone:</span> 
                                    <?php
                                    if (isset($_SESSION['user']) && isset($_SESSION['pass'])) 
                                    {
                                        echo "$phno";
                                    }
                                        ?>
                                </li>
                                </ul>
</div>
</div>
</div>
</div>
</div>
</div> 
</section>
<br><br><br>

<form action="add_balance.php" method="post">
  <h2 align="center">Add balance to your account</h2>
  <br><br>
  <div class="container p-0">
    <div class="card px-4">
      <div class="row gx-3">
        <div class="col-12">
          <div class="d-flex flex-column">
            <p class="text mb-1 mt-3">Enter Amount</p> <!-- Added mt-3 for margin-top -->
            <input class="form-control mb-3" type="number" placeholder="0.000" name="amount" required>
          </div>
        </div>
        <div class="col-6">
          <div class="d-flex flex-column">
            <p class="text mb-1">CVV/PIN</p>
            <input class="form-control mb-3 pt-2" type="password" placeholder="***" name="pin" required>
          </div>
        </div>
        <div class="col-12">
          <input type="submit" class="btn btn-primary mb-3" value="Add">
        </div>
      </div>
    </div>
  </div>
</form><br><br><br><br><br><br><br><br>

<form action="profile.php" method="post">
  <h2 align="center">Check balance of your account</h2>
  <br><br>
  <div class="container p-0">
    <div class="card px-4">
      <div class="row gx-3">
        <div class="col-12">
          <div class="d-flex flex-column">
            <p class="text mb-1 mt-3">Enter CVV/PIN</p> <!-- Added mt-3 for margin-top -->
            <input class="form-control mb-3" type="number" placeholder="***" name="pin" required>
          </div>
        </div>
        <div class="col-6">
          <div class="d-flex flex-column">
            <p class="text mb-1"></p>
            <p class="form-control mb-3 pt-2" name="balance">
            <?php
            if($_SERVER['REQUEST_METHOD']=='POST')
            {
             if ($pmatch1==false) 
             {
                 echo '<script>alert("incorrect pin")</script>';
             }
             else if ($_SERVER['REQUEST_METHOD'] == 'POST') 
                {
                    echo "$balance";
                }
            }
            ?>   
            </p>
          </div>
        </div>
        <div class="col-12">
          <input type="submit" class="btn btn-primary mb-3" value="Check">
        </div>
      </div>
    </div>
  </div>
</form>
<br><br><br><br><br><br>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.3.2/mdb.umd.min.js"></script>
</body>
</html>

