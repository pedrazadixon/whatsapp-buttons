<!-- Justo antes de tu formulario, o donde prefieras mostrar el mensaje -->
<?php if ($this->session->flashdata('success')) : ?>
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <?= $this->session->flashdata('success') ?>
    </div>
<?php elseif ($this->session->flashdata('error')) : ?>
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <?= $this->session->flashdata('error') ?>
    </div>
<?php endif; ?>

<!-- Page header -->
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                    Botón
                </div>
                <h2 class="page-title">
                    Crear Botón
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
                <?= form_open('buttons/create') ?>
                <div class="row">
                    <div class="col-12">
                        <div class="mb-3">
                            <label class="form-label" for="description">Descripción</label>
                            <input class="form-control" type="text" id="description" name="description" value="<?= set_value('description') ?>" placeholder="Ingrese descripción" require>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="telephone">Telefono</label>
                            <input class="form-control" type="text" id="telephone" name="telephone" value="<?= set_value('telephone') ?>" placeholder="Ingrese telefono" require>
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
                                    <div class="col-lg-3 col-md-12 mb-4">
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
                </div>
            </div>
        </div>
    </div>
</div>

<script>
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
    });
</script>