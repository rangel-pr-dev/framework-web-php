<?php
namespace App\Nucleo;

class Fragmento
{
    public const ITEM_LISTA = "ITEM_LISTA";

    private const FRAGMENTO_LISTA = [

        self::ITEM_LISTA => "item/lb_item",
    ];

    //
    public static function fragmentoVisao(string $fragmento): string
    {
        return self::FRAGMENTO_LISTA[$fragmento]
            ?? throw new Erro("Fragmento nao encontrado: {$fragmento}");
    }
}