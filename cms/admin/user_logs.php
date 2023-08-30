<?php
include('../class/User.php');
include('include/header.php');

?>
<title>User Logs</title>
<!-- <script src="js/jquery.dataTables.min.js"></script> -->
<!-- <script src="js/dataTables.bootstrap.min.js"></script>		 -->
<!-- <link rel="stylesheet" href="css/dataTables.bootstrap.min.css" /> -->
<!-- <script src="js/users.js"></script>	 -->
<link rel="stylesheet" href="css/style.css">
<?php
include('include/container.php');
include 'menus.php';
function displayUserLogsTable() {
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'user-management-system';
    
    $conn = new mysqli($host, $username, $password, $database);
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $sql = "SELECT id, user_id, activity, timestamp FROM user_logs";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        echo "<table border='1'>
                <tr>
                    <th>ID</th>
                    <th>User ID</th>
                    <th>Activity</th>
                    <th>Timestamp</th>
                </tr>";
        
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['user_id']}</td>
                    <td>{$row['activity']}</td>
                    <td>{$row['timestamp']}</td>
                  </tr>";
        }
        
        echo "</table>";
    } else {
        echo "No records found.";
    }
    
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<style>
    table {
        border-collapse: collapse;
        width: 100%;
    }

    th, td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #f2f2f2;
    }

    tr:hover {
        background-color: #f5f5f5;
    }
	h3{
		background-color: pink;
		padding: 15px;
	}
</style>
<head>
    <!-- <title>User Logs</title> -->
</head>
<body>
    <br><br><br><br><br><br><h3>User Logs</h3>
    <?php displayUserLogsTable(); ?>
</body>
</html>
