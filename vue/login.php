<?php
// Check if the 'error' parameter is set in the URL
$error = isset($_GET['error']) ? $_GET['error'] : null;

// Define an error message based on the error parameter
$error_message = '';
if ($error === '1') {
  $error_message = 'Invalid email or password. Please try again.';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Log In</title>
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../public/css/stylelogin.css">
</head>

<body>

  <div id="intro" class="bg-image shadow-2-strong">
    <div class="mask d-flex align-items-center h-100">
      <div class="container">
        <div class="row justify-content-center hh">
          <div class="col-xl-5 col-md-8 fm">
            <!-- Display error message if it exists -->
            <?php if (!empty($error_message)) : ?>
              <div class="alert alert-danger" role="alert">
                <?php echo $error_message; ?>
              </div>
            <?php endif; ?>

            <form onsubmit="return validateForm()" id="signin-form" class="bg-white rounded shadow-5-strong p-5" action="../model/logIn.php" method="post">
              <!-- Email input -->
              <div class="form-outline mb-4" data-mdb-input-init>
                <label for="email">
                  <h3>Log In</h3>
                </label>
                <input type="email" id="email" name="email" class="form-control" />
                <label class="form-label" for="email">Email address</label>
              </div>
              <!-- Password input -->
              <div class="form-outline mb-4" data-mdb-input-init>
                <input type="password" id="pwd" name="pwd" class="form-control" />
                <label class="form-label" for="pwd">Password</label>
              </div>
              <!-- Submit button -->
              <input type="submit" class="btn btn-primary btn-block" data-mdb-ripple-init> </input><br>
              <a href="signinpage.php">Sign in</a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- JavaScript -->
  <script>
    // Function to validate the form fields
    function validateForm() {
      // Retrieve form fields
      var email = document.getElementById("email").value;
      var password = document.getElementById("pwd").value;

      // Check if email is empty
      if (email.trim() === "") {
        alert("Please enter your email.");
        return false;
      }

      // Check if password is empty
      if (password.trim() === "") {
        alert("Please enter your password.");
        return false;
      }

      // If all validations pass, return true to submit the form
      return true;
    }
  </script>

  <!-- Bootstrap JS and dependencies -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>