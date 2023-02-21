<body>
    <nav class="navbar navbar-expand-lg navbar-dark <?= $this->session->userdata('role') ? 'bg-danger' : 'bg-dark'?>">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">Dojo eCommerce</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <?php if ($this->session->userdata('user_id')) {
                    if ($this->session->userdata('role')) { ?>
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a href="/dashboard" class="nav-link active" aria-current="page">Orders</a>
                            </li>
                            <li class="nav-item">
                                <a href="/users/edit" class="nav-link active" aria-current="page">Products</a>
                            </li>
                        </ul>
                    <?php } ?>
                    <a href="/users/logout" class="btn btn-warning ms-auto">Log off</a>
                <?php } ?>
            </div>
        </div>

    </nav>
    <div class="text-danger">
        <p><?= $this->session->flashdata('errors'); ?></p>
    </div>
    <div class="text-primary">
        <p><?= $this->session->flashdata('message'); ?></p>
    </div>
</body>

</html>