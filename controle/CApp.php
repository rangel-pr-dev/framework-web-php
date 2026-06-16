<?php
namespace App\Controle;

use App\Nucleo\Configuracao;
use App\Nucleo\Contexto;
use App\Nucleo\Sessao;
use App\Nucleo\Idioma;
use App\Nucleo\Tema;
use App\Nucleo\Pagina;
use App\Nucleo\Renderizacao;
use App\Nucleo\Rota;
use App\Nucleo\Erro;

use App\Modelo\MApp;
use App\Modelo\MItem;

use App\Visao_Modelo\VMBaseErro;
use App\Visao_Modelo\VMBaseGenerico;
use App\Visao_Modelo\VMMapeamento;

class CApp
{
    //
    public static function appRaiz()
    {
        $idioma = Idioma::idiomaValidoOuPadrao(Sessao::idiomaSeleciona());

        header("Location: " . (new MApp())->dado()->urlBase . "/{$idioma}", true, 302);

        exit;
    }

    //
    public static function appErro404()
    {
        http_response_code(404);

        $appModelo = new MApp();

        $visaoModelo = VMBaseErro::sucesso(
            $appModelo->dado(),
            $appModelo->textoPagina(Pagina::APP_ERRO_404),
            null,
            false
        );

        Renderizacao::paginaComLayout(Pagina::APP_ERRO_404, $visaoModelo);
    }

    public static function appErro405(array $metodoPermitidoLista = [])
    {
        http_response_code(405);

        $appModelo = new MApp();

        $textoConteudo = $appModelo->textoPagina(Pagina::APP_ERRO_405);

        $erroMensagem = $metodoPermitidoLista
            ? str_replace(
                "{metodo_lista}",
                implode(", ", $metodoPermitidoLista),
                $textoConteudo["erro_405_metodo_lista"] ?? "{metodo_lista}"
            )
            : null;

        $visaoModelo = VMBaseErro::sucesso(
            $appModelo->dado(),
            $textoConteudo,
            $erroMensagem,
            $erroMensagem !== null
        );

        Renderizacao::paginaComLayout(Pagina::APP_ERRO_405, $visaoModelo);
    }

    //
    public static function appErro500(
        ?string $erroMensagem = null,
        string $ambiente = Configuracao::AMBIENTE_INDEFINIDO
    ) {
        http_response_code(500);

        $appModelo = new MApp();

        $visaoModelo = VMBaseErro::sucesso(
            $appModelo->dado(),
            $appModelo->textoPagina(Pagina::APP_ERRO_500),
            $erroMensagem,
            $ambiente === Configuracao::AMBIENTE_LOCAL
        );

        Renderizacao::paginaComLayout(Pagina::APP_ERRO_500, $visaoModelo);
    }

    //
    public static function appADS()
    {
        $appModelo = new MApp();
        header("Content-Type: text/plain");
        $visaoModelo = VMBaseGenerico::sucesso(
            $appModelo->dado(),
            $appModelo->textoPagina(Pagina::APP_ADS)
        );
        Renderizacao::paginaSemLayout(Pagina::APP_ADS, $visaoModelo);
    }

    //
    public static function appRobots()
    {
        $appModelo = new MApp();
        header("Content-Type: text/plain");
        $visaoModelo = VMBaseGenerico::sucesso(
            $appModelo->dado(),
            $appModelo->textoPagina(Pagina::APP_ROBOTS)
        );
        Renderizacao::paginaSemLayout(Pagina::APP_ROBOTS, $visaoModelo);
    }

    //
    public static function appMapeamento()
    {
        $appModelo = new MApp();
        $itemModelo = new MItem();
        $appDado = $appModelo->dado();
        $urlBase = $appDado->urlBase;

        $rotaLista = [
            $urlBase . $appDado->rotaInicio,
            $urlBase . $appDado->rotaSobre,
            $urlBase . $appDado->rotaContato,
            $urlBase . $appDado->rotaTermosUso,
            $urlBase . $appDado->rotaPoliticaPrivacidade,
            $urlBase . $appDado->rotaItens,
        ];
        
        $itemLista = $itemModelo->itemLista();

        foreach ($itemLista as $item) {
            $rotaLista[] = $urlBase . Rota::rotaItem($item->id);
        }

        //
        $visaoModelo = VMMapeamento::sucesso(
            $appModelo->dado(),
            $appModelo->textoPagina(Pagina::APP_MAPEAMENTO),
            $rotaLista,
        );

        header("Content-Type: application/xml");
        Renderizacao::paginaSemLayout(Pagina::APP_MAPEAMENTO, $visaoModelo);
    }

    //
    public static function appConfigura()
    {
        $tema = $_GET[Rota::PARAMETRO_TEMA] ?? null;
        $idioma = $_GET[Rota::PARAMETRO_IDIOMA] ?? null;

        $url = $_SERVER["HTTP_REFERER"] ?? Rota::rotaRaiz();

        if ($tema !== null && Tema::temaSuportado($tema)) {

            Sessao::temaAtualiza($tema);
        }

        if ($idioma !== null && Idioma::idiomaSuportado($idioma)) {

            $idiomaAtual = Contexto::idiomaSeleciona();

            $appDado = (new MApp())->dado();
            $urlBase = $appDado->urlBase;

            Sessao::idiomaAtualiza($idioma);
            Contexto::idiomaAtualiza($idioma);

            // Garante a substituição exata do segmento de idioma na URL
            $url = str_replace($urlBase . "/" . $idiomaAtual, $urlBase . "/" . $idioma, $url);

            if ($url === ($_SERVER["HTTP_REFERER"] ?? '')) {
                $url = $urlBase . "/" . $idioma;
            }
        }

        header("Location: " . $url);
        exit;
    }
}