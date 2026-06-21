<?php
/** @var App\Visao_Modelo\VMInicio $visaoModelo */
?>
<!-- secao -->
<section id="<?php echo $visaoModelo->dadoSeleciona()->rotaInicio; ?>">
    <div class="row">
        <div class="col-12">
            <div class="text-center m-0 pt-5">
                <h2 class="fw-bold texo-gradiente" data-aos="zoom-out" data-aos-duration="1500">
                    <?php echo $visaoModelo->textoConteudoSeleciona("titulo"); ?>
                </h2>
            </div>
        </div>
        <div class="col-12">
            <h4 class="text-center text-muted py-5" data-aos="fade-in" data-aos-duration="1500">
                <?php echo $visaoModelo->textoConteudoSeleciona("nenhum_registro"); ?>
            </h4>
        </div>
        <div class="col-12">
            <div class="card border-0 p-0 rounded-5 shadow-lg" data-aos="fade-up" data-aos-duration="1500">
                <div class="row g-0 align-items-center">
                    <div class="col-12">
                        <div class="card-body p-5">
                            <h3 class="card-title fw-bold text-primary">
                                <?php echo $visaoModelo->textoConteudoSeleciona("nenhum_registro"); ?>
                            </h3>
                            <p class="card-subtitle lead fw-normal py-3">
                                <?php echo $visaoModelo->textoConteudoSeleciona("nenhum_registro"); ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>