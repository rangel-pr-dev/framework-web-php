<?php
namespace App\Visao_Modelo;

use App\Visao_Apresentacao\VPItemLista;

class VMItemListaFragmento extends VMBaseFragmento
{
    //
    /** @var VPItemLista[] $itemLista */
    protected array $itemLista = [];

    /**
     * @param VPItemLista[] $itemLista
     */
    public function __construct(
        array $itemLista
    ) {
        $this->itemLista = $itemLista;
    }

    //
    public function itemLista(): bool
    {
        return !empty($this->itemLista);
    }
    /** @return VPItemLista[] */
    public function itemListaSeleciona(): array
    {
        return $this->itemLista;
    }
}