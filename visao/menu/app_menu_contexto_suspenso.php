<?php
/** @var App\Visao_Modelo\VMBasePagina $visaoModelo */
?>
<?php if ($visaoModelo->dadoSeleciona()->layoutMenuContexto): ?>
    <!-- menu global -->
    <div class="d-block d-sm-block d-md-block d-lg-none d-xl-none d-xxl-none">
        <div class="offcanvas offcanvas-start" tabindex="-1" id="menu-contexto-suspenso" aria-labelledby="menu-contexto-suspenso-titulo">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="menu-contexto-suspenso-titulo">
                    <?php echo $visaoModelo->textoNavegacao("menu"); ?>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="XXXX"></button>
            </div>
            <div class="offcanvas-body">
                <?php include "visao/menu/app_menu_contexto_corpo.php"; ?>
            </div>
        </div>
    </div>
<?php endif; ?>