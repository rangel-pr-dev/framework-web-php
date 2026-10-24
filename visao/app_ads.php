<?php
/** @var App\Visao_Modelo\VMBasePaginaGenerica $visaoModelo */
?>
<?php if ($visaoModelo->dadoSeleciona()->googleAd): ?>google.com, pub-<?= $visaoModelo->dadoSeleciona()->googleAdClientId; ?>, DIRECT, <?= $visaoModelo->dadoSeleciona()->googleAdTag; ?><?php endif; ?>