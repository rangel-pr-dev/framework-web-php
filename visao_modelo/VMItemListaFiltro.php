<?php
namespace App\Visao_Modelo;

use App\Controle\Dado\DTOItemFiltro;

use App\Base_Dado\Entidade\BDItemTipo;

class VMItemListaFiltro
{
    //
    /** @var string[] */
    protected array $itemNomeLista = [];

    /** @var BDItemTipo[] */
    protected array $itemTipoLista = [];

    /** @var int[] */
    protected array $itemQualidadeLista = [];

    //
    protected ?string $entradaItemNome = null;

    /** @var string[] */
    protected array $entradaItemTipoLista = [];

    /** @var int[] */
    protected array $entradaItemQualidadeLista = [];

    /** @var int */
    protected int $entradaItemListaDeslocamento = 0;

    public function __construct(
        DTOItemFiltro $filtro
    ) {

        $this->itemNomeLista = $filtro->itemNomeLista;
        $this->itemTipoLista = $filtro->itemTipoLista;
        $this->itemQualidadeLista = $filtro->itemQualidadeLista;

        $this->entradaItemNome = $filtro->entradaItemNome;
        $this->entradaItemTipoLista = $filtro->entradaItemTipoLista;
        $this->entradaItemQualidadeLista = $filtro->entradaItemQualidadeLista;

        $this->entradaItemListaDeslocamento = $filtro->entradaItemListaDeslocamento;
    }

    //
    public function itemNomeLista(): bool
    {
        return !empty($this->itemNomeLista);
    }
    /** @return string[] */
    public function itemNomeListaSeleciona(): array
    {
        return $this->itemNomeLista;
    }

    //
    public function itemTipoLista(): bool
    {
        return !empty($this->itemTipoLista);
    }
    /** @return BDItemTipo[] */
    public function itemTipoListaSeleciona(): array
    {
        return $this->itemTipoLista;
    }

    //
    public function itemQualidadeLista(): bool
    {
        return !empty($this->itemQualidadeLista);
    }
    /** @return int[] */
    public function itemQualidadeListaSeleciona(): array
    {
        return $this->itemQualidadeLista;
    }

    //
    public function entradaItemNomeSeleciona(): ?string
    {
        return $this->entradaItemNome;
    }

    /** @return string[] */
    public function entradaItemTipoListaSeleciona(): array
    {
        return $this->entradaItemTipoLista;
    }

    /** @return int[] */
    public function entradaItemQualidadeListaSeleciona(): array
    {
        return $this->entradaItemQualidadeLista;
    }

    /** @return int */
    public function entradaItemListaDeslocamentoSeleciona(): int
    {
        return $this->entradaItemListaDeslocamento;
    }
}