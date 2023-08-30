<?php
session_start();

// Add logUserActivity function here
function logUserActivity($user_id, $activity) {
    // Database connection code here
    // ...
    $host = 'localhost';
	$username = 'root';
	$password = '';
	$database = 'user-management-system';
	
	$conn = new mysqli($host, $username, $password, $database);
	
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

    $activity = $conn->real_escape_string($activity);
    $sql = "INSERT INTO user_logs (user_id, activity) VALUES ('$user_id', '$activity')";
    
    $conn->query($sql);
    $conn->close();
}

if (isset($_SESSION['userid'])) {
    $user_id = $_SESSION['userid'];
    $activity = "Logged out";
    logUserActivity($user_id, $activity);
}

unset($_SESSION['userid']);
unset($_SESSION['name']);
header("Location:login.php");
?>

<?php
// session_start();
unset($_SESSION['userid']);
unset($_SESSION['name']);
header("Location:login.php");
?>