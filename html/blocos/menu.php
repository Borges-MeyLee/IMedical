<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="dashboard.php" class="app-brand-link">

          <img src="../assets/img/favicon/imedical_log.png" style="height: 120px">
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item">
            <a href="dashboard.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>

        <!-- Layouts -->

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Pacientes</span>
        </li>

        <li class="menu-item">
            <a href="pag-pacientes-cadastrados.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings">Pacientes cadastrados</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="pag-novo-paciente.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-lock-open-alt"></i>
                <div data-i18n="Authentications">Cadastrar novo paciente</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="pag-novo-procedimentos.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings">Cadastrar novo procedimento</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase"><span class="menu-header-text">Configuração</span></li>
        <!-- Perfil -->
        <li class="menu-item">
            <a href="pag-conf-admin.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-detail"></i>
                <div data-i18n="Form Elements">Meu perfil</div>
            </a>
        </li>

</aside>