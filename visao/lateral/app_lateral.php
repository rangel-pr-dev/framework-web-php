<?php
/** @var App\Visao_Modelo\VMBasePagina $visaoModelo */
?>
<div class="row d-none d-sm-none d-md-none d-lg-block d-xl-block d-xxl-block">
    <div class="col-12">
        <p class="my-3">
            <?php echo $visaoModelo->textoLateral("sessao_lateral_1"); ?>
        </p>
        <form class="d-block" action="https://www.paypal.com/donate" method="post" target="_blank">
            <div>
                <input type="hidden" name="hosted_button_id" value="<?php echo $visaoModelo->dadoSeleciona()->appPaypalId; ?>" />
                <button type="submit" class="btn btn-secondary text-start text-truncate rounded-pill w-100">
                    <i class="bi bi-hand-thumbs-up-fill"></i>
                    <?php echo $visaoModelo->textoLateral("bt_doacao"); ?>
                </button>
            </div>
        </form>
    </div>
</div>