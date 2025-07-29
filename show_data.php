<?php
// VERY SIMPLE FORM PROCESSING AND DATA DISPLAY FOR BEGINNERS

// 1. Connect to Database
$db = mysqli_connect('localhost', 'root', '', 'practice2');

// Check connection
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}

// 2. Process form when submitted

// 4. Get all data from the table
$query = "SELECT * FROM student ORDER BY id ";
$result = mysqli_query($db, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Simple Form with Data Display</title>
    <style>
        body { font-family: Arial; max-width: 800px; margin: 0 auto; padding: 20px; }
        .form-group { margin-bottom: 15px; }
        input, textarea { width: 100%; padding: 8px; }
        textarea { height: 100px; }
        table { width: 100%; border-collapse: collapse; margin-top: 30px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        tr:nth-child(even) { background-color: #f9f9f9; }
    </style>
</head>
<body>
    <h1>Student Registration Form</h1>
    
   
    <?php if (mysqli_num_rows($result) > 0): ?>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Password</th>
                <th>Message</th>
            </tr>
            <?php while($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['id']); ?></td>
                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                    <td><?php echo htmlspecialchars($row['password']); ?></td>
                    <td><?php echo htmlspecialchars($row['message']); ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>No submissions yet.</p>
    <?php endif; ?>
</body>
</html>

<?php
// Close connection
mysqli_close($db);
?>