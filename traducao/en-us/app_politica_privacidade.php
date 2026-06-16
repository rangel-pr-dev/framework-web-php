<?php
return [
    "titulo" => "Privacy Policy",
    "p1" => "Last updated: June 15, 2026.",
    "p2" => "This policy describes how an application based on Symmetria Framework may handle data during navigation, use of demonstrative resources and interaction with modules enabled by the project.",
    
    "p_informacao_coleta_titulo" => "Information Collection",
    "p_informacao_coleta_p1" => "The base project uses technical information required for application behavior, such as selected language, visual theme and request code used to validate BFF calls. Personal data should only be collected when a module, form or integration is implemented for that purpose.",

    "p_informacao_uso_titulo" => "Use of Information",
    "p_informacao_uso_p1" => "Technical information is used to maintain the session, apply language and theme preferences, protect asynchronous requests, render pages and allow modules to work predictably. Information voluntarily submitted through forms should be used only for the purpose stated by that feature.",

    "p_informacao_armazenamento_titulo" => "Information Storage",
    "p_informacao_armazenamento_p1" => "Session preferences may be temporarily kept by PHP. Persistent data depends on the models and tables enabled by the application. The framework example includes language-specific databases and demonstrative Item data, without requiring personal data for its basic operation.",

    "p_informacao_protecao_titulo" => "Information Protection",
    "p_informacao_protecao_p1" => "The framework separates configuration by environment, validates required keys, avoids exposing credentials in views, normalizes input through DTOs and validates BFF calls with a request code. Even so, each final application should review permissions, forms, logs, databases and integrations before production.",

    "p_google_analytics_titulo" => "Google Analytics and Google Ads",
    "p_google_analytics_p1" => "The README describes optional keys for Google Analytics, Google Ads and ads.txt. These services should only be considered active when configured in the environment and enabled by the application.",
    "p_google_analytics_p2" => "When used, these services may process technical and statistical data about navigation, performance, traffic source and page interaction. The final configuration should inform users according to the rules applicable to the project.",
    "p_google_analytics_p3" => "<a class='link-info text-decoration-none' target='_blank' href='http://www.google.com/policies/privacy/partners/'>How Google uses information from sites or apps that use its services.</a>",

    "p_cookies_titulo" => "Cookies and Session",
    "p_cookies_p1" => "Cookies and session data may be used to keep the application working properly.",
    "p_cookies_p2" => "In the base project, the session supports preferences such as language and theme, as well as the request code used to protect BFF calls.",
    "p_cookies_p3" => "Third-party services, such as analytics, ads or payments, may add their own cookies when enabled by the final application.",

    "p_terceiros_titulo" => "Third-Party Services",
    "p_terceiros_p1" => "The application may contain external links or configurable integrations, such as Google Services and PayPal. Each integration should be intentionally enabled by the final project and may have its own privacy, cookie and data processing policies.",

    "p_atualizacao_titulo" => "Updates to this Policy",
    "p_atualizacao_p1" => "This policy may be updated as new modules, forms, databases, integrations or BFF flows are added. The update date should be reviewed whenever the application's data processing changes.",

    "p_contato_titulo" => "Contact",
    "p_contato_p1" => "For questions about privacy, data use or adapting this policy in a real application, use the institutional email configured in the project or the contact channel provided by the final application.",

    "p3" => "This text is a demonstrative base for projects created with Symmetria Framework. Before using it in production, review the content according to enabled modules, active integrations and legal requirements applicable to your context.",
];
