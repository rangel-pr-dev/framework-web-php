<?php /** @var App\Visao_Modelo\VMBaseGenerico $visaoModelo */ ?>
User-agent: *

Allow: /

Sitemap: <?= $visaoModelo->dadoSeleciona()->urlBase . $visaoModelo->dadoSeleciona()->rotaMapeamentoPortugues; ?>

Sitemap: <?= $visaoModelo->dadoSeleciona()->urlBase . $visaoModelo->dadoSeleciona()->rotaMapeamentoIngles; ?>