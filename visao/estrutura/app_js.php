<?php
/** @var App\Visao_Modelo\VMBasePagina $visaoModelo */
?>
<!-- jquery js -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<!-- bootstrap js -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- aos js -->
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>

<?php if ($visaoModelo->dadoSeleciona()->googleServicoExibe): ?>
    <!-- google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?= $visaoModelo->dadoSeleciona()->googleAnalyticsId; ?>"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag("js", new Date());
        gtag("config", "<?= $visaoModelo->dadoSeleciona()->googleAnalyticsId; ?>");
    </script>
<?php endif; ?>

<!-- rota js -->
<script>
    window.App = {

        ambiente: "<?= $visaoModelo->dadoSeleciona()->ambiente; ?>",
        idioma: "<?= $visaoModelo->dadoSeleciona()->idioma; ?>",
        tema: "<?= $visaoModelo->dadoSeleciona()->tema; ?>",
        logExibe: <?= $visaoModelo->dadoSeleciona()->appLogExibe ? 'true' : 'false'; ?>,

        bff: {

            contrato: <?= json_encode($visaoModelo->dadoSeleciona()->bffContrato, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?>,
        }
    };
</script>
<!-- principal js -->
<script src="/js/principal.js"></script>