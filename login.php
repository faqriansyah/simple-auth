<?php 

session_start();

$conn = new mysqli("127.0.0.1", "root", "", "exp");

if($conn) {
  echo "Connection Success <br>";
}

if(isset($_SESSION)) {
  echo '<pre>';
  var_dump($_SESSION);
  var_dump($_COOKIE);
  echo '</pre>';
}

if(isset($_POST['log'])) {
  
}
if(isset($_POST['regst'])) {
  $pw = $_POST['pwd'];
  
  // username and password that will stored on database
  $usrnm = $_POST['usrnm']; $pw = password_hash($pw, PASSWORD_DEFAULT);
  
  $stmt = $conn->prepare("INSERT INTO users (`username`, `password`) VALUES (?,?)");
  $stmt->bind_param('ss', $usrnm, $pw);

  if($stmt->execute()){
    setcookie("status", "logged_in");
  } else {
    echo "Failed";
  }
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>login</title>
</head>
<body>

  <?php if(isset($_COOKIE['logged_in'])) { ?>
    <div>
      <a href="login.php?lgt">Logout!</a>
    </div>
  <?php } ?>
  
  <h1>Form Login</h1>
  <form action="login.php" method="POST" accept-charset="utf-8">
    <input type="text" name="usrnm" placeholder="usrnm" />
    <input type="text" name="pwd" placeholder="pwd" />
    <input type="submit" name="log" id="login" value="login" />
  </form>
  
  <h1>Form register</h1>
  <form action="login.php" method="POST" accept-charset="utf-8" autocomplete="off">
    <input type="text" name="usrnm" placeholder="usrnm" />
    <input type="text" name="pwd" placeholder="pwd" />
    <input type="submit" name="regst" value="register">
  </form>
</body>
</html>