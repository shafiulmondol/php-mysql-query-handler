<?php
$conn = mysqli_connect("localhost", "root", "", "practice2");
if (!$conn) {
    die("Connection error: " . mysqli_connect_error());
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Student Biodata</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            display: flex;
            background-color: aqua;
        }
        .form-panel, .data-panel {
            width: 500px;
            height: 500px;
            padding: 20px;
            box-sizing: border-box;
        }
        .form-panel {
            background-color: #f0f0f0;
        }
        .data-panel {
            background-color: #e0e0e0;
            overflow-y: auto;
        }
        label {
            display: inline-block;
            width: 80px;
            margin-bottom: 10px;
        }
        input[type="text"], input[type="password"] {
            padding: 5px;
            margin-bottom: 10px;
        }
        input[type="submit"] {
            padding: 8px 15px;
            margin-right: 10px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-panel">
            <form action="" method="post">
                <label>ID:</label>
                <input type="text" name="id"><br>
                <label>Password:</label>
                <input type="password" name="password"><br>
                <input type="submit" name="submit" value="Show Biodata">
                <input type="submit" name="refresh" value="Refresh">
            </form>
        </div>
        <div class="data-panel">
            <?php
            $query = "SELECT * FROM student";
            $result = mysqli_query($conn, $query);
            $num = mysqli_num_rows($result);

            if ($num > 0) {
                if (isset($_POST['submit'])) {
                    $input_id = $_POST['id'] ?? '';
                    $input_password = $_POST['password'] ?? '';

                    while ($row = mysqli_fetch_assoc($result)) {
                        if ($input_id == $row['id'] && $input_password == $row['password']) {
                            echo "<strong>ID:</strong> " . $row['id'] . "<br>";
                            echo "<strong>Name:</strong> " . $row['name'] . "<br>";
                            echo "<strong>Password:</strong> " . $row['password'] . "<br>";
                            echo "<strong>Message:</strong> " . $row['message'] . "<br><hr>";
                        }
                    }
                } elseif (isset($_POST['refresh'])) {
                    header("Location: " . $_SERVER['PHP_SELF']);
                    exit();
                }
            } else {
                echo "No records found in the database.";
            }
            mysqli_close($conn);
            ?>
        </div>
    </div>
</body>
</html>