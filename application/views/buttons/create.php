<div class="row p-3">
    <div class="col">
        <h3>Create</h3>
    </div>
</div>

<div class="px-3">
    <div class="row mb-3">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <?= form_open('buttons/create') ?>

                    <label for="description">Descripción</label>
                    <input type="text" id="description" name="description" require>

                    <label for="enable">Habilitado</label>
                    <input type="checkbox" id="enable" name="enable">

                    <?php
                    $dias = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];

                    foreach ($dias as $dia) {
                    ?>
                        <h3><?= ucfirst($dia) ?></h3>

                        <label for="<?= $dia ?>_enable">Habilitado</label>
                        <input type="checkbox" id="<?= $dia ?>_enable" name="<?= $dia ?>_enable" class="day_enable">

                        <label for="<?= $dia ?>_from">Desde</label>
                        <input type="time" id="<?= $dia ?>_from" name="<?= $dia ?>_from" class="<?= $dia ?>_time">

                        <label for="<?= $dia ?>_until">Hasta</label>
                        <input type="time" id="<?= $dia ?>_until" name="<?= $dia ?>_until" class="<?= $dia ?>_time">

                    <?php
                    }
                    ?>

<input type="submit" class="btn btn-primary" name="submit" value="Guardar">

                    <?= form_close() ?>


                </div>
               
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col">
            <a href="<?php echo site_url('buttons') ?>" class="btn btn-danger">Volver</a>
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
                // Si el checkbox está marcado, establecer los campos de tiempo como requeridos
                timeFields.prop('required', true);
            } else {
                // Si el checkbox no está marcado, eliminar el atributo requerido de los campos de tiempo
                timeFields.prop('required', false);
            }
        });
    });
</script>