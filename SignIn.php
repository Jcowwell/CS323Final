<?php include 'conn.php'; ?>
<?php

$email = $_POST['email'];
$password = $_POST['password'];
$returnValue = array();

$sql = "select * from users where email='" . $email . "'";

$result = $conn->query($sql);

if ($result != null && (mysqli_num_rows($result) >= 1)) {

  $row = $result->fetch_array(MYSQLI_ASSOC);
  if(password_verify($password, $row['password'])) {
    if (!empty($row)) {
      $returnValue = $row;
    }
  }
}
else {
  echo "Incorrect Credentials";
}

if(!empty($returnValue)) {
  echo "success!";
  session_start();
  $_SESSION["logged"] = 1;
  header("Location:home.php");
  // Go to Home Page : Run Home.html
} else {
  echo "Incorrect Credentials";
}
$conn->close();
echo "";
?>
