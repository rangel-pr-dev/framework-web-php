<?php
return [
    "titulo" => "Politica de Privacidade",
    "p1" => "Ultima atualizacao: 15/06/2026.",
    "p2" => "Esta politica descreve como uma aplicacao baseada no Symmetria Framework pode tratar dados durante a navegacao, uso de recursos demonstrativos e interacao com modulos habilitados pelo projeto.",
    
    "p_informacao_coleta_titulo" => "Coleta de Informacoes",
    "p_informacao_coleta_p1" => "O projeto base utiliza informacoes tecnicas necessarias para funcionamento da aplicacao, como idioma selecionado, tema visual e codigo de solicitacao usado para validar chamadas BFF. Dados pessoais somente devem ser coletados quando um modulo, formulario ou integracao for implementado para essa finalidade.",

    "p_informacao_uso_titulo" => "Uso de Informacoes",
    "p_informacao_uso_p1" => "As informacoes tecnicas sao usadas para manter a sessao, aplicar preferencias de idioma e tema, proteger requisicoes assincronas, renderizar paginas e permitir que os modulos funcionem de forma previsivel. Informacoes enviadas voluntariamente em formularios devem ser usadas apenas para a finalidade informada no proprio recurso.",

    "p_informacao_armazenamento_titulo" => "Armazenamento de Informacoes",
    "p_informacao_armazenamento_p1" => "Preferencias de sessao podem ser mantidas temporariamente pelo PHP. Dados persistentes dependem dos modelos e tabelas habilitados pela aplicacao. O exemplo do framework inclui bancos por idioma e dados demonstrativos da entidade Item, sem necessidade de dados pessoais para seu funcionamento basico.",

    "p_informacao_protecao_titulo" => "Protecao de Informacoes",
    "p_informacao_protecao_p1" => "O framework separa configuracoes por ambiente, valida chaves obrigatorias, evita expor credenciais nas views, normaliza entradas por DTOs e valida chamadas BFF com codigo de solicitacao. Ainda assim, cada aplicacao final deve revisar permissoes, formularios, logs, banco de dados e integracoes antes de entrar em producao.",

    "p_google_analytics_titulo" => "Google Analytics e Google Ads",
    "p_google_analytics_p1" => "O README descreve chaves opcionais para Google Analytics, Google Ads e ads.txt. Esses servicos so devem ser considerados ativos quando configurados no ambiente e habilitados pela aplicacao.",
    "p_google_analytics_p2" => "Quando usados, esses servicos podem tratar dados tecnicos e estatisticos sobre navegacao, desempenho, origem de acesso e interacao com paginas. A configuracao final deve informar o usuario conforme as regras aplicaveis ao projeto.",
    "p_google_analytics_p3" => "<a class='link-info text-decoration-none' target='_blank' href='http://www.google.com/policies/privacy/partners/'>Como o Google usa informacoes de sites ou apps que utilizam seus servicos.</a>",

    "p_cookies_titulo" => "Cookies e Sessao",
    "p_cookies_p1" => "Cookies e dados de sessao podem ser usados para manter o funcionamento basico da aplicacao.",
    "p_cookies_p2" => "No projeto base, a sessao apoia preferencias como idioma e tema, alem do codigo de solicitacao usado na protecao de chamadas BFF.",
    "p_cookies_p3" => "Servicos de terceiros, como analytics, anuncios ou pagamentos, podem adicionar seus proprios cookies quando forem habilitados pela aplicacao final.",

    "p_terceiros_titulo" => "Servicos de Terceiros",
    "p_terceiros_p1" => "A aplicacao pode conter links externos ou integracoes configuraveis, como Google Services e PayPal. Cada integracao deve ser ativada conscientemente pelo projeto final e pode possuir politicas proprias de privacidade, cookies e tratamento de dados.",

    "p_atualizacao_titulo" => "Atualizacoes desta Politica",
    "p_atualizacao_p1" => "Esta politica pode ser atualizada conforme novos modulos, formularios, bancos, integracoes ou fluxos BFF sejam adicionados. A data de atualizacao deve ser revisada sempre que o tratamento de dados da aplicacao mudar.",

    "p_contato_titulo" => "Contato",
    "p_contato_p1" => "Para duvidas sobre privacidade, uso de dados ou adaptacao desta politica em uma aplicacao real, utilize o email institucional configurado no projeto ou o canal de contato disponibilizado pela aplicacao final.",

    "p3" => "Este texto e uma base demonstrativa para projetos criados com o Symmetria Framework. Antes de usar em producao, revise o conteudo conforme os modulos habilitados, as integracoes ativas e as exigencias legais aplicaveis ao seu contexto.",
];
