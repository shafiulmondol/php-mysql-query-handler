<?php
$dbconn = mysqli_connect("localhost", "root", "", "practice2");

if (!$dbconn) {
    die("Connection error: " . mysqli_connect_error());
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Student Data</title>
    <style>
        .container { display: flex; }
        .left-panel, .right-panel {
            width: 400px;
            height: 400px;
            padding: 20px;
        }
        .left-panel { background-color: aquamarine; }
        .right-panel { background-color: blanchedalmond; }
        button { padding: 10px 20px; margin: 10px; cursor: pointer; }
    </style>
</head>
<body>
    <div class="container">
        <div class="left-panel">
            <form method="post">
                <button type="submit" name="show_data">Show Data</button>
                <button type="submit" name="refresh">Refresh</button>
            </form>
        </div>
        <div class="right-panel">
            <?php
            if (isset($_POST['show_data'])) {
                $query = "SELECT * FROM student";
                $result = mysqli_query($dbconn, $query);
                
                if (!$result) {
                    die("Query error: " . mysqli_error($dbconn));
                }

                $num = mysqli_num_rows($result);
                
                if ($num > 0) {
                    echo "<h3>Student Records:</h3>";
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "ID: " . $row['id'] . "<br>";
                        echo "Name: " . $row['name'] . "<br>";
                        echo "Password: " . $row['password'] . "<br>";
                        echo "Message: " . $row['message'] . "<br><hr>";
                    }
                } else {
                    echo "No records found";
                }
            } elseif (isset($_POST['refresh'])) {
                // This will simply reload the page without showing data
                header("Location: ".$_SERVER['PHP_SELF']);
                exit();
            }
            mysqli_close($dbconn);
            ?>
        </div>
    </div>
</body>
</html>