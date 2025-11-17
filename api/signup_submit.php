<?php
  // If user is already signed in, and this signup_submit.php is requested for, the user will automatically get logged out first.
  session_start();
  session_destroy();

  require "../includes/database_connect_hide_error.php";

  if( !$con )
  {
    // echo mysqli_connect_error();
    //  exit();
    $response = array("success" => false, "message" => "Database Connectivity Error!");
    echo json_encode($response);
    return;
  }
  else {
    $full_name = $_POST["full_name"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];

    $password = $_POST["password"];
    // If password is to be stored in hashed format.
    $password = sha1($password);

    $college_name = $_POST["college_name"];
    if( isset($_POST["gender"]) )
      {$gender = $_POST["gender"];}

    $sql_query1 = "SELECT * FROM users where email='$email';";
    $result1 = mysqli_query($con,$sql_query1);

    if ( !$result1 ) {
      $response = array("success" => false, "message" => "Something went wrong!");
      echo json_encode($response);
      return;
    }

    //When already the email is registered by another user previosly
    $row_count = mysqli_num_rows($result1);
    if ($row_count != 0) {
      $response = array("success" => false, "message" => "This email id is already registered with us!");
      echo json_encode($response);
      return;
    }

    $result2 = FALSE;
    if( mysqli_num_rows($result1)==0 ){
      $sql_query2 = "INSERT INTO users (full_name,phone,email,password,college_name,gender) VALUES ('$full_name','$phone','$email','$password','$college_name','$gender');";
      $result2 = mysqli_query($con,$sql_query2);

      if ( !$result2 ) {
        $response = array("success" => false, "message" => "Something went wrong! Registration Unsuccessfull!");
        echo json_encode($response);
        return;
      }
      else {
        $response = array("success" => true, "message" => "User is successfully registered!");
        echo json_encode($response);
        return;
      }
    }
  }

?>



<?php mysqli_close($con); ?>