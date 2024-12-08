<?php
include 'config.php';

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $sql = "INSERT INTO users (name, age) VALUES ('$name', '$age')";
    mysqli_query($conn, $sql);
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM users WHERE id=$id";
    mysqli_query($conn, $sql);
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $age = $_POST['age'];
    $sql = "UPDATE users SET name='$name', age='$age' WHERE id=$id";
    mysqli_query($conn, $sql);
}

$users = mysqli_query($conn, "SELECT * FROM users");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Example</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>CRUD Operations with PHP</h1>

        <!-- Add User Form -->
        <form method="POST">
            <input type="text" name="name" placeholder="Name" required>
            <input type="number" name="age" placeholder="Age" required>
            <button type="submit" name="submit">Add User</button>
        </form>

        <!-- Users Table -->
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($user = mysqli_fetch_assoc($users)): ?>
                    <tr>
                        <td><?php echo $user['id']; ?></td>
                        <td><?php echo $user['name']; ?></td>
                        <td><?php echo $user['age']; ?></td>
                        <td>
                            <!-- Update User Form -->
                            <a href="javascript:void(0);" onclick="openUpdateForm(<?php echo $user['id']; ?>, '<?php echo $user['name']; ?>', <?php echo $user['age']; ?>)">Update</a> |
                            <a href="?delete=<?php echo $user['id']; ?>">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <!-- Update Form (hidden by default) -->
        <div id="updateForm" class="hidden">
            <h2>Update User</h2>
            <form method="POST">
                <input type="hidden" name="id" id="updateId">
                <input type="text" name="name" id="updateName" required>
                <input type="number" name="age" id="updateAge" required>
                <button type="submit" name="update">Update User</button>
            </form>
            <button onclick="closeUpdateForm()">Close</button>
        </div>
    </div>

    <script>
        // Show Update Form
        function openUpdateForm(id, name, age) {
            document.getElementById('updateForm').classList.remove('hidden');
            document.getElementById('updateId').value = id;
            document.getElementById('updateName').value = name;
            document.getElementById('updateAge').value = age;
        }

        // Close Update Form
        function closeUpdateForm() {
            document.getElementById('updateForm').classList.add('hidden');
        }
    </script>
</body>
</html>
