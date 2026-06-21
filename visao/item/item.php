<?php
/** @var App\Visao_Modelo\VMItemSeleciona $visaoModelo */
?>
<!-- item_seleciona -->
<div class="row mt-5" data-aos="fade-in">
    <div class="col-5 col-sm-5 col-md-3 col-lg-3 col-xl-2 col-xxl-2 text-center">
        <img class="img-thumbnail border-0 p-0 bg-transparent d-block w-100 imagem-perfil-item <?php echo $visaoModelo->itemSeleciona()->imagemFundo; ?>" src="<?php echo htmlspecialchars($visaoModelo->itemSeleciona()->imagem); ?>" alt="<?php echo $visaoModelo->itemSeleciona()->nome; ?>">
    </div>
    <div class="col-7 col-sm-7 col-md-9 col-lg-9 col-xl-10 col-xxl-10">
        <div class="d-flex flex-column justify-content-center h-100">
            <p class="fs-3 m-0">
                <?php echo $visaoModelo->itemSeleciona()->nome; ?>
            </p>
            <p class="fs-6 m-0 item-qualidade">
                <?php echo $visaoModelo->itemSeleciona()->qualidadeHtml; ?>
            </p>
            <a class="fs-6 link-info text-decoration-none" href="<?php echo $visaoModelo->itemSeleciona()->rotaItemTipo; ?>">
                <?php echo $visaoModelo->itemSeleciona()->itemTipo->nome; ?>
            </a>
        </div>
    </div>
</div>
<!-- item_acao -->
<div class="row mt-5" data-aos="fade-up">
    <div class="col-12">
        <div class="nav nav-tabs flex-column flex-sm-column flex-md-row flex-lg-row flex-xl-row flex-xxl-row flex-nowrap">
            <a class="flex-fill text-sm-start text-md-center text-lg-center text-xl-center text-xxl-center nav-link text-truncate <?php echo ($modo ?? "padrao") == "item_relacionado" ? "active" : ""; ?>" href="<?php echo $visaoModelo->itemSeleciona()->rotaItemRelacionado; ?>">
                <?php echo $visaoModelo->textoConteudoSeleciona("navegacao_item_relacionado"); ?>
            </a>
        </div>
    </div>
</div>