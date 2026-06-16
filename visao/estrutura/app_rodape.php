<?php
/** @var App\Visao_Modelo\VMBasePagina $visaoModelo */
?>
<footer class="footer py-2 <?php echo ($visaoModelo->dadoSeleciona()->tema === 'noite') ? 'bg-dark' : 'bg-light'; ?>" data-bs-theme="<?php echo ($visaoModelo->dadoSeleciona()->tema === 'noite') ? 'dark' : 'light'; ?>">
    <div class="<?php echo ($visaoModelo->dadoSeleciona()->layoutFluido) ? "container-fluid" : "container"; ?>">
        <div class="row">
            <div class="col-12">
                <nav class="nav flex-column flex-md-row flex-lg-row">
                    <a class="nav-link text-start" role="button" href="<?php echo $visaoModelo->dadoSeleciona()->rotaSobre; ?>"><?php echo $visaoModelo->textoRodape("bt_app_sobre"); ?></a>
                    <a class="nav-link text-start" role="button" href="<?php echo $visaoModelo->dadoSeleciona()->rotaContato; ?>"><?php echo $visaoModelo->textoRodape("bt_app_contato"); ?></a>
                    <a class="nav-link text-start" role="button" href="<?php echo $visaoModelo->dadoSeleciona()->rotaTermosUso; ?>"><?php echo $visaoModelo->textoRodape("bt_app_termos_uso"); ?></a>
                    <a class="nav-link text-start" role="button" href="<?php echo $visaoModelo->dadoSeleciona()->rotaPoliticaPrivacidade; ?>"><?php echo $visaoModelo->textoRodape("bt_app_politica_privacidade"); ?></a>
                </nav>
            </div>
            <div class="col-12">
                <p class="m-0 p-3 text-start">&copy; <?php echo date("Y") . " " . $visaoModelo->textoRodape("p1"); ?></p>
            </div>
        </div>
    </div>
</footer>