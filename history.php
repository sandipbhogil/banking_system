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
    // Access session variables
    $uname = $_SESSION['user'];
    $up = $_SESSION['pass'];
    
        //match user details
        $query2="select sno from user where email='$uname' && password='$up'";
        $result7=mysqli_query($con,$query2);
        $row7=mysqli_fetch_assoc($result7);
        $id=$row7['sno'];
        
       

//retrive hisory in table
$query="select * from history where uno='$id' order by sno desc LIMIT 20";
$result=mysqli_query($con,$query);
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History</title>
</head>
<body>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
  <!-- MDB -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.3.2/mdb.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="home.css">
</head>

<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <!-- Container wrapper -->
    <div class="container-fluid">
      <!-- Toggle button -->
      <button data-mdb-collapse-init class="navbar-toggler" type="button" data-mdb-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fas fa-bars"></i>
      </button>

      <!-- Collapsible wrapper -->
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Navbar brand -->
        <a class="navbar-brand mt-2 mt-lg-0" href="#">
          <img src="bank.png" height="15" alt="Logo" loading="lazy" />
        </a>
        <!-- Left links -->
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="home.php">Home</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="customer.php">Customers</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="transfer.php">Transfer</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="#">History</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="about_us.php">About Us</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="contact_us.php">Contact Us</a>
          </li>
          <li class="nav-item">
                    <a class="nav-link" href="profile.php">My Profile</a>
                </li>
        </ul>
      </div>
    </div>
  </nav><br><br><br><br>
  <table class="table table-dark table-hover ">
    <tr>
      <th>Sno</th>
      <th>Receiver name</th>
      <th>Amount</th>
      <th>Date & Time</th>
</tr>

<?php
$cnt=0;
while($row=mysqli_fetch_assoc($result))
{
  
  $cnt++;
  
  ?>
<tr>

    <td><?php echo $cnt ?></td>
    <td><?php echo $row['rname'];?></td>
    <td><?php echo $row['amount'];?></td>
    <td><?php echo $row['time'];?></td>
      
</tr>
<?php
}
?>
  </table>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.3.2/mdb.umd.min.js"></script>
</body>

</html>