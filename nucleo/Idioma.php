<?php
namespace App\Nucleo;

class Idioma
{
    //
    private const IDIOMA_PT_BR = 0;
    private const IDIOMA_EN_US = 1;

    //
    private const IDIOMA_LISTA = [

        self::IDIOMA_PT_BR => "pt-br",
        self::IDIOMA_EN_US => "en-us",
    ];

    //
    public static function idiomaSuportado(string $idioma): bool
    {
        return in_array($idioma, self::IDIOMA_LISTA, true);
    }

    public static function idiomaPadrao(): string
    {
        return self::IDIOMA_LISTA[self::IDIOMA_PT_BR];
    }

    //
    public static function idiomaLista(): array
    {
        return self::IDIOMA_LISTA;
    }

    public static function idiomaPTBR(): string
    {
        return self::IDIOMA_LISTA[self::IDIOMA_PT_BR];
    }

    public static function idiomaENUS(): string
    {
        return self::IDIOMA_LISTA[self::IDIOMA_EN_US];
    }

    //
    public static function idiomaValidoOuPadrao(?string $idioma): string
    {
        if ($idioma !== null && self::idiomaSuportado($idioma)) {
            return $idioma;
        }

        return self::idiomaPadrao();
    }
}