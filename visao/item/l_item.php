<?php
/** @var App\Visao_Modelo\VMItemLista $visaoModelo */
?>
<div class="row">
    <div class="col-12">
        <?php include "./visao/estrutura/app_google_ad.php"; ?>
    </div>
</div>
<div class="row">
    <!-- menu lateral -->
    <div class="col-12 col-sm-12 col-md-12 col-lg-3 col-xl-2 col-xxl-2">
        <?php include "./visao/menu/app_menu_contexto_lateral.php"; ?>
    </div>
    <!-- conteudo -->
    <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-8 col-xxl-8">
        <!-- item_lista_filtro -->
        <div class="row">
            <div class="col-12">
                <div class="modal fade" tabindex="-1" id="m-item-filtro">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">
                                    <?php echo $visaoModelo->textoConteudoSeleciona("filtro_titulo"); ?>
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="XXXX"></button>
                            </div>
                            <div class="modal-body">
                                <div class="container-fluid">
                                    <div class="row" data-aos="fade-in">
                                        <div class="col-12">
                                            <form class="row" id="formulario-item-lista-filtro" data-bff-form="filtro" data-bff-route="<?php echo $visaoModelo->dadoSeleciona()->rotaItensFiltroBFF; ?>" novalidate>
                                                <div class="col-12">
                                                    <p class="text-warning small m-0 my-2">
                                                        <?php echo $visaoModelo->textoConteudoSeleciona("filtro_descricao"); ?>
                                                    </p>
                                                    <p class="text-info m-0 mb-2">
                                                        <?php echo $visaoModelo->textoConteudoSeleciona("filtro_atributo_nome"); ?>
                                                    </p>
                                                    <!-- app_codigo_solicitacao -->
                                                    <input id="entrada-app-codigo-solicitacao" type="text" class="form-control" value="<?php echo $visaoModelo->dadoSeleciona()->appCodigoSolicitacao; ?>" readonly hidden required>
                                                    <!-- item_nome -->
                                                    <input type="text" class="form-control" name="entrada-item-nome" id="entrada-item-nome" placeholder="<?php echo $visaoModelo->textoConteudoSeleciona("filtro_atributo_nome_placeholder"); ?>" value="<?php echo $visaoModelo->itemListaFiltroSeleciona()->entradaItemNomeSeleciona(); ?>" list="entrada-item-nome-lista">
                                                    <?php if ($visaoModelo->itemListaFiltroSeleciona()->itemNomeLista()): ?>
                                                        <datalist id="entrada-item-nome-lista">
                                                            <?php foreach ($visaoModelo->itemListaFiltroSeleciona()->itemNomeListaSeleciona() as $itemNome): ?>
                                                                <option value="<?php echo $itemNome; ?>"></option>
                                                            <?php endforeach; ?>
                                                        </datalist>
                                                    <?php endif; ?>
                                                    <!-- atributo_tipo -->
                                                    <p class="text-info m-0 my-2">
                                                        <?php echo $visaoModelo->textoConteudoSeleciona("filtro_atributo_tipo"); ?>
                                                    </p>
                                                    <?php if ($visaoModelo->itemListaFiltroSeleciona()->itemTipoLista()): ?>
                                                        <?php foreach ($visaoModelo->itemListaFiltroSeleciona()->itemTipoListaSeleciona() as $itemTipo): ?>
                                                            <div class="form-check">
                                                                <?php if (in_array($itemTipo->id, $visaoModelo->itemListaFiltroSeleciona()->entradaItemTipoListaSeleciona())): ?>
                                                                    <input class="form-check-input" type="checkbox" value="<?php echo $itemTipo->id; ?>" name="entrada-item-tipo-lista" id="entrada-item-tipo-<?php echo $itemTipo->id; ?>" checked>
                                                                <?php else: ?>
                                                                    <input class="form-check-input" type="checkbox" value="<?php echo $itemTipo->id; ?>" name="entrada-item-tipo-lista" id="entrada-item-tipo-<?php echo $itemTipo->id; ?>">
                                                                <?php endif; ?>
                                                                <label class="form-check-label texto-limitado" for="entrada-item-tipo-<?php echo $itemTipo->id; ?>">
                                                                    <?php echo $itemTipo->nome; ?>
                                                                </label>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    <?php else: ?>
                                                        <p class="text-warning small m-0 my-2"><?php echo $visaoModelo->textoConteudoSeleciona("nenhum_registro"); ?></p>
                                                    <?php endif; ?>
                                                    <!-- atributo_qualidade -->
                                                    <p class="text-info m-0 my-2">
                                                        <?php echo $visaoModelo->textoConteudoSeleciona("filtro_atributo_qualidade"); ?>
                                                    </p>
                                                    <?php if ($visaoModelo->itemListaFiltroSeleciona()->itemQualidadeLista()): ?>
                                                        <?php foreach ($visaoModelo->itemListaFiltroSeleciona()->itemQualidadeListaSeleciona() as $itemQualidade): ?>
                                                            <div class="form-check">
                                                                <?php if (in_array($itemQualidade, $visaoModelo->itemListaFiltroSeleciona()->entradaItemQualidadeListaSeleciona())): ?>
                                                                    <input class="form-check-input" type="checkbox" value="<?php echo $itemQualidade; ?>" name="entrada-item-qualidade-lista" id="entrada-item-qualidade-<?php echo $itemQualidade; ?>" checked>
                                                                <?php else: ?>
                                                                    <input class="form-check-input" type="checkbox" value="<?php echo $itemQualidade; ?>" name="entrada-item-qualidade-lista" id="entrada-item-qualidade-<?php echo $itemQualidade; ?>">
                                                                <?php endif; ?>
                                                                <label class="form-check-label texto-limitado" for="entrada-item-qualidade-<?php echo $itemQualidade; ?>">
                                                                    <?php echo $itemQualidade; ?>         <?php echo $visaoModelo->textoConteudoSeleciona("filtro_atributo_qualidade_estrelas"); ?>
                                                                </label>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    <?php else: ?>
                                                        <p class="text-warning small m-0 my-2"><?php echo $visaoModelo->textoConteudoSeleciona("nenhum_registro"); ?></p>
                                                    <?php endif; ?>
                                                    <!-- **** -->
                                                    <button type="submit" class="btn btn-success rounded-pill my-2 w-100">
                                                        <?php echo $visaoModelo->textoConteudoSeleciona("bt_filtro_filtrar"); ?>
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- item_lista -->
        <div class="row align-items-center">
            <div class="col-8">
                <p class="icone-container h5 my-3" data-aos="flip-up">
                    <i class="icone icone-transparente icone-topico"></i>
                    <?php echo $visaoModelo->textoConteudoSeleciona("lista"); ?>
                </p>
            </div>
            <div class="col-4">
                <button type="button" class="btn btn-primary rounded-pill float-end d-block m-0" data-bs-toggle="modal" data-bs-target="#m-item-filtro" data-aos="fade-in">
                    <i class="bi bi-funnel-fill"></i>
                    <?php echo $visaoModelo->textoConteudoSeleciona("bt_filtro"); ?>
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card rounded-5">
                    <div class="card-body">
                        <?php $visaoModeloFragmento = $visaoModelo->itemListaFragmentoSeleciona(); ?>
                        <?php if ($visaoModeloFragmento->itemLista()): ?>
                            <div class="row row-cols-3 row-cols-sm-3 row-cols-md-6 row-cols-lg-6 row-cols-xl-8 row-cols-xxl-12 g-0" id="conteudo-item-lista">
                                <?php include "./visao/item/lb_item.php"; ?>
                            </div>
                        <?php else: ?>
                            <div class="row" data-aos="fade-in">
                                <div class="col-12">
                                    <p class="m-0 text-warning">
                                        <?php echo $visaoModelo->textoConteudoSeleciona("nenhum_registro"); ?>
                                    </p>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <form class="row" id="formulario-item-lista-paginacao" data-bff-form="paginacao" data-bff-route="<?php echo $visaoModelo->dadoSeleciona()->rotaItensPaginacaoBFF; ?>" data-bff-target="#conteudo-item-lista" data-bff-offset="#entrada-item-lista-deslocamento" data-bff-button="#botao-item-lista-paginacao" novalidate>
                    <div class="col-12 visually-hidden">
                        <input name="entrada-app-codigo-solicitacao" id="entrada-app-codigo-solicitacao" type="text" class="form-control" value="<?php echo $visaoModelo->dadoSeleciona()->appCodigoSolicitacao; ?>" readonly required>
                        <input name="entrada-item-lista-deslocamento" id="entrada-item-lista-deslocamento" type="number" class="form-control" value="<?php echo $visaoModelo->itemListaFiltroSeleciona()->entradaItemListaDeslocamentoSeleciona(); ?>" readonly required>
                        <input name="entrada-item-nome" id="entrada-item-nome" type="text" class="form-control" value="<?php echo $visaoModelo->itemListaFiltroSeleciona()->entradaItemNomeSeleciona(); ?>" readonly required>
                        <input name="entrada-item-tipo-lista" id="entrada-item-tipo-lista" type="text" class="form-control" value="<?php echo implode(",", $visaoModelo->itemListaFiltroSeleciona()->entradaItemTipoListaSeleciona()); ?>" readonly required>
                        <input name="entrada-item-qualidade-lista" id="entrada-item-qualidade-lista" type="text" class="form-control" value="<?php echo implode(",", $visaoModelo->itemListaFiltroSeleciona()->entradaItemQualidadeListaSeleciona()); ?>" readonly required>
                    </div>
                    <div class="col-12">
                        <div class="d-block w-100 text-center">
                            <button id="botao-item-lista-paginacao" type="submit" class="btn btn-secondary rounded-pill text-truncate my-3">
                                <i class="bi bi-download"></i>
                                <?php echo $visaoModelo->textoConteudoSeleciona("bt_paginacao_mais"); ?>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- app lateral -->
    <div class="col-12 col-sm-12 col-md-12 col-lg-3 col-xl-2 col-xxl-2">
        <?php include "./visao/lateral/app_lateral.php"; ?>
    </div>
</div>