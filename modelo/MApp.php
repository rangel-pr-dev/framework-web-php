<?php
namespace App\Modelo;

use App\Nucleo\Configuracao;
use App\Nucleo\Contexto;
use App\Nucleo\Sessao;
use App\Nucleo\Idioma;
use App\Nucleo\Tema;
use App\Nucleo\Pagina;
use App\Nucleo\Apresentacao;
use App\Nucleo\Rota;
use App\Nucleo\BFFContrato;
use App\Nucleo\Erro;
use App\Nucleo\TextoEstrutura;
use App\Nucleo\Traducao;

use App\Visao_Apresentacao\VPDado;

class MApp
{
    //
    public function textoEstrutura(string $textoEstrutura): array
    {
        return Traducao::textoVisao($textoEstrutura);
    }

    public function textoPagina(string $pagina): array
    {
        return Traducao::textoVisao(Pagina::paginaTexto($pagina));
    }

    /**
     * Retorna a URL base absoluta da aplicação, considerando protocolos e subdiretórios.
     */
    private static function urlBase(): string
    {
        $protocolo = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' || ($_SERVER['SERVER_PORT'] ?? null) == 443) ? "https" : "http";
        $host = $_SERVER['HTTP_HOST'] ?? null;
        $diretorio = rtrim(dirname($_SERVER['PHP_SELF'] ?? ''), '/\\');

        if ($host === null)
            throw new Erro("HTTP_HOST nao definido.");

        return $protocolo . "://" . $host . $diretorio;
    }

    //
    public function dado(
        $layoutFluido = true
    ): VPDado {
        return new VPDado(

            // App Configuração
            Configuracao::ambienteAtual(),
            Contexto::idiomaSeleciona(),
            Contexto::temaSeleciona(),
            Configuracao::appEmail(),
            Apresentacao::imagemUri("recurso/imagem/logomarca/logomarca_" . str_replace('-', '_', Contexto::idiomaSeleciona()) . ".png"),
            Sessao::codigoSolicitacaoSeleciona(),
            Configuracao::ambienteAtual() === Configuracao::AMBIENTE_LOCAL,
            $layoutFluido,

            // Google Services
            Configuracao::googleAnalyticsId(),
            Configuracao::googleAdClient(),
            Configuracao::googleAdSlot(),
            Configuracao::appAdsTag(),
            Configuracao::ambienteAtual() === Configuracao::AMBIENTE_PRODUCAO,

            // Integração Externa
            Configuracao::appPaypalId(),
            Rota::rotaPortfolio(),
            Rota::rotaLinkedin(),
            Rota::rotaGithub(),

            // Rotas
            Rota::rotaRaiz(),

            Rota::rotaLinguagem(Idioma::idiomaPTBR()),
            Rota::rotaLinguagem(Idioma::idiomaENUS()),
            self::urlBase(),

            Rota::rotaUrl(Rota::ROTA_MAPEAMENTO, [], [], Idioma::idiomaPTBR()),
            Rota::rotaUrl(Rota::ROTA_MAPEAMENTO, [], [], Idioma::idiomaENUS()),

            Rota::rotaTema(Tema::temaDia()),
            Rota::rotaTema(Tema::temaNoite()),

            Rota::rotaInicio(),
            Rota::rotaSobre(),
            Rota::rotaContato(),
            Rota::rotaTermosUso(),
            Rota::rotaPoliticaPrivacidade(),

            Rota::rotaItens(),

            // BFF
            Rota::rotaItensFiltroBFF(),
            Rota::rotaItensPaginacaoBFF(),
            BFFContrato::dado(),

            // Conteudo Texto
            $this->textoEstrutura(TextoEstrutura::NAVEGACAO),
            $this->textoEstrutura(TextoEstrutura::RODAPE),
            $this->textoEstrutura(TextoEstrutura::MENU),
            $this->textoEstrutura(TextoEstrutura::LATERAL),
        );
    }
}