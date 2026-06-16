<?php
namespace App\Controle;

use App\Nucleo\Pagina;
use App\Nucleo\Renderizacao;

use App\Modelo\MApp;
use App\Modelo\MItem;

use App\Visao_Apresentacao\VPItemLista;

use App\Servico\AppServico;

use App\Visao_Modelo\VMBaseGenerico;
use App\Visao_Modelo\VMInicio;
use App\Visao_Modelo\VMSobre;

use App\Visao_Modelo\VMItemListaFragmento;

class CInicio
{
    //
    public static function appInicio()
    {
        $appModelo = new MApp();
        $itemModelo = new MItem();

        $itemLista1 = $itemModelo->itemListaFiltro(

            null,
            null,
            [5],
            null,
            null
        );

        $itemLista2 = $itemModelo->itemListaFiltro(

            null,
            null,
            [4],
            null,
            null
        );

        $visaoModelo = VMInicio::sucesso(
            $appModelo->dado(),
            $appModelo->textoPagina(Pagina::APP_INICIO),
            new VMItemListaFragmento(VPItemLista::vpItemFabricaLista($itemLista1)),
            new VMItemListaFragmento(VPItemLista::vpItemFabricaLista($itemLista2)),
        );

        Renderizacao::paginaComLayout(Pagina::APP_INICIO, $visaoModelo);
    }

    public static function appSobre()
    {
        $appModelo = new MApp();
        $appServico = new AppServico();

        $visaoModelo = VMSobre::sucesso(
            $appModelo->dado(false),
            $appModelo->textoPagina(Pagina::APP_SOBRE),
            $appServico->sobreTopicoLista()
        );

        Renderizacao::paginaComLayout(Pagina::APP_SOBRE, $visaoModelo);
    }

    public static function appContato()
    {
        $appModelo = new MApp();

        $visaoModelo = VMBaseGenerico::sucesso(
            $appModelo->dado(false),
            $appModelo->textoPagina(Pagina::APP_CONTATO),
        );

        Renderizacao::paginaComLayout(Pagina::APP_CONTATO, $visaoModelo);
    }

    public static function appTermosUso()
    {
        $appModelo = new MApp();

        $visaoModelo = VMBaseGenerico::sucesso(
            $appModelo->dado(false),
            $appModelo->textoPagina(Pagina::APP_TERMOS_USO),
        );

        Renderizacao::paginaComLayout(Pagina::APP_TERMOS_USO, $visaoModelo);
    }

    public static function appPoliticaPrivacidade()
    {
        $appModelo = new MApp();

        $visaoModelo = VMBaseGenerico::sucesso(
            $appModelo->dado(false),
            $appModelo->textoPagina(Pagina::APP_POLITICA_PRIVACIDADE),
        );

        Renderizacao::paginaComLayout(Pagina::APP_POLITICA_PRIVACIDADE, $visaoModelo);
    }
}