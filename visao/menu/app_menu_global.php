<?php
/** @var App\Visao_Modelo\VMBasePagina $visaoModelo */
?>
<?php if ($visaoModelo->dadoSeleciona()->layoutMenuGlobal): ?>
    <!-- menu global -->
    <div class="collapse navbar-collapse " id="menu-global">
        <ul class="navbar-nav ms-auto">
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $visaoModelo->dadoSeleciona()->rotaInicio; ?>">
                    <?php echo $visaoModelo->textoMenu("bt_inicio"); ?>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $visaoModelo->dadoSeleciona()->rotaItens; ?>">
                    <?php echo $visaoModelo->textoMenu("bt_item"); ?>
                </a>
            </li>
        </ul>
    </div>
<?php endif; ?>