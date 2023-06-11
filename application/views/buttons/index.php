<div class="row p-3">
    <div class="col">
        <h3>List of buttons</h3>
    </div>
    <div class="col text-end">
        <a href="<?php echo site_url('buttons/create'); ?>" class="btn btn-success">New</a>
    </div>
</div>

<div class="px-3">
    <div class="card">
        <div class="card-body">
            <table class="table">
                <tr>
                    <th>desc</th>
                    <th>actions</th>
                </tr>

                <?php foreach ($files as $key => $file) : ?>
                    <tr>
                        <td>
                            <?php echo $file["filename"] ?>
                        </td>
                        <td>
                            <a href="<?php echo site_url('buttons/edit/' . $file["b64_filename"]); ?>" class="btn btn-primary">Edit</a>
                            <a href="<?php echo site_url('buttons/deploy/' . $file["b64_filename"]); ?>" class="btn btn-info">Deploy</a>
                            <a href="<?php echo site_url('buttons/delete/' . $file["b64_filename"]); ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>
                        </td>
                    </tr>
                <?php endforeach ?>

            </table>
        </div>
    </div>
</div>