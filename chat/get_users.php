<?php
  require_once('../server/DB.php');
  $db = DB::getInstance();
  $uid = $_SESSION['uid'];

  $query = "SELECT * FROM users WHERE id != $uid ORDER BY username ASC";
  $result = mysqli_query($db, $query);
  $table = "<table class='' id='users-table' style='margin: 40px auto; width:55%; border: 1px solid #000000' >
              <thead class='table-dark'>
                <th style = 'border-radius: 0%; background-color:#000000; Padding: 1%; text-align: center'>User</th>
                <th style = 'border-radius: 0%; background-color:#000000; Padding: 1%; text-align: center'>Status</th>
                <th style = 'border-radius: 0%; background-color:#000000; Padding: 1%; text-align: center'>Chat</th>
              </thead>";
  while($row = mysqli_fetch_assoc($result)){
    $rid = $row['id'];
    $username = $row['username'];
    $online = $row['online'];
    $last_timestamp = $row['last_timestamp'];

    $dot = "";
    $status = "Offline";

    if($online == 1){
      // $dotColor = "#198853";
      $chatColor = "#0E6DFD";
      $status = "Online";
    }
    else{
      // $dotColor = "#6C757D";
      $chatColor = "#6C757D";
      $status = "Offline";
    }

    $status = "<span class='receiver-public-statusText'>$status</span>";
    $table .= "
    <tr>
      <td class='fw-light' style='padding-left: 20px; border-radius: 0%; background-color:#ffffff; Padding: 1%; text-align: center; font-family: arial' >".ucfirst($username)."</td>
      <td style = 'border-radius: 0%; background-color:#ffffff; Padding: 1%; text-align: center ; font-family: Candara'>$status</td>
      <td style = 'border-radius: 0%; background-color:#ffffff; Padding: 1%; text-align: center'>
        <button class='btn btn-sm border-0' data-bs-toggle='modal' data-bs-target='#chatModal' data-bs-senderId='$uid' data-bs-receiverId='$rid' data-bs-username='$username' data-bs-status='$online'>
        <i style='font-size:18px; color:#37C36C;' class='receiver-public-chatIcon fas fa-comments align-middle'></i></button>
      </td>
      </tr>";
  }
  echo $table;
?>