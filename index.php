<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://kit.fontawesome.com/4733528720.js" crossorigin="anonymous"></script>

  <title>Cyber Chat</title>
</head>
<body style="background-color:#CBD0D4;">
  <h1 class="d-flex justify-content-left" style="text-align: center; font-size:60px; font-family: Courier">Cyber Chat&#128373</h1>
  <br/>
  <h1 style="text-align: center; font-size:40px; font-family: Candara">
            Sign In
        </h1>

    <center><form action="" method="POST" style="margin: 20px auto;">
        <div class="form-group" style="margin: 15px" >
            <input type="text" class="form-control" placeholder="Username" required name="username" style = "width: 15%; padding: 12px 20px; margin: 8px 0; box-sizing: border-box;">
        </div>

        <div class="input-group mb-3">
            <input type="password" class="form-control" id="exampleInputPassword1" style = "width: 15%; padding: 12px 20px; margin: 8px 0; box-sizing: border-box;" placeholder="Password" name="password" required >
            <div class="input-group-append" style="margin-top: 15px">
                <button type="submit" class="btn btn-outline-primary w-100" name="login" style = "background-color:#0080FF; border:none; color: white; padding: 10px 20px; ">Login</button>
            </div>
        </div>
    </form>
    </center>
    <div id="small" style="text-align: center;">
        <small>
            <a href="register.php" class="text-secondary">Register?</a>
        </small>
    </div>
    <?php require_once 'server/server.php'; ?>
</body>
</html>

<script>
	if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>