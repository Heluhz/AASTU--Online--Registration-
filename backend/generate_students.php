<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'online_registration';

// Connect to the database
$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function randomPassword($length = 10) {
    $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789@$!%*?&';
    return substr(str_shuffle(str_repeat($chars, $length)), 0, $length);
}

$firstNames = ['Helen', 'Lidya', 'Samuel', 'Nahom', 'Abel', 'Meron', 'Betty', 'Robel', 'Kalkidan', 'Sami'];
$lastNames = ['Lemessa', 'Tesfaye', 'Abebe', 'Tadesse', 'Mengesha', 'Alemu', 'Gebremariam', 'Wolde', 'Yohannes', 'Bekele'];

for ($i = 1; $i <= 20; $i++) {
    $fname = $firstNames[array_rand($firstNames)];
    $lname = $lastNames[array_rand($lastNames)];
    $fullname = "$fname $lname";
    
    $student_id = str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT) . "/" . rand(13, 15);  // Example: 0559/15
    $email = strtolower($fname) . "." . strtolower($lname) . rand(1, 99) . "@aastustudent.edu.et";
    
    $plainPassword = randomPassword(12);  // Strong random password
    $hashedPassword = password_hash($plainPassword, PASSWORD_DEFAULT);
    
    $sql = "INSERT INTO student (student_id, fullname, email, password) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $student_id, $fullname, $email, $hashedPassword);
    
    if ($stmt->execute()) {
        echo "Inserted: $fullname ($student_id) | Email: $email | Password: $plainPassword <br>";
    } else {
        echo "Error: " . $stmt->error . "<br>";
    }

    $stmt->close();
}

$conn->close();
?>