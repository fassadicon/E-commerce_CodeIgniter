  <nav class="navbar navbar-expand-lg navbar-dark <?= $this->session->userdata('role') ? 'bg-danger' : 'bg-dark' ?>">
      <div class="container-fluid">
          <a class="navbar-brand" href="/">Sixenart Clothing</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <?php if ($this->session->userdata('user_id')) {
                    if ($this->session->userdata('role')) { ?>
                      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                          <li class="nav-item">
                              <a href="/dashboard/orders" class="nav-link active <?= $selected == 'orders' ? 'text-decoration-underline' : '' ?>" aria-current="page">Orders</a>
                          </li>
                          <li class="nav-item">
                              <a href="/dashboard/products" class="nav-link active <?= $selected == 'products' ? 'text-decoration-underline' : '' ?>" aria-current="page">Products</a>
                          </li>
                      </ul>
                  <?php } ?>
                  <div class="right-side ms-auto">
                      <a href="/carts" class="btn btn-info">Shopping Cart</a>
                      <a href="/users/logout" class="btn btn-warning">Log off</a>
                  </div>

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