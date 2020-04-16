<?php

if (!empty($_POST) && isset($_POST["email"]) && filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
  include("db.php");

  $email = $_POST["email"];

  // check if in current db
  if ($stmt = $con->prepare("SELECT emails FROM mask_emails WHERE emails = ?")) {

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 0) {
      $stmt->close();

      if ($stmt = $con->prepare("INSERT INTO mask_emails (emails) VALUES (?)")) {

        $stmt->bind_param("s", $email);

        $stmt->execute();
        $stmt->close();
        $con->close();

        echo "Success__Email was successfully added.";
        exit();


      } else {
        echo "Error__Theres was a server error";
        $con->close();
        exit();
      }

    } else {
      echo "Error__This email has already been used.";
      $stmt->close();
      $con->close();
      exit();

    }


  } else {
    echo "Error__Theres was a server error... Please try again later";
    $con->close();
    exit();
  }

} else {
  echo "Error__Wrong Credentials.";
}

 ?>
