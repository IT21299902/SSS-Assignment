<?php
  require_once('../server/DB.php');
  require_once('../modules/methods.php');
  $db = DB::getInstance();

  $senderId = $_REQUEST['sid'];
  $receiverId = $_REQUEST['rid'];
  $whichCase = $_REQUEST['whichCase'];

  $query = "";
  $updateRequired = false;
  $senderIsHere = true;

  if($whichCase == "displayAll"){
    $updateRequired = false;
    $query = "SELECT * 
              FROM chat 
              WHERE (sender_id=$senderId AND receiver_id=$receiverId) OR (sender_id=$receiverId AND receiver_id=$senderId) 
              ORDER BY timestamp";
  }
  else if ($whichCase == "displayNewOnly"){
    $updateRequired = true;
    $query = "SELECT * 
              FROM chat
              WHERE (s_stat=0 OR r_stat=0) AND ((sender_id=$senderId AND receiver_id=$receiverId) OR (sender_id=$receiverId AND receiver_id=$senderId))
              ORDER BY timestamp";
  }

  $result = mysqli_query($db, $query);
  $messages = [];

  while($row = mysqli_fetch_assoc($result)){
    $node = [];
    $chatId = $row['id'];
    $sender = $row['sender_id'];
    $receiver = $row['receiver_id'];
    $enc = $row['enc_method'];
    $message = "-1";
    $timestamp = $row['timestamp'];
    $isFile = $row['is_file'];
    $fileName = $row['file_name'];
    $gamalData = [];

    if($enc == 0){
      $DES = new DES();
      $query = "SELECT *
                FROM des
                WHERE message_id=$chatId
                ORDER BY timestamp";
      $desResult = mysqli_query($db, $query);
      $desRow = mysqli_fetch_assoc($desResult);

      $plainTextDes = $DES->DES_DECRYPT($desRow['cipher'], $desRow['receiver_key']);
      $plainTextDesSplit = str_split($plainTextDes, 32);
      $plainHexDes = base_convert($plainTextDesSplit[0], 2, 16) . base_convert($plainTextDesSplit[1], 2, 16);
      $message = $plainHexDes;
      // echo $message;
    }
    else if($enc == 1){
      $AES = new AES();
      $query = "SELECT *
                FROM aes
                WHERE message_id=$chatId
                ORDER BY timestamp";
      $aesResult = mysqli_query($db, $query);
      $aesRow = mysqli_fetch_assoc($aesResult);

      $cipherAesBin = hex2bin($aesRow['cipher']);  

      $ciphertext = str_split($cipherAesBin,16);
      $finalPlainText = "";
      for($i=0 ; $i<count($ciphertext) ; $i++)
      {
          $plain = $AES->AES_DECRYPT($ciphertext[$i], $aesRow['receiver_key']);
          
          $plain = hex2bin($plain);
          $removeThePadKeyword = str_replace('#', '', $plain);
          $finalPlainText .= $removeThePadKeyword;
      }
      $message = $finalPlainText;

    }
    else if($enc == 2){
      $RSA = new RSA();
      $query = "SELECT *
                FROM rsa
                WHERE message_id=$chatId
                ORDER BY timestamp";
      $rsaResult = mysqli_query($db, $query);
      $rsaRow = mysqli_fetch_assoc($rsaResult);
      $message = $RSA->decrypt($row['message'], $rsaRow['d'], $rsaRow['n'], $rsaRow['every_separate']);
    }
    else if($enc == 3){
      $query = "SELECT *
                FROM gamal
                WHERE message_id=$chatId
                ORDER BY timestamp";
      $gamalResult = mysqli_query($db, $query);
      $gamalRow = mysqli_fetch_assoc($gamalResult);

      $gamalData[] = $gamalRow['c1'];
      $gamalData[] = $row['message'];
      $gamalData[] = $gamalRow['xa'];
      $gamalData[] = $gamalRow['q'];
      $gamalData[] = $gamalRow['every_separate'];
    }

    $node[] = $sender;
    $node[] = $receiver;
    $node[] = $enc;
    $node[] = $message;
    $node[] = ''; 
    $node[] = ''; 


    $node[] = $isFile;
    $node[] = $fileName;
    $node[] = $gamalData;
    

    if($updateRequired){
      if($row['sender_id'] == $senderId && $row['s_stat'] == 0){
        $senderIsHere = true;
        $messages[] = $node;
      }
      else if($row['sender_id'] == $receiverId && $row['r_stat'] == 0){
        $senderIsHere = false;
        $messages[] = $node;
      }
    }
    else{
      $messages[] = $node;
    }
  }

  if($updateRequired){
    $query = "";
    if($senderIsHere){
      $query = "UPDATE chat 
                SET s_stat=1
                WHERE s_stat=0 AND ((sender_id=$senderId AND receiver_id=$receiverId) OR (sender_id=$receiverId AND receiver_id=$senderId))
                ORDER BY timestamp";
    }
    else{
      $query = "UPDATE chat 
                SET r_stat=1
                WHERE r_stat=0 AND ((sender_id=$senderId AND receiver_id=$receiverId) OR (sender_id=$receiverId AND receiver_id=$senderId))
                ORDER BY timestamp";
    }

    if($db->query($query) === true){
      echo json_encode($messages);
    }
    else{
      die();
    }
  } else {
    echo json_encode($messages);
  }
  

?>
