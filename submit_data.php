<?php
// VERY SIMPLE FORM PROCESSING FOR BEGINNERS

// 1. Connect to Database
$db = mysqli_connect('localhost', 'root', '', 'practice2');

// Check connection
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}

// 2. Process form when submitted
if (isset($_POST['submit'])) {
    // Sanitize user inputs
    $name = mysqli_real_escape_string($db, $_POST['name']);
    $pass = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hashing password
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $message = mysqli_real_escape_string($db, $_POST['message']);
    
    // 3. Insert into database using prepared statement
    $sql = "INSERT INTO student (name, password, email, message) VALUES (?, ?, ?, ?)";
    
    $stmt = mysqli_prepare($db, $sql);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssss", $name, $pass, $email, $message);
        
        if (mysqli_stmt_execute($stmt)) {
            echo "<p style='color:green;'>Thank you! Your form was submitted.</p>";
        } else {
            echo "<p style='color:red;'>Error: " . mysqli_stmt_error($stmt) . "</p>";
            // For debugging - remove in production
            echo "<p>SQL: $sql</p>";
            echo "<pre>";
            print_r($_POST);
            echo "</pre>";
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "<p style='color:red;'>Error preparing statement: " . mysqli_error($db) . "</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Simple Form</title>
    <style>
        body { font-family: Arial; max-width: 500px; margin: 0 auto; padding: 20px; }
        .form-group { margin-bottom: 15px; }
        input, textarea { width: 100%; padding: 8px; }
        textarea { height: 100px; }
        .error { color: red; }
    </style>
</head>
<body>
    <h1>Simple Contact Form</h1>
    
    <form method="post" action="">
        <div class="form-group">
            <label>Your Name:</label>
            <input type="text" name="name" required>
        </div>
        
        <div class="form-group">
            <label>Your Email:</label>
            <input type="email" name="email" required>
        </div>
        
        <div class="form-group">
            <label>Your Password:</label>
            <input type="password" name="password" required minlength="8">
        </div>
        
        <div class="form-group">
            <label>Your Message:</label>
            <textarea name="message" required></textarea>
        </div>
        
        <input type="submit" name="submit" value="Submit">
    </form>
</body>
</html>

<?php
// Close connection
mysqli_close($db);
?>