<html lang = "en">

    <head>
        <title>logout</title>
    </head>
</html>
<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


if (isset($_POST['login']) && !empty($_POST['username']) && !empty($_POST['password'])) {


    $msg = 'Right username or password';
    ?>
<h4 class = "form-signin-heading"><?php echo $msg; ?></h4>
<?php
} 
?>