<?php
function getUser($email, $hash,$conn){
    $stmt = $conn->prepare("SELECT  verified FROM  user WHERE  email = :email AND hash = :hash");
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':hash', $hash);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

