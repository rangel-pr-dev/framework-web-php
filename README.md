# Symmetria Framework

O **Symmetria Framework** e um framework MVC em PHP puro, criado para manter a aplicacao previsivel, explicita e facil de evoluir. A proposta central e separar bem as responsabilidades: o nucleo inicializa e roteia, os controles orquestram, os modelos acessam dados, os ViewModels transportam estado para a interface e as visoes apenas renderizam.

O projeto evita automacao "magica" e prefere contratos claros. Cada rota, pagina, fragmento, DTO e ViewModel fica declarado em um ponto conhecido, o que facilita manutencao, auditoria e criacao de novos modulos.

## Indice

- [Principios](#principios)
- [Tecnologias](#tecnologias)
- [Pre-requisitos](#pre-requisitos)
- [Instalacao](#instalacao)
- [Configuracao de Ambiente](#configuracao-de-ambiente)
- [Banco de Dados](#banco-de-dados)
- [Estrutura do Projeto](#estrutura-do-projeto)
- [Ciclo de Vida da Requisicao](#ciclo-de-vida-da-requisicao)
- [Documentacao das Classes Principais](#documentacao-das-classes-principais)
- [Rotas e Paginas](#rotas-e-paginas)
- [BFF e JavaScript](#bff-e-javascript)
- [Guias de Desenvolvimento](#guia-criando-um-novo-modulo)
- [Convencoes de Nome](#convencoes-de-nome)
- [Troubleshooting](#troubleshooting)
- [Checklist para Novo Modulo](#checklist-para-novo-modulo)

## Principios

- **MVC explicito:** controle, modelo, apresentacao e visao possuem responsabilidades separadas.
- **Fonte unica de rotas:** `nucleo/Rota.php` concentra as URIs, os metodos HTTP e os manipuladores.
- **Fonte unica de paginas:** `nucleo/Pagina.php` conecta identificadores de pagina aos arquivos de `visao/`.
- **Views tipadas:** dados chegam por ViewModels e Presenters, evitando consultas e regras de negocio dentro da interface.
- **BFF integrado:** formularios e paginacao assincrona usam endpoints dedicados, DTOs e token de sessao.
- **Internacionalizacao por contexto:** idioma e tema ficam em `Sessao` e `Contexto`, com textos em `traducao/`.
- **Baixo acoplamento:** cada camada conhece apenas o necessario da camada seguinte.

## Tecnologias

- PHP 8.x+
- MySQL ou MariaDB
- Apache com `mod_rewrite` ou servidor equivalente
- Bootstrap 5, CSS moderno e JavaScript/jQuery para integracao BFF

## Pre-requisitos

Antes de instalar, confirme que o ambiente possui:

- PHP 8.x ou superior.
- Extensao `mysqli` habilitada.
- Extensao `fileinfo` habilitada, usada por `Apresentacao::imagemUri()`.
- MySQL 8.x ou MariaDB compativel.
- Apache com reescrita de URL ativa, ou servidor equivalente configurado para entregar requisicoes ao `index.php`.
- Permissao de leitura para `configuracao.{ambiente}.php`, `traducao/`, `visao/` e `recurso/`.
- Permissao de sessao PHP funcionando no servidor.

## Instalacao

1. Clone o projeto no servidor local.
2. Configure o servidor para direcionar as requisicoes para `index.php`.
3. Defina a variavel de ambiente `APP_AMBIENTE`, por exemplo `local` ou `producao`.
4. Copie `configuracao.exemplo.php` para `configuracao.{ambiente}.php`.
5. Ajuste credenciais, dominio, Google Services, PayPal e demais configuracoes nesse arquivo.
6. Importe `base_dado/sql/bd_framework.sql` no MySQL/MariaDB.
7. Acesse a raiz da aplicacao. A rota `/` redireciona para o idioma ativo da sessao.

## Configuracao de Ambiente

O arquivo de configuracao e escolhido pelo valor de `APP_AMBIENTE`.

Exemplo:

```text
APP_AMBIENTE=local
```

Com esse valor, o framework tenta carregar:

```text
configuracao.local.php
```

Use `configuracao.exemplo.php` como base. As chaves esperadas sao:

- `APP_EMAIL`: email institucional usado pela aplicacao.
- `BD_SERVIDOR`: host do MySQL/MariaDB.
- `BD_USUARIO_PT_BR`: usuario do banco em portugues.
- `BD_USUARIO_EN_US`: usuario do banco em ingles.
- `BD_SENHA`: senha do banco.
- `BD_NOME_PT_BR`: nome da base de dados em portugues.
- `BD_NOME_EN_US`: nome da base de dados em ingles.
- `GOOGLE_ANALYTICS_ID`: identificador do Google Analytics.
- `GOOGLE_AD_CLIENT`: cliente do Google AdSense.
- `GOOGLE_AD_SLOT`: slot de anuncio.
- `APP_ADS_TAG`: conteudo usado em `ads.txt`.
- `APP_PAYPAL_ID`: identificador de integracao PayPal.

Em desenvolvimento, valores de servicos externos podem ficar como placeholders, desde que as chaves existam no array. `Configuracao::configuracaoValida()` exige todas as chaves obrigatorias.

## Banco de Dados

O script `base_dado/sql/bd_framework.sql` cria o esquema inicial com dados populados para os idiomas do projeto.

No dump atual, sao criadas duas bases:

- `bd_framework_1`
- `bd_framework_2`

Configure `BD_NOME_PT_BR` e `BD_NOME_EN_US` no arquivo `configuracao.{ambiente}.php` apontando para os bancos correspondentes ao portugues e ao ingles no seu ambiente.

Exemplo:

```php
"BD_NOME_PT_BR" => "bd_framework_1",
"BD_NOME_EN_US" => "bd_framework_2",
```

O framework escolhe a base pelo idioma ativo em `Contexto`:

- `pt-br` usa `Configuracao::bdUsuarioPTBR()` e `Configuracao::bdNomePTBR()`.
- `en-us` usa `Configuracao::bdUsuarioENUS()` e `Configuracao::bdNomeENUS()`.

As tabelas principais do exemplo sao:

- `tb_item`: itens listados, filtrados, paginados e exibidos em detalhe.
- `tb_item_tipo`: tipos de item usados na ordenacao e nos filtros.

## Estrutura do Projeto

- `index.php`: ponto de entrada da aplicacao.
- `nucleo/`: bootstrap, autoload, configuracao, sessao, contexto, roteamento, renderizacao, BFF e contratos centrais.
- `controle/`: controllers web, controllers BFF e validadores de entrada.
- `controle/dado/`: DTOs usados para validar e normalizar dados de GET, POST ou JSON.
- `modelo/`: acesso a dados e montagem de dados de aplicacao.
- `base_dado/`: conexao, entidades de banco e scripts SQL em `base_dado/sql/`.
- `servico/`: regras transversais ou orquestracoes de dominio.
- `visao_modelo/`: ViewModels usados como contrato entre controller e view.
- `visao_apresentacao/`: Presenters que adaptam entidades e dados globais para a interface.
- `visao/`: templates PHP/HTML, estrutura do layout, menus, laterais, paginas e telas de entidade.
- `traducao/`: textos por idioma, como `pt-br` e `en-us`.
- `js/`: comportamento da interface e integracao assincrona com BFF.
- `css/`: estilos, tema e ajustes visuais.
- `recurso/`: imagens, icones e arquivos estaticos.

## Ciclo de Vida da Requisicao

1. O servidor entrega a requisicao para `index.php`.
2. `App\Nucleo\Inclusao` registra o autoload.
3. `App\Nucleo\Aplicacao::executa()` inicia sessao, token BFF, tema e roteamento.
4. `Aplicacao::urlSolicitada()` normaliza a URI, inclusive em subdiretorios.
5. `Roteamento::rotaExecuta()` encontra a rota em `Rota::ROTA_LISTA`.
6. O idioma da URL ou da sessao atualiza `Sessao` e `Contexto`.
7. O controller valida entradas, chama modelos/servicos e monta o ViewModel.
8. `Renderizacao` renderiza uma pagina com layout, sem layout ou um fragmento.
9. Em endpoints BFF, `BFF` valida JSON/token e responde em JSON.

## Documentacao das Classes Principais

### Nucleo (`App\Nucleo`)

#### `Aplicacao`

Classe de bootstrap da aplicacao.

- `executa()`: inicia o fluxo principal.
- `roteamento()`: registra em `Roteamento` todas as rotas declaradas em `Rota::ROTA_LISTA`.
- `urlSolicitada()`: resolve a URI atual, removendo subdiretorios quando necessario.
- `trataErro(Throwable $e, string $url)`: decide entre erro HTML e erro JSON para BFF.

#### `Inclusao`

Autoloader do framework.

- Resolve namespaces `App\...` para a estrutura fisica do projeto.
- Remove a necessidade de `require` manual nas classes.
- Mantem o framework portavel em raiz ou subdiretorios.

#### `Configuracao`

Centraliza ambiente e variaveis de configuracao.

- Define ambientes como `AMBIENTE_LOCAL`, `AMBIENTE_PRODUCAO` e `AMBIENTE_INDEFINIDO`.
- Expoe credenciais, servicos externos, email, paginacao e flags de exibicao.
- Evita que a view ou o JavaScript dependam diretamente do nome do ambiente.
- `ambienteSeleciona()`: le e valida `APP_AMBIENTE`.
- `ambienteAtual()`: retorna o ambiente atual ou `AMBIENTE_INDEFINIDO` quando nao configurado.
- `appEmail()`, `bdServidor()`, `bdUsuarioPTBR()`, `bdUsuarioENUS()`, `bdSenha()`, `bdNomePTBR()`, `bdNomeENUS()`: acessores de configuracao da aplicacao e banco.
- `googleAnalyticsId()`, `googleAdClient()`, `googleAdSlot()`, `appAdsTag()`, `appPaypalId()`: acessores de integracoes externas.

#### `Erro`

Excecao base do framework.

- Padroniza falhas internas.
- E usada por classes do nucleo, modelos e renderizacao para comunicar erros estruturais.

#### `Sessao`

Gerencia estado persistido por usuario.

- `sessaoInicio()`: inicia a sessao PHP.
- `idiomaSeleciona()` / `idiomaAtualiza(string $idioma)`: leem e atualizam idioma.
- `temaSeleciona()` / `temaAtualiza(string $tema)`: leem e atualizam tema.
- `codigoSolicitacaoSeleciona()` / `codigoSolicitacaoAtualiza(string $codigo)`: controlam o token usado pelo BFF.

#### `Contexto`

Mantem o estado atual da requisicao.

- `idiomaSeleciona()` / `idiomaAtualiza(string $idioma)`: disponibilizam o idioma atual sem precisar passar parametro por todas as camadas.
- `temaSeleciona()` / `temaAtualiza(string $tema)`: disponibilizam o tema atual.

#### `Idioma`

Contrato de idiomas suportados.

- `idiomaPTBR()` e `idiomaENUS()`: retornam os idiomas nativos do projeto.
- `idiomaPadrao()`: retorna o idioma padrao.
- `idiomaSuportado(string $idioma)`: valida um idioma.
- `idiomaValidoOuPadrao(?string $idioma)`: retorna o idioma recebido ou o padrao.

#### `Tema`

Contrato de temas suportados.

- `temaDia()` e `temaNoite()`: retornam os temas disponiveis.
- `temaSuportado(string $tema)`: valida o tema.
- `temaValidoOuPadrao(?string $tema)`: normaliza o tema atual.

#### `Rota`

Fonte unica de verdade das URLs.

- Constantes `ROTA_*`: nomes logicos das rotas.
- Constantes `PARAMETRO_*`: nomes de parametros de rota ou filtro.
- `ROTA_LISTA`: mapa com metodo HTTP, URI e manipulador.
- `rotaUrl(string $rota, array $parametros = [], array $filtros = [], ?string $idioma = null)`: gera URL para rota nomeada.
- `rotaInicio()`, `rotaSobre()`, `rotaItens()`, `rotaItem(string $idItem)`: atalhos para rotas usadas nas views.
- `rotaItensFiltro(...)`: monta URL amigavel com query string de filtros.
- `rotaItensFiltroBFF()` e `rotaItensPaginacaoBFF()`: URLs dos endpoints assincronos.

#### `Roteamento`

Executa o despacho das rotas.

- `rotaRegistra(string $metodo, string $uri, array $manipulador)`: registra uma rota.
- `rotaExecuta(string $url, string $metodo)`: encontra a rota, extrai parametros e chama o controller.
- `rotaMetodoPermitido(string $url, string $metodoAtual)`: identifica metodos alternativos para responder 405.
- Atualiza idioma de `Sessao` e `Contexto` antes de chamar o controller.

#### `Pagina`

Fonte unica de verdade dos arquivos de view.

- Constantes `APP_*` e `ITEM_*`: identificadores logicos das paginas.
- `PAGINA_LISTA`: mapeia identificadores para caminhos dentro de `visao/`.
- `paginaVisao(string $pagina)`: resolve o arquivo de view.
- `paginaTexto(string $pagina)`: resolve a chave de traducao equivalente.

#### `Fragmento`

Fonte unica de verdade dos fragmentos renderizaveis.

- Constantes de fragmento, como `ITEM_LISTA`.
- `fragmentoVisao(string $fragmento)`: resolve o arquivo em `visao/` usado por renderizacao parcial.

#### `Renderizacao`

Motor de templates.

- `paginaComLayout(string $pagina, VMBase $visaoModelo)`: renderiza uma pagina dentro de `visao/estrutura/app.php`.
- `paginaSemLayout(string $pagina, VMBase $visaoModelo)`: renderiza arquivos tecnicos, como `robots.txt`, `ads.txt` ou sitemap.
- `fragmento(string $fragmento, VMBase $visaoModeloFragmento)`: renderiza HTML parcial com output buffering.

#### `BFF`

Base para endpoints Backend for Frontend.

- `bffEntrada()`: le JSON bruto do corpo da requisicao.
- `bffEntradaValida()`: valida JSON, token de sessao e idioma.
- `bffRespostaSucesso(array $dado = [], ?string $mensagem = "Sucesso")`: responde JSON 200.
- `bffRespostaRequisicaoInvalida()`, `bffRespostaProibida()`, `bffRespostaErroInterno()`: respostas padronizadas.

#### `BFFContrato`

Contrato de nomes entre PHP e JavaScript.

- Centraliza chaves de entrada, como o codigo de solicitacao.
- E entregue para a interface por `VPDado`.
- Evita strings soltas entre `principal.js` e os controllers BFF.

#### `Traducao` e `TextoEstrutura`

Responsaveis pelos textos da aplicacao.

- `Traducao::arquivo(string $arquivo)`: carrega um arquivo de traducao dentro do idioma selecionado em `Contexto`.
- `Traducao::textoVisao(string $visao)`: carrega textos do idioma atual.
- `TextoEstrutura`: identifica grupos de textos globais, como navegacao, rodape, menu e lateral.

#### `Apresentacao`

Utilitario de apresentacao e performance.

- `imagemUri(string $caminho)`: resolve imagem como URI pronta para uso.
- `imagemFundo($qualidade)`: retorna classe visual conforme a qualidade de um item.
- `perfilQualidade($qualidade)`: gera marcadores visuais de qualidade.
- Ajuda a centralizar recursos visuais usados por `MApp` e `VPDado`.

### Controle (`App\Controle`)

#### `CApp`

Controller de rotas globais e tecnicas.

- `appRaiz()`: redireciona `/` para o idioma da sessao.
- `appErro404()`, `appErro405(array $metodoPermitidoLista = [])`, `appErro500(...)`: renderizam paginas de erro.
- `appADS()`: renderiza `ads.txt`.
- `appRobots()`: renderiza `robots.txt`.
- `appMapeamento()`: gera sitemap XML com rotas estaticas e itens.
- `appConfigura()`: atualiza idioma e tema via query string.

#### `CInicio`

Controller das paginas institucionais.

- `appInicio()`: renderiza a home com listas de itens em destaque.
- `appSobre()`: renderiza a pagina sobre usando dados de `AppServico`.
- `appContato()`, `appTermosUso()`, `appPoliticaPrivacidade()`: renderizam paginas institucionais simples.
- Usa `MApp` para dados globais e textos.

#### `CItem`

Controller web da entidade de exemplo `Item`.

- `itemLista()`: le filtros de `$_GET`, consulta `MItem`, monta `VMItemLista` e renderiza `Pagina::ITEM_LISTA`.
- `itemSeleciona($parametroLista)`: recebe `{id_item}`, consulta item e relacionados, monta `VMItemSeleciona` e renderiza `Pagina::ITEM_SELECAO`.
- Usa `DTOItemFiltro` para normalizar filtros.
- Usa `VPItemLista` e `VPItemSelecao` para adaptar entidades de banco para a view.

#### `BFFItem`

Controller BFF da entidade `Item`.

- `itemListaFiltro()`: valida JSON, converte filtros e retorna uma URL de listagem filtrada.
- `itemListaPaginacao()`: valida JSON, busca o proximo lote, renderiza fragmento `Fragmento::ITEM_LISTA` e retorna HTML + deslocamento.
- Usa `DTOBFFRespostaLocalizacao` e `DTOBFFRespostaPaginacao` para padronizar respostas.

#### `CValidacao`

Validador estatico de entrada.

- `str($valor, $nulo = true)`: normaliza string com `trim()` e `htmlspecialchars()`.
- `int($valor, $nulo = true)`: normaliza inteiro.
- `arrayInt($valorLista, $valorPermitidoLista)`: converte lista de inteiros e aplica lista permitida.
- `arrayStr($valorLista, $valorPermitidoLista)`: sanitiza lista de strings e aplica lista permitida.
- Apoia DTOs para evitar validacao espalhada nos controllers.
- Deve ser usado antes de dados externos chegarem aos modelos.

### DTOs (`App\Controle\Dado`)

#### `DTOItemFiltro`

Normaliza filtros da listagem de itens.

- Recebe dados de `$_GET` ou JSON do BFF.
- Converte nome, tipos, qualidades e deslocamento de paginacao.
- Mantem a mesma regra para fluxo web e fluxo assincrono.

#### `DTOBFFRespostaLocalizacao`

Resposta para redirecionamento/localizacao.

- Encapsula a URL final depois de converter filtros em rota amigavel.

#### `DTOBFFRespostaPaginacao`

Resposta de paginacao assincrona.

- Transporta o HTML renderizado do fragmento.
- Transporta o novo deslocamento da lista.

### Modelo (`App\Modelo`)

#### `MApp`

Modelo de dados globais da aplicacao.

- `textoEstrutura(string $textoEstrutura)`: carrega textos globais.
- `textoPagina(string $pagina)`: carrega textos de uma pagina.
- `dado(bool $layoutFluido = true)`: monta `VPDado` com ambiente, idioma, tema, rotas, tokens, textos e flags.
- `urlBase()`: calcula a URL absoluta considerando protocolo, host e subdiretorio.

#### `MItem`

Modelo da entidade de exemplo `Item`.

- `itemListaFiltro($nome, $idTipoLista, $qualidadeLista, $deslocamento, $limite)`: lista itens com filtros e paginacao.
- `itemLista()`: lista todos os itens para sitemap e usos gerais.
- `itemNomeLista()`: lista nomes de itens.
- `itemTipoLista()`: lista tipos de item.
- `itemSeleciona($idItem)`: busca um item e seu tipo.
- `itemRelacionamentoLista($idRelacionamento)`: busca itens relacionados.
- `executar(callable $procedimento)`: abre e fecha conexao, tratando erros de banco.

### Base de Dados (`App\Base_Dado`)

#### `BDConexao`

Gerencia a conexao com o banco.

- `bdInstancia()`: retorna a instancia compartilhada da conexao.
- `bdConexaoInicializa()`: abre conexao `mysqli`.
- `bdConexaoObtem()`: retorna a conexao ativa.
- `bdConexaoFinaliza()`: encerra a conexao aberta.
- Usa configuracoes do ambiente atual e seleciona usuario/base conforme o idioma em `Contexto`.
- E consumida pelos modelos.

#### Entidades em `base_dado/entidade/`

Objetos simples que representam registros do banco.

- `BDItem`: entidade da tabela de itens.
- `BDItemTipo`: entidade de tipos de item.
- Devem conter dados de persistencia, sem regra de interface.

#### Scripts SQL em `base_dado/sql/`

Scripts versionados para criacao e populacao do banco.

- `bd_framework.sql`: cria os bancos iniciais do framework e popula as tabelas `tb_item` e `tb_item_tipo`.
- Deve ser usado na instalacao inicial ou como referencia de estrutura para novos ambientes.

### Servico (`App\Servico`)

#### `AppServico`

Espaco para regras transversais.

- `sobreTopicoLista()`: organiza os grupos de topicos tecnicos usados pela pagina Sobre.
- Use quando a regra envolver varias entidades, calculos complexos ou integracoes externas.
- Evite colocar orquestracoes grandes diretamente em controllers.
- Evite colocar regra de negocio complexa em ViewModels ou Views.

### ViewModels (`App\Visao_Modelo`)

#### `VMBase`

Classe base de todos os ViewModels.

- Permite que `Renderizacao` aceite contratos comuns.

#### `VMBasePagina`

Base para paginas com layout.

- `dadoSeleciona()`: retorna `VPDado`.
- `textoNavegacao(string $chave)`, `textoRodape(string $chave)`, `textoMenu(string $chave)`, `textoLateral(string $chave)`: leem textos estruturais.
- `textoConteudoSeleciona(string $chave)`: le textos especificos da pagina.

#### `VMBaseErro`

ViewModel de paginas de erro.

- Guarda mensagem de erro e flag de exibicao.
- Permite mostrar detalhes no ambiente local e ocultar em producao.

#### `VMBaseGenerico`

ViewModel para paginas tecnicas ou simples.

- `sucesso(VPDado $dado, ?array $textoConteudo)`: fabrica uma instancia com dados globais e textos da pagina.
- Usado em `ads.txt`, `robots.txt` e telas sem dados complexos.

#### `VMBaseFragmento`

Base para fragmentos renderizados sem layout.

- Usado pelo BFF para retornar HTML parcial.

#### `VMMapeamento`

ViewModel do sitemap.

- Transporta lista de URLs para `app_mapeamento.php`.

#### `VMInicio`

ViewModel da pagina inicial.

- Transporta textos da home e dois fragmentos de lista de itens.
- `itemLista1FragmentoSeleciona()` e `itemLista2FragmentoSeleciona()`: expoem os blocos de itens usados na view.

#### `VMSobre`

ViewModel da pagina Sobre.

- Transporta a lista de topicos montada por `AppServico`.
- `topicoListaSeleciona()`: retorna os grupos de topicos para a view.

#### ViewModels de `Item`

- `VMItemLista`: pagina de listagem completa.
- `VMItemListaFiltro`: estado atual dos filtros.
- `VMItemListaFragmento`: lista renderizavel de itens.
- `VMItemSeleciona`: pagina de detalhe de um item.

### Presenters (`App\Visao_Apresentacao`)

#### `VPDado`

Presenter global da aplicacao.

- Transporta ambiente, idioma, tema, token BFF, rotas, textos estruturais e flags de exibicao.
- Entrega dados seguros para views e JavaScript.
- O metodo `dado()` exporta esses valores como array.

#### `VPItemLista`

Presenter de itens para listagem.

- Converte entidades `BDItem` em dados prontos para cards/listas.
- Mantem formatacao fora da view.

#### `VPItemSelecao`

Presenter de item selecionado.

- Prepara dados do detalhe do item.
- Encapsula acessos a entidade e relacionamentos para a view.

### Views (`visao/`)

As views sao arquivos PHP/HTML que recebem um ViewModel ja montado.

- `visao/estrutura/app.php`: layout principal.
- `visao/estrutura/app_css.php`: inclusao de estilos.
- `visao/estrutura/app_js.php`: inclusao de scripts e dados globais para JavaScript.
- `visao/estrutura/app_navegacao.php`: navegacao superior.
- `visao/estrutura/app_rodape.php`: rodape.
- `visao/estrutura/app_google_ad.php`: bloco de anuncio.
- `visao/menu/`: componentes de menu.
- `visao/lateral/`: componentes laterais.
- `visao/item/`: paginas e fragmentos da entidade `Item`.

## Rotas e Paginas

O framework separa **identidade da pagina** e **acesso pela URL**.

### `Pagina.php`: onde esta a view

Use `Pagina` para cadastrar o arquivo fisico da tela.

```php
public const APP_GALERIA = "APP_GALERIA";

private const PAGINA_LISTA = [
    self::APP_GALERIA => "app_galeria",
];
```

O exemplo acima aponta para:

```text
visao/app_galeria.php
traducao/{idioma}/app_galeria.php
```

### `Rota.php`: como chegar na pagina

Use `Rota` para cadastrar URL, metodo HTTP e controller.

```php
public const ROTA_GALERIA = "GALERIA";

self::ROTA_GALERIA => [
    self::ROTA_METODO => "GET",
    self::ROTA_URI => "/{" . self::PARAMETRO_IDIOMA . "}/galeria",
    self::ROTA_MANIPULADOR => [CGaleria::class, "galeriaLista"],
],
```

Gere links sempre por rota nomeada:

```php
Rota::rotaUrl(Rota::ROTA_GALERIA);
```

ou crie um atalho:

```php
public static function rotaGaleria(): string
{
    return self::rotaUrl(self::ROTA_GALERIA);
}
```

### Rotas principais atuais

- `ROTA_RAIZ`: `/`
- `ROTA_ADS`: `/ads.txt`
- `ROTA_ROBOTS`: `/robots.txt`
- `ROTA_MAPEAMENTO`: `/{idioma}/mapa_do_site`
- `ROTA_CONFIGURA`: `/configura`
- `ROTA_INICIO`: `/{idioma}`
- `ROTA_SOBRE`: `/{idioma}/sobre`
- `ROTA_CONTATO`: `/{idioma}/contato`
- `ROTA_TERMOS_USO`: `/{idioma}/termos_de_uso`
- `ROTA_POLITICA_PRIVACIDADE`: `/{idioma}/politica_de_privacidade`
- `ROTA_ITEMS`: `/{idioma}/itens`
- `ROTA_ITEM`: `/{idioma}/item/{id_item}`
- `ROTA_ITEM_RELACIONADOS`: `/{idioma}/item/{id_item}/relacionados`
- `ROTA_ITEMS_FILTRO`: `/bff/itens/filtro`
- `ROTA_ITEMS_PAGINACAO`: `/bff/itens/paginacao`

## BFF e JavaScript

O BFF serve para fluxos assincronos da interface sem quebrar os contratos do backend.

### Fluxo de filtro

1. A view renderiza um formulario com dados e rota BFF.
2. `js/principal.js` coleta os campos e inclui o token `appCodigoSolicitacao`.
3. O endpoint BFF chama `BFF::bffEntradaValida()`.
4. O DTO normaliza os dados.
5. O BFF retorna uma localizacao.
6. O navegador redireciona para a URL amigavel gerada por `Rota`.

### Fluxo de paginacao

1. A view envia filtros atuais e deslocamento.
2. O BFF valida token e entrada.
3. O modelo busca o proximo lote.
4. O controller monta um ViewModel de fragmento.
5. `Renderizacao::fragmento()` gera HTML parcial.
6. O JSON retorna HTML e novo deslocamento.
7. O JavaScript adiciona o HTML ao container.

## Modulo de Exemplo: Item

O modulo `Item` demonstra o fluxo completo do framework.

- Banco: `BDItem`, `BDItemTipo` e script `base_dado/sql/bd_framework.sql`.
- Modelo: `MItem` consulta listas, filtros, detalhes e relacionamentos.
- DTO: `DTOItemFiltro` normaliza entradas web e BFF.
- Controller web: `CItem` renderiza lista e detalhe.
- Controller BFF: `BFFItem` atende filtro e paginacao assincrona.
- Presenters: `VPItemLista` e `VPItemSelecao` adaptam entidades para exibicao.
- ViewModels: `VMItemLista`, `VMItemListaFiltro`, `VMItemListaFragmento`, `VMItemSeleciona`.
- Views: `visao/item/l_item.php`, `visao/item/s_item.php` e fragmentos relacionados.
- Rotas: `ROTA_ITEMS`, `ROTA_ITEM`, `ROTA_ITEMS_FILTRO`, `ROTA_ITEMS_PAGINACAO`.
- Textos: `traducao/{idioma}/item/l_item.php` e `traducao/{idioma}/item/s_item.php`.

## Guia: Criando um Novo Modulo

Use este roteiro quando criar uma nova entidade, por exemplo `Produto`.

### 1. Banco e entidades

1. Crie ou atualize o esquema de banco. Se houver script versionado, mantenha-o em `base_dado/sql/`.
2. Crie entidades em `base_dado/entidade/`, por exemplo `BDProduto.php`.
3. Mantenha entidades como objetos de dados, sem HTML e sem regra de controller.

### 2. Modelo

Crie `modelo/MProduto.php`.

Responsabilidades comuns:

- abrir e fechar conexao via `BDConexao`;
- consultar listas, detalhes e relacionamentos;
- aplicar filtros de banco;
- retornar entidades ou arrays tipados.

### 3. DTOs de entrada

Crie DTOs em `controle/dado/`.

Use DTO quando houver:

- filtros em `$_GET`;
- corpo JSON do BFF;
- ids vindos de rota;
- paginacao, ordenacao ou listas de valores.

O DTO deve receber dados brutos e expor propriedades ja normalizadas.

### 4. Rotas

Em `nucleo/Rota.php`:

1. Importe o controller.
2. Declare constantes `ROTA_PRODUTOS`, `ROTA_PRODUTO`, `ROTA_PRODUTOS_FILTRO`, etc.
3. Declare parametros, como `PARAMETRO_PRODUTO_ID`.
4. Registre cada rota em `ROTA_LISTA`.
5. Crie atalhos como `rotaProdutos()` e `rotaProduto(string $idProduto)`.

### 5. Paginas e fragmentos

Em `nucleo/Pagina.php`:

1. Declare `PRODUTO_LISTA` e `PRODUTO_SELECAO`.
2. Aponte para `produto/l_produto` e `produto/s_produto`.

Se houver BFF com HTML parcial, em `nucleo/Fragmento.php`:

1. Declare `PRODUTO_LISTA`.
2. Aponte para `produto/lb_produto`.

### 6. Presenters

Crie presenters em `visao_apresentacao/`.

Exemplos:

- `VPProdutoLista`: dados resumidos para cards/lista.
- `VPProdutoSelecao`: dados completos para detalhe.

Use presenters para formatar rotas, nomes, imagens, classes visuais e dados derivados.

### 7. ViewModels

Crie ViewModels em `visao_modelo/`.

Padrao recomendado:

- `VMProdutoLista extends VMBasePagina`
- `VMProdutoListaFiltro`
- `VMProdutoListaFragmento extends VMBaseFragmento`
- `VMProdutoSeleciona extends VMBasePagina`

Os ViewModels devem agrupar dados da tela, nao consultar banco.

### 8. Controllers

Crie `controle/CProduto.php`.

Fluxo tipico de pagina:

```php
$appModelo = new MApp();
$produtoModelo = new MProduto();
$filtro = DTOProdutoFiltro::dtoProdutoFiltro($_GET);

$produtoLista = $produtoModelo->produtoListaFiltro(/* filtros */);

$visaoModelo = VMProdutoLista::sucesso(
    $appModelo->dado(),
    $appModelo->textoPagina(Pagina::PRODUTO_LISTA),
    new VMProdutoListaFiltro($filtro),
    new VMProdutoListaFragmento(VPProdutoLista::vpProdutoFabricaLista($produtoLista)),
);

Renderizacao::paginaComLayout(Pagina::PRODUTO_LISTA, $visaoModelo);
```

Se o modulo tiver endpoints assincronos, crie tambem `controle/BFFProduto.php`.

### 9. Views

Crie arquivos em `visao/produto/`.

Sugestao de organizacao:

- `l_produto.php`: pagina de listagem.
- `lb_produto.php`: fragmento de lista usado por BFF.
- `s_produto.php`: pagina de detalhe.
- `produto.php`: item/card individual reutilizavel.

Declare o tipo esperado no topo:

```php
<?php /** @var App\Visao_Modelo\VMProdutoLista $visaoModelo */ ?>
```

A view deve consumir ViewModel e Presenter. Evite acessar `$_GET`, banco ou configuracao diretamente.

### 10. Traducoes

Crie textos nos idiomas ativos:

```text
traducao/pt-br/produto/l_produto.php
traducao/pt-br/produto/s_produto.php
traducao/en-us/produto/l_produto.php
traducao/en-us/produto/s_produto.php
```

Use as mesmas chaves em todos os idiomas.

### 11. Dados globais opcionais

Se a rota aparecer em menu, rodape, JavaScript ou outras views:

1. Adicione propriedade em `visao_apresentacao/VPDado.php`.
2. Preencha em `modelo/MApp.php`.
3. Consuma pela view com `$visaoModelo->dadoSeleciona()`.

### 12. Sitemap e SEO

Se o modulo tiver paginas indexaveis:

1. Atualize `CApp::appMapeamento()`.
2. Busque entidades no modelo.
3. Gere URLs com os atalhos de `Rota`.

## Guia: Criando uma Nova Pagina Simples

Exemplo: pagina `Galeria`.

### 1. Pagina

Em `nucleo/Pagina.php`:

```php
public const APP_GALERIA = "APP_GALERIA";

self::APP_GALERIA => "app_galeria",
```

### 2. Rota

Em `nucleo/Rota.php`:

```php
public const ROTA_GALERIA = "GALERIA";

self::ROTA_GALERIA => [
    self::ROTA_METODO => "GET",
    self::ROTA_URI => "/{" . self::PARAMETRO_IDIOMA . "}/galeria",
    self::ROTA_MANIPULADOR => [CGaleria::class, "galeriaLista"],
],

public static function rotaGaleria(): string
{
    return self::rotaUrl(self::ROTA_GALERIA);
}
```

### 3. ViewModel

Em `visao_modelo/VMGaleria.php`:

```php
namespace App\Visao_Modelo;

use App\Visao_Apresentacao\VPDado;

class VMGaleria extends VMBasePagina
{
    public array $imagemLista;

    public static function sucesso(VPDado $dado, array $texto, array $imagemLista): static
    {
        $vm = new static();
        $vm->dado = $dado;
        $vm->textoConteudo = $texto;
        $vm->imagemLista = $imagemLista;

        return $vm;
    }
}
```

### 4. Controller

Em `controle/CGaleria.php`:

```php
namespace App\Controle;

use App\Modelo\MApp;
use App\Nucleo\Pagina;
use App\Nucleo\Renderizacao;
use App\Visao_Modelo\VMGaleria;

class CGaleria
{
    public static function galeriaLista(): void
    {
        $appModelo = new MApp();
        $imagemLista = [];

        $visaoModelo = VMGaleria::sucesso(
            $appModelo->dado(),
            $appModelo->textoPagina(Pagina::APP_GALERIA),
            $imagemLista,
        );

        Renderizacao::paginaComLayout(Pagina::APP_GALERIA, $visaoModelo);
    }
}
```

### 5. View

Em `visao/app_galeria.php`:

```php
<?php /** @var App\Visao_Modelo\VMGaleria $visaoModelo */ ?>

<h1><?php echo $visaoModelo->textoConteudoSeleciona("titulo"); ?></h1>

<?php foreach ($visaoModelo->imagemLista as $imagem): ?>
    <img src="<?php echo $imagem; ?>" alt="">
<?php endforeach; ?>
```

### 6. Traducao

Em `traducao/pt-br/app_galeria.php` e `traducao/en-us/app_galeria.php`:

```php
<?php
return [
    "titulo" => "Galeria",
];
```

## Guia: Adicionando um Novo Idioma

Exemplo: espanhol `es-es`.

1. Crie `traducao/es-es/`.
2. Copie a estrutura de `traducao/pt-br/` ou `traducao/en-us/`.
3. Traduza mantendo as mesmas chaves.
4. Em `nucleo/Idioma.php`, adicione constante e metodo do novo idioma.
5. Atualize a lista de idiomas suportados.
6. Se o idioma usar outra base de dados, adicione as chaves em `Configuracao` e no arquivo `configuracao.{ambiente}.php`.
7. Em `VPDado`, adicione a rota de troca de idioma se ela precisar aparecer na interface.
8. Em `MApp::dado()`, preencha a nova rota com `Rota::rotaLinguagem(...)`.
9. Atualize o componente de idioma na view.

Depois disso, o roteamento passa a reconhecer o prefixo de idioma e o contexto sera carregado durante a requisicao.

## Convencoes de Nome

O projeto fica mais previsivel quando os novos modulos seguem uma mesma nomenclatura.

Para uma entidade `Produto`, use:

- `BDProduto`: entidade de banco em `base_dado/entidade/`.
- `MProduto`: modelo em `modelo/`.
- `CProduto`: controller web em `controle/`.
- `BFFProduto`: controller BFF em `controle/`, se houver fluxo assincrono.
- `DTOProdutoFiltro`: DTO de entrada em `controle/dado/`.
- `VPProdutoLista` e `VPProdutoSelecao`: presenters em `visao_apresentacao/`.
- `VMProdutoLista`, `VMProdutoListaFiltro`, `VMProdutoListaFragmento`, `VMProdutoSeleciona`: ViewModels em `visao_modelo/`.
- `PRODUTO_LISTA` e `PRODUTO_SELECAO`: constantes de pagina em `Pagina`.
- `ROTA_PRODUTOS`, `ROTA_PRODUTO`, `ROTA_PRODUTOS_FILTRO`, `ROTA_PRODUTOS_PAGINACAO`: constantes de rota em `Rota`.
- `produto/l_produto`, `produto/s_produto`, `produto/lb_produto`, `produto/produto`: views e fragmentos em `visao/produto/`.

## Padroes de Desenvolvimento

- Controllers orquestram; nao devem conter SQL nem HTML.
- Models acessam dados; nao devem renderizar views.
- Services guardam regras transversais ou operacoes complexas.
- DTOs validam entrada; nao devem acessar banco.
- Presenters preparam dados para exibicao; nao devem consultar requisicao diretamente.
- ViewModels transportam estado da tela; nao devem aplicar regra de negocio pesada.
- Views renderizam HTML; nao devem acessar `$_GET`, banco ou configuracao diretamente.
- Rotas devem ser geradas por `Rota`, nunca por strings montadas na view.
- Textos de interface devem ir para `traducao/`.
- Fragmentos usados por BFF devem ser registrados em `Fragmento`.

## Troubleshooting

### Ambiente nao configurado

Erro comum:

```text
Ambiente nao configurado. Defina APP_AMBIENTE no servidor.
```

Verifique se `APP_AMBIENTE` existe no servidor e se o arquivo `configuracao.{ambiente}.php` correspondente esta na raiz do projeto.

### Ambiente invalido

Use apenas valores suportados por `Configuracao`:

- `local`
- `producao`

### Arquivo de configuracao nao encontrado

Se `APP_AMBIENTE=local`, o arquivo esperado e:

```text
configuracao.local.php
```

Copie `configuracao.exemplo.php`, renomeie e preencha as chaves obrigatorias.

### Chave obrigatoria ausente

Todas as chaves de `configuracao.exemplo.php` devem existir no arquivo final, mesmo que algumas integracoes estejam desativadas ou com placeholders no ambiente local.

### Erro de conexao com banco

Confira:

- se `base_dado/sql/bd_framework.sql` foi importado;
- se `BD_SERVIDOR`, `BD_USUARIO_PT_BR`, `BD_USUARIO_EN_US`, `BD_SENHA`, `BD_NOME_PT_BR` e `BD_NOME_EN_US` estao corretos;
- se o usuario possui permissao para as bases configuradas;
- se o idioma ativo aponta para a base esperada.

### Traducao nao encontrada

Quando `Traducao` nao encontra um arquivo, verifique:

- se o prefixo da URL usa idioma suportado, como `/pt-br` ou `/en-us`;
- se existe arquivo equivalente em `traducao/{idioma}/`;
- se `Pagina::paginaTexto()` aponta para o mesmo caminho esperado em `traducao/`.

### Pagina ou fragmento nao encontrado

Confira se:

- a constante foi registrada em `Pagina::PAGINA_LISTA` ou `Fragmento::FRAGMENTO_LISTA`;
- o arquivo existe em `visao/`;
- o nome foi informado sem `.php`.

### Rota retorna 404

Confira se:

- a rota esta registrada em `Rota::ROTA_LISTA`;
- o metodo HTTP esta correto (`GET` ou `POST`);
- os parametros dinamicos da URI batem com os nomes esperados;
- links foram gerados por `Rota::rotaUrl()` ou atalhos de `Rota`.

### BFF retorna 403

O BFF valida o token `codigoSolicitacao` da sessao. Confira se:

- a pagina renderizou `VPDado::appCodigoSolicitacao`;
- o JavaScript enviou a chave definida em `BFFContrato`;
- a sessao PHP esta ativa;
- a chamada esta usando o endpoint BFF correto.

## Checklist para Novo Modulo

- [ ] Esquema de banco definido e script SQL versionado em `base_dado/sql/`, se aplicavel.
- [ ] Entidades criadas em `base_dado/entidade/`.
- [ ] Modelo criado em `modelo/`.
- [ ] DTOs criados em `controle/dado/`.
- [ ] Controller web criado em `controle/`.
- [ ] Controller BFF criado, se houver fluxo assincrono.
- [ ] Rotas registradas em `nucleo/Rota.php`.
- [ ] Paginas registradas em `nucleo/Pagina.php`.
- [ ] Fragmentos registrados em `nucleo/Fragmento.php`, se necessario.
- [ ] Presenters criados em `visao_apresentacao/`.
- [ ] ViewModels criados em `visao_modelo/`.
- [ ] Views criadas em `visao/`.
- [ ] Traducoes criadas em todos os idiomas ativos.
- [ ] Rotas globais adicionadas em `VPDado` e `MApp`, se usadas por menus ou layout.
- [ ] Sitemap atualizado em `CApp::appMapeamento()`, se o conteudo for indexavel.

---

Desenvolvido por **Rangel Pereira Ribeiro**.
