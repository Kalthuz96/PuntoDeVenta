<?php headerAdmin($data);?>
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-dashboard"></i><?=$data['page_title'];?></h1>
          <p>Reto Reaccion Digital</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="<?= base_url();?>dashboard">Menu De Inicio</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <div class="row">
                <div class="col-md-3">
                  <div class="widget-small primary card-dash"><a href="<?=base_url();?>users"><i class="icon fa fa-users fa-3x"></i></a>
                    <div class="info">
                      <h4>Usuario</h4>
                      <p><b>5</b></p>
                    </div>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="widget-small info card-dash"><a href="<?=base_url();?>product"><i class="icon fa fa-product-hunt fa-3x"></i></a>
                    <div class="info">
                      <h4>Productos</h4>
                      <p><b>25</b></p>
                    </div>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="widget-small warning card-dash"><a href="<?=base_url();?>category"><i class="icon fa fa-list-alt fa-3x"></i></a>
                    <div class="info">
                      <h4>Categorias</h4>
                      <p><b>10</b></p>
                    </div>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="widget-small danger card-dash"><a href="<?=base_url();?>sales"><i class="icon fa fa-shopping-cart fa-3x"></i></a>
                    <div class="info">
                      <h4>Ventas</h4>
                      <p><b>500</b></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
<?php footerAdmin($data);?>