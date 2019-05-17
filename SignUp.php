<?php include 'conn.php'; ?>

<?php

// create a variable
$email = $_POST["email"];
$password = $_POST ["password"];
echo $email;
echo $password;

$returnValue = array();
//Check if email is in system
$sql = "select * from users where email='" . $email. "'";
echo $sql;
$stmt = $conn->query($sql);
if ($stmt != null && (mysqli_num_rows($stmt) >= 1)) {
     $row = $stmt->fetch_array(MYSQLI_ASSOC);
     if (!empty($row)) {
       // $returnValue = $row['user_id'];
       // echo $returnValue;
       echo "User with Email Already Exist";
       return;
     }
   }
// if (!$stmt) {
//         echo "email false";
//     }
// $stmt->bind_param('s', $email);
// $results = $stmt->execute();
// echo $results;

// if(mysqli_affected_rows($conn) > 0){
//   //Let User Know to That Profile with email is already on file.
//   echo "User with Email Already Exists";
//   return;
// }

$stmt->close();

// Hash Password Function

$secure_password = password_hash ( $password, PASSWORD_DEFAULT );

$sql = "insert into users set email=?, password=?";
$stmt = $conn->prepare($sql);
if (!$stmt) {
        echo "false";
    }
$stmt->bind_param('ss', $email, $secure_password);
$results = $stmt->execute();

if(mysqli_affected_rows($conn) > 0){
  session_start();
  // echo "Success!";
  // echo $results;
  $_SESSION["logged"] = 1;
  header("Location:home.php");
  // Go to Home Page : Run Home.php

} else {
  echo "Sorry! There was an Error!";
  echo mysqli_error ($conn);
}
$stmt->close();
$conn->close();
echo "";
?>
