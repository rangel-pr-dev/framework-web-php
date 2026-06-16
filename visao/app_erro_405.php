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
                <?php echo $visaoModelo->textoConteudoSeleciona("erro_405"); ?>
            </p>
            <?php if ($visaoModelo->erroMensagemExibe()): ?>
                <p class="text-center text-warning mt-5 mb-0">
                    <?php echo $visaoModelo->erroMensagemSeleciona(); ?>
                </p>
            <?php endif; ?>
        </div>
    </div>
</div>
