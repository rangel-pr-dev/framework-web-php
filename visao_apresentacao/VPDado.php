<?php
namespace App\Visao_Apresentacao;

class VPDado
{
    // App Configuração
    public string $ambiente;
    public string $idioma;
    public string $tema;
    public string $appEmail;
    public string $logomarca;
    public string $appCodigoSolicitacao;
    public bool $appLogExibe;
    public bool $layoutFluido;

    // Google Services
    public ?string $googleAnalyticsId;
    public ?string $googleAdClient;
    public ?string $googleAdSlot;
    public string $appAdsTag;
    public bool $googleServicoExibe;

    // Integração Externa
    public ?string $appPaypalId;
    public string $rotaPortfolio;
    public string $rotaLinkedin;
    public string $rotaGithub;

    // Rotas
    public string $rotaRaiz;

    public string $rotaLinguagemPortugues;
    public string $rotaLinguagemIngles;
    public string $urlBase;

    public string $rotaMapeamentoPortugues;
    public string $rotaMapeamentoIngles;

    public string $rotaTemaDia;
    public string $rotaTemaNoite;

    public string $rotaInicio;
    public string $rotaSobre;
    public string $rotaContato;
    public string $rotaTermosUso;
    public string $rotaPoliticaPrivacidade;

    public string $rotaItens;

    // BFF
    public string $rotaItensFiltroBFF;
    public string $rotaItensPaginacaoBFF;
    public array $bffContrato;

    // Conteudo Texto
    public array $textoNavegacao;
    public array $textoRodape;
    public array $textoMenu;
    public array $textoLateral;

    //
    public function __construct(

        // App Configuração
        string $ambiente,
        string $idioma,
        string $tema,
        string $appEmail,
        string $logomarca,
        string $appCodigoSolicitacao,
        bool $appLogExibe,
        bool $layoutFluido,

        // Google Services
        ?string $googleAnalyticsId,
        ?string $googleAdClient,
        ?string $googleAdSlot,
        string $appAdsTag,
        bool $googleServicoExibe,

        // Integração Externa
        ?string $appPaypalId,
        string $rotaPortfolio,
        string $rotaLinkedin,
        string $rotaGithub,

        // Rotas
        string $rotaRaiz,

        string $rotaLinguagemPortugues,
        string $rotaLinguagemIngles,
        string $urlBase,

        string $rotaMapeamentoPortugues,
        string $rotaMapeamentoIngles,

        string $rotaTemaDia,
        string $rotaTemaNoite,

        string $rotaInicio,
        string $rotaSobre,
        string $rotaContato,
        string $rotaTermosUso,
        string $rotaPoliticaPrivacidade,

        string $rotaItens,

        // BFF
        string $rotaItensFiltroBFF,
        string $rotaItensPaginacaoBFF,
        array $bffContrato,

        // Conteudo Texto
        array $textoNavegacao,
        array $textoRodape,
        array $textoMenu,
        array $textoLateral,
    ) {

        // App Configuração
        $this->ambiente = $ambiente;
        $this->idioma = $idioma;
        $this->tema = $tema;
        $this->appEmail = $appEmail;
        $this->logomarca = $logomarca;
        $this->appCodigoSolicitacao = $appCodigoSolicitacao;
        $this->appLogExibe = $appLogExibe;
        $this->layoutFluido = $layoutFluido;

        // Google Services
        $this->googleAnalyticsId = $googleAnalyticsId;
        $this->googleAdClient = $googleAdClient;
        $this->googleAdSlot = $googleAdSlot;
        $this->appAdsTag = $appAdsTag;
        $this->googleServicoExibe = $googleServicoExibe;

        // Integração Externa
        $this->appPaypalId = $appPaypalId;
        $this->rotaLinkedin = $rotaLinkedin;
        $this->rotaPortfolio = $rotaPortfolio;
        $this->rotaGithub = $rotaGithub;

        // Rotas
        $this->rotaRaiz = $rotaRaiz;

        $this->rotaLinguagemPortugues = $rotaLinguagemPortugues;
        $this->rotaLinguagemIngles = $rotaLinguagemIngles;
        $this->urlBase = $urlBase;

        $this->rotaMapeamentoPortugues = $rotaMapeamentoPortugues;
        $this->rotaMapeamentoIngles = $rotaMapeamentoIngles;

        $this->rotaTemaDia = $rotaTemaDia;
        $this->rotaTemaNoite = $rotaTemaNoite;

        $this->rotaInicio = $rotaInicio;
        $this->rotaSobre = $rotaSobre;
        $this->rotaContato = $rotaContato;
        $this->rotaTermosUso = $rotaTermosUso;
        $this->rotaPoliticaPrivacidade = $rotaPoliticaPrivacidade;

        $this->rotaItens = $rotaItens;

        // BFF
        $this->rotaItensFiltroBFF = $rotaItensFiltroBFF;
        $this->rotaItensPaginacaoBFF = $rotaItensPaginacaoBFF;
        $this->bffContrato = $bffContrato;

        // Conteudo Texto
        $this->textoNavegacao = $textoNavegacao;
        $this->textoRodape = $textoRodape;
        $this->textoMenu = $textoMenu;
        $this->textoLateral = $textoLateral;
    }

    public function dado(): array
    {
        return [

            // App Configuração
            "ambiente" => $this->ambiente,
            "idioma" => $this->idioma,
            "tema" => $this->tema,
            "appEmail" => $this->appEmail,
            "logomarca" => $this->logomarca,
            "appCodigoSolicitacao" => $this->appCodigoSolicitacao,
            "appLogExibe" => $this->appLogExibe,
            "layoutFluido" => $this->layoutFluido,

            // Google Services
            "googleAnalyticsId" => $this->googleAnalyticsId,
            "googleAdClient" => $this->googleAdClient,
            "googleAdSlot" => $this->googleAdSlot,
            "appAdsTag" => $this->appAdsTag,
            "googleServicoExibe" => $this->googleServicoExibe,

            // Integração Externa
            "appPaypalId" => $this->appPaypalId,
            "rotaLinkedin" => $this->rotaLinkedin,
            "rotaPortfolio" => $this->rotaPortfolio,
            "rotaGithub" => $this->rotaGithub,

            // Rotas
            "rotaRaiz" => $this->rotaRaiz,

            "rotaLinguagemPortugues" => $this->rotaLinguagemPortugues,
            "rotaLinguagemIngles" => $this->rotaLinguagemIngles,
            "urlBase" => $this->urlBase,

            "rotaMapeamentoPortugues" => $this->rotaMapeamentoPortugues,
            "rotaMapeamentoIngles" => $this->rotaMapeamentoIngles,

            "rotaTemaDia" => $this->rotaTemaDia,
            "rotaTemaNoite" => $this->rotaTemaNoite,

            "rotaInicio" => $this->rotaInicio,
            "rotaSobre" => $this->rotaSobre,
            "rotaContato" => $this->rotaContato,
            "rotaTermosUso" => $this->rotaTermosUso,
            "rotaPoliticaPrivacidade" => $this->rotaPoliticaPrivacidade,

            //
            "rotaItens" => $this->rotaItens,

            // BFF
            "rotaItensFiltroBFF" => $this->rotaItensFiltroBFF,
            "rotaItensPaginacaoBFF" => $this->rotaItensPaginacaoBFF,
            "bffContrato" => $this->bffContrato,

            // Conteudo Texto
            "textoNavegacao" => $this->textoNavegacao,
            "textoRodape" => $this->textoRodape,
            "textoMenu" => $this->textoMenu,
            "textoLateral" => $this->textoLateral,
        ];
    }
}