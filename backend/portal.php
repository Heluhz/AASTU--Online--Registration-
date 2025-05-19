<?php
// Start session
session_start();

// Check if student is logged in
if (!isset($_SESSION['student_id'])) {
    header("Location: login.php");
    exit();
}

// Database connection
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'online_registration';

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get student information
$student_id = $_SESSION['student_id'];
$student_query = "SELECT * FROM student WHERE student_id = ?";
$stmt = $conn->prepare($student_query);
$stmt->bind_param("s", $student_id);
$stmt->execute();
$student_result = $stmt->get_result();

if ($student_result->num_rows == 0) {
    die("Student not found");
}

$student = $student_result->fetch_assoc();

// Get current semester courses (year=student.year, semester=student.semester)
$current_courses_query = "SELECT * FROM courses WHERE course_year = ? AND semester = ?";
$stmt = $conn->prepare($current_courses_query);
$year = $student['year'];
$semester = $student['semester'];
$stmt->bind_param("ii", $year, $semester);
$stmt->execute();
$current_courses = $stmt->get_result();

// Get available courses (all courses except current semester)
$available_courses_query = "SELECT * FROM courses WHERE NOT (course_year = ? AND semester = ?) ORDER BY course_year, semester";
$stmt = $conn->prepare($available_courses_query);
$stmt->bind_param("ii", $year, $semester);
$stmt->execute();
$available_courses = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Online Registration Portal</title>
  <link rel="stylesheet" href="registration.css">
</head>
<body>
  <header>
    <div class="header-content">
        <a href="home page.html" class="logo"><img src="logos.jpg" class="photo"></a>
      <nav>
        <ul>
          <li><a href="#">Courses</a></li>
          <li><a href="#">Schedule</a></li>
          <li><a href="#">Account</a></li>
        </ul>
      </nav>
      <div class="logout">
        <a href="logout.php">Logout</a>
      </div>
    </div>
  </header>

  <main>
    <section class="student-info">
      <h2>Student Information</h2>
      <div class="info-container">
        <p>Name: <?php echo htmlspecialchars($student['first_name']) ." " .htmlspecialchars($student['middle_name']); ?></p>
        <p>ID: <?php echo htmlspecialchars($student['student_id']); ?></p>
        <p>Department: <?php echo htmlspecialchars($student['department']); ?></p>
        <p>Year: <?php echo htmlspecialchars($student['year']); ?></p>
        <p>Semester: <?php echo htmlspecialchars($student['semester']); ?></p>
      </div>
    </section>

    <section class="semester-courses">
      <h2>Semester Courses</h2>
      <div class="table-container">
        <table id="semester-courses">
          <thead>
            <tr>
            <th>Course Code</th>
              <th>Course Title</th>
              
              <th>Credit Hours</th>
              <th>Year</th>
              <th>Semester</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($course = $current_courses->fetch_assoc()): ?>
            <tr>
            <td><?php echo htmlspecialchars($course['course_code']); ?></td>
              <td><?php echo htmlspecialchars($course['course_title']); ?></td>
              
              <td><?php echo htmlspecialchars($course['credit_hour']); ?></td>
              <td><?php echo htmlspecialchars($course['course_year']); ?></td>
              <td><?php echo htmlspecialchars($course['semester']); ?></td>
              
              <td><button class="action-btn drop-button">Drop</button></td>
              
            </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
      <div class="submit">
        <a href="costsharing.php"><button type="submit" class="submit-button">Submit</button></a>
      </div>
    </section>

    <section class="available-courses">
      <h2>Available Courses</h2>
      <div class="table-container">
        <table id="available-courses">
          <thead>
            <tr>
              <th>Course Code</th>
              <th>Course Title</th>
              <th>Credit Hour</th>
              <th>Year</th>
              <th>Semester</th>
              
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($course = $available_courses->fetch_assoc()): ?>
            <tr>  
              <td><?php echo htmlspecialchars($course['course_code']); ?></td>
              <td><?php echo htmlspecialchars($course['course_title']); ?></td>
              <td><?php echo htmlspecialchars($course['credit_hour']); ?></td>
              <td><?php echo htmlspecialchars($course['course_year']); ?></td>
              <td><?php echo htmlspecialchars($course['semester']); ?></td>
              
              
              <td><button class="action-btn add-button">Add</button></td>
              
            </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
    </section>
  </main>
  <script src="course-management.js"></script>
</body>
</html>

<?php
// Close database connection
$conn->close();
?>