<?php
// session_start();
include('class/User.php');
$user = new User();
$errorMessage =  $user->login();

// Function to log user activity
function logUserActivity($user_id, $activity) {
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

// Check if login is successful
if ($user->login()) {
    $user_id = $_SESSION['userid'];
    $activity = "Logged in";
    logUserActivity($user_id, $activity);

    header("Location: dashboard.php"); // Redirect to dashboard after successful login
}

include('include/header.php');
?>
<title>CMS User Login</title>
<?php include('include/container.php');?>
<div class="container contact">    
    <h2>CMS User Login</h2>
    <div class="col-md-6">
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="panel-title">Log In</div>
            </div>
            <div style="padding-top:30px" class="panel-body">
                <?php if ($errorMessage != '') { ?>
                    <div id="login-alert" class="alert alert-danger col-sm-12"><?php echo $errorMessage; ?></div>
                <?php } ?>
                <form id="loginform" class="form-horizontal" role="form" method="POST" action="">
                    <div style="margin-bottom: 25px" class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input type="text" class="form-control" id="loginId" name="loginId" value="<?php if(isset($_COOKIE["loginId"])) { echo $_COOKIE["loginId"]; } ?>" placeholder="email">
                    </div>
                    <div style="margin-bottom: 25px" class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input type="password" class="form-control" id="loginPass" name="loginPass" value="<?php if(isset($_COOKIE["loginPass"])) { echo $_COOKIE["loginPass"]; } ?>" placeholder="password">
                    </div>
                    <div class="input-group">
                      <div class="checkbox">
                        <label>
                          <input  type="checkbox" id="remember" name="remember" <?php if(isset($_COOKIE["loginId"])) { ?> checked <?php } ?>> Remember me
                        </label>
                        <label><a href="forget_password.php">Forget your password</a></label>
                      </div>
                    </div>
                    <div style="margin-top:10px" class="form-group">
                        <div class="col-sm-12 controls">
                          <input type="submit" name="login" value="Login" class="btn btn-info">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12 control">
                            <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                                Don't have an account!
                            <a href="register.php">
                                Register
                            </a>Here.
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include('include/footer.php');?>
