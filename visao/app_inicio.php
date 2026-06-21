<?php
/** @var App\Visao_Modelo\VMInicio $visaoModelo */
?>
<div class="row">
    <div class="col-12">
        <?php include "./visao/estrutura/app_google_ad.php"; ?>
    </div>
</div>
<div class="row">
    <!-- menu lateral -->
    <div class="col-12 col-sm-12 col-md-12 col-lg-3 col-xl-2 col-xxl-2">
        <?php include "./visao/menu/app_menu_contexto_lateral.php"; ?>
    </div>
    <!-- conteudo -->
    <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-8 col-xxl-8">
        <!-- item_lista -->
        <div class="row">
            <div class="col-12">
                <p class="icone-container h5 my-3" data-aos="flip-up">
                    <i class="icone icone-transparente icone-topico"></i>
                    <?php echo $visaoModelo->textoConteudoSeleciona("item_1"); ?>
                </p>
                <div class="card rounded-5">
                    <div class="card-body">
                        <?php $visaoModeloFragmento = $visaoModelo->itemLista1FragmentoSeleciona(); ?>
                        <?php if ($visaoModeloFragmento->itemLista()): ?>
                            <div class="row row-cols-3 row-cols-sm-3 row-cols-md-6 row-cols-lg-6 row-cols-xl-8 row-cols-xxl-12 g-0" data-aos="fade-in">
                                <?php include "./visao/item/lb_item.php"; ?>
                            </div>
                        <?php else: ?>
                            <div class="row" data-aos="fade-in">
                                <div class="col-12">
                                    <p class="m-0 text-warning">
                                        <?php echo $visaoModelo->textoConteudoSeleciona("nenhum_registro"); ?>
                                    </p>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- item_lista -->
        <div class="row">
            <div class="col-12">
                <p class="icone-container h5 my-3" data-aos="flip-up">
                    <i class="icone icone-transparente icone-topico"></i>
                    <?php echo $visaoModelo->textoConteudoSeleciona("item_2"); ?>
                </p>
                <div class="card rounded-5">
                    <div class="card-body">
                        <?php $visaoModeloFragmento = $visaoModelo->itemLista2FragmentoSeleciona(); ?>
                        <?php if ($visaoModeloFragmento->itemLista()): ?>
                            <div class="row row-cols-3 row-cols-sm-3 row-cols-md-6 row-cols-lg-6 row-cols-xl-8 row-cols-xxl-12 g-0" data-aos="fade-in">
                                <?php include "./visao/item/lb_item.php"; ?>
                            </div>
                        <?php else: ?>
                            <div class="row" data-aos="fade-in">
                                <div class="col-12">
                                    <p class="m-0 text-warning">
                                        <?php echo $visaoModelo->textoConteudoSeleciona("nenhum_registro"); ?>
                                    </p>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- app lateral -->
    <div class="col-12 col-sm-12 col-md-12 col-lg-3 col-xl-2 col-xxl-2">
        <?php include "./visao/lateral/app_lateral.php"; ?>
    </div>
</div>