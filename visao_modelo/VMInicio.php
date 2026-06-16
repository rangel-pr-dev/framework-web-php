<?php
namespace App\Visao_Modelo;

use App\Visao_Apresentacao\VPDado;

class VMInicio extends VMBasePagina
{
    //
    protected VMItemListaFragmento $itemLista1Fragmento;
    protected VMItemListaFragmento $itemLista2Fragmento;

    /**
     * @param VPDado $dado
     * @param ?array $textoConteudo
     * @param VMItemListaFragmento $itemLista1Fragmento
     * @param VMItemListaFragmento $itemLista2Fragmento
     * @return VMInicio
     */
    public static function sucesso(

        VPDado $dado,
        ?array $textoConteudo,

        VMItemListaFragmento $itemLista1Fragmento,
        VMItemListaFragmento $itemLista2Fragmento,

    ): self {

        $visaoModelo = new self();

        $visaoModelo->dado = $dado;
        $visaoModelo->textoConteudo = $textoConteudo;

        $visaoModelo->itemLista1Fragmento = $itemLista1Fragmento;
        $visaoModelo->itemLista2Fragmento = $itemLista2Fragmento;

        return $visaoModelo;
    }

    //
    public function itemLista1FragmentoSeleciona(): VMItemListaFragmento
    {
        return $this->itemLista1Fragmento;
    }

    public function itemLista2FragmentoSeleciona(): VMItemListaFragmento
    {
        return $this->itemLista2Fragmento;
    }
}