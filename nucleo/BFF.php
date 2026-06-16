<?php
namespace App\Nucleo;

class BFF
{
    //
    public const STATUS_SUCESSO = 200;
    public const STATUS_REQUISICAO_INVALIDA = 400;
    public const STATUS_PROIBIDO = 403;
    public const STATUS_ERRO_INTERNO = 500;

    //
    public static function bffEntrada(): ?array
    {
        $raw = file_get_contents("php://input");
        $dado = json_decode($raw, true);

        if (json_last_error() != JSON_ERROR_NONE) {

            return null;
        }

        if (!is_array($dado)) {

            return null;
        }

        return $dado;
    }

    public static function bffEntradaValida(): array
    {
        $entradaDado = self::bffEntrada();

        if ($entradaDado == null) {

            self::bffRespostaRequisicaoInvalida("Falha");
        }

        if (!self::bffCodigoSolicitacaoValido($entradaDado)) {

            self::bffRespostaProibida("Falha");
        }

        self::bffIdiomaAtualiza();

        return $entradaDado;
    }

    //
    private static function bffCodigoSolicitacaoValido(array $entradaDado): bool
    {
        return ($entradaDado[BFFContrato::ENTRADA_APP_CODIGO_SOLICITACAO] ?? null) === Sessao::codigoSolicitacaoSeleciona();
    }

    //
    public static function bffIdiomaAtualiza(): void
    {
        $idioma = Sessao::idiomaSeleciona() ?? $_SERVER["HTTP_ACCEPT_LANGUAGE"] ?? Idioma::idiomaPadrao();
        $idioma = explode(",", $idioma)[0];
        $idioma = explode(";", $idioma)[0];
        $idioma = strtolower(trim($idioma));

        if (!Idioma::idiomaSuportado($idioma)) {

            $idioma = Idioma::idiomaPadrao();
        }

        Contexto::idiomaAtualiza($idioma);
    }

    //
    public static function bffResposta(
        bool $estado = false,
        ?string $mensagem = null,
        array $dado = [],
        int $status = self::STATUS_SUCESSO
    ): void {

        http_response_code($status);

        header("Content-Type: application/json");

        echo json_encode(array_merge([
            "estado" => $estado,
            "mensagem" => $mensagem,
        ], $dado));

        exit;
    }

    //
    public static function bffRespostaSucesso(
        array $dado = [],
        ?string $mensagem = "Sucesso"
    ): void {

        self::bffResposta(true, $mensagem, $dado, self::STATUS_SUCESSO);
    }

    public static function bffRespostaFalha(
        ?string $mensagem = "Falha",
        int $status = self::STATUS_REQUISICAO_INVALIDA,
        array $dado = []
    ): void {

        self::bffResposta(false, $mensagem, $dado, $status);
    }

    //
    public static function bffRespostaRequisicaoInvalida(
        ?string $mensagem = "Falha",
        array $dado = []
    ): void {

        self::bffRespostaFalha($mensagem, self::STATUS_REQUISICAO_INVALIDA, $dado);
    }

    public static function bffRespostaProibida(
        ?string $mensagem = "Falha",
        array $dado = []
    ): void {

        self::bffRespostaFalha($mensagem, self::STATUS_PROIBIDO, $dado);
    }

    public static function bffRespostaErroInterno(
        ?string $mensagem = "Falha",
        array $dado = []
    ): void {

        self::bffRespostaFalha($mensagem, self::STATUS_ERRO_INTERNO, $dado);
    }
}