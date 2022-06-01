<?php
    
    if(!isset($_SESSION['USUARIO'])){
        echo "<script>alert('Não existe nenhum usuario logado!'); location.href='login.php';</script>";
    }

?>