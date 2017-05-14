<?php require_once('./include/sessions.php'); ?>
<?php require_once('./database/open-connection.php'); ?>
<?php require_once('./database/queries.php'); ?>
<?php require_once('./include/functions.php'); ?>
<?php
  // Check whether the user is logged in.
  confirm_user_authentication();
  confirm_admin_authentication();

  $forums = get_forums();
  $forumreq = mysqli_query($connection, $forums);

  if(isset($_POST['new-mod']))
  {
    $mod = $_POST['mod'];
    $forum = $_POST['forums'];
    $query = set_mod($forum, $mod);
    $result = mysqli_query($connection, $query);


    if($result)
    {
      $_SESSION['success'] = "New Mod Appointed";
    }
    else {
      $_SESSION['fail'] = "Could not appoint mod";
    }

    unset($query);
    unset($result);

    //update the status of the new mod in the DB
    $query = update_status($mod, 1);
    $result = mysqli_query($connection, $query);

    unset($query);
    unset($result);
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
  </head>

  <body>
    <?php include "navbar.php" ?>

    <div id="wrapper">
      <?php include "sidebar.php"; ?>

        <!-- Page Content -->
      <div id="page-content-wrapper">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-12">
                 <div class="container">
                  <div class="row">
                      <div class="col-lg-5 col-lg-offset-3">
                        <h1 class="text-center">New Forum</h1>
                        <br>
                        <?php
                          if (isset($_SESSION['success'])) {
                              echo '<div class="alert alert-success text-center">' . $_SESSION['success'] . '</div>';
                          }
                          if (isset($_SESSION['fail'])) {
                              echo '<div class="alert alert-danger text-center">' . $_SESSION['fail'] . '</div>';
                          }
                        ?>
                        <form method="post" enctype="multipart/form-data">
                          <div class="form-group">
                            <label for="forum">Forum Name</label>
                            <select class="form-control" name="forums">
                              <?php
                                while($getforum = mysqli_fetch_assoc($forumreq))
                                {
                                  echo "<option value='{$getforum['ForumName']}'>{$getforum['ForumName']}</option>";
                                }
                               ?>
                            </select>
                          </div>
                          <div class="form-group">
                            <label for="fmod">Forum Moderator</label>
                            <input type="text" class="form-control" name="mod" id="fmod" placeholder="Forum Mod" value="<?php echo $request['RequestedBy']; ?>" required>
                          </div>
                          <hr>
                          <button type="submit" name="new-mod" class="btn btn-primary">Assign New Mod</button>
                        </form>
                      </div>
                    </div>
                </div>
                <?php //include "mailform.php"?>
            </div>
          </div>
        </div>
      </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->
    <?php include "scripts.php"; ?>

    <!-- Menu Toggle Script -->
    <script src="js/sidebar.js"></script>
  </body>
</html>
<?php
  require_once('./database/close-connection.php');
  unset($_SESSION['success']);
  unset($_SESSION['fail']);
?>
