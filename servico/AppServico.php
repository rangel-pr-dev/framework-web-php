<?php
namespace App\Servico;

class AppServico
{
    public function sobreTopicoLista(): array
    {
        return [
            "topico_1" => [
                "titulo" => "topico_1",
                "descricao" => "p1"
            ],
            "topico_2" => [
                "titulo" => "topico_2",
                "descricao" => "p2"
            ],
        ];
    }
}