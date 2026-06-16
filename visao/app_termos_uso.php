<?php
/** @var App\Visao_Modelo\VMBaseGenerico $visaoModelo */
?>
<div class="row">
    <div class="col-12">
        <p class="h4 text-center mb-5">
            <?php echo $visaoModelo->textoConteudoSeleciona("titulo"); ?>
        </p>
        <div class="card rounded-5">
            <div class="card-body">
                <p class="m-0">
                    <?php echo $visaoModelo->textoConteudoSeleciona("p1"); ?>
                </p>
                <p class="m-0 mt-2">
                    <?php echo $visaoModelo->textoConteudoSeleciona("p2"); ?>
                </p>
                <hr>
                <p class="icone-container fw-bold my-3">
                    <i class="icone icone-transparente icone-topico"></i>
                    <?php echo $visaoModelo->textoConteudoSeleciona("p_propriedade_intelectual_titulo"); ?>
                </p>
                <p class="m-0">
                    <?php echo $visaoModelo->textoConteudoSeleciona("p_propriedade_intelectual_p1"); ?>
                </p>
                <p class="m-0 mt-2">
                    <?php echo $visaoModelo->textoConteudoSeleciona("p_propriedade_intelectual_p2"); ?>
                </p>
                <p class="icone-container fw-bold my-3">
                    <i class="icone icone-transparente icone-topico"></i>
                    <?php echo $visaoModelo->textoConteudoSeleciona("p_uso_aceitavel_titulo"); ?>
                </p>
                <p class="m-0">
                    <?php echo $visaoModelo->textoConteudoSeleciona("p_uso_aceitavel_p1"); ?>
                </p>
                <p class="m-0 mt-2">
                    <?php echo $visaoModelo->textoConteudoSeleciona("p_uso_aceitavel_p2"); ?>
                </p>
                <p class="m-0 mt-2">
                    <?php echo $visaoModelo->textoConteudoSeleciona("p_uso_aceitavel_p3"); ?>
                </p>
                <p class="m-0 mt-2">
                    <?php echo $visaoModelo->textoConteudoSeleciona("p_uso_aceitavel_p4"); ?>
                </p>
                <p class="m-0 mt-2">
                    <?php echo $visaoModelo->textoConteudoSeleciona("p_uso_aceitavel_p5"); ?>
                </p>
                <p class="m-0 mt-2">
                    <?php echo $visaoModelo->textoConteudoSeleciona("p_uso_aceitavel_p6"); ?>
                </p>
                <p class="icone-container fw-bold my-3">
                    <i class="icone icone-transparente icone-topico"></i>
                    <?php echo $visaoModelo->textoConteudoSeleciona("p_links_terceiros_titulo"); ?>
                </p>
                <p class="m-0">
                    <?php echo $visaoModelo->textoConteudoSeleciona("p_links_terceiros_p1"); ?>
                </p>
                <p class="m-0 mt-2">
                    <?php echo $visaoModelo->textoConteudoSeleciona("p_links_terceiros_p2"); ?>
                </p>
                <p class="icone-container fw-bold my-3">
                    <i class="icone icone-transparente icone-topico"></i>
                    <?php echo $visaoModelo->textoConteudoSeleciona("p_limitacao_responsabilidade_titulo"); ?>
                </p>
                <p class="m-0">
                    <?php echo $visaoModelo->textoConteudoSeleciona("p_limitacao_responsabilidade_p1"); ?>
                </p>
                <p class="m-0 mt-2">
                    <?php echo $visaoModelo->textoConteudoSeleciona("p_limitacao_responsabilidade_p2"); ?>
                </p>
                <p class="icone-container fw-bold my-3">
                    <i class="icone icone-transparente icone-topico"></i>
                    <?php echo $visaoModelo->textoConteudoSeleciona("p_alteracoes_termos_uso_titulo"); ?>
                </p>
                <p class="m-0">
                    <?php echo $visaoModelo->textoConteudoSeleciona("p_alteracoes_termos_uso_p1"); ?>
                </p>
                <p class="icone-container fw-bold my-3">
                    <i class="icone icone-transparente icone-topico"></i>
                    <?php echo $visaoModelo->textoConteudoSeleciona("p_contato_titulo"); ?>
                </p>
                <p class="m-0">
                    <?php echo $visaoModelo->textoConteudoSeleciona("p_contato_p1"); ?>
                </p>
                <hr>
                <p class="m-0">
                    <?php echo $visaoModelo->textoConteudoSeleciona("p3"); ?>
                </p>
            </div>
        </div>
    </div>
</div>