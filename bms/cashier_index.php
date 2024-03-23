<?php
    $con = new mysqli('localhost','root','','bank');
session_start();
if(!isset($_SESSION['cashid'])){ header('location:cashier_index.php');}
?><!DOCTYPE html>

<html lang="en">
<head>
      <meta charset="utf-8">
      <title>Bank</title>
      <link href="images/bankl.jpg" rel="icon">
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Merienda+One">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="assets/css/home.scss">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
   <body>
      <nav>
      
         <div class="logo" >
         <img src="images/bankl.jpg" width="45" alt="" class="logo-img">
          Bank
         </div>
        <style> 
        .logo-img{
            margin-bottom: -9px;
        }
        </style>
         <input type="checkbox" id="click">
         <label for="click" class="menu-btn">
         <i class="fas fa-bars"></i>
         </label>
         <ul>
            
         
            <li><a class="active" href="logout.php">Logout</a></li>
         </ul>
      </nav>

      <style>
    @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');
*{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Poppins', sans-serif;
} 
nav{
  display: flex;
  height: 80px;
  width: 100%;
  background: #1b1b1b;
  align-items: center;
  justify-content: space-between;
  padding: 0 50px 0 100px;
  flex-wrap: wrap;
}
nav .logo {
    color: #fff;
    font-size: 29px;
    font-weight: 600;
    /* left: 12px; */
    /* left: 27px; */
    /* align-content: baseline; */
    /* align-items: baseline; */
    margin-left: -24px;
}
nav ul{
  display: flex;
  flex-wrap: wrap;
  list-style: none;
}
nav ul li{
  margin: 0 5px;
}
.logo-img {
    margin-bottom: 6px;
}
nav ul li a{
  color: #f2f2f2;
  text-decoration: none;
  font-size: 18px;
  font-weight: 500;
  padding: 8px 15px;
  border-radius: 5px;
  letter-spacing: 1px;
  transition: all 0.3s ease;
}
nav ul li a.active,
nav ul li a:hover{
  color: #111;
  background: #fff;
}
nav .menu-btn i{
  color: #fff;
  font-size: 22px;
  cursor: pointer;
  display: none;
}
input[type="checkbox"]{
  display: none;
}
@media (max-width: 1000px){
  nav{
    padding: 0 40px 0 50px;
  }
}
@media (max-width: 920px) {
  nav .menu-btn i{
    display: block;
  }
  #click:checked ~ .menu-btn i:before{
    content: "\f00d";
  }
  nav ul{
    position: fixed;
    top: 80px;
    left: -100%;
    background: #111;
    height: 100vh;
    width: 100%;
    text-align: center;
    display: block;
    transition: all 0.3s ease;
  }
  #click:checked ~ ul{
    left: 0;
  }
  nav ul li{
    width: 100%;
    margin: 40px 0;
  }
  nav ul li a{
    width: 100%;
    margin-left: -100%;
    display: block;
    font-size: 20px;
    transition: 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
  }
  #click:checked ~ ul li a{
    margin-left: 0px;
  }
  nav ul li a.active,
  nav ul li a:hover{
    background: none;
    color: cyan;
  }
}
.content{
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  text-align: center;
  z-index: -1;
  width: 100%;
  padding: 0 30px;
  color: #1b1b1b;
}
.content div{
  font-size: 40px;
  font-weight: 700;
}
dl, ol, ul {
    margin-top: 12px;
    margin-bottom: 1rem;
}
</style>

  <div class="maincontainer">
    <div class="container py-5">
        <div class="row">
            <div class=" mx-auto">
                <div class="bg-white rounded-lg shadow-sm p-5">

                    <ul role="tablist" class="nav bg-light nav-pills rounded-pill nav-fill mb-3">
                        <li class="nav-item">
                            <h5><i class="fa fa-university fa-lg">&nbsp;Account Information</i></h5>
                        </li>
                    </ul>

                    <div class="tab-content">

                        <div id="nav-tab-card" class="tab-pane fade show active">
                            <!-- Buttons for different actions -->
                            <button class="btn btn-secondary mb-3" onclick="showAccountDetails()">Account Details</button>
                            <button class="btn btn-success mb-3" onclick="showWithdrawForm()">Withdraw</button>
                            <button class="btn btn-primary mb-3" onclick="showDepositForm()">Deposit</button>

                            <!-- Forms for account details, withdrawal, and deposit -->
                            <div id="accountDetailsForm" style="display: none;">
                                <form role="form" method="POST">
                                    <div class="form-group">
                                        <label>Account number</label>
                                        <input type="text" name="accountno" placeholder="Enter Your Account number" class="form-control" />
                                    </div>
                                    <button class="btn btn-secondary" type="submit" name="getAccountDetails">Get Account Info</button>
                                    <button class="btn btn-secondary" onclick="goBackToButtons()">Back</button>
                                </form>
                               
                            </div>

                            <div id="withdrawForm" style="display: none;">
                                <form role="form" method="POST">
                                    <div class="form-group">
                                        <label>Account number</label>
                                        <input type="text" name="accountno" placeholder="Enter Your Account number" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label>Amount to Withdraw</label>
                                        <input type="number" name="withdrawAmount" placeholder="Enter Amount" class="form-control" />
                                    </div>
                                    <button class="btn btn-success" type="submit" name="withdraw">Withdraw</button>
                                    <button class="btn btn-secondary" onclick="goBackToButtons()">Back</button>
                                </form>
                            </div>

                            <div id="depositForm" style="display: none;">
                                <form role="form" method="POST">
                                    <div class="form-group">
                                        <label>Account number</label>
                                        <input type="text" name="accountno" placeholder="Enter Your Account number" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label>Amount to Deposit</label>
                                        <input type="number" name="depositAmount" placeholder="Enter Amount" class="form-control" />
                                    </div>
                                    <button class="btn btn-primary" type="submit" name="deposit">Deposit</button>
                                    <button class="btn btn-secondary" onclick="goBackToButtons()">Back</button>
                                </form>
                                </div>
                        
                            <?php
// Check if the form for fetching account details is submitted
if (isset($_POST['getAccountDetails'])) {
    // Retrieve the account number from the form
    $accountno = $_POST['accountno'];
    
    // Perform a query to fetch the account details based on the provided account number
    $query = "SELECT * FROM useraccounts WHERE accountno = '$accountno'";
    $result = mysqli_query($con, $query);

    // Check if any rows are returned
    if ($result&&mysqli_num_rows($result) > 0) {
        // Fetch the data from the query result
        $row = mysqli_fetch_assoc($result);
        
        // Display the account details
        echo "<div class='row'>";
        echo "<div class='col'>";
        echo "<p>Account Number: " . $row['accountno'] . "</p>";
        echo "<p>Account Holder Name: " . $row['name'] . "</p>";
        echo "<p>Balance: Rs." . $row['deposit'] . "</p>";
        echo "<p>Phone: " . $row['phonenumber'] . "</p>";
        echo "</div>";
        echo "</div>";
        echo "<button class='btn btn-secondary' onclick='goBackToButtons()'>Back</button>";
    } else {
      // Display a message if no account is found with the provided account number
      echo "<div class='alert alert-danger'>Account with the provided account number does not exist.</div>";
    
  }
  
}

   ?>
  <?php
// PHP code to handle withdrawal
if (isset($_POST['withdraw'])) {
    $accountno = $_POST['accountno'];
    $query = "SELECT * FROM useraccounts WHERE accountno = '$accountno'";
    $result= mysqli_query($con, $query);
    $withdrawAmount = $_POST['withdrawAmount'];
    if ($result&&mysqli_num_rows($result) > 0) {
      // Fetch the data from the query result
      
    // Deduct the withdrawal amount from the account balance
    $query1 = "UPDATE useraccounts SET deposit = deposit - $withdrawAmount WHERE accountno = '$accountno'";
    $result1 = mysqli_query($con, $query1);

    if ($result1) {
        // Withdrawal successful
        echo "<script>alert('Withdrawal successful');</script>";
    } else {
        // Withdrawal failed
        echo "<script>alert('Failed to process withdrawal');</script>";
    }
}
else{
  echo "<script>alert('Invalid Account Number');</script>";
}
}

// PHP code to handle deposit
if (isset($_POST['deposit'])) {
    $accountno = $_POST['accountno'];
    $query = "SELECT * FROM useraccounts WHERE accountno = '$accountno'";
    $result= mysqli_query($con, $query);
    $depositAmount = $_POST['depositAmount'];
    if ($result&&mysqli_num_rows($result) > 0) {
    // Add the deposit amount to the account balance
    $query1 = "UPDATE useraccounts SET deposit = deposit + $depositAmount WHERE accountno = '$accountno'";
    $result1 = mysqli_query($con, $query1);

    if ($result1) {
        // Deposit successful
        echo "<script>alert('Deposit successful');</script>";
    } else {
        // Deposit failed
        echo "<script>alert('Failed to process deposit');</script>";
    }
}
else{
  echo "<script>alert('Invalid Account Number');</script>";
}
}
?>
<script>
    function showAccountDetails() {
        document.getElementById("accountDetailsForm").style.display = "block";
        document.getElementById("withdrawForm").style.display = "none";
        document.getElementById("depositForm").style.display = "none";
    }
    function showWithdrawForm() {
        document.getElementById("accountDetailsForm").style.display = "none";
        document.getElementById("withdrawForm").style.display = "block";
        document.getElementById("depositForm").style.display = "none";
    }

    function showDepositForm() {
        document.getElementById("accountDetailsForm").style.display = "none";
        document.getElementById("withdrawForm").style.display = "none";
        document.getElementById("depositForm").style.display = "block";
    }
    function goBackToButtons() {
        document.getElementById("accountDetailsForm").style.display = "none";
        document.getElementById("withdrawForm").style.display = "none";
        document.getElementById("depositForm").style.display = "none";
        document.getElementById('accountDetailsForm').style.display = "none";
    }
</script>