<?php require_once('./include/sessions.php'); ?>
<?php require_once('./database/open-connection.php'); ?>
<?php require_once('./database/queries.php'); ?>
<?php require_once('./include/functions.php'); ?>
<?php
  // Check whether the user is logged in.
  confirm_user_authentication();

  $spectator;

  if(isset($_GET['user']))
  {
    $user = $_GET['user'];
    $spectator = true;
  }
  else
  {
    // Cannot use username varible since navbar.php uses it to empty contents
    $user = $_SESSION['username'];
    $spectator = false;
  }

  // Get users information
  $query = get_user($user);

  // Perform the query on the database
  $result = mysqli_query($connection, $query);
  $user_info = mysqli_fetch_assoc($result);

  // Free the query variable
  unset($query);

  // User uploading their own profile pic
  if(isset($_POST['submitImage']))
  {
    // Get image data from the form
    $image = addslashes(file_get_contents($_FILES['upload-image']['tmp_name']));

    // Update image query
    $query = update_profile_image_query($user, $image);

    // Perform query
    $result = mysqli_query($connection, $query);

    if($result)
    {
      redirect_to("profile.php");
    }
    else
    {
      die("Database query failed. " . mysqli_error($connection));
    }

    // Free the query variable
    unset($query);
  }
?>

<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, shrink-to-fit=no, initial-scale=1">
    <title>GyroChan</title>
    <!-- Bootstrap Core CSS -->
    <?php include "bootstrap.php"; ?>
    <!-- Custom CSS -->
    <link href="css/sidebar.css" rel="stylesheet">
    <link href="css/profile-style.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <?php include "navbar.php" ?>
    <div id="wrapper">
      <?php include "sidebar.php"; ?>
        <!-- Page Content -->
      <div id="page-content-wrapper">
        <div class="container-fluid">
          <div class="col-md-12 main">
            <h1 class="page-header">Profile</h1>
            <div class="row">
              <div class="col-md-4">

                <?php echo '<img src="data:image/jpeg/;base64,' . base64_encode($user_info['ProfilePic']) . '" id="profile-pic-img" alt="profile-picture" class="img-circle" height="200" width="200" />'; ?>

                <?php
                  if(!$spectator)
                  { ?>
                    <form class="form-line" method="POST" enctype="multipart/form-data">
                      <div class="form-group">
                        <label for="upload-image">Select A Profile Image</label>
                        <input type="file" name="upload-image" id="upload-image">
                      </div>
                      <button type="submit" class="btn btn-primary btn-sm" id="submitImage" name="submitImage">Upload</button>
                    </form>
                <?php } ?>

              </div>
              <div id="userInfo" class="col-md-6">
                <p class="user-info">Name : <span id="fullname"><?php echo $user_info['Fullname'] ?></span></p>
                <p class="user-info">Username : <span class="username"><?php echo $user_info['Username'] ?></span></p>
                <p class="user-info">Status : <span id="status">
                  <?php
                    if($user_info['Status'] == 0) {
                      echo "Member";
                    } else if ($user_info['Status'] == 1) {
                      echo "Moderator";
                    } else {
                      echo "Administrator";
                    }
                  ?>
                  </span></p>

                <?php
                  if($spectator) { ?>
                    <br>
                    <p class="user-info">Send <span class="username"><?= $user ?> </span> a messsage</p>
                    <a href="composemail.php?user=<?php echo $user;?>"><img src="https://cdn2.iconfinder.com/data/icons/picol-vector/32/mailbox-128.png" alt="mailbox" width="75" height="75"></a>
                <?php } ?>
              </div>
            </div>
          </div>
        </div>
      </div>

      <?php
        mysqli_free_result($result);
      ?>

    </div>
    <!-- /#wrapper -->
    <?php include "scripts.php"; ?>
    <!-- Menu Toggle Script -->
    <script src="js/sidebar.js"></script>
  </body>
</html>
<?php require_once('./database/close-connection.php'); ?>
