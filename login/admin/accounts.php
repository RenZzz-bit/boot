<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Kaagapay / Admin</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <style>
        /* General Body and Page Layout */
body {
  font-family: Arial, sans-serif;
  background-color: #f4f6f9; /* Light background for better contrast */
  margin: 0;
  padding: 0;
}

/* Sidebar */
#sidebar-wrapper {
  width: 250px;
  background-color: #2c3e50;
  color: #fff;
}

.sidebar-heading {
  font-size: 1.5rem;
  font-weight: bold;
  color: #FF5733;
  padding: 20px;
  text-align: center;
}

.list-group-item {
  background-color: white;
  border: none;
  color: #FF5733;
  font-size: 1rem;
}

.list-group-item:hover {
  background-color: #16a085;
  cursor: pointer;
}

/* Page Content Area */
#page-content-wrapper {
  width: 100%;
  padding: 20px;
}

/* Form Styling */
form {
  background-color: white;
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
  width: 100%;
  max-width: 700px;
  margin: 20px auto;
}

form label {
  font-size: 1rem;
  color: #333;
  margin-bottom: 10px;
  display: block;
}

form input[type="text"],
form textarea,
form input[type="file"] {
  width: 100%;
  padding: 10px;
  margin-bottom: 15px;
  border: 1px solid #ccc;
  border-radius: 4px;
  font-size: 1rem;
}

form textarea {
  resize: vertical;
  min-height: 150px;
}

form button {
  background-color: #FF5733; /* Green */
  color: white;
  padding: 10px 20px;
  border: none;
  border-radius: 4px;
  font-size: 1rem;
  cursor: pointer;
  width: 100%;
}

form button:hover {
  background-color: #FF5733; /* Darker green on hover */
}

/* Responsive Styles */
@media (max-width: 768px) {
  form {
    padding: 15px;
  }

  form button {
    padding: 12px 0;
  }
}

    </style>
    <body>
        <div class="d-flex" id="wrapper">
            <!-- Sidebar-->
            <div class="border-end bg-white" id="sidebar-wrapper">
                <div class="sidebar-heading border-bottom bg-light">Kaagapay / Admin</div>
                <div class="list-group list-group-flush">
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="admin.php">News Articles</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="accounts.php">User Accounts</a>
                    <!-- <a class="list-group-item list-group-item-action list-group-item-light p-3" href="#!">Overview</a>
                     <a class="list-group-item list-group-item-action list-group-item-light p-3" href="#!">Events</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="#!">Profile</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="#!">Status</a> -->
                </div>
            </div>
            <!-- Page content wrapper-->
            <div id="page-content-wrapper">
                <!-- Top navigation-->
                <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                    <div class="container-fluid">
                        <button class="btn text-white" id="sidebarToggle" style="background-color : #FF5733">Menu</button>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                                <!-- <li class="nav-item active"><a class="nav-link" href="#!">Home</a></li>
                                 <li class="nav-item"><a class="nav-link" href="#!">Link</a></li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="#!">Action</a>
                                        <a class="dropdown-item" href="#!">Another action</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#!">Something else here</a>
                                    </div>
                                </li> --> 
                            </ul>
                        </div>
                    </div>
                </nav>
                <!-- Page content-->
                <?php
                  include 'db.php';

                  // Fetch all unverified users
                  $query = "SELECT id, firstname, lastname, email FROM users WHERE verified = 0";
                  $result = $conn->query($query);

                  while($row = $result->fetch_assoc()){
                      echo "<div class='user'>
                              <p>{$row['firstname']} {$row['lastname']} ({$row['email']})</p>
                              <a href='admin_verify.php?id={$row['id']}'>Verify</a>
                            </div>";
                  }
?>=



        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
