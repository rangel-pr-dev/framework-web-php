<?php
namespace App\Nucleo;

use App\Controle\CApp;
use Throwable;

class Aplicacao
{
    public static function executa(): void
    {
        $url = self::urlSolicitada();

        try {

            Sessao::sessaoInicio();

            Sessao::codigoSolicitacaoAtualiza(Sessao::codigoSolicitacaoSeleciona() ?? bin2hex(random_bytes(32)));

            Contexto::temaAtualiza(Tema::temaValidoOuPadrao(Sessao::temaSeleciona()));

            self::roteamento()->rotaExecuta(
                $url,
                $_SERVER["REQUEST_METHOD"] ?? "GET"
            );
        }
        //
        catch (Throwable $e) {

            self::trataErro($e, $url);
        }
    }

    private static function roteamento(): Roteamento
    {
        $roteamento = new Roteamento();

        foreach (Rota::ROTA_LISTA as $rota) {

            $roteamento->rotaRegistra(
                $rota[Rota::ROTA_METODO],
                $rota[Rota::ROTA_URI],
                $rota[Rota::ROTA_MANIPULADOR],
            );
        }

        return $roteamento;
    }

    private static function urlSolicitada(): string
    {
        $url = $_GET["url"] ?? null;

        if ($url !== null && $url !== "") {

            return $url;
        }

        $url = parse_url($_SERVER["REQUEST_URI"] ?? "/", PHP_URL_PATH) ?: "/";
        $diretorioScript = str_replace("\\", "/", dirname($_SERVER["SCRIPT_NAME"] ?? ""));

        if (
            $diretorioScript !== ""
            && $diretorioScript !== "/"
            && str_starts_with($url, $diretorioScript)
        ) {

            $url = substr($url, strlen($diretorioScript)) ?: "/";
        }

        return $url;
    }

    private static function trataErro(Throwable $e, string $url): void
    {
        error_log($e->getMessage());

        $ambiente = Configuracao::ambienteAtual();

        if (self::solicitacaoBff($url)) {

            BFF::bffRespostaErroInterno(
                self::erroMensagem($e->getMessage(), $ambiente)
            );
        }

        try {

            CApp::appErro500(
                $e->getMessage(),
                $ambiente,
            );
            exit;
        }
        //
        catch (Throwable $erroAplicacao) {

            error_log($erroAplicacao->getMessage());

            echo self::erroMensagem($e->getMessage(), $ambiente);
        }
    }

    private static function solicitacaoBff(string $url): bool
    {
        return str_starts_with(trim($url, "/"), Rota::ROTA_BFF . "/");
    }

    private static function erroMensagem(
        string $erroMensagem,
        string $ambiente
    ): string {

        return match ($ambiente) {

            Configuracao::AMBIENTE_LOCAL => $erroMensagem,
            Configuracao::AMBIENTE_PRODUCAO => "Ocorreu um erro interno na aplicacao.",
            default => "Ocorreu um erro interno na aplicacao.",
        };
    }
}