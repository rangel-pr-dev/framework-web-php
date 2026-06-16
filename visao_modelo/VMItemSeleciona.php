<?php
namespace App\Visao_Modelo;

use App\Visao_Apresentacao\VPDado;

use App\Visao_Apresentacao\VPItemSelecao;

class VMItemSeleciona extends VMBasePagina
{
    //
    protected VPItemSelecao $item;

    //
    protected VMItemListaFragmento $itemListaFragmento;

    /**
     * @param VPDado $dado
     * @param ?array $textoConteudo
     * @param VPItemSelecao $item
     * @param VMItemListaFragmento $itemListaFragmento
     * @return VMItemSeleciona
     */
    public static function sucesso(

        VPDado $dado,
        ?array $textoConteudo,

        VPItemSelecao $item,
        VMItemListaFragmento $itemListaFragmento,

    ): self {

        $visaoModelo = new self();

        $visaoModelo->dado = $dado;
        $visaoModelo->textoConteudo = $textoConteudo;

        $visaoModelo->item = $item;
        $visaoModelo->itemListaFragmento = $itemListaFragmento;

        return $visaoModelo;
    }

    //
    public function itemSeleciona(): VPItemSelecao
    {
        return $this->item;
    }
    public function item(): bool
    {
        return !empty($this->item);
    }

    //
    public function itemListaFragmentoSeleciona(): VMItemListaFragmento
    {
        return $this->itemListaFragmento;
    }
}