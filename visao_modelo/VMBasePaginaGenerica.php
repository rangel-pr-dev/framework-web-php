<?php
namespace App\Visao_Modelo;

use App\Visao_Apresentacao\VPDado;

class VMBasePaginaGenerica extends VMBasePagina
{
    /**
     * @param VPDado $dado
     * @param ?array $textoConteudo
     * @return VMBasePaginaGenerica
     */
    public static function sucesso(

        VPDado $dado,
        ?array $textoConteudo,

    ): self {

        $visaoModelo = new self();

        $visaoModelo->dado = $dado;
        $visaoModelo->textoConteudo = $textoConteudo;

        return $visaoModelo;
    }
}