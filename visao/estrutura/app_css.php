<?php /** @var App\Visao_Modelo\VMBasePagina $visaoModelo */ ?>
<!-- bootstrap css -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
<!-- bootstrap icons css -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.css">
<!-- aos css -->
<link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
<!-- google font css -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
<!--  google ads -->
<?php if ($visaoModelo->dadoSeleciona()->googleServicoExibe): ?>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=<?= $visaoModelo->dadoSeleciona()->googleAdClient; ?>" crossorigin="anonymous"></script>
<?php endif; ?>
<!-- principal css -->
<link rel="stylesheet" href="/css/principal.css">