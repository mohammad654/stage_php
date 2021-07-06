<?php

$page_title = 'Register Area';
include_once('header.php');
require_once'mail.php';
include_once('connection.php');

session_start();
if(isset( $_SESSION['my_email'])){
    // success , failure
    $_SESSION['failure']='You are already Registered';
    header("location: index.php");
}

//start register__________________________________________________________________________
if (isset($_POST['register'])) {


    if (!empty($_POST['first_name']) &&
        !empty($_POST['last_name'])
        && !empty($_POST['email'])
        && !empty($_POST['password'])
        && !empty($_POST['confirm'])) {

        $first_name = htmlspecialchars($_POST['first_name']);
        $last_name = htmlspecialchars($_POST['last_name']);
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);
        $confirm = htmlspecialchars($_POST['confirm']);
       $pass_hash = password_hash($password, PASSWORD_BCRYPT, ['COST' => 20]);
        $errors = '';
        if ($password != $confirm) {//Password
            $errors .= "Password and confimration deos not match<br>";
        }
         if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {//FILTER_VALIDATE
             $errors .= "Your Email Is Not valid<br>";
         }


         if(empty($errors)){ // register

             //Email Is Exist
             $stmt = $conn->prepare("SELECT  email FROM  user WHERE  email = :email");
             $stmt->bindParam(':email', $email);
             $stmt->execute();
             $result = $stmt->fetch(PDO::FETCH_ASSOC);
             if ($result){
                 $errors.= "Your Email Is Exist <br>";
                 echo $errors;
             }else{
                 $hash = md5( rand(0,1000) );
                 $stmt = $conn->prepare("INSERT INTO user (first_name, last_name,email ,password,hash)
                            VALUES (:first_name,:last_name,:email,:password,:hash)");
                 $stmt->bindParam(':first_name', $first_name);
                 $stmt->bindParam(':last_name', $last_name);
                 $stmt->bindParam(':email', $email);
                 $stmt->bindParam(':password', $pass_hash);
                 $stmt->bindParam(':hash', $hash);
                 $stmt->execute();
                 ////  Email Confirmation __________________________________________________________________________
                 ///
                $e_mail = $_POST['email'];
                $e_mail = base64_decode(urldecode($_POST['user_email']));
                $rand = md5(uniqid(mt_rand(), true));
                $base64 = base64_decode($rand);
                $modified = str_replace(array('+', '='), array('', ''), $base64);
                $token = substr($base64, 0, 33);
                echo $modified;


                $mail->setFrom(' mohammad.ali.shikhi.55@gmail.com', 'Mohammad ');
                $mail->addAddress($_POST['email'], ' PHP');     // Add a recipient
// Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = 'Register';
                $mail->Body = ' Thank for Subscribe ' . '</b><br>' .

                    'Activation ' . "<b><a href='http://localhost/6-PHP/Whales/activation.php?email=$email&hash=$hash'

                    style='color: greenyellow;font-size: 30px'>". 'Activation' . '</a></b><br>';

                $mail->send();


                 header("location: login.php");
             }
         }  else { // register
             echo $errors;
         }

    }else{//If Not Empty
        echo "All Data Require";
    }

}


//$public_key="6Le0QcYZAAAAAC75zwkg7uMqBCwTPnE0WFdObupY";
//$private_key="6Le0QcYZAAAAAP8qlD72kvNppI7gq1su1I0uCn5y";
//$url="https://www.google.com/recaptcha/api/siteverify";
//$response_key=$_POST['g-recaptcha'];
//$response=file_get_contents($url."?secret=".$private_key."&response=".$response_key."&remoteip=".$_SERVER['REMOTE_ADDR']);
//$response=json_decode($response);



//start register__________________________________________________________________________
//if (isset($_POST['register'])) {

////Recaptcha______________________
//    if (!isset($_POST['g-recaptcha-response'])) {
//        echo "Check";
//        return;
//    }
//    $url = 'https://www.google.com/recaptcha/api/siteverify';
//    $myvars = 'secret=6Le0QcYZAAAAAP8qlD72kvNppI7gq1su1I0uCn5y' . '&response=' . $_POST['g-recaptcha-response'];
//
//    $ch = curl_init($url);
//    curl_setopt($ch, CURLOPT_POST, 1);
//    curl_setopt($ch, CURLOPT_POSTFIELDS, $myvars);
//    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
//    curl_setopt($ch, CURLOPT_HEADER, 0);
//    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//    $response = json_decode(curl_exec($ch));
//    curl_close($ch);

//    if ($response->success == true) {



//
//



//

//                if ($stmt) {
//                    header("location: login.php");
//                } else {
//                    header("location: register.php");
//                }
//            } else {//FILTER_VALIDATE
//                echo "Email is not VALIDATE";
//            }
//
//        } else {
//            echo "Your Password is not equal to confirm password";
//        }
//
//    } else {
//        echo 'All field required';
//    }
//}
//}
//    } else {
//        echo 'Invalid reCaptcha';
//        return;
//    }

//    mysqli_real_escape_string
/*
preg_match
escape php
 */

//    if ($stmt) {
//        header("location: timezone.php");
//    } else {
//
//    }
//    $pattern="/^[a-zA-Z]{3,15}$/";
//    if (preg_match($pattern,$user)){
//     $er_n= "name must be at last 3 character long ";
//    }
?>

    <div class='text-center my_form '>
    <form method="POST">

        <input type="text" class="form-control" name="first_name"  required placeholder="First Name "  >
        <input type="text" class="form-control" name="last_name"  required placeholder="Last Name "  >
        <input type="text" class="form-control" name="email"  required placeholder="User Email ">
        <input type="password" class="form-control" name="password" required placeholder="User password ">
        <input type="password"  class="form-control" name="confirm"  required placeholder="confirm password ">

<!--        <script src='https://www.google.com/recaptcha/api.js'></script>-->
<!--        <div class="g-recaptcha" data-sitekey="--><?php //echo $public_key ?><!--"></div>-->

        <button type="submit" class="btn btn-primary" name="register">Register</button>

    </form>
</div>


<?php
require_once('footer.php');