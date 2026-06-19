<?php
namespace App\Nucleo;

use Throwable;

class Apresentacao
{
    public static function imagemFundo(int $qualidade): string
    {
        return match ($qualidade) {

            1 => "imagem-fundo-qualidade-1",
            2 => "imagem-fundo-qualidade-2",
            3 => "imagem-fundo-qualidade-3",
            4 => "imagem-fundo-qualidade-4",
            5 => "imagem-fundo-qualidade-5",
        };
    }

    public static function perfilQualidade(int $qualidade): string
    {
        $estrelas = '';
        $quantidade = (int) $qualidade;

        for ($i = 0; $i < $quantidade; $i++) {
            $estrelas .= '<i class="bi bi-star-fill me-1"></i>';
        }

        return $estrelas;
    }

    public static function imagemUri(string $imagemCaminho): string
    {
        try {

            if (!file_exists($imagemCaminho)) {

                throw new Erro("Arquivo nao encontrado: " . $imagemCaminho);
            }

            $imagemConteudo = file_get_contents($imagemCaminho);

            if ($imagemConteudo === false) {

                throw new Erro("Falha ao ler o arquivo: " . $imagemCaminho);
            }

            $imagemDado = base64_encode($imagemConteudo);

            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $imagemMimeType = finfo_file($finfo, $imagemCaminho);
            finfo_close($finfo);

            if (!$imagemMimeType) {

                throw new Erro("Nao foi possivel determinar o MIME type do arquivo.");
            }

            return "data:$imagemMimeType;base64,$imagemDado";
        }
        //
        catch (Throwable $e) {

            error_log("Erro ao processar a imagem: " . $e->getMessage());

            return "Erro ao carregar a imagem.";
        }
    }
}