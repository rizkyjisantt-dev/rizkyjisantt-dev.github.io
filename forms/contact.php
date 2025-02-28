<?php
  // Ganti dengan email tujuan yang benar
  $receiving_email_address = 'moch.rizkiaji@gmail.com';

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Ambil data dari form dan lakukan validasi dasar
    $name = isset($_POST['name']) ? htmlspecialchars(strip_tags($_POST['name'])) : '';
    $email = isset($_POST['email']) ? filter_var($_POST['email'], FILTER_SANITIZE_EMAIL) : '';
    $subject = isset($_POST['subject']) ? htmlspecialchars(strip_tags($_POST['subject'])) : 'No Subject';
    $message = isset($_POST['message']) ? htmlspecialchars(strip_tags($_POST['message'])) : '';

    // Cek apakah semua field terisi
    if (empty($name) || empty($email) || empty($message)) {
      die("Error: Harap isi semua bidang yang diperlukan.");
    }

    // Validasi email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      die("Error: Alamat email tidak valid.");
    }

    // Persiapan email
    $headers = "From: $name <$email>\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // Kirim email
    if (mail($receiving_email_address, $subject, $message, $headers)) {
      echo "Your message has been sent. Thank you!";
    } else {
      echo "Error: Failed to send message.";
    }
  } else {
    echo "Error: Invalid request.";
  }
?>
