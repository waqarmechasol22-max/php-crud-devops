<?php

include "connection.php";

if (!isset($_GET['id'])) {

    die("Student ID is missing.");

}

$id = $_GET['id'];

$sql = "SELECT * FROM students WHERE id = ?";

$stmt = $conn->prepare($sql);

$stmt->bind_param("i", $id);

$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows == 0) {

    die("Student not found.");

}

$student = $result->fetch_assoc();

$stmt->close();


if (isset($_POST['update'])) {

    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $course = trim($_POST['course']);

    if ($name == "" || $email == "" || $course == "") {

        echo "Please fill all fields.";

    } else {

        $sql = "UPDATE students
                SET name = ?, email = ?, course = ?
                WHERE id = ?";

        $stmt = $conn->prepare($sql);

        $stmt->bind_param(
            "sssi",
            $name,
            $email,
            $course,
            $id
        );

        if ($stmt->execute()) {

            header("Location: index.php");
            exit();

        } else {

            echo "Error updating student.";
        }

        $stmt->close();
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Edit Student</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

<div class="container">

    <div class="form-box">

        <h1>Edit Student</h1>

        <form method="POST">

            <label>Name</label>

            <input
                type="text"
                name="name"
                value="<?php echo htmlspecialchars($student['name']); ?>"
            >

            <label>Email</label>

            <input
                type="email"
                name="email"
                value="<?php echo htmlspecialchars($student['email']); ?>"
            >

            <label>Course</label>

            <input
                type="text"
                name="course"
                value="<?php echo htmlspecialchars($student['course']); ?>"
            >

            <button
                type="submit"
                name="update"
                class="btn"
            >
                Update Student
            </button>

            <a href="index.php" class="btn">
                Cancel
            </a>

        </form>

    </div>

</div>

</body>

</html>