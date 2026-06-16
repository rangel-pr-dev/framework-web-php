<?php
namespace App\Nucleo;

class Pagina
{
    // Estrutura
    public const APP = "APP";

    // Erro
    public const APP_ERRO_404 = "APP_ERRO_404";
    public const APP_ERRO_405 = "APP_ERRO_405";
    public const APP_ERRO_500 = "APP_ERRO_500";

    // Técnico
    public const APP_ADS = "APP_ADS";
    public const APP_ROBOTS = "APP_ROBOTS";
    public const APP_MAPEAMENTO = "APP_MAPEAMENTO";

    // App
    public const APP_INICIO = "APP_INICIO";
    public const APP_SOBRE = "APP_SOBRE";
    public const APP_CONTATO = "APP_CONTATO";
    public const APP_TERMOS_USO = "APP_TERMOS_USO";
    public const APP_POLITICA_PRIVACIDADE = "APP_POLITICA_PRIVACIDADE";

    // Entidade
    public const ITEM_LISTA = "ITEM_LISTA";
    public const ITEM_SELECAO = "ITEM_SELECAO";

    private const PAGINA_LISTA = [

            //
        self::APP => "estrutura/app",

            // Erro
        self::APP_ERRO_404 => "app_erro_404",
        self::APP_ERRO_405 => "app_erro_405",
        self::APP_ERRO_500 => "app_erro_500",

            // Técnico
        self::APP_ADS => "app_ads",
        self::APP_ROBOTS => "app_robots",
        self::APP_MAPEAMENTO => "app_mapeamento",

            // App
        self::APP_INICIO => "app_inicio",
        self::APP_SOBRE => "app_sobre",
        self::APP_CONTATO => "app_contato",
        self::APP_TERMOS_USO => "app_termos_uso",
        self::APP_POLITICA_PRIVACIDADE => "app_politica_privacidade",

            // Entidade
        self::ITEM_LISTA => "item/l_item",
        self::ITEM_SELECAO => "item/s_item",
    ];

    //
    private static function pagina(string $pagina): string
    {
        return self::PAGINA_LISTA[$pagina]
            ?? throw new Erro("Pagina nao encontrada: {$pagina}");
    }

    //
    public static function paginaVisao(string $pagina): string
    {
        return self::pagina($pagina);
    }

    //
    public static function paginaTexto(string $pagina): string
    {
        return self::pagina($pagina);
    }
}