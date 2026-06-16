<?php
/** @var App\Visao_Modelo\VMItemSeleciona $visaoModelo */
?>
<div class="row" data-aos="fade-up">
    <div class="col-12">
        <p class="icone-container h5 my-3">
            <i class="icone icone-transparente icone-topico"></i>
            <?php echo $visaoModelo->textoConteudoSeleciona("item_relacionado_item"); ?>
        </p>
        <div class="card rounded-5 my-3">
            <div class="card-body">
                <?php $visaoModeloFragmento = $visaoModelo->itemListaFragmentoSeleciona(); ?>
                <?php if ($visaoModeloFragmento->itemLista()): ?>
                    <div class="row row-cols-3 row-cols-sm-3 row-cols-md-6 row-cols-lg-6 row-cols-xl-8 row-cols-xxl-12 g-0">
                        <?php include "./visao/item/lb_item.php"; ?>
                    </div>
                <?php else: ?>
                    <p class="m-0 text-warning"><?php echo $visaoModelo->textoConteudoSeleciona("nenhum_registro"); ?></p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>