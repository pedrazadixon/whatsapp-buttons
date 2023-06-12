<!-- Page header -->
<div class="page-header d-print-none">
    <div class="container-xl">
        <?php if ($this->session->flashdata('success')) : ?>
            <div class="alert alert-success alert-dismissible" role="alert">
                <div class="d-flex">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <circle cx="12" cy="12" r="9"></circle>
                            <line x1="12" y1="8" x2="12.01" y2="8"></line>
                            <polyline points="11 12 12 12 12 16 13 16"></polyline>
                        </svg>
                    </div>
                    <div>
                        <h4 class="alert-title">Realizado</h4>
                        <div class="text-muted"><?= $this->session->flashdata('success') ?></div>
                    </div>
                </div>
                <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
            </div>
        <?php elseif ($this->session->flashdata('error')) : ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
                <div class="d-flex">
                    <div>
                        <svg>...</svg>
                    </div>
                    <div>
                        <h4 class="alert-title">Error</h4>
                        <div class="text-muted"> <?= $this->session->flashdata('error') ?></div>
                    </div>
                </div>
                <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
            </div>
        <?php endif; ?>
        <div class="row g-2 align-items-center">
            <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                    UI Toolkit
                </div>
                <h2 class="page-title">
                    Lista de UI Toolkit
                </h2>
            </div>
            <!-- Page title actions -->
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    <a href="<?php echo site_url('uitoolkit/create'); ?>" class="btn btn-primary d-none d-sm-inline-block">
                        <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M12 5l0 14" />
                            <path d="M5 12l14 0" />
                        </svg>
                        Nuevo UI Toolkit
                    </a>
                    <a href="#" class="btn btn-primary d-sm-none btn-icon">
                        <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M12 5l0 14" />
                            <path d="M5 12l14 0" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page body -->
<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <div class="card-body">

                <div class="card">
                    <div class="table-responsive">
                        <table class="table table-vcenter card-table">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Descripción</th>
                                    <th>Estado</th>
                                    <th class="w-1"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($files as $key => $file) : ?>

                                    <tr>
                                        <td> <?php echo $file["filename"] ?></td>
                                        <td> <?php echo $file["content"]['description'] ?></td>
                                        <td> <span class="badge  <?= ($file["content"]['enable']) ? 'bg-green' : 'bg-red' ?>  "><?= ($file["content"]['enable']) ? 'Active' : 'Disable' ?></span></td>
                                        <td>
                                            <div class="btn-list flex-nowrap">
                                                <a href="<?php echo site_url('uitoolkit/edit/' . $file["b64_filename"]); ?>" class="btn btn-primary">Editar</a>
                                                <a href="<?php echo site_url('uitoolkit/deploy/' . $file["b64_filename"]); ?>" class="btn btn-dark">Desplegar</a>
                                                <a href="<?php echo site_url('uitoolkit/delete/' . $file["b64_filename"]); ?>" class="btn btn-danger" onclick="return confirm('¿Esta seguro que desea eliminar este item?');">Eliminar</a>

                                            </div>


                                        </td>
                                    </tr>

                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>