<?php
namespace App\Visao_Modelo;

use App\Visao_Apresentacao\VPDado;

class VMMapeamento extends VMBasePagina
{
    /** @var string[] */
    protected array $rotaLista;

    /**
     * @param VPDado $dado
     * @param ?array $textoConteudo
     * @param string[] $rotaLista
     * @return VMMapeamento
     */
    public static function sucesso(

        VPDado $dado,
        ?array $textoConteudo,

        array $rotaLista,

    ): self {

        $visaoModelo = new self();

        $visaoModelo->dado = $dado;
        $visaoModelo->textoConteudo = $textoConteudo;

        $visaoModelo->rotaLista = $rotaLista;

        return $visaoModelo;
    }

    //
    public function rotaLista(): bool
    {
        return !empty($this->rotaLista);
    }

    /** @return string[] */
    public function rotaListaSeleciona(): array
    {
        return $this->rotaLista;
    }

    //
    public function dataSeleciona(): string
    {
        return date("c", strtotime(date('Y-m-d H:i:s')));
    }
}