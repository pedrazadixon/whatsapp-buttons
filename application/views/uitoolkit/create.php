<!-- Page header -->
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                    UI Toolkit
                </div>
                <h2 class="page-title">
                    Crear UI Toolkit
                </h2>
            </div>
        </div>
    </div>
</div>

<!-- Page body -->
<div class="page-body">
    <div class="container-xl">
        <?php if (validation_errors()) : ?>
            <div class="card mt-2">
                <div class="card-status-top bg-danger"></div>
                <div class="card-body">
                    <?= validation_errors() ?>
                </div>
            </div>
        <?php endif; ?>
        <div class="card mt-2">
            <div class="card-body">
                <?= form_open('uitoolkit/create') ?>
                <div class="row">
                    <div class="col-lg-7 col-md-12">
                        <div class="mb-3">
                            <label class="form-label required" for="description">Descripción</label>
                            <input class="form-control" type="text" id="description" name="description" value="<?= set_value('description') ?>" placeholder="Ingrese descripción" require>
                        </div>
                        <div class="mb-3">
                            <div class="form-label" for="enable">Estado</div>
                            <div>
                                <label class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="enable" name="enable" <?= set_checkbox('enable', 'on') ?>>
                                    <span class="form-check-label">Activo</span>
                                </label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="row">
                                <?php
                                $dias = [
                                    'lunes' => 'monday',
                                    'martes' => 'tuesday',
                                    'miércoles' => 'wednesday',
                                    'jueves' => 'thursday',
                                    'viernes' => 'friday',
                                    'sábado' => 'saturday',
                                    'domingo' => 'sunday'
                                ];

                                foreach ($dias as $dia_es => $dia_en) {
                                ?>
                                    <div class="col-lg-4 col-md-12 mb-4">
                                        <h3><?= ucfirst($dia_es) ?></h3>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input day_enable" type="checkbox" id="<?= $dia_en ?>_enable" name="<?= $dia_en ?>_enable" <?= set_checkbox($dia_en . '_enable', 'on') ?>>
                                            <label class="form-check-label" for="<?= $dia_en ?>_enable">Habilitado</label>
                                        </div>

                                        <div class="row">
                                            <div class="col-6">
                                                <label class="form-label" for="<?= $dia_en ?>_from">Desde</label>
                                                <input class="form-control <?= $dia_en ?>_time" type="time" id="<?= $dia_en ?>_from" name="<?= $dia_en ?>_from" class="<?= $dia_en ?>_time" value="<?= set_value($dia_en . '_from') ?>">
                                            </div>

                                            <div class="col-6">
                                                <label class="form-label" for="<?= $dia_en ?>_until">Hasta</label>
                                                <input class="form-control <?= $dia_en ?>_time" type="time" id="<?= $dia_en ?>_until" name="<?= $dia_en ?>_until" class="<?= $dia_en ?>_time" value="<?= set_value($dia_en . '_until') ?>">
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>

                        <input type="submit" class="btn btn-primary" name="submit" value="Crear">

                        <?= form_close() ?>

                    </div>
                    <div class="col-lg-5 col-md-12">
                        <div class="mb-3">
                            <div class="form-label">Ejemplos</div>
                            <div class="row g-2 align-items-center">
                                <div class="col-lg-6 col-sm-12 col-md-2 col-xl-auto">
                                    <a onclick="exampleAlert()" class="btn btn-warning w-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-alert-circle" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>
                                            <path d="M12 8v4"></path>
                                            <path d="M12 16h.01"></path>
                                        </svg>
                                        Alerta
                                    </a>
                                </div>
                                <div class="col-lg-6 col-sm-12 col-md-2 col-xl-auto">
                                    <a onclick="exampleModal()" class="btn btn-twitter w-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-app-window" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M3 5m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z"></path>
                                            <path d="M6 8h.01"></path>
                                            <path d="M9 8h.01"></path>
                                        </svg>
                                        Modal
                                    </a>
                                </div>
                                <div class="col-lg-6 col-sm-12 col-md-2 col-xl-auto">
                                    <a onclick="exampleWhatsapp()" class="btn btn-teal w-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-whatsapp" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M3 21l1.65 -3.8a9 9 0 1 1 3.4 2.9l-5.05 .9"></path>
                                            <path d="M9 10a.5 .5 0 0 0 1 0v-1a.5 .5 0 0 0 -1 0v1a5 5 0 0 0 5 5h1a.5 .5 0 0 0 0 -1h-1a.5 .5 0 0 0 0 1"></path>
                                        </svg>
                                        Boton Whatsapp
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="html_code">Código HTML</label>
                            <textarea class="form-control" id="html_code" rows="5" name="html_code" require>
<?php if (empty($json['enable'])) : ?>
<!-- Escribe tu código HTML aquí. Ejemplo:
    <div></div>
    <script></script>
    <style></style>
-->
<?php else : ?>
    <?= $json['html_code'] ?? '' ?>
    <?php endif ?>
</textarea>
                        </div>
                        <div class="row g-2 align-items-center">
                            <div class="col-6 col-sm-4 col-md-2 col-xl-auto py-3">
                                <a onclick="clearCode()" href="#" class="btn w-100 btn-icon" aria-label="Blanquear" data-bs-toggle="tooltip" data-bs-placement="left" title="Blanquear Campo">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eraser" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M19 20h-10.5l-4.21 -4.3a1 1 0 0 1 0 -1.41l10 -10a1 1 0 0 1 1.41 0l5 5a1 1 0 0 1 0 1.41l-9.2 9.3"></path>
                                        <path d="M18 13.3l-6.3 -6.3"></path>
                                    </svg>
                                </a>
                            </div>
                            <div class="col-6 col-sm-4 col-md-2 col-xl-auto py-3">
                                <a onclick="previewCode()" class="btn btn-twitter w-100 btn-icon" aria-label="" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Visualizar Codigo">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M8 9l3 3l-3 3"></path>
                                        <path d="M13 15l3 0"></path>
                                        <path d="M4 4m0 4a4 4 0 0 1 4 -4h8a4 4 0 0 1 4 4v8a4 4 0 0 1 -4 4h-8a4 4 0 0 1 -4 -4z"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>

                        <div id="html_preview" class="mb-3">
                            <!-- Aquí se mostrará el HTML ingresado -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const previewCode = () => {
        var html_code = $("#html_code").val();
        $('#html_preview').html(html_code);
    }

    const clearCode = () => {
        $("#html_code").val('');
        previewCode();
    }

    const exampleWhatsapp = () => {
        let html_code = `<a href="https://api.whatsapp.com/send?phone=573222222222" target="_blank">
            <div class="btn-whatsapp"></div>
        </a>
        <style>
            .btn-whatsapp {
                position: fixed;
                width: 60px;
                height: 60px;
                bottom: 40px;
                right: 40px;
                background-color: #25d366;
                color: #FFF;
                border-radius: 50px;
                text-align: center;
                font-size: 30px;
                box-shadow: 2px 2px 3px #999;
                z-index: 100;
                display: flex;
                justify-content: center;
                align-items: center;
                transition: box-shadow 0.3s ease;
                /* Agregamos una transición para un efecto suave */
            }

            .btn-whatsapp:hover {
                box-shadow: 0px 0px 10px 5px rgba(0, 0, 0, 0.2);
                /* Cambiamos la sombra en el estado hover */
            }

            .btn-whatsapp::before {
                content: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' class='icon icon-tabler icon-tabler-brand-whatsapp' width='28' height='28' viewBox='0 0 22 22' stroke-width='2' stroke='%23FFF' fill='none' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath stroke='none' d='M0 0h24v24H0z' fill='none'%3E%3C/path%3E%3Cpath d='M3 21l1.65 -3.8a9 9 0 1 1 3.4 2.9l-5.05 .9'%3E%3C/path%3E%3Cpath d='M9 10a.5 .5 0 0 0 1 0v-1a.5 .5 0 0 0 -1 0v1a5 5 0 0 0 5 5h1a.5 .5 0 0 0 0 -1h-1a.5 .5 0 0 0 0 1'%3E%3C/path%3E%3C/svg%3E");
            }
        </style>
        `
        $("#html_code").val(html_code);
        previewCode();

    }

    const exampleModal = () => {
        let html_code = `<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Launch demo modal
            </button>

            <div class="modal" id="exampleModal" tabindex="-1">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci animi beatae delectus deleniti dolorem eveniet facere fuga iste nemo nesciunt nihil odio perspiciatis, quia quis reprehenderit sit tempora totam unde.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Save changes</button>
                </div>
                </div>
            </div>
            </div>
            `

        $('#html_code').val(html_code);
        previewCode();
    }

    const exampleAlert = () => {
        html_code = `<div class="alert alert-success" role="alert">
            <h4 class="alert-title">Wow! Everything worked!</h4>
            <div class="text-muted">Your account has been saved!</div>
        </div>`;
        $('#html_code').val(html_code);
        previewCode();

    }

    $(document).ready(function() {
        // Evento que se dispara cuando se cambia el estado de cualquier checkbox
        $(".day_enable").change(function() {
            var day = this.name.split('_')[0];
            var timeFields = $('.' + day + '_time');

            if (this.checked) {
                timeFields.prop('required', true);
            } else {
                timeFields.prop('required', false);
            }
        });

        // Trigger para configurar correctamente los campos requeridos al cargar la página
        $(".day_enable").trigger('change');

        // Evento que se dispara cuando se hace un cambio en el textarea
        $("#html_code").on('input', function() {
            previewCode()
        });

        // Trigger para configurar correctamente los campos requeridos al cargar la página
        $(".day_enable").trigger('change');


    });
</script>