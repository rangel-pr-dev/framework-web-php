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
                    <?php echo $visaoModelo->textoConteudoSeleciona("subtitulo"); ?>
                </p>
                <hr>
                <p class="fw-bold my-3">
                    <i class="bi bi-envelope-at-fill me-2"></i>
                    <?php echo $visaoModelo->textoConteudoSeleciona("email_label"); ?>
                </p>
                <p class="m-0">
                    <a class="link-info text-decoration-none" href="mailto:<?php echo $visaoModelo->dadoSeleciona()->appEmail; ?>">
                        <?php echo $visaoModelo->dadoSeleciona()->appEmail; ?>
                    </a>
                </p>
                <p class="fw-bold my-3">
                    <i class="bi bi-globe me-2"></i>
                    <?php echo $visaoModelo->textoConteudoSeleciona("portfolio_label"); ?>
                </p>
                <p class="m-0">
                    <a class="link-info text-decoration-none" href="<?php echo $visaoModelo->dadoSeleciona()->rotaPortfolio; ?>" target="_blank">
                        <?php echo str_replace(['http://', 'https://'], '', $visaoModelo->dadoSeleciona()->rotaPortfolio); ?>
                    </a>
                </p>
                <p class="fw-bold my-3">
                    <i class="bi bi-linkedin me-2"></i>
                    <?php echo $visaoModelo->textoConteudoSeleciona("linkedin_label"); ?>
                </p>
                <p class="m-0">
                    <a class="link-info text-decoration-none" href="<?php echo $visaoModelo->dadoSeleciona()->rotaLinkedin; ?>" target="_blank">
                        <?php echo str_replace(['http://', 'https://'], '', $visaoModelo->dadoSeleciona()->rotaLinkedin); ?>
                    </a>
                </p>
                <p class="fw-bold my-3">
                    <i class="bi bi-github me-2"></i>
                    <?php echo $visaoModelo->textoConteudoSeleciona("github_label"); ?>
                </p>
                <p class="m-0">
                    <a class="link-info text-decoration-none" href="<?php echo $visaoModelo->dadoSeleciona()->rotaGithub; ?>" target="_blank">
                        <?php echo str_replace(['http://', 'https://'], '', $visaoModelo->dadoSeleciona()->rotaGithub); ?>
                    </a>
                </p>
                <hr>
                <p class="m-0">
                    <?php echo $visaoModelo->textoConteudoSeleciona("p_convite"); ?>
                </p>
            </div>
        </div>
    </div>
</div>