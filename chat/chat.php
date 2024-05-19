<?php require('../server/chat_server.php'); ?>
<!DOCTYPE html>

<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://kit.fontawesome.com/4733528720.js" crossorigin="anonymous"></script>

  <title>Cyber Chat</title>
  <link rel="stylesheet" type="text/css" href="../resources/css/chat.css">

  <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  <!-- JavaScript Bundle with Popper -->

  <!-- pop-up message -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
  
  <!-- msg content display(previous msg) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</head>
<body style="background-color:#CBD0D4; padding: top 20%">
<h1 style="text-align: center; font-size:48px; font-family: Candara" class="animate__animated animate__fadeIn"><?php echo "Welcome, <strong>".$_SESSION['username']; ?></strong></h1>
  <?php require_once('get_users.php'); ?>   <!-- Table is in get_user.php -->

  <div class="modal fade fast" id="chatModal" tabindex="-1" aria-labelledby="chatModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title fw-light" id="chatModalLabel">Chat with </h5>
            <!-- <div class="animate__animated animate__fadeInDown animate__faster" id="last-seen" style="font-style:italic; font-size:10px; font-weight:300; color:#666; float:right; margin-top:5px; margin-left:5px;">Status</div> -->
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="mb-3">
              <div id="chat-box" style="height:500px; background-color:#efefef; border:1px solid #ddd; overflow: auto; padding:16px; margin: 25px 15px 0px 15px; border-radius:8px;">
              </div>
        </div>
        <div class="modal-body">
          <form href="" method="POST">
            <div class="mb-3">
              <textarea class="form-control" id="message-text" oninput="this.style.height = '';this.style.height = this.scrollHeight + 'px'" style="height:60px;" required focus placeholder="Type a message..." onkeyup="messageTextChanged()"></textarea>

              <select id="enc-method" style="margin-top:15px; padding:8px; cursor:pointer; border-radius:8px; background-color:#f3f3f3; width: 100%;">
                <option disabled>Encryption Method - </option>  
                <option value="aes">AES</option>
                <option selected value="rsa">RSA</option>
                <option value="gamal">ElGamal</option>
              </select>            
            </div>
        
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <label class="btn btn-outline-dark" for="upload-file" style="cursor: pointer;"><i style="font-size:16px;" class='fas fa-file-export'></i></label>
            <input type="file" id="upload-file" name="upload-file" style="opacity: 0; position: absolute; z-index: -1;">
            <a id="link" download style="display: none"></a>
          <button type="button" class="btn btn-outline-success" id="send-button" disabled onclick="sendClicked();">Send&nbsp&nbsp<i style="font-size:16px;" class='fas fa-paper-plane'></i></button>
        </div>
          </form>
        </div>
      </div>
    </div>
  </div>

</body>
</html>

<?php include_once "../modules/methods.php" ?>
<script src="../modules/methods.js"></script>
<script src="../resources/js/vars.js"></script>
<script src="../resources/js/utilities.js"></script>
<script src="../resources/js/chatBubbles.js"></script>
<script src="../resources/js/home.js"></script>
<script src="../resources/js/ajax.js"></script>
<script src="../resources/js/chat.js"></script>