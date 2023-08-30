<?php
include('class/User.php');
$user = new User();
$user->loginStatus();
include('include/header.php');
?>
<title>CMS Landing</title>
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
<?php include('include/container.php');?>
<div class="container contact">	
    <h2>CMS User Landing Page</h2>	
    <?php include('menu.php');?>
    <div class="table-responsive">	
        <h3>Welcome to Contact Sharing App</h3>
    
        <?php
        // database connection
        $host = 'localhost';
    	$username = 'root';
    	$password = '';
    	$database = 'user-management-system';
        
        $conn = new mysqli($host, $username, $password, $database);
        
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        $sql = "SELECT first_name, last_name, gender, mobile, designation FROM user";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>First Name</th><th>Last Name</th><th>Gender</th><th>Mobile</th><th>Designation</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["first_name"] . "</td><td>" . $row["last_name"] . "</td><td>" . $row["gender"] . "</td><td>" . $row["mobile"] . "</td><td>" . $row["designation"] . "</td></tr>";
            }
            echo "</table>";
        } else {
            echo "No records found";
        }
        
        $conn->close();
        ?>
    
    </div>
</div>	
<?php include('include/footer.php');?>

