<?php
namespace App\Visao_Modelo;

class VMBaseFragmentoGenerico extends VMBaseFragmento
{
    /**
     * @param ?array $textoConteudo
     * @return VMBaseFragmentoGenerico
     */
    public static function sucesso(

        ?array $textoConteudo,

    ): self {

        $visaoModelo = new self();

        $visaoModelo->textoConteudo = $textoConteudo;

        return $visaoModelo;
    }
}