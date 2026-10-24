<?php /** @var App\Visao_Modelo\VMBasePaginaGenerica $visaoModelo */ ?>
User-agent: *

Allow: /

Sitemap: <?= $visaoModelo->dadoSeleciona()->urlBase . $visaoModelo->dadoSeleciona()->rotaMapeamentoPortugues; ?>

Sitemap: <?= $visaoModelo->dadoSeleciona()->urlBase . $visaoModelo->dadoSeleciona()->rotaMapeamentoIngles; ?>

Ads: <?= $visaoModelo->dadoSeleciona()->urlBase . $visaoModelo->dadoSeleciona()->rotaAds; ?>