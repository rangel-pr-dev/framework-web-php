<?php
namespace App\Visao_Modelo;

class VMBaseFragmentoErro extends VMBaseFragmento
{
    //
    protected ?string $erroMensagem = null;

    //
    protected bool $erroMensagemExibe = false;

    /**
     * @param ?array $textoConteudo
     * @param ?string $erroMensagem
     * @param bool $erroMensagemExibe
     * @return VMBaseFragmentoErro
     */
    public static function sucesso(
        ?array $textoConteudo,
        ?string $erroMensagem,
        bool $erroMensagemExibe,
    ): self {

        $visaoModelo = new self();

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