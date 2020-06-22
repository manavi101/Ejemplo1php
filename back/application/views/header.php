<!DOCTYPE html>
<html>
    <head>
        <title>Ejercicio 1 php</title>
        <meta name="" content="" />
        <link rel="stylesheet" href="css/bootstrap.min.css"  crossorigin="anonymous"> 
        <script>
            var csrfName="<?php echo $this->security->get_csrf_token_name(); ?>"
            var csrfHash="<?php echo $this->security->get_csrf_hash(); ?>"
        </script>
        <script src="js/ajax.js" crossorigin="anonymous"></script>
        <script src="js/jquery-3.4.1.js" crossorigin="anonymous"></script>
        <script src="js/popper.js"  crossorigin="anonymous"></script>
        <script src="js/bootstrap.min.js" crossorigin="anonymous"></script>
    </head>
   