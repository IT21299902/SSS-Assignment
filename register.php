<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="https://kit.fontawesome.com/4733528720.js" crossorigin="anonymous"></script>
<title>Cyber Chat</title>
<link rel="stylesheet" type="text/css" href="resources/css/index.css">
<link rel="stylesheet" type="text/css" href="resources/css/queries.css">
<link rel="stylesheet" type="text/css" href="vendors/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="vendors/css/normalize.css">
<link rel="stylesheet" type="text/css" href="vendors/css/Grid.css">
</head>
<body style="background-color:#989DA2;">
<h1 class="d-flex justify-content-left" style="text-align: center; font-size:60px; font-family: Courier">Cyber Chat&#128373</h1>
<br/>
<h1 style="text-align: center; font-size:40px; font-family: Candara" >
    Sign Up
</h1>
<center>
<form action="" method="POST" style="margin: 20px auto;" id="registrationForm">
<div class="form-group" style="margin: 15px">
<input type="text" class="form-control" placeholder="Username" required name="username" style="width: 15%; padding: 12px 20px; margin: 8px 0; box-sizing: border-box;">
</div>
<div class="input-group mb-3">
<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password" required style="width: 15%; padding: 12px 20px; margin: 8px 0; box-sizing: border-box;">
<div class="input-group-append" style="margin-top: 15px">
<button type="submit" class="btn btn-secondary w-100" name="register" style="background-color:#0080FF; border:none; color: white; padding: 10px 20px;">Register</button>
</div>
<div id="passwordHelpBlock" class="form-text" style="margin-top: 10px; color: #FFFFFF;"></div>
</div>
</form>
<div id="small" style="text-align: center;">
<small>
<a href="index.php" class="text-primary">Login?</a>
</small>
</div>
<?php require_once 'server/server.php'; ?>
</body>
</html>
 
<script>
    document.getElementById('exampleInputPassword1').addEventListener('input', function() {
        const password = this.value;
        const requirements = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
        const helpBlock = document.getElementById('passwordHelpBlock');
 
        if (!requirements.test(password)) {
            helpBlock.innerHTML = '<p style="margin: 5px 0;">Password must be at least 8 characters long</p>' +
                                  '<p style="margin: 5px 0;">Contain at least one uppercase letter</p>' +
                                  '<p style="margin: 5px 0;">Contain at least one lowercase letter</p>' +
                                  '<p style="margin: 5px 0;">Contain at least one number</p>' +
                                  '<p style="margin: 5px 0;">Contain at least one special character (@$!%*?&)</p>';
            helpBlock.style.display = 'block'; // Show the policy box if incorrect
        } else {
            helpBlock.style.display = 'none'; // Hide the policy box if correct
        }
    });
 
    document.getElementById('registrationForm').addEventListener('submit', function(event) {
        const password = document.getElementById('exampleInputPassword1').value;
        const requirements = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
 
        if (!requirements.test(password)) {
            event.preventDefault(); // Stop form submission
            alert('Please ensure the password meets all the requirements.');
        }
    });
 
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>