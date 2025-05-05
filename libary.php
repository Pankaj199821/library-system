<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect form data
    $name = htmlspecialchars($_POST['name']);
    $dob = htmlspecialchars($_POST['dob']);
    $phone = htmlspecialchars($_POST['phone']);
    $course = htmlspecialchars($_POST['course']);
    $college = htmlspecialchars($_POST['college']);

    // Handle photo upload
    $photo = $_FILES['photo'];
    $uploadDir = 'uploads/';
    $uploadFile = $uploadDir . basename($photo['name']);

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    if (move_uploaded_file($photo['tmp_name'], $uploadFile)) {
        $photoURL = $uploadFile;
    } else {
        $photoURL = null;
    }

    // Display submitted data
    echo "<div style='font-family: Arial, sans-serif; width: 50%; margin: 20px auto; background: #f4f4f9; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);'>";
    echo "<h1>Library Card</h1>";
    echo "<p><strong>Name:</strong> $name</p>";
    echo "<p><strong>Date of Birth:</strong> $dob</p>";
    echo "<p><strong>Phone Number:</strong> $phone</p>";
    echo "<p><strong>Course:</strong> $course</p>";
    echo "<p><strong>College:</strong> $college</p>";

    if ($photoURL) {
        echo "<p><strong>Photo:</strong></p>";
        echo "<img src='$photoURL' alt='Uploaded Photo' style='max-width: 100%; height: auto; border: 1px solid #ccc;'>";
    } else {
        echo "<p><strong>Photo:</strong> Upload failed.</p>";
    }

    echo "</div>";
}
