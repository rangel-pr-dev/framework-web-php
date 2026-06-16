<?php
namespace App\Visao_Modelo;

use App\Visao_Apresentacao\VPDado;

abstract class VMBasePagina extends VMBase
{
    //
    protected VPDado $dado;

    //
    protected ?array $textoConteudo;

    //
    public function dadoSeleciona(): VPDado
    {
        return $this->dado;
    }

    //
    public function textoNavegacao(
        string $chave
    ): string {

        return $this->dado->textoNavegacao[$chave] ?? "-";
    }

    //
    public function textoRodape(
        string $chave
    ): string {

        return $this->dado->textoRodape[$chave] ?? "-";
    }

    //
    public function textoMenu(
        string $chave
    ): string {

        return $this->dado->textoMenu[$chave] ?? "-";
    }

    //
    public function textoLateral(
        string $chave
    ): string {

        return $this->dado->textoLateral[$chave] ?? "-";
    }

    //
    public function textoConteudoSeleciona(
        string $chave
    ): string {

        return $this->textoConteudo[$chave] ?? "-";
    }
}