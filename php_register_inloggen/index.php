

<!--Index-->
<?php $page_title = ' Index'; ?>
<?php require_once('header.php');
include_once('connection.php');

session_start();
$loggedIn = false;
if (isset($_SESSION['my_email'])){
   $email= $_SESSION['my_email'];
$loggedIn = true;
    $stmt = $conn->prepare(" SELECT * FROM user WHERE email=:email");

    $stmt->bindParam(':email', $email);
    $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        echo '<h1 class="text-center"> Welcome : '. $result['first_name'].'</h1><br>';

//    foreach ($result as $user){
//      echo  $result['email'].'<br>';
//    }

}
?>

<p><?php  if (isset($_SESSION['failure']) ){

    echo $_SESSION['failure'];};
unset($_SESSION['failure']);
?>
</p>



<div class="container-fluid index_van">

    <nav>
        <ul>
            <?php  if (!$loggedIn){
            ?>
            <li><a href="register.php" class="btn btn-primary">Register</a></li>
            <li><a href="login.php" class="btn btn-success ">LogIn</a></li>
            <?php }  ?>

            <?php  if ($loggedIn){
            ?>
            <li><a href="loguit.php" class="btn btn-danger">LogUit</a></li>
            <?php }  ?>
        </ul>
    </nav>
</div>

<?php require_once('footer.php'); ?>

