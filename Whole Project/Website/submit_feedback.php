<?php
require '../process/database_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $message = mysqli_real_escape_string($conn, $_POST['message']);

  $query = "INSERT INTO feedbacks (sender_name, sender_email, message, date_sent)
            VALUES ('$name', '$email', '$message', NOW())";

  if (mysqli_query($conn, $query)) {
    echo "<script>alert('Thank you for your feedback!'); window.location.href = 'guest.php';</script>";
  } else {
    echo "<script>alert('Failed to send feedback.'); window.location.href = 'guest.php';</script>";
  }
}
?>