<?php
/** @var App\Visao_Modelo\VMSobre $visaoModelo */
?>
<div class="row">
    <div class="col-12">
        <p class="h4 text-center mb-5">
            <?php echo $visaoModelo->textoConteudoSeleciona("titulo"); ?>
        </p>
        <div class="card rounded-5">
            <?php $topicoLista = $visaoModelo->topicoListaSeleciona(); ?>
            <div class="card-body text-center">
                <p class="m-0">
                    <?php echo $visaoModelo->textoConteudoSeleciona($topicoLista["topico_1"]["titulo"]); ?>
                </p>
                <p class="m-0 mt-2">
                    <?php echo $visaoModelo->textoConteudoSeleciona($topicoLista["topico_1"]["descricao"]); ?>
                </p>
                <hr>
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-4 col-lg-3 col-xl-2 col-xxl-2 m-auto">
                        <img class="image-fluid rounded-circle w-100" src="<?php echo $visaoModelo->dadoSeleciona()->logomarca; ?>" alt="<?php echo $visaoModelo->textoNavegacao("titulo"); ?>">
                    </div>
                </div>
                <hr>
                <p class="m-0">
                    <?php echo $visaoModelo->textoConteudoSeleciona($topicoLista["topico_2"]["titulo"]); ?>
                </p>
                <p class="m-0">
                    <?php echo $visaoModelo->textoConteudoSeleciona($topicoLista["topico_2"]["descricao"]); ?>
                </p>
            </div>
        </div>
    </div>
</div>