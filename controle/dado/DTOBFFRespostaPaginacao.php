<?php
namespace App\Controle\Dado;

class DTOBFFRespostaPaginacao
{
    public function __construct(
        public string $visao,
        public int $deslocamento
    ) {
    }

    public function dado(): array
    {
        return [
            "visao" => $this->visao,
            "deslocamento" => $this->deslocamento,
        ];
    }
}