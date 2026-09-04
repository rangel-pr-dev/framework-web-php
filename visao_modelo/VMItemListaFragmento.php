<?php
namespace App\Visao_Modelo;

use App\Visao_Apresentacao\VPItemLista;

class VMItemListaFragmento extends VMBaseFragmento
{
    //
    /** @var VPItemLista[] $itemLista */
    protected array $itemLista = [];

    /**
     * @param ?array $textoConteudo
     * @param VPItemLista[] $itemLista
     * @return self
     */
    public static function sucesso(

        ?array $textoConteudo,
        array $itemLista

    ): self {

        $visaoModeloFragmento = new self();

        $visaoModeloFragmento->textoConteudo = $textoConteudo;
        $visaoModeloFragmento->itemLista = $itemLista;

        return $visaoModeloFragmento;
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