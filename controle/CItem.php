<?php
namespace App\Controle;

use App\Nucleo\Configuracao;
use App\Nucleo\Pagina;
use App\Nucleo\Renderizacao;

use App\Modelo\MApp;
use App\Modelo\MItem;

use App\Visao_Apresentacao\VPItemLista;
use App\Visao_Apresentacao\VPItemSelecao;

use App\Controle\Dado\DTOItemFiltro;

use App\Visao_Modelo\VMItemLista;
use App\Visao_Modelo\VMItemListaFiltro;
use App\Visao_Modelo\VMItemListaFragmento;
use App\Visao_Modelo\VMItemSeleciona;

class CItem
{
    //
    public static function itemLista()
    {
        $appModelo = new MApp();
        $itemModelo = new MItem();

        $itemFiltro = DTOItemFiltro::dtoItemFiltro($_GET);
        $itemLista = $itemModelo->itemListaFiltro(
            $itemFiltro->entradaItemNome,
            $itemFiltro->entradaItemTipoLista,
            $itemFiltro->entradaItemQualidadeLista,
            $itemFiltro->entradaItemListaDeslocamento,
            Configuracao::CONFIGURACAO_PAGINACAO_LIMITE,
        );

        $itemFiltro->entradaItemListaDeslocamento += count($itemLista);

        $visaoModelo = VMItemLista::sucesso(
            $appModelo->dado(),
            $appModelo->textoPagina(Pagina::ITEM_LISTA),
            new VMItemListaFiltro($itemFiltro),
            new VMItemListaFragmento(VPItemLista::vpItemFabricaLista($itemLista)),
        );

        Renderizacao::paginaComLayout(Pagina::ITEM_LISTA, $visaoModelo);
    }

    public static function itemSeleciona($parametroLista)
    {
        $appModelo = new MApp();
        $itemModelo = new MItem();

        // item
        $item = $itemModelo->itemSeleciona($parametroLista["id_item"]);

        //
        if ($item) {

            // itemLista
            $itemLista = $itemModelo->itemRelacionamentoLista($item->idRelacionamento);

            //
            $visaoModelo = VMItemSeleciona::sucesso(

                $appModelo->dado(),
                $appModelo->textoPagina(Pagina::ITEM_SELECAO),
                VPItemSelecao::vpItemFabrica($item),
                new VMItemListaFragmento(VPItemLista::vpItemFabricaLista($itemLista)),
            );

            //
            Renderizacao::paginaComLayout(Pagina::ITEM_SELECAO, $visaoModelo);
        }
        //
        else {

            CApp::appErro404();
            exit;
        }
    }
}