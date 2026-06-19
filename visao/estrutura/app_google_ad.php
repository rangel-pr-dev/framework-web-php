<?php
/** @var App\Visao_Modelo\VMBasePagina $visaoModelo */
?>
<?php if ($visaoModelo->dadoSeleciona()->googleServicoExibe): ?>
    <div class="d-block w-100">
        <!-- Principal -->
        <ins class="adsbygoogle" style="display:block" data-ad-client="<?= $visaoModelo->dadoSeleciona()->googleAdClient; ?>" data-ad-slot="<?= $visaoModelo->dadoSeleciona()->googleAdSlot; ?>" data-ad-format="auto" data-full-width-responsive="true"></ins>
        <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
        </script>
    </div>
<?php endif; ?>