<?php
namespace App\Nucleo;

class Sessao
{
    //
    private const IDIOMA = "IDIOMA";
    private const TEMA = "TEMA";
    private const CODIGO_SOLICITACAO = "CODIGO_SOLICITACAO";

    //
    public static function sessaoInicio()
    {
        session_start();
    }

    public static function sessaoFim()
    {
        session_destroy();
    }

    //
    public static function idiomaAtualiza($idioma)
    {
        $_SESSION[self::IDIOMA] = $idioma;
    }

    public static function idiomaSeleciona()
    {
        return $_SESSION[self::IDIOMA] ?? null;
    }

    //
    public static function temaAtualiza($tema)
    {
        $_SESSION[self::TEMA] = $tema;
    }

    public static function temaSeleciona()
    {
        return $_SESSION[self::TEMA] ?? null;
    }

    //
    public static function codigoSolicitacaoAtualiza($codigoSolicitacao)
    {
        $_SESSION[self::CODIGO_SOLICITACAO] = $codigoSolicitacao;
    }

    public static function codigoSolicitacaoSeleciona()
    {
        return $_SESSION[self::CODIGO_SOLICITACAO] ?? null;
    }
}