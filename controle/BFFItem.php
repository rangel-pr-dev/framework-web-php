<?php
namespace App\Controle;

use App\Nucleo\Erro;

use App\Nucleo\Configuracao;
use App\Nucleo\Fragmento;
use App\Nucleo\Rota;
use App\Nucleo\BFF;
use App\Nucleo\Renderizacao;

use App\Modelo\MItem;

use App\Visao_Apresentacao\VPItemLista;

use App\Controle\Dado\DTOItemFiltro;

use App\Controle\Dado\DTOBFFRespostaLocalizacao;
use App\Controle\Dado\DTOBFFRespostaPaginacao;

use App\Visao_Modelo\VMItemListaFragmento;

use \Throwable;

class BFFItem
{
    //
    public static function itemListaFiltro()
    {
        $entradaDado = BFF::bffEntradaValida();

        $itemFiltro = DTOItemFiltro::dtoItemFiltro($entradaDado);

        BFF::bffRespostaSucesso((new DTOBFFRespostaLocalizacao(
            Rota::rotaItensFiltro(
                $itemFiltro->entradaItemNome,
                $itemFiltro->entradaItemTipoLista,
                $itemFiltro->entradaItemQualidadeLista,
            )
        ))->dado());
    }

    public static function itemListaPaginacao()
    {
        $entradaDado = BFF::bffEntradaValida();

        //
        try {

            //
            $itemModelo = new MItem();

            // itemLista
            $itemFiltro = DTOItemFiltro::dtoItemFiltro($entradaDado);

            //
            $itemLista = $itemModelo->itemListaFiltro(

                // filtro
                $itemFiltro->entradaItemNome,
                $itemFiltro->entradaItemTipoLista,
                $itemFiltro->entradaItemQualidadeLista,

                // paginacao
                $itemFiltro->entradaItemListaDeslocamento,
                Configuracao::CONFIGURACAO_PAGINACAO_LIMITE,
            );

            //
            $itemFiltro->entradaItemListaDeslocamento += count($itemLista);

            //
            $visaoModeloFragmento = new VMItemListaFragmento(VPItemLista::vpItemFabricaLista($itemLista));

            //
            BFF::bffRespostaSucesso((new DTOBFFRespostaPaginacao(
                Renderizacao::fragmento(Fragmento::ITEM_LISTA, $visaoModeloFragmento),
                $itemFiltro->entradaItemListaDeslocamento,
            ))->dado());
        }
        //
        catch (Erro | Throwable $e) {

            BFF::bffRespostaErroInterno($e->getMessage());
        }
    }
}