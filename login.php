<?php
session_start();
require ('config.php');

if(isset($_SESSION['admin'])){
    header("Location:/");
}

if(isset($_POST['login']) && $_POST['pass']){
    $login = $_POST['login'];
    $pass = md5($_POST['pass']);

    $SQL = "SELECT * from admin WHERE email = '$login' AND pass = '$pass'";
    $Result = mysqli_query($connection,$SQL);
    if(mysqli_num_rows($Result) == 1){
        $userDataRow = mysqli_fetch_assoc($Result);
        $_SESSION['admin'][0] = $userDataRow['id'];
        $_SESSION['admin'][1] = $userDataRow['name'];
        print("true");
    }else{
        print('<span class="text-danger">You entered wrong email address or password</span>');
    }
}else{

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | <?php print(WEBSITE_NAME); ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="/assets/style.css">
    <link rel="stylesheet" type="text/css" href="/assets/font-awesome.min.css">
    <script src="/assets/function.js"></script>
</head>
<body>
    <div class="container py-5 my-md-5 my-4">
        <div class="row m-0 p-0">
            <div class="col-md-6 col-12 mx-auto border shadow-sm px-4 pt-5 pb-4 rounded">
                <h5 class="text-cus mx-auto text-center mt-0 mb-4">Login to <?php print(WEBSITE_NAME); ?></h5>
                <form onsubmit="return tryLogin();" class="text-center p-4">
                    <input type="email" class="mb-4 p-4 form-control" placeholder="Login Id" id="login" required>
                    <input type="password" class="mb-4 p-4 form-control" placeholder="Password" id="pass" required>
                    <input type="submit" value="Login to <?php print(WEBSITE_NAME); ?>" class="btn btn-cus-2 py-3 px-5 mt-2 rounded-pill text-white" onsubmit="tryLogin();">
                </form>
                <div class="text-center py-1 small" id="login-response"></div>
            </div>
        </div>    
    </div>

</body>
</html>

<?php 
}
?>
