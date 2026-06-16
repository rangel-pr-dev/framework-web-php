<?php
namespace App\Visao_Modelo;

use App\Visao_Apresentacao\VPDado;

class VMSobre extends VMBasePagina
{
    //
    protected array $topicoLista = [];

    /**
     * @param VPDado $dado
     * @param ?array $textoConteudo
     * @param array $topicoLista
     * @return VMSobre
     */
    public static function sucesso(
        VPDado $dado,
        ?array $textoConteudo,
        array $topicoLista
    ): self {
        $visaoModelo = new self();
        $visaoModelo->dado = $dado;
        $visaoModelo->textoConteudo = $textoConteudo;
        $visaoModelo->topicoLista = $topicoLista;
        return $visaoModelo;
    }

    public function topicoListaSeleciona(): array
    {
        return $this->topicoLista;
    }
}