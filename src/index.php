<?php require_once('./include/sessions.php'); ?>
<?php require_once('./database/open-connection.php'); ?>
<?php require_once('./database/queries.php'); ?>

<?php
  $query = get_forums();
  $result = mysqli_query($connection, $query);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>GyroChan</title>
    <?php include "bootstrap.php"; ?>
    <link href="css/index-style.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
  </head>
  <body>
    <?php include "navbar.php"; ?>
    <div class="container-fluid">
      <div class="jumbotron">
        <h1 style="font-family: 'Press Start 2P', cursive;">Welcome to GyroChan!</h1>
        <?php
          if(!isset($_SESSION['username']))
          {
            echo "<p class='lead'>
                  If you don't have an account, please <a href='register.php'><span id='register-link'>register</span></a>
                 </p>";
          }
        ?>
      </div>
      <hr>
    </div>

  <!-- Content here -->
    <div class="container-fluid">
      <h1>Forums</h1>
      <a id="post_thread"  class="btn btn-default pull-right" href="newthread.php?forum=<?php echo $forumtype ?>">Request New Forum</a>
      <table class="table table-striped table-bordered">
        <thead class="thead-inverse">
        <th></th>
        <th>Forum Topic</th>
        <th>Description</th>
        </thead>
      <tbody>
      <?php
        while($forums=mysqli_fetch_assoc($result))
        {
          echo "<tr>";
          echo "<td></td>";
          echo "<td><a href='forums.php?forum={$forums['ForumName']}'>{$forums['ForumName']}</a></td>";
          echo "<td>{$forums['Description']}</td>";
          echo "</tr>";
          //echo '<img style="max-height:220px" src="data:image/png;base64,' . base64_encode($forum['Picture']) .'">';
        }
        // Release the data from the database
        mysqli_free_result($result);
      ?>
      </tbody>
      </table>
    </div>


    <?php include "scripts.php"; ?>
  </body>
</html>

<?php
  require_once('./database/close-connection.php');
?>
