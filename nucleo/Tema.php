<?php
namespace App\Nucleo;

class Tema
{
    //
    private const TEMA_DIA = 0;
    private const TEMA_NOITE = 1;

    //
    private const TEMA_LISTA = [

        self::TEMA_DIA => "dia",
        self::TEMA_NOITE => "noite",
    ];

    //
    public static function temaSuportado(string $tema): bool
    {
        return in_array($tema, self::TEMA_LISTA, true);
    }

    public static function temaPadrao(): string
    {
        return self::TEMA_LISTA[self::TEMA_DIA];
    }

    public static function temaDia(): string
    {
        return self::TEMA_LISTA[self::TEMA_DIA];
    }

    public static function temaNoite(): string
    {
        return self::TEMA_LISTA[self::TEMA_NOITE];
    }

    public static function temaValidoOuPadrao(?string $tema): string
    {
        if ($tema !== null && self::temaSuportado($tema)) {
            return $tema;
        }
        return self::temaPadrao();
    }
}