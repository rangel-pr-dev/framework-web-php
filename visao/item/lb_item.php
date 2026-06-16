<?php
/** @var App\Visao_Modelo\VMItemListaFragmento $visaoModeloFragmento */
?>
<?php foreach ($visaoModeloFragmento->itemListaSeleciona() as $item): ?>
    <div class="col p-1" data-aos="fade-in">
        <a class="btn btn-link text-decoration-none text-center d-block w-100 p-0 m-0 border-0" href="<?php echo $item->rotaItem; ?>">
            <div class="ratio ratio-1x1">
                <img class="img-thumbnail border-0 p-0 bg-transparent d-block w-100 imagem-perfil-item <?php echo $item->imagemFundo; ?>" src="<?php echo htmlspecialchars($item->imagem); ?>" alt="<?php echo $item->nome; ?>">
            </div>
            <span class="texto-limitado">
                <?php echo $item->nome; ?>
            </span>
        </a>
    </div>
<?php endforeach; ?>