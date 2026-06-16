<?php
/** @var App\Visao_Modelo\VMItemSeleciona $visaoModelo */
$modo = $modo ?? "item_relacionado";
?>
<div class="row">
    <div class="col-12">
        <?php include "./visao/estrutura/app_google_ad.php"; ?>
    </div>
</div>
<div class="row">
    <div class="col-12 col-sm-12 col-md-12 col-lg-3 col-xl-2 col-xxl-2">
        <?php include "./visao/menu/app_menu.php"; ?>
    </div>
    <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-8 col-xxl-8">
        <?php if ($visaoModelo->item()): ?>
            <!-- item -->
            <?php include "./visao/item/item.php"; ?>
            <!-- modo -->
            <?php
            switch ($modo) {
                default:
                    include "./visao/item/item_relacionado.php";
                    break;
            }
            ?>
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
    <div class="col-12 col-sm-12 col-md-12 col-lg-3 col-xl-2 col-xxl-2">
        <?php include "./visao/lateral/app_lateral.php"; ?>
    </div>
</div>