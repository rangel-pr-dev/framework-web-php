<?php
namespace App\Controle\Dado;

class DTOBFFRespostaLocalizacao
{
    public function __construct(
        public string $localizacao
    ) {
    }

    public function dado(): array
    {
        return [
            "localizacao" => $this->localizacao,
        ];
    }
}