<?php
/** @var string $visaoConteudo */
/** @var App\Visao_Modelo\VMBasePagina $visaoModelo */
?>
<!DOCTYPE html>
<html lang="<?php echo $visaoModelo->dadoSeleciona()->idioma; ?>" data-bs-theme="<?php echo ($visaoModelo->dadoSeleciona()->tema === 'noite') ? 'dark' : 'light'; ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php echo $visaoModelo->textoConteudoSeleciona("titulo"); ?>
    </title>
    <?php include "./visao/estrutura/app_css.php"; ?>
</head>

<body>
    <?php include "./visao/estrutura/app_navegacao.php"; ?>
    <div class="<?php echo ($visaoModelo->dadoSeleciona()->layoutFluido) ? "container-fluid" : "container"; ?> py-5 mt-5 corpo">
        <?php include $visaoConteudo; ?>
    </div>
    <?php include "./visao/estrutura/app_rodape.php"; ?>
    <?php include "./visao/estrutura/app_js.php"; ?>
</body>

</html>