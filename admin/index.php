<?php
    // incluindo o sistema de autenticação
    include('acesso_com.php'); // Acesso comum
    include('../config.php');
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title><?php echo SYS_NAME?> - Área Administrativa</title>
</head>
<body>
    <?php include('menu_adm.php'); ?>
    <?php include('adm_options.php'); ?>
</body>
</html>