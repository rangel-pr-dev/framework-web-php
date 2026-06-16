<?php
/** @var App\Visao_Modelo\VMBasePagina $visaoModelo */
?>
<nav class="navbar navbar-expand-lg fixed-top shadow <?php echo ($visaoModelo->dadoSeleciona()->tema === 'noite') ? 'bg-dark' : 'bg-light'; ?>" data-bs-theme="<?php echo ($visaoModelo->dadoSeleciona()->tema === 'noite') ? 'dark' : 'light'; ?>">
    <div class="<?php echo ($visaoModelo->dadoSeleciona()->layoutFluido) ? "container-fluid" : "container"; ?>">
        <a class="navbar-brand" href="<?php echo $visaoModelo->dadoSeleciona()->rotaRaiz; ?>">
            <img class="d-inline-block align-top rounded-circle me-2" src="<?php echo $visaoModelo->dadoSeleciona()->logomarca; ?>" width="32" height="32" alt="<?php echo $visaoModelo->textoNavegacao("titulo"); ?>">
            <?php echo $visaoModelo->textoNavegacao("titulo"); ?>
        </a>
        <!-- **** -->
        <div class="d-flex align-items-center ms-auto">
            <ul class="navbar-nav flex-row">
                <!-- Linguagem -->
                <li class="nav-item dropdown me-2">
                    <a class="nav-link px-2" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-translate"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end rounded-4 shadow border-0 mt-2">
                        <li>
                            <a class="dropdown-item <?php echo ($visaoModelo->dadoSeleciona()->idioma === 'pt-br') ? 'active' : ''; ?>" href="<?php echo $visaoModelo->dadoSeleciona()->rotaLinguagemPortugues; ?>">
                                <?php echo $visaoModelo->textoMenu("bt_linguagem_portugues"); ?>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item <?php echo ($visaoModelo->dadoSeleciona()->idioma === 'en-us') ? 'active' : ''; ?>" href="<?php echo $visaoModelo->dadoSeleciona()->rotaLinguagemIngles; ?>">
                                <?php echo $visaoModelo->textoMenu("bt_linguagem_ingles"); ?>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- Tema -->
                <li class="nav-item dropdown me-2">
                    <a class="nav-link px-2" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi <?php echo ($visaoModelo->dadoSeleciona()->tema === 'dark') ? 'bi-moon-stars-fill' : 'bi-brightness-high-fill'; ?>"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end rounded-4 shadow border-0 mt-2">
                        <li>
                            <a class="dropdown-item <?php echo ($visaoModelo->dadoSeleciona()->tema === 'light') ? 'active' : ''; ?>" href="<?php echo $visaoModelo->dadoSeleciona()->rotaTemaDia; ?>">
                                <i class="bi bi-brightness-high-fill me-2"></i>
                                <?php echo $visaoModelo->textoMenu("bt_tema_dia"); ?>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item <?php echo ($visaoModelo->dadoSeleciona()->tema === 'dark') ? 'active' : ''; ?>" href="<?php echo $visaoModelo->dadoSeleciona()->rotaTemaNoite; ?>">
                                <i class="bi bi-moon-stars-fill me-2"></i>
                                <?php echo $visaoModelo->textoMenu("bt_tema_noite"); ?>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- **** -->
            <button class="navbar-toggler border-0 ms-1" type="button" data-bs-toggle="offcanvas" data-bs-target="#menu-suspenso" aria-controls="menu-suspenso" aria-label="XXXX">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        <!-- **** -->
        <div class="offcanvas offcanvas-start" tabindex="-1" id="menu-suspenso" aria-labelledby="menu-suspenso-titulo">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="menu-suspenso-titulo">
                    <?php echo $visaoModelo->textoNavegacao("menu"); ?>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="XXXX"></button>
            </div>
            <div class="offcanvas-body">
                <?php include "visao/menu/app_menu_suspenso.php"; ?>
            </div>
        </div>
    </div>
</nav>