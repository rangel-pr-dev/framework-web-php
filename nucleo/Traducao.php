<?php
namespace App\Nucleo;

class Traducao
{
    //
    public static function arquivo(string $arquivo): array
    {
        $idioma = Contexto::idiomaSeleciona();

        $traducaoArquivo = dirname(__DIR__) . "/traducao/$idioma/$arquivo.php";

        if (!is_readable($traducaoArquivo)) {

            throw new Erro("Arquivo de traducao nao encontrado: $traducaoArquivo");
        }

        return include $traducaoArquivo;
    }

    //
    public static function textoVisao(string $visao): array
    {
        return self::arquivo($visao);
    }
}