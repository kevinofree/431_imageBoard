<?php require_once('./include/sessions.php'); ?>
<?php require_once('./database/open-connection.php'); ?>
<?php require_once('./database/queries.php'); ?>
<?php require_once('./include/functions.php'); ?>
<?php
  // Check whether the user is logged in.
  confirm_user_authentication();

  $threadNo = $_GET['thread'];
  $query = get_posts($threadNo);
  $result = mysqli_query($connection, $query) or die(mysqli_error($connection));

  //Get Thread Info
  $getThread = get_thread_info($threadNo);
  $threadinfo = mysqli_query($connection, $getThread);
  $threadres = mysqli_fetch_assoc($threadinfo);


  if(isset($_POST['post-submit']))
  {
    // Get form data
    $post = $_POST['content'];

    // Get the clients username stored in the session
    $username = $_SESSION['username'];

    // Check if file was uploaded
    if(is_uploaded_file($_FILES['image']['tmp_name'])){
      // Santize image before inserting into mysql
      $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
      $query = post_reply($username, $post, $image, $threadNo);
    }
    else{
      // No file was uploaded
      $query = post_reply($username, $post, "", $threadNo);
    }

    // Perform the query on the database
    $result = mysqli_query($connection, $query);

    // Check if the query contained any errors
    if($result)
    {
      // Post created success message
      $_SESSION['success_message'] = 'Post Submitted!';
      redirect_to("threads.php?thread={$threadNo}");
    }
    else
    {
      // Post failed to be created
      $_SESSION['fail_message'] = "Failed to Submit.";

    }
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, shrink-to-fit=no, initial-scale=1">
    <link href="css/styles.css" rel="stylesheet">
    <title>GyroChan</title>
    <!-- Bootstrap Core CSS -->
    <?php include "bootstrap.php"; ?>
    <?php include "navbar.php" ?>
    <?php include "header.html"; ?>
    <?php
    ?>
  </head>
  <body>
    <div clas="container-fluid">
      <h1 class="text-center" style="font-family: 'Press Start 2P', cursive;"><?php echo $threadres['Title']; ?></h1>
        <div class="col-lg-5 col-lg-offset-3">
          <form method="POST" enctype="multipart/form-data">
            <?php
              if(isset($_SESSION['success_message']))
              {
                echo '<div class="alert alert-success text-center">' . $_SESSION['success_message'] . '</div>';
              }
              if(isset($_SESSION['fail_message']))
              {
                echo '<div class="alert alert-danger text-center">' . $_SESSION['fail_message'] . '</div>';
              }
            ?>
            <br>
            <div class="form-group">
              <label for="content">Reply</label>
                <textarea class="form-control" rows="5" name ="content" placeholder="Reply text here..." required></textarea>
            </div>
            <div class="form-group">
              <input type="file" name="image">
            </div>
            <hr>
            <button type="submit" name="post-submit" class="btn btn-primary">Submit</button>
          </form>
          <br>
        </div>
      </div>
      <hr>
      <div class="container-fluid">
        <table class="table table-hover">
          <thead>
            <th>User</th>
            <th>Image</th>
            <th>Post</th>
            <th>Date</th>
            <th>Actions</th>
          </thead>
        <tbody>
          <?php
            while ($reply=mysqli_fetch_assoc($result)) {
                $date = strtotime($reply['PostDate']);
                echo "<tr>";
                echo "<td><a href='profile.php?user={$reply['Poster']}'>{$reply['Poster']}</a></td>";
                if($reply['Image'] != ""){
                  echo '<td><img src="data:image/jpeg/;base64,' .
                        base64_encode($reply['Image']) .
                        '" height="300" width="300" /></td>';
                }
                else {
                  echo "<td> </td>";
                }
                echo "<td>{$reply['PostText']}</td>";
                echo "<td>" . date('j F Y', $date) . "</td>";
                if($_SESSION['username'] == $reply['Poster'] ){
                  echo "<td><a href='editpost.php?pid={$reply['PostNo']}&tid={$threadNo}'>Edit</a></td>";
                }else {
                  echo "<td></td>";
                }
                echo "</tr>";
            }
          ?>
        </tbody>
        </table>
      </div>
    </div>
  </body>
<!DOCTYPE html>
</html>
<?php
  unset($_SESSION['register_page']);
  unset($_SESSION['success_message']);
  unset($_SESSION['fail_message']);

  require_once('./database/close-connection.php');
?>
