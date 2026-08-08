<?php

include "connection.php";

$sql = "SELECT * FROM students ORDER BY id DESC";

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Student CRUD</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

<div class="container">

    <h1>Student Management Non Main</h1>

    <a href="create.php" class="btn">
        + Add Student
    </a>

    <table>

        <tr>

            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Course</th>
            <th>Action</th>

        </tr>

        <?php

        if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {

        ?>

        <tr>

            <td>
                <?php echo $row['id']; ?>
            </td>

            <td>
                <?php echo htmlspecialchars($row['name']); ?>
            </td>

            <td>
                <?php echo htmlspecialchars($row['email']); ?>
            </td>

            <td>
                <?php echo htmlspecialchars($row['course']); ?>
            </td>

            <td>

                <a
                    href="edit.php?id=<?php echo $row['id']; ?>"
                    class="edit"
                >
                    Edit
                </a>

                <a
                    href="delete.php?id=<?php echo $row['id']; ?>"
                    class="delete"
                    onclick="return confirm('Are you sure you want to delete this student?');"
                >
                    Delete
                </a>

            </td>

        </tr>

        <?php

            }

        } else {

        ?>

        <tr>

            <td colspan="5">
                No students found.
            </td>

        </tr>

        <?php

        }

        ?>

    </table>

</div>

</body>

</html>