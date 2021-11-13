    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
      <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="<?= media();?>/img/avatar.png" alt="User Image">
        <div>
          <p class="app-sidebar__user-name"><?= $_SESSION['userData']['UserName']?></p>
          <p class="app-sidebar__user-designation">Administrador</p>
        </div>
      </div>
      <ul class="app-menu">
        <li><a class="app-menu__item" href="<?= base_url();?>dashboard"><i class="app-menu__icon fa fa-home"></i><span class="app-menu__label">Menu De Inicio</span></a></li>
        <li><a class="app-menu__item" href="<?= base_url();?>users"><i class="app-menu__icon fa fa-user"></i><span class="app-menu__label">Usuarios</span></a></li>
        <li><a class="app-menu__item" href="<?= base_url();?>category"><i class="app-menu__icon fa fa-list-alt"></i><span class="app-menu__label">Categorias</span></a></li>
        <li><a class="app-menu__item" href="<?= base_url();?>product"><i class="app-menu__icon fa fa-product-hunt"></i><span class="app-menu__label">Productos</span></a></li>
        <li><a class="app-menu__item" href="<?= base_url();?>sales"><i class="app-menu__icon fa fa-shopping-cart"></i><span class="app-menu__label">Ventas</span></a></li>
        <li><a class="app-menu__item" href="<?= base_url();?>transaction"><i class="app-menu__icon fa fa-file-text"></i><span class="app-menu__label">Transacciones</span></a></li>      
    </ul>
    </aside> 