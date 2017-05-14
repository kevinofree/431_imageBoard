<?php require_once('./include/sessions.php'); ?>
<?php require_once('./database/open-connection.php'); ?>
<?php require_once('./database/queries.php'); ?>
<?php require_once('./include/functions.php'); ?>
<?php
  // Check whether the user is logged in.
  confirm_user_authentication();
  confirm_admin_authentication();

  $button = "new-request";
  $buttontxt = "Create Forum";

  if (isset($_GET['reqID'])) {
    $req = $_GET['reqID'];
    $query = get_request($req);
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
    $request = mysqli_fetch_assoc($result);
    $userRequest = true;
    $button = "makechoice";
    $buttontxt = "Make Choice";
    unset($query);
  }

  //create forum if its a request
  if (isset($_POST['makechoice'])) {
    // Get form data
    $forumName = $_POST['ForumName'];
    $descr = $_POST['Description'];
    $mod = $_POST['mod'];
    $image = addslashes(file_get_contents($_FILES['upload-image']['tmp_name']));
    $option = $_POST['choice'];
    $reqID = $_POST['request-id'];

    if($option == 'approve')
    {
      $query = create_forum($forumName, $mod, $image, $descr);
      $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
      $_SESSION['approved'] = "The Forum Request was Approved";
    }else {
      $_SESSION['denied'] = "The Forum Request was Denied";
    }

    unset($query);
    $query = delete_request($reqID);
    $result = mysqli_query($connection, $query);
  }

  if (isset($_POST['Create-Forum'])) {
    // Get form data
    $forumName = $_POST['ForumName'];
    $descr = $_POST['Description'];
    $mod = $_POST['mod'];
    $image = addslashes(file_get_contents($_FILES['upload-image']['tmp_name']));
    $option = $_POST['choice'];
    $reqID = $_POST['request-id'];

    $query = create_forum($forumName, $mod, $image, $descr);
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));

    unset($query);
    $query = delete_request($reqID);
    $result = mysqli_query($connection, $query);
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
                          if (isset($_SESSION['approved'])) {
                              echo '<div class="alert alert-success text-center">' . $_SESSION['approved'] . '</div>';
                          }
                          if (isset($_SESSION['denied'])) {
                              echo '<div class="alert alert-danger text-center">' . $_SESSION['denied'] . '</div>';
                          }
                        ?>
                        <form method="post" enctype="multipart/form-data">
                          <div class="form-group">
                            <label for="forum">Forum Name</label>
                            <input type="text" class="form-control" name="ForumName" id="forum" placeholder="Forum Name" value="<?php echo $request['FName']; ?>" required>
                          </div>
                          <div class="form-group">
                            <label for="requestor">Forum Moderator</label>
                            <input type="text" class="form-control" name="mod" id="requestor" placeholder="Forum Mod" value="<?php echo $request['RequestedBy']; ?>" required>
                          </div>
                          <hr>
                          <div class="form-group">
                            <label for="descr">Forum Description</label>
                            <textarea id="descr" class="form-control" rows="5" name ="Description" placeholder="Forum Description"  required><?php echo $request['Description']; ?></textarea>
                          </div>
                            <?php
                            if($userRequest)
                            {
                              echo "
                              <div class='form-group'>
                                <label class='radio-inline'>
                                  <input type='radio' name='choice' value='approve'>Approve
                                </label>
                                <label class='radio-inline'>
                                  <input type='radio' name='choice' value='deny'>Deny
                                </label>
                              </div>
                              <input type='hidden' name='request-id' value='{$req}'>
                              ";
                            }
                            ?>
                          <div class="form-group">
                            <label for="upload-image">Select A Forum Image</label>
                            <input type="file" name="upload-image" id="upload-image">
                          </div>
                          <button type="submit" name="<?php echo $button ?>" class="btn btn-primary"><?php echo $buttontxt; ?></button>
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
  unset($_SESSION['approved']);
  unset($_SESSION['denied']);
?>
