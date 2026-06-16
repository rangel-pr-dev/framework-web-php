<?php
/** @var App\Visao_Modelo\VMBaseErro $visaoModelo */
?>
<div class="row vh-100 align-items-center">
    <div class="col-12">
        <div class="justify-content-center">
            <p class="display-1 fw-bold text-center mb-5">
                <?php echo $visaoModelo->textoConteudoSeleciona("titulo"); ?>
            </p>
            <p class="text-center m-0">
                <?php echo $visaoModelo->textoConteudoSeleciona("erro_404"); ?>
            </p>
            <div class="text-center mt-5">
                <a href="<?php echo $visaoModelo->dadoSeleciona()->rotaInicio; ?>" class="btn btn-outline-info rounded-pill">
                    <?php echo $visaoModelo->textoConteudoSeleciona("bt_inicio"); ?>
                </a>
            </div>
        </div>
    </div>
</div>