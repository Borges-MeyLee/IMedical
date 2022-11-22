<?php
include "functions/logout.php";
if(!isset($_GET['id'])){
    header("Location:pag-pacientes-cadastrados.php");
    exit();
}
include "functions/conexao_banco.php";
$id_paciente = $_GET['id'];
$sql = "SELECT * FROM tb_paciente WHERE id_paciente = '{$id_paciente}'";
$resultado = $conecta->query($sql);
$paciente = $resultado->fetch_assoc();

?>
<!DOCTYPE html>
<html
        lang="pt-br"
        class="light-style layout-menu-fixed"
        dir="ltr"
        data-theme="theme-default"
        data-assets-path="../assets/"
        data-template="vertical-menu-template-free"
>
<head>
    <meta charset="utf-8"/>
    <meta
            name="viewport"
            content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>IMedical</title>

    <meta name="description" content=""/>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/logo_comp.png"/>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
    <link
            href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
            rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="../assets/vendor/fonts/boxicons.css"/>

    <!-- Core CSS -->
    <link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css"/>
    <link rel="stylesheet" href="../assets/vendor/css/theme-default.css" class="template-customizer-theme-css"/>
    <link rel="stylesheet" href="../assets/css/demo.css"/>

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css"/>

    <link rel="stylesheet" href="../assets/vendor/libs/apex-charts/apex-charts.css"/>

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="../assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../assets/js/config.js"></script>
</head>

<body>
<!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <!-- Menu -->

        <?php
        include("blocos/menu.php");
        ?>

        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
            <!-- Navbar -->

            <?php
            include "blocos/nav.php";
            ?>

            <!-- / Navbar -->

            <!-- Content wrapper -->
                <!-- Content -->
                <div class="container-xxl flex-grow-1 container-p-y">
                    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Pacientes/</span> Editar dados do
                        paciente</h4>
                    <div class="content-wrapper">
                        <?php
                        if(isset($_GET['sucesso'])){
                            $msg="Dados dos paciente editados com sucesso!";
                            ?>
                            <div class="alert alert-success" role="alert">
                                <?= $msg; ?>

                            </div>
                            <?php
                        }
                        ?>
                        <?php
                        if(isset($_GET['erro'])){
                            ?>
                            <div class="alert alert-danger" role="alert">
                                <?= $msg = "Erro ao editar os dados do paciente."?>
                            </div>
                            <?php
                        }
                        ?>

                    <!-- Basic Layout -->
                    <div class="row">
                        <div class="col-xl">
                            <div class="card mb-4">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0">Dados</h5>
                                </div>
                                <div class="card-body">
                                    <form action="functions/update_paciente.php" method="post">
                                        <input type="hidden" name="id_paciente" value="<?= $paciente['id_paciente']?>">
                                        <div class="mb-3">
                                            <label class="form-label" for="basic-default-fullname">Nome completo</label>
                                            <input type="text"
                                                   class="form-control"
                                                   id="nome_paciente"
                                                   name="nome_paciente"
                                                   value="<?= $paciente['nome']?>"
                                                   placeholder=""
                                                   required="required"/>

                                            <div class="form-text">*Obrigatório</div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label for="html5-date-input" class="col-md-2 col-form-label">Data
                                                Nascimento</label>
                                            <div class="col-md-2">
                                                <input class="form-control"
                                                       type="date"
                                                       name="dt_nascimento"
                                                       value="<?= $paciente['dt_nascimento']?>"
                                                       id="dt_nascimento"/>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label" for="basic-default-email">E-mail</label>
                                            <div class="input-group input-group-merge">
                                                <input
                                                        type="text"
                                                        id="email"
                                                        name="email"
                                                        value="<?= $paciente['email']?>"
                                                        class="form-control"
                                                        placeholder="nome@exemplo.com"
                                                        aria-label="john.doe"
                                                        aria-describedby="basic-default-email2"
                                                        required="required"
                                                />
                                            </div>
                                            <div class="form-text">*Obrigatório</div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label" for="basic-default-company">Endereço</label>
                                            <input type="text"
                                                   class="form-control"
                                                   id="endereco"
                                                   value="<?= $paciente['endereco']?>"
                                                   name="endereco"
                                                   placeholder=""/>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label" for="basic-default-phone">Celular</label>
                                            <input
                                                    type="text"
                                                    id="celular"
                                                    name="celular"
                                                    value="<?= $paciente['celular']?>"
                                                    class="form-control phone-mask"
                                                    placeholder=""
                                            />
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label"
                                                   for="basic-default-message">Observações</label>
                                            <textarea
                                                    id="observacao_paciente"
                                                    name="observacao_paciente"
                                                    class="form-control"
                                                    placeholder="Alguma observação para o atendiemnto?"><?= $paciente['observacao']?></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Salvar alterações</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>


            <!-- / Content -->

            <!-- Footer -->
            <?php
            include "blocos/footer.php"
            ?>
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
        </div>
        <!-- Content wrapper -->
    </div>
    <!-- / Layout page -->
</div>

<!-- Overlay -->
<div class="layout-overlay layout-menu-toggle"></div>
</div>
<!-- / Layout wrapper -->

<!-- Core JS -->
<!-- build:js assets/vendor/js/core.js -->
<script src="../assets/vendor/libs/jquery/jquery.js"></script>
<script src="../assets/vendor/libs/popper/popper.js"></script>
<script src="../assets/vendor/js/bootstrap.js"></script>
<script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

<script src="../assets/vendor/js/menu.js"></script>
<!-- endbuild -->

<!-- Vendors JS -->
<script src="../assets/vendor/libs/apex-charts/apexcharts.js"></script>

<!-- Main JS -->
<script src="../assets/js/main.js"></script>

<!-- Page JS -->
<script src="../assets/js/dashboards-analytics.js"></script>

<!-- Place this tag in your head or just before your close body tag. -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
</body>
</html>
