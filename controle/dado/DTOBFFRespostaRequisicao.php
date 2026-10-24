<?php
namespace App\Controle\Dado;

class DTOBFFRespostaRequisicao
{
    public function __construct(
        public string $visao,
    ) {
    }

    public function dado(): array
    {
        return [
            "visao" => $this->visao,
        ];
    }
}