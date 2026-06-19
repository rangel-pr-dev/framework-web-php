<?php
namespace App\Nucleo;

class Sessao
{
    //
    private const IDIOMA = "IDIOMA";
    private const TEMA = "TEMA";
    private const CODIGO_SOLICITACAO = "CODIGO_SOLICITACAO";

    //
    public static function sessaoInicio(): void
    {
        session_start();
    }

    public static function sessaoFim(): void
    {
        session_destroy();
    }

    //
    public static function idiomaAtualiza(string $idioma)
    {
        $_SESSION[self::IDIOMA] = $idioma;
    }

    public static function idiomaSeleciona(): ?string
    {
        return $_SESSION[self::IDIOMA] ?? null;
    }

    //
    public static function temaAtualiza(string $tema)
    {
        $_SESSION[self::TEMA] = $tema;
    }

    public static function temaSeleciona(): ?string
    {
        return $_SESSION[self::TEMA] ?? null;
    }

    //
    public static function codigoSolicitacaoAtualiza(string $codigoSolicitacao)
    {
        $_SESSION[self::CODIGO_SOLICITACAO] = $codigoSolicitacao;
    }

    public static function codigoSolicitacaoSeleciona(): ?string
    {
        return $_SESSION[self::CODIGO_SOLICITACAO] ?? null;
    }
}