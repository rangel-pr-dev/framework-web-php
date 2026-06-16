<?php
namespace App\Visao_Modelo;

use App\Visao_Apresentacao\VPDado;

class VMItemLista extends VMBasePagina
{
    //
    protected VMItemListaFiltro $itemListaFiltro;

    //
    protected VMItemListaFragmento $itemListaFragmento;

    private function __construct()
    {

    }

    /**
     * @param VPDado $dado
     * @param ?array $textoConteudo
     * @param VMItemListaFiltro $itemListaFiltro
     * @param VMItemListaFragmento $itemListaFragmento
     * @return VMItemLista
     */
    public static function sucesso(

        VPDado $dado,
        ?array $textoConteudo,

        VMItemListaFiltro $itemListaFiltro,
        VMItemListaFragmento $itemListaFragmento

    ): self {

        $visaoModelo = new self();

        $visaoModelo->dado = $dado;
        $visaoModelo->textoConteudo = $textoConteudo;

        $visaoModelo->itemListaFiltro = $itemListaFiltro;
        $visaoModelo->itemListaFragmento = $itemListaFragmento;

        return $visaoModelo;
    }

    //
    public function itemListaFiltroSeleciona(): VMItemListaFiltro
    {
        return $this->itemListaFiltro;
    }

    //
    public function itemListaFragmentoSeleciona(): VMItemListaFragmento
    {
        return $this->itemListaFragmento;
    }
}