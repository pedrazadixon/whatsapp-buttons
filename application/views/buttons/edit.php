   <!-- Justo antes de tu formulario, o donde prefieras mostrar el mensaje -->
<?php if($this->session->flashdata('success')): ?>
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <?= $this->session->flashdata('success') ?>
    </div>
<?php elseif($this->session->flashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <?= $this->session->flashdata('error') ?>
    </div>
<?php endif; ?>
<!-- El resto de tu código -->
   
   <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        Buttons
                    </div>
                    <h2 class="page-title">
                        Edit Buttons
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-body">
                    <?= form_open('buttons/edit/' . ($filename ?? '')) ?>
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label" for="description">Descripción</label>
                                <input class="form-control" type="text" id="description" name="description" value="<?= $json['description'] ?? '' ?>" placeholder="Input Description">
                            </div>

                            <div class="mb-3">
                                <div class="form-label" for="enable">Status</div>
                                <div>
                                    <label class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="enable" name="enable" <?= $json['enable'] ? 'checked' : '' ?>>
                                        <span class="form-check-label">Active</span>
                                    </label>
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="row">
                                    <?php
                                    $dias = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];

                                    foreach ($dias as $dia) {
                                        $schedule = $json['schedules'][$dia] ?? null;
                                    ?>
                                        <div class="col-lg-3 col-md-12 mb-4">
                                            <h3><?= ucfirst($dia) ?></h3>
                                            <div class="form-check mb-3">
                                                <input class="form-check-input" type="checkbox" id="<?= $dia ?>_enable" name="<?= $dia ?>_enable" class="day_enable" <?= $schedule['enable'] ? 'checked' : '' ?>>
                                                <label class="form-check-label" for="<?= $dia ?>_enable">Habilitado</label>
                                            </div>

                                            <div class="row">
                                                <div class="col-6">
                                                    <label class="form-label" for="<?= $dia ?>_from">From</label>
                                                    <input class="form-control" type="time" id="<?= $dia ?>_from" name="<?= $dia ?>_from" class="<?= $dia ?>_time" value="<?= $schedule['from'] ?? '' ?>">
                                                </div>

                                                <div class="col-6">
                                                    <label class="form-label" for="<?= $dia ?>_until">Until</label>
                                                    <input class="form-control" type="time" id="<?= $dia ?>_until" name="<?= $dia ?>_until" class="<?= $dia ?>_time" value="<?= $schedule['until'] ?? '' ?>">
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>

                            <input type="submit" class="btn btn-primary" name="submit" value="Guardar">

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
        });
    </script>