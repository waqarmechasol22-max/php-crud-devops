<?php

include "connection.php";

$message = "";

if (isset($_POST['submit'])) {

    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $course = trim($_POST['course']);

    if ($name == "" || $email == "" || $course == "") {

        $message = "Please fill all fields.";

    } else {

        $sql = "INSERT INTO students (name, email, course)
                VALUES (?, ?, ?)";

        $stmt = $conn->prepare($sql);

        $stmt->bind_param("sss", $name, $email, $course);

        if ($stmt->execute()) {

            header("Location: index.php");
            exit();

        } else {

            $message = "Error adding student.";
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

    <title>Add Student</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

<div class="container">

    <div class="form-box">

        <h1>Add Student</h1>

        <?php if ($message != "") { ?>

            <div class="message">
                <?php echo $message; ?>
            </div>

        <?php } ?>

        <form method="POST">

            <label>Name</label>

            <input
                type="text"
                name="name"
                placeholder="Enter student name"
            >

            <label>Email</label>

            <input
                type="email"
                name="email"
                placeholder="Enter email"
            >

            <label>Course</label>

            <input
                type="text"
                name="course"
                placeholder="Enter course"
            >

            <button
                type="submit"
                name="submit"
                class="btn"
            >
                Add Student
            </button>

            <a href="index.php" class="btn">
                Back
            </a>

        </form>

    </div>

</div>

</body>

</html>