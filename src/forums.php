<?php require_once('./include/sessions.php'); ?>
<?php require_once('./database/open-connection.php'); ?>
<?php require_once('./database/queries.php'); ?>
<?php require_once('./include/functions.php'); ?>
<?php
  // Check whether the user is logged in.
  confirm_user_authentication();
  $forumtype = $_GET['forum'];
  $query = get_related_threads($_SESSION['username'], $forumtype);
  $result = mysqli_query($connection, $query) or die(mysqli_error($connection));

  if(isset($_POST['action']))
  {
    $threadno = $_POST['threadno'];
    $rankno = $_POST['rankID'];
    if($_POST['action'] == 'thumsdown')
    {
      $query = rank_thread($rankno, $_SESSION['username'], 2, $threadno);
      mysqli_query($connection, $query) or die(mysqli_error($connection));
    }
    elseif ($_POST['action'] == 'thumbsup') {
      $query = rank_thread($rankno, $_SESSION['username'], 1, $threadno);
      mysqli_query($connection, $query) or die(mysqli_error($connection));
    }
    unset($query);
    redirect_to("forums.php?forum={$forumtype}");
  }


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, shrink-to-fit=no, initial-scale=1">
    <?php include "scripts.php"; ?>
    <link href="css/styles.css" rel="stylesheet">

    <!-- use jquery datatables -->
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
    <script type="text/javascript" src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
      $('#threadtable').DataTable();
    } );
    </script>

    <title>GyroChan</title>
    <!-- Bootstrap Core CSS -->
    <?php include "bootstrap.php"; ?>
    <?php include "navbar.php" ?>
    <?php include "header.html"; ?>
    <?php
    ?>

  </head>
  <body>
    <div class="container-fluid">
      <h1><?php echo $forumtype ?></h1>
      <a id="post_thread"  class="btn btn-default pull-right" href="newthread.php?forum=<?php echo $forumtype ?>">POST THREAD</a>
      <table class="display" cellspacing-"0" width="100%" id="threadtable">
        <thead class="thead-inverse">
        <th>Thread</th>
        <th>Description</th>
        <th>Created By</th>
        <th>Actions</th>
        </thead>
      <tbody>
      <?php
        while ($threads=mysqli_fetch_assoc($result)) {
            $thumbsup = '<i class="fa fa-thumbs-o-up" aria-hidden="true"></i>';
            $thumbsdown = '<i class="fa fa-thumbs-o-down" aria-hidden="true"></i>';
            echo "<tr>";
            echo "<td><a href='threads.php?thread={$threads['ThreadNo']}'>{$threads['Title']}</a></td>";
            echo "<td>{$threads['Content']}</td>";
            echo "<td><a href='profile.php?user={$threads['StartUser']}'>{$threads['StartUser']}</a></td>";
            if($threads['Ranking'] == 1)
            {
              $thumbsup = '<i class="fa fa-thumbs-up" aria-hidden="true"></i>';
            }
            else if ($threads['Ranking'] == 2)
            {
              $thumbsdown = '<i class="fa fa-thumbs-down" aria-hidden="true"></i>';
            }

            echo "<td>";
            echo "<form method='post' action='forums.php?forum={$forumtype}'>";
            echo "<input type='hidden' name='threadno' value='{$threads['ThreadNo']}'>";
            echo "<input type='hidden' name='rankID' value='{$threads['RankID']}'>";
            echo '<button type="submit" name="action" value="thumsdown">';
            echo $thumbsdown;
            echo '</button>';
            echo '<button type="submit" name="action" value="thumbsup">';
            echo $thumbsup;
            echo '</button>';
            echo '</form>';
            echo "</td>";
            echo "</tr>";
        }
      ?>
      </tbody>
      </table>
    </div>

  </body>
</html>

<?php
  require_once('./database/close-connection.php');
?>
