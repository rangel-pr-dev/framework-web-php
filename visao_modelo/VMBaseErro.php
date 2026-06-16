<?php
namespace App\Visao_Modelo;

use App\Visao_Apresentacao\VPDado;

class VMBaseErro extends VMBasePagina
{
    //
    protected ?string $erroMensagem = null;

    //
    protected bool $erroMensagemExibe = false;

    /**
     * @param VPDado $dado
     * @param ?array $textoConteudo
     * @param ?string $erroMensagem
     * @param bool $erroMensagemExibe
     * @return VMBaseErro
     */
    public static function sucesso(
        VPDado $dado,
        ?array $textoConteudo,
        ?string $erroMensagem,
        bool $erroMensagemExibe,
    ): self {

        $visaoModelo = new self();

        $visaoModelo->dado = $dado;
        $visaoModelo->textoConteudo = $textoConteudo;
        $visaoModelo->erroMensagem = $erroMensagem;
        $visaoModelo->erroMensagemExibe = $erroMensagemExibe;

        return $visaoModelo;
    }

    //
    public function erroMensagemSeleciona(): ?string
    {
        return $this->erroMensagem;
    }

    //
    public function erroMensagemExibe(): bool
    {
        return $this->erroMensagemExibe;
    }
}