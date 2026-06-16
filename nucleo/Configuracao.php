<?php
namespace App\Nucleo;

use App\Nucleo\Erro;
use Throwable;

class Configuracao
{
    //
    private const CONFIGURACAO_CHAVE_AMBIENTE = "APP_AMBIENTE";

    //
    public const AMBIENTE_LOCAL = "local";
    public const AMBIENTE_PRODUCAO = "producao";
    public const AMBIENTE_INDEFINIDO = "indefinido";

    //
    private const CONFIGURACAO_CHAVE_APP_EMAIL = "APP_EMAIL";

    //
    private const CONFIGURACAO_CHAVE_BD_SERVIDOR = "BD_SERVIDOR";
    private const CONFIGURACAO_CHAVE_BD_USUARIO_PT_BR = "BD_USUARIO_PT_BR";
    private const CONFIGURACAO_CHAVE_BD_USUARIO_EN_US = "BD_USUARIO_EN_US";
    private const CONFIGURACAO_CHAVE_BD_SENHA = "BD_SENHA";
    private const CONFIGURACAO_CHAVE_BD_NOME_PT_BR = "BD_NOME_PT_BR";
    private const CONFIGURACAO_CHAVE_BD_NOME_EN_US = "BD_NOME_EN_US";

    //
    private const CONFIGURACAO_CHAVE_GOOGLE_ANALYTICS_ID = "GOOGLE_ANALYTICS_ID";
    private const CONFIGURACAO_CHAVE_GOOGLE_AD_CLIENT = "GOOGLE_AD_CLIENT";
    private const CONFIGURACAO_CHAVE_GOOGLE_AD_SLOT = "GOOGLE_AD_SLOT";
    private const CONFIGURACAO_CHAVE_APP_ADS_TAG = "APP_ADS_TAG";

    //
    private const CONFIGURACAO_CHAVE_APP_PAYPAL_ID = "APP_PAYPAL_ID";

    //
    public const CONFIGURACAO_PAGINACAO_LIMITE = 50;

    //
    private const CONFIGURACAO_CHAVE_LISTA = [

            // App Configuração
        self::CONFIGURACAO_CHAVE_APP_EMAIL,

            // Base Dado
        self::CONFIGURACAO_CHAVE_BD_SERVIDOR,
        self::CONFIGURACAO_CHAVE_BD_USUARIO_PT_BR,
        self::CONFIGURACAO_CHAVE_BD_USUARIO_EN_US,
        self::CONFIGURACAO_CHAVE_BD_SENHA,
        self::CONFIGURACAO_CHAVE_BD_NOME_PT_BR,
        self::CONFIGURACAO_CHAVE_BD_NOME_EN_US,

            // Google Services
        self::CONFIGURACAO_CHAVE_GOOGLE_ANALYTICS_ID,
        self::CONFIGURACAO_CHAVE_GOOGLE_AD_CLIENT,
        self::CONFIGURACAO_CHAVE_GOOGLE_AD_SLOT,
        self::CONFIGURACAO_CHAVE_APP_ADS_TAG,

            // Integração Externa
        self::CONFIGURACAO_CHAVE_APP_PAYPAL_ID,
    ];

    //
    private static ?array $configuracao = null;

    //
    public static function ambienteSeleciona(): string
    {
        $ambiente =
            $_SERVER[self::CONFIGURACAO_CHAVE_AMBIENTE]
            ?? getenv(self::CONFIGURACAO_CHAVE_AMBIENTE)
            ?? null;

        if ($ambiente === null || $ambiente === "") {

            throw new Erro("Ambiente nao configurado. Defina " . self::CONFIGURACAO_CHAVE_AMBIENTE . " no servidor.");
        }

        $ambienteLista = [
            self::AMBIENTE_LOCAL,
            self::AMBIENTE_PRODUCAO,
        ];

        if (!in_array($ambiente, $ambienteLista, true)) {

            throw new Erro("Ambiente invalido: $ambiente");
        }

        return $ambiente;
    }

    public static function ambienteAtual(): string
    {
        try {

            return self::ambienteSeleciona();
        }
        //
        catch (Throwable) {

            return self::AMBIENTE_INDEFINIDO;
        }
    }

    //
    private static function configuracaoValida(
        array $configuracao,
        string $arquivo
    ): void {

        foreach (self::CONFIGURACAO_CHAVE_LISTA as $chave) {

            if (!array_key_exists($chave, $configuracao)) {

                throw new Erro("Chave obrigatoria ausente em $arquivo: $chave");
            }
        }
    }

    private static function configuracaoCarrega(): array
    {
        if (self::$configuracao !== null) {

            return self::$configuracao;
        }

        $ambiente = self::ambienteSeleciona();
        $arquivo = dirname(__DIR__) . "/configuracao.$ambiente.php";

        if (!file_exists($arquivo)) {

            throw new Erro("Arquivo de configuracao nao encontrado para o ambiente: $ambiente");
        }

        $configuracao = include $arquivo;

        if (!is_array($configuracao)) {

            throw new Erro("Configuracao invalida no arquivo: $arquivo");
        }

        self::configuracaoValida($configuracao, $arquivo);

        self::$configuracao = $configuracao;

        return self::$configuracao;
    }

    private static function configuracaoValor(string $chave): string
    {
        $configuracao = self::configuracaoCarrega();

        return $configuracao[$chave];
    }

    // App Configuração
    public static function appEmail(): string
    {
        return self::configuracaoValor(self::CONFIGURACAO_CHAVE_APP_EMAIL);
    }

    // Base Dado
    public static function bdServidor(): string
    {
        return self::configuracaoValor(self::CONFIGURACAO_CHAVE_BD_SERVIDOR);
    }

    public static function bdUsuarioPTBR(): string
    {
        return self::configuracaoValor(self::CONFIGURACAO_CHAVE_BD_USUARIO_PT_BR);
    }

    public static function bdUsuarioENUS(): string
    {
        return self::configuracaoValor(self::CONFIGURACAO_CHAVE_BD_USUARIO_EN_US);
    }

    public static function bdSenha(): string
    {
        return self::configuracaoValor(self::CONFIGURACAO_CHAVE_BD_SENHA);
    }

    public static function bdNomePTBR(): string
    {
        return self::configuracaoValor(self::CONFIGURACAO_CHAVE_BD_NOME_PT_BR);
    }

    public static function bdNomeENUS(): string
    {
        return self::configuracaoValor(self::CONFIGURACAO_CHAVE_BD_NOME_EN_US);
    }

    // Google Services
    public static function googleAnalyticsId(): ?string
    {
        return self::configuracaoValor(self::CONFIGURACAO_CHAVE_GOOGLE_ANALYTICS_ID);
    }
    public static function googleAdClient(): ?string
    {
        return self::configuracaoValor(self::CONFIGURACAO_CHAVE_GOOGLE_AD_CLIENT);
    }
    public static function googleAdSlot(): ?string
    {
        return self::configuracaoValor(self::CONFIGURACAO_CHAVE_GOOGLE_AD_SLOT);
    }
    public static function appAdsTag(): string
    {
        return self::configuracaoValor(self::CONFIGURACAO_CHAVE_APP_ADS_TAG);
    }

    // Integração Externa
    public static function appPaypalId(): ?string
    {
        return self::configuracaoValor(self::CONFIGURACAO_CHAVE_APP_PAYPAL_ID);
    }
}