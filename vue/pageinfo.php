<?php
session_start();
if (!isset($_SESSION['id'])) {
  header('location: login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bootstrap Navbar with Cards</title>
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
    /* Add your custom styles here */
  </style>
</head>

<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
      <a class="navbar-brand" href="#"> Your Brand</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="pageinfo.php" id="homeLink">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#" id="qrCodeLink">My QR code</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../model/logout.php">Log out</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Main Content -->
  <div class="mt-5 mx-5">
    <div class="row" id="firstRow" style="display: none;">
      <div class="col">
        <div class="card">
          <div class="card-body d-flex justify-content-center">
            <div id="qr-imag">
              <!-- PHP code to generate the QR code URL dynamically -->
              <?php
              // Check if the session variable is set
              if (isset($_SESSION['id'])) {
                // Get the value from the session variable
                $id = $_SESSION['id'];
                // Generate the QR code URL with the session variable value
                $qr_code_url = "https://api.qrserver.com/v1/create-qr-code/?data=$id&size=100x600";
                // Output the QR code image
                echo "<img src=\"$qr_code_url\" alt=\"QR Code\">";
              }
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-6">
        <h2>Todays order</h2>
        <div class="card">
          <div class="card-body">
            <div class="table-responsive"> <!-- Add table-responsive class here -->
              <table class="table table-striped table-bordered" id="todaysOrder">
                <thead>
                  <tr>
                    <th>ProductID</th>
                    <th>ProductName</th>
                    <th>Price</th>
                    <th>Quantity</th>
                  </tr>
                </thead>
                <tbody>
                  
                </tbody>
              </table>
            </div>
            <div class="text-center">
              <div id="totalPrice" class="text-success">Total: $0.00</div>
            </div>
      </div>
        </div>
      </div>
      <div class="col-lg-6">
        <h2>Previous orders</h2>
        <div class="card">
          <div class="card-body">
            <div class="table-responsive"> <!-- Add table-responsive class here -->
              <table class="table table-striped table-bordered" id="previousOrders">
                <thead>
                  <tr>
                    <th>ProductID</th>
                    <th>ProductName</th>
                    <th>Price</th>
                    <th>Quantity</th>
                  </tr>
                </thead>
                <tbody>
                  
                </tbody>
             </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="../public/js/pageInfo.js"></script>
  <!-- Bootstrap JS and dependencies -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>