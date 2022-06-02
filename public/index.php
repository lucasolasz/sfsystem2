<?php
include './../app/config/configuracao.php';
include './../app/Libraries/Rota.php';
include './../app/Libraries/Controller.php';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo URL?>/public/css/estilos.css" rel="stylesheet">
    <title><?php echo APP_NOME ?></title>
</head>

<body>

    <?php
    $rotas = new Rota();
    
    ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo URL?>/public/js/jquery.funcoes.js"></script>
</body>

</html>