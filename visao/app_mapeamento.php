<?php
/** @var App\Visao_Modelo\VMMapeamento $visaoModelo */
?>
<?php echo "<?xml version='1.0' encoding='UTF-8'?>"; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <?php foreach ($visaoModelo->rotaListaSeleciona() as $rota): ?>
        <url>
            <loc><?= htmlspecialchars($rota, ENT_XML1, 'UTF-8') ?></loc>
            <lastmod><?= htmlspecialchars($visaoModelo->dataSeleciona(), ENT_XML1, 'UTF-8') ?></lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.8</priority>
        </url>
    <?php endforeach; ?>
</urlset>