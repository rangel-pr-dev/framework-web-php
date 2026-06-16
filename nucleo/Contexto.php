<?php
namespace App\Nucleo;

class Contexto
{
    //
    private static string $idioma;
    private static string $tema;

    //
    public static function idiomaAtualiza(string $idioma): void
    {
        self::$idioma = $idioma;
    }

    public static function idiomaSeleciona(): string
    {
        return self::$idioma ?? Idioma::idiomaPadrao();
    }

    //
    public static function temaAtualiza(string $tema): void
    {
        self::$tema = $tema;
    }

    public static function temaSeleciona(): string
    {
        return self::$tema ?? Tema::temaPadrao();
    }
}