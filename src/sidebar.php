<?php require_once('./include/sessions.php'); ?>
<!-- Sidebar -->
<div id="sidebar-wrapper">
  <ul class="sidebar-nav">
    <li class="sidebar-brand">
      <a>Menu</a>
    </li>
    <li>
      <a href="profile.php">Your Profile</a>
    </li>
    <li>
      <a href="chatroomform.php">Start a Chatroom</a>
    </li>
    <li>
      <a href="chatroomlist.php">Join a Chatroom</a>
    </li>
    <li class="sidebar-brand">
      <a>Mailbox</a>
    </li>
    <li>
      <a href="composemail.php">Compose Mail</a>
    </li>
    <li>
      <a href="inbox.php">Inbox</a>
    </li>
    <li>
      <a href="sent.php">Sent</a>
    </li>
    <?php
      if($_SESSION['status'] == 2)
      {
        echo "
        <li class='sidebar-brand'>
          <a>Admin</a>
        </li>
        <li>
          <a href='requests.php'>Forum Requests</a>
        </li>
        <li>
          <a href='viewreq.php'>New Request</a>
        </li>
        ";
      }
     ?>
  </ul>
</div>
<!-- /#sidebar-wrapper -->
