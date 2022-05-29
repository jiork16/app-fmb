 <!-- navLateral -->
 <section class="full-width navLateral">
     <div class="full-width navLateral-bg btn-menu"></div>
     <div class="full-width navLateral-body">
         <div class="full-width navLateral-body-logo text-center tittles">
             <i class="zmdi zmdi-close btn-menu"></i> {{ session('Modulo') }}
         </div>
         <figure class="full-width" style="height: 77px;">
             <div class="navLateral-body-cl">
                 <img src="  {{ asset('img/avatar-male.png') }}" alt="Avatar" class="img-responsive">
             </div>
             <figcaption class="navLateral-body-cr hide-on-tablet">
                 <span>
                     {{ Auth::user()->name }}<br>
                     <small>Admin</small>
                 </span>
             </figcaption>
         </figure>
         <div class="full-width tittles navLateral-body-tittle-menu">
             <i class="zmdi zmdi-desktop-mac"></i><span class="hide-on-tablet">&nbsp; DASHBOARD</span>
         </div>
         <nav class="full-width">
             <ul class="full-width list-unstyle menu-principal">
                 <li class="full-width">
                     <a href="/dashboard" class="full-width">
                         <div class="navLateral-body-cl">
                             <i class="zmdi zmdi-view-dashboard"></i>
                         </div>
                         <div class="navLateral-body-cr hide-on-tablet">
                             INICIO
                         </div>
                     </a>
                 </li>
                 <li class="full-width divider-menu-h"></li>
                 {{-- <li class="full-width">
                     <a class="full-width btn-subMenu">
                         <div class="navLateral-body-cl">
                             <i class="zmdi zmdi-case"></i>
                         </div>
                         <div class="navLateral-body-cr hide-on-tablet">
                             ADMINISTRACION
                         </div>
                         <span class="zmdi zmdi-chevron-left"></span>
                     </a>
                     <ul class="full-width menu-principal sub-menu-options">
                         <li class="full-width">
                             <a href="providers.html" class="full-width">
                                 <div class="navLateral-body-cl">
                                     <i class="zmdi zmdi-truck"></i>
                                 </div>
                                 <div class="navLateral-body-cr hide-on-tablet">
                                     PROVEEDORES
                                 </div>
                             </a>
                         </li>
                         <li class="full-width">
                             <a href="company.html" class="full-width">
                                 <div class="navLateral-body-cl">
                                     <i class="zmdi zmdi-balance"></i>
                                 </div>
                                 <div class="navLateral-body-cr hide-on-tablet">
                                     LABORATORIOS
                                 </div>
                             </a>
                         </li>
                         <li class="full-width">
                             <a href="categories.html" class="full-width">
                                 <div class="navLateral-body-cl">
                                     <i class="zmdi zmdi-label"></i>
                                 </div>
                                 <div class="navLateral-body-cr hide-on-tablet">
                                     CATEGORIES
                                 </div>
                             </a>
                         </li>
                         <li class="full-width">
                             <a href="producto" class="full-width">
                                 <div class="navLateral-body-cl">
                                     <i class="zmdi zmdi-label"></i>
                                 </div>
                                 <div class="navLateral-body-cr hide-on-tablet">
                                     PRODUCTOS
                                 </div>
                             </a>
                         </li>
                         <li class="full-width">
                             <a href="payments.html" class="full-width">
                                 <div class="navLateral-body-cl">
                                     <i class="zmdi zmdi-card"></i>
                                 </div>
                                 <div class="navLateral-body-cr hide-on-tablet">
                                     PAGOS
                                 </div>
                             </a>
                         </li>

                     </ul>
                 </li>
                 <li class="full-width divider-menu-h"></li>
                 <li class="full-width">
                     <a class="full-width btn-subMenu">
                         <div class="navLateral-body-cl">
                             <i class="zmdi zmdi-face"></i>
                         </div>
                         <div class="navLateral-body-cr hide-on-tablet">
                             USUARIOS
                         </div>
                         <span class="zmdi zmdi-chevron-left"></span>
                     </a>
                     <ul class="full-width menu-principal sub-menu-options">
                         <li class="full-width">
                             <a href="admin.html" class="full-width">
                                 <div class="navLateral-body-cl">
                                     <i class="zmdi zmdi-account"></i>
                                 </div>
                                 <div class="navLateral-body-cr hide-on-tablet">
                                     ADMINISTRADOR
                                 </div>
                             </a>
                         </li>
                         <li class="full-width">
                             <a href="client.html" class="full-width">
                                 <div class="navLateral-body-cl">
                                     <i class="zmdi zmdi-accounts"></i>
                                 </div>
                                 <div class="navLateral-body-cr hide-on-tablet">
                                     CLIENTES
                                 </div>
                             </a>
                         </li>
                     </ul>
                 </li> --}}
                 <li class="full-width divider-menu-h"></li>
                 <li class="full-width">
                     <a href="/products" class="full-width">
                         <div class="navLateral-body-cl">
                             <i class="zmdi zmdi-washing-machine"></i>
                         </div>
                         <div class="navLateral-body-cr hide-on-tablet">
                             PRODUCTOS
                         </div>
                     </a>
                 </li>
                 <li class="full-width divider-menu-h"></li>
                 <li class="full-width">
                     <a class="full-width btn-subMenu">
                         <div class="navLateral-body-cl">
                             <i class="zmdi zmdi-shopping-cart"></i>
                         </div>
                         <div class="navLateral-body-cr hide-on-tablet">
                             VENTAS
                         </div>
                         <span class="zmdi zmdi-chevron-left"></span>
                     </a>
                     <ul class="full-width menu-principal sub-menu-options">
                         <li class="full-width">
                             <a href="sales.report" class="full-width" data-turbolinks="false">
                                 <div class="navLateral-body-cl">
                                     <i class="zmdi zmdi-view-list-alt"></i>
                                 </div>
                                 <div class="navLateral-body-cr hide-on-tablet">
                                     REPORTE VENTA
                                 </div>
                             </a>
                         </li>
                         <li class="full-width">
                             <a href="sale" class="full-width">
                                 <div class="navLateral-body-cl">
                                     <i class="zmdi zmdi-shopping-cart-add"></i>
                                 </div>
                                 <div class="navLateral-body-cr hide-on-tablet">
                                     VENTA
                                 </div>
                             </a>
                         </li>
                     </ul>
                 </li>
                 {{-- <li class="full-width divider-menu-h"></li>
                 <li class="full-width">
                     <a href="product.iventory" class="full-width">
                         <div class="navLateral-body-cl">
                             <i class="zmdi zmdi-store"></i>
                         </div>
                         <div class="navLateral-body-cr hide-on-tablet">
                             INVENTARIO
                         </div>
                     </a>
                 </li>
                 <li class="full-width divider-menu-h"></li> --}}
                 {{-- <li class="full-width">
                     <a href="#!" class="full-width btn-subMenu">
                         <div class="navLateral-body-cl">
                             <i class="zmdi zmdi-wrench"></i>
                         </div>
                         <div class="navLateral-body-cr hide-on-tablet">
                             SETTINGS
                         </div>
                         <span class="zmdi zmdi-chevron-left"></span>
                     </a>
                     <ul class="full-width menu-principal sub-menu-options">
                         <li class="full-width">
                             <a href="#!" class="full-width">
                                 <div class="navLateral-body-cl">
                                     <i class="zmdi zmdi-widgets"></i>
                                 </div>
                                 <div class="navLateral-body-cr hide-on-tablet">
                                     OPTION
                                 </div>
                             </a>
                         </li>
                         <li class="full-width">
                             <a href="#!" class="full-width">
                                 <div class="navLateral-body-cl">
                                     <i class="zmdi zmdi-widgets"></i>
                                 </div>
                                 <div class="navLateral-body-cr hide-on-tablet">
                                     OPTION
                                 </div>
                             </a>
                         </li>
                     </ul>
                 </li> --}}
             </ul>
         </nav>
     </div>
 </section>
 <style>

 </style>
