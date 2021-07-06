<!--LogIn -->

<?php
$page_title='Log_In Area';

include_once('header.php');
include_once('connection.php');

session_start();
//  if user is logged is , go to index
if(isset( $_SESSION['my_email'])){
    $_SESSION['failure']='You are already logged in';
    header("location: index.php");
}

if (isset($_POST['login'])) {
    if (!empty($_POST['email']) &&
        !empty($_POST['password'])) {
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);
        $stmt = $conn->prepare("SELECT  * FROM  user WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        print_r($result);
    }
}
?>

<div class='text-center my_form '>
    <form method="POST">
        <input type="email" name="email"  placeholder="User Email " >
        <input type="password" name="password"  placeholder="User password " >
        <button type="submit" name="login" class="btn btn-success ">LogIn</button>
    </form>
</div>

<?php
include_once('footer.php');