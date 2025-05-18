<?php
session_start();

// Enhanced CORS handling
$allowedOrigins = [
    'http://localhost',
    'null' // For file:// URLs during development
];

$origin = $_SERVER['HTTP_ORIGIN'] ?? '';
if (in_array($origin, $allowedOrigins)) {
    header("Access-Control-Allow-Origin: $origin");
} else {
    header("Access-Control-Allow-Origin: http://localhost");
}

header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// Handle preflight request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

// Debug logging
error_log("Request method: " . $_SERVER['REQUEST_METHOD']);
error_log("Content-Type: " . ($_SERVER['CONTENT_TYPE'] ?? 'not set'));

// Database connection
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'online_registration';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    error_log("DB connection failed: ".$conn->connect_error);
    die(json_encode(["status" => "error", "message" => "Database connection failed."]));
}

// Get input data
$json = file_get_contents('php://input');
error_log("Raw input: " . $json);

$data = json_decode($json, true);
if (json_last_error() !== JSON_ERROR_NONE) {
    error_log("JSON decode error: " . json_last_error_msg());
    die(json_encode(["status" => "error", "message" => "Invalid JSON data."]));
}

$email = $data['email'] ?? '';
$password = $data['password'] ?? '';

error_log("Login attempt for: " . $email);

// Validation
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    error_log("Invalid email format: " . $email);
    die(json_encode(["status" => "error", "message" => "Please enter a valid email address."]));
}

// Database query
$stmt = $conn->prepare("SELECT student_id, password FROM student WHERE email = ?");
if (!$stmt) {
    error_log("Prepare failed: " . $conn->error);
    die(json_encode(["status" => "error", "message" => "Database error."]));
}

$stmt->bind_param("s", $email);
if (!$stmt->execute()) {
    error_log("Execute failed: " . $stmt->error);
    die(json_encode(["status" => "error", "message" => "Database error."]));
}

$result = $stmt->get_result();
if ($result->num_rows === 0) {
    error_log("No user found for email: " . $email);
    die(json_encode(["status" => "error", "message" => "Student not found."]));
}

$student = $result->fetch_assoc();
if (!password_verify($password, $student['password'])) {
    error_log("Password verification failed for: " . $email);
    die(json_encode(["status" => "error", "message" => "Incorrect password."]));
}

// Login successful
$_SESSION['student_id'] = $student['student_id'];
error_log("Login successful for: " . $email);
echo json_encode(["status" => "success", "message" => "Login successful."]);

$stmt->close();
$conn->close();
?>