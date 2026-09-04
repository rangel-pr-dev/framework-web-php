<?php
/** @var App\Visao_Modelo\VMBasePagina $visaoModelo */
?>
<?php if ($visaoModelo->dadoSeleciona()->googleAd && $visaoModelo->dadoSeleciona()->googleAdBanner): ?>
    <div class="d-block w-100 text-center">
        <!-- google ads -->
        <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-<?= $visaoModelo->dadoSeleciona()->googleAdClientId; ?>" data-ad-slot="<?= $visaoModelo->dadoSeleciona()->googleAdSlot; ?>" data-ad-format="auto" data-full-width-responsive="true"></ins>
        <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
        </script>
        <script>
            if (<?= $visaoModelo->dadoSeleciona()->appLogExibe ? 'true' : 'false'; ?>) {
                console.log("Google Ads Slot ID: <?= $visaoModelo->dadoSeleciona()->googleAdSlot; ?>");
            }
        </script>
    </div>
<?php endif; ?>