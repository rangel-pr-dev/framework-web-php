<?php
namespace App\Nucleo;

use App\Controle\CApp;

use App\Controle\CInicio;

use App\Controle\CItem;
use App\Controle\BFFItem;

class Rota
{
    //
    public const ROTA_RAIZ = "RAIZ";
    public const ROTA_ADS = "ADS";
    public const ROTA_ROBOTS = "ROBOTS";
    public const ROTA_MAPEAMENTO = "MAPEAMENTO";

    //
    public const ROTA_CONFIGURA = "CONFIGURA";

    public const PARAMETRO_TEMA = "tema";
    public const PARAMETRO_IDIOMA = "idioma";

    //
    public const ROTA_INICIO = "INICIO";
    public const ROTA_SOBRE = "SOBRE";
    public const ROTA_CONTATO = "CONTATO";
    public const ROTA_TERMOS_USO = "TERMOS_USO";
    public const ROTA_POLITICA_PRIVACIDADE = "POLITICA_PRIVACIDADE";

    //
    public const ROTA_ITEMS = "ITENS";
    public const ROTA_ITEMS_FILTRO = "ITENS_FILTRO";
    public const ROTA_ITEMS_PAGINACAO = "ITENS_PAGINACAO";
    public const ROTA_ITEM = "ITEM";
    public const ROTA_ITEM_RELACIONADOS = "ITEM_RELACIONADOS";

    //
    public const PARAMETRO_ITEM_ID = "id_item";
    public const PARAMETRO_ITEM_NOME = "nome";
    public const PARAMETRO_ITEM_TIPO = "tipo";
    public const PARAMETRO_ITEM_QUALIDADE = "qualidade";

    //
    public const ROTA_METODO = "metodo";
    public const ROTA_URI = "uri";
    public const ROTA_MANIPULADOR = "manipulador";

    //
    public const ROTA_BFF = "bff";
    public const ROTA_FILTRO = "filtro";
    public const ROTA_PAGINACAO = "paginacao";

    //
    public const ROTA_LISTA = [

            //
        self::ROTA_RAIZ => [

            self::ROTA_METODO => "GET",
            self::ROTA_URI => "/",
            self::ROTA_MANIPULADOR => [CApp::class, "appRaiz"]
        ],
        self::ROTA_ADS => [

            self::ROTA_METODO => "GET",
            self::ROTA_URI => '/ads.txt',
            self::ROTA_MANIPULADOR => [CApp::class, "appADS"]
        ],
        self::ROTA_ROBOTS => [

            self::ROTA_METODO => "GET",
            self::ROTA_URI => '/robots.txt',
            self::ROTA_MANIPULADOR => [CApp::class, "appRobots"]
        ],
        self::ROTA_MAPEAMENTO => [

            self::ROTA_METODO => "GET",
            self::ROTA_URI => "/{" . self::PARAMETRO_IDIOMA . "}/mapa_do_site",
            self::ROTA_MANIPULADOR => [CApp::class, "appMapeamento"]
        ],

            //
        self::ROTA_CONFIGURA => [
            self::ROTA_METODO => "GET",
            self::ROTA_URI => "/configura",
            self::ROTA_MANIPULADOR => [CApp::class, "appConfigura"]
        ],

            //
        self::ROTA_INICIO => [

            self::ROTA_METODO => "GET",
            self::ROTA_URI => "/{" . self::PARAMETRO_IDIOMA . "}",
            self::ROTA_MANIPULADOR => [CInicio::class, "appInicio"]
        ],
        self::ROTA_SOBRE => [

            self::ROTA_METODO => "GET",
            self::ROTA_URI => "/{" . self::PARAMETRO_IDIOMA . "}/sobre",
            self::ROTA_MANIPULADOR => [CInicio::class, "appSobre"]
        ],
        self::ROTA_CONTATO => [

            self::ROTA_METODO => "GET",
            self::ROTA_URI => "/{" . self::PARAMETRO_IDIOMA . "}/contato",
            self::ROTA_MANIPULADOR => [CInicio::class, "appContato"]
        ],
        self::ROTA_TERMOS_USO => [

            self::ROTA_METODO => "GET",
            self::ROTA_URI => "/{" . self::PARAMETRO_IDIOMA . "}/termos_de_uso",
            self::ROTA_MANIPULADOR => [CInicio::class, "appTermosUso"]
        ],
        self::ROTA_POLITICA_PRIVACIDADE => [

            self::ROTA_METODO => "GET",
            self::ROTA_URI => "/{" . self::PARAMETRO_IDIOMA . "}/politica_de_privacidade",
            self::ROTA_MANIPULADOR => [CInicio::class, "appPoliticaPrivacidade"]
        ],

            //
        self::ROTA_ITEMS => [

            self::ROTA_METODO => "GET",
            self::ROTA_URI => "/{" . self::PARAMETRO_IDIOMA . "}/itens",
            self::ROTA_MANIPULADOR => [CItem::class, "itemLista"]
        ],
        self::ROTA_ITEMS_FILTRO => [

            self::ROTA_METODO => "POST",
            self::ROTA_URI => "/" . self::ROTA_BFF . "/itens/" . self::ROTA_FILTRO,
            self::ROTA_MANIPULADOR => [BFFItem::class, "itemListaFiltro"]
        ],
        self::ROTA_ITEMS_PAGINACAO => [

            self::ROTA_METODO => "POST",
            self::ROTA_URI => "/" . self::ROTA_BFF . "/itens/" . self::ROTA_PAGINACAO,
            self::ROTA_MANIPULADOR => [BFFItem::class, "itemListaPaginacao"]
        ],
        self::ROTA_ITEM => [

            self::ROTA_METODO => "GET",
            self::ROTA_URI => "/{" . self::PARAMETRO_IDIOMA . "}/item/{" . self::PARAMETRO_ITEM_ID . "}",
            self::ROTA_MANIPULADOR => [CItem::class, "itemSeleciona"]
        ],
        self::ROTA_ITEM_RELACIONADOS => [

            self::ROTA_METODO => "GET",
            self::ROTA_URI => "/{" . self::PARAMETRO_IDIOMA . "}/item/{" . self::PARAMETRO_ITEM_ID . "}/relacionados",
            self::ROTA_MANIPULADOR => [CItem::class, "itemSeleciona"]
        ],
    ];

    // rota
    public static function rotaUrl(
        string $rota,
        array $parametros = [],
        array $filtros = [],
        ?string $idioma = null,
    ): string {

        $definicao = self::ROTA_LISTA[$rota] ?? null;

        if (!$definicao) {

            throw new Erro("Rota '{$rota}' nao existe.");
        }

        $idioma ??= Contexto::idiomaSeleciona();

        $uri = $definicao[self::ROTA_URI];

        $url = preg_replace_callback(

            "/{(\w+)}/",
            function ($m) use ($parametros, $idioma) {

                if ($m[1] === self::PARAMETRO_IDIOMA) {

                    return $idioma;
                }

                return $parametros[$m[1]] ?? throw new Erro("Parametro '{$m[1]}' ausente.");
            },
            $uri
        );

        if ($filtros) {

            $url .= "?" . http_build_query($filtros);
        }

        return $url;
    }

    private static function rotaComId(
        string $rota,
        string $parametro,
        string $valor
    ): string {

        return self::rotaUrl($rota, [$parametro => $valor]);
    }

    private static function filtrarParametros(array $parametros): array
    {
        return array_filter(
            $parametros,
            static fn($v) => $v !== null
        );
    }

    private static function filtrarArray(?array $valores): ?string
    {
        return $valores ? implode(",", $valores) : null;
    }

    // rota
    public static function rotaRaiz(): string
    {
        return self::rotaUrl(self::ROTA_RAIZ);
    }

    // rota : app
    public static function rotaLinguagem(string $idioma): string
    {
        return self::rotaUrl(self::ROTA_CONFIGURA, [], [
            self::PARAMETRO_IDIOMA => $idioma
        ]);
    }

    public static function rotaTema(string $tema): string
    {
        return self::rotaUrl(self::ROTA_CONFIGURA, [], [
            self::PARAMETRO_TEMA => $tema
        ]);
    }

    // rota : app
    public static function rotaInicio(): string
    {
        return self::rotaUrl(self::ROTA_INICIO);
    }

    public static function rotaSobre(): string
    {
        return self::rotaUrl(self::ROTA_SOBRE);
    }
    public static function rotaContato(): string
    {
        return self::rotaUrl(self::ROTA_CONTATO);
    }
    public static function rotaTermosUso(): string
    {
        return self::rotaUrl(self::ROTA_TERMOS_USO);
    }
    public static function rotaPoliticaPrivacidade(): string
    {
        return self::rotaUrl(self::ROTA_POLITICA_PRIVACIDADE);
    }

    // rota: item
    public static function rotaItens(): string
    {
        return self::rotaUrl(self::ROTA_ITEMS);
    }
    /**
     * @param ?string $nome
     * @param ?string[] $tipo
     * @param ?string[] $qualidade
     */
    public static function rotaItensFiltro(
        ?string $nome,
        ?array $tipo,
        ?array $qualidade,
    ): string {

        $parametros = self::filtrarParametros([

            self::PARAMETRO_ITEM_NOME => $nome,
            self::PARAMETRO_ITEM_TIPO => self::filtrarArray($tipo),
            self::PARAMETRO_ITEM_QUALIDADE => self::filtrarArray($qualidade),
        ]);

        return self::rotaUrl(self::ROTA_ITEMS, [], $parametros);
    }
    public static function rotaItensFiltroBFF(): string
    {
        return self::rotaUrl(self::ROTA_ITEMS_FILTRO);
    }
    public static function rotaItensPaginacaoBFF(): string
    {
        return self::rotaUrl(self::ROTA_ITEMS_PAGINACAO);
    }
    public static function rotaItem(string $idItem): string
    {
        return self::rotaComId(self::ROTA_ITEM, self::PARAMETRO_ITEM_ID, $idItem);
    }
    public static function rotaItemRelacionados(string $idItem): string
    {
        return self::rotaComId(self::ROTA_ITEM_RELACIONADOS, self::PARAMETRO_ITEM_ID, $idItem);
    }

    // rota : externo
    public static function rotaPortfolio(): string
    {
        return "https://genial-apps.com";
    }

    public static function rotaLinkedin(): string
    {
        return "https://www.linkedin.com/in/rangelpr";
    }

    public static function rotaGithub(): string
    {
        return "https://github.com/rangel-pr-dev";
    }
}