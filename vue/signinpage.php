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
            <form id="signin-form" class="bg-white rounded shadow-5-strong p-5" method="post" action="../model/signIn.php">
              <!-- Email input -->
              <div class="form-outline mb-4" data-mdb-input-init>
                <label for="email">
                  <h3>Sign in</h3>
                </label>
                <input type="email" id="email" name="email" class="form-control" />
                <label class="form-label" for="email">Email address</label>
              </div>
              <div class="form-outline mb-4" data-mdb-input-init>
                <input type="text" id="name" name="name" class="form-control" />
                <label class="form-label" for="name">Name</label>
              </div>
              <div class="form-outline mb-4" data-mdb-input-init>
                <input type="number" id="number" name="number" class="form-control" />
                <label class="form-label" for="number">Phone number</label>
              </div>
              <!-- Password input -->
              <div class="form-outline mb-4" data-mdb-input-init>
                <input type="password" id="pwd" name="pwd" class="form-control" />
                <label class="form-label" for="pwd">Password</label>
              </div>
              <!-- Submit button -->
              <button type="submit" class="btn btn-primary btn-block" data-mdb-ripple-init>Log in</button><br>
              <a href="login.php">Log in</a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS and dependencies -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <!-- AJAX Script -->

</body>

</html>