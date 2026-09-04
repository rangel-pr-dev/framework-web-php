<?php
namespace App\Visao_Modelo;

abstract class VMBaseFragmento extends VMBase
{
    //
    protected ?array $textoConteudo;

    //
    public function textoConteudoSeleciona(
        string $chave
    ): string {

        return $this->textoConteudo[$chave] ?? $chave;
    }
}