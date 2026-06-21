<?php
/** @var App\Visao_Modelo\VMBasePagina $visaoModelo */
?>
<p class="px-3 my-3">
    <?php echo $visaoModelo->textoMenu("sessao_menu_1"); ?>
</p>
<div class="list-group rounded-4 w-100">
    <a class="list-group-item list-group-item-action text-truncate icone-container" href="<?php echo $visaoModelo->dadoSeleciona()->rotaInicio; ?>">
        <i class="icone icone-inicio"></i>
        <?php echo $visaoModelo->textoMenu("bt_inicio"); ?>
    </a>
    <a class="list-group-item list-group-item-action text-truncate icone-container" href="<?php echo $visaoModelo->dadoSeleciona()->rotaItens; ?>">
        <i class="icone icone-item"></i>
        <?php echo $visaoModelo->textoMenu("bt_item"); ?>
    </a>
</div>
<p class="px-3 my-3">
    <?php echo $visaoModelo->textoMenu("sessao_menu_2"); ?>
</p>
<div class="list-group rounded-4 w-100">
    <a class="list-group-item list-group-item-action text-truncate icone-container" href="<?php echo $visaoModelo->dadoSeleciona()->rotaPortfolio; ?>" target="_blank">
        <i class="icone icone-ferramenta"></i>
        <?php echo $visaoModelo->textoMenu("bt_portfolio"); ?>
    </a>
</div>