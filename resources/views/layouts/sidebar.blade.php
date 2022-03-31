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
                             HOME
                         </div>
                     </a>
                 </li>
                 <li class="full-width divider-menu-h"></li>
                 <li class="full-width">
                     <a href="#!" class="full-width btn-subMenu">
                         <div class="navLateral-body-cl">
                             <i class="zmdi zmdi-case"></i>
                         </div>
                         <div class="navLateral-body-cr hide-on-tablet">
                             ADMINISTRATION
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
                                     PAYMENTS
                                 </div>
                             </a>
                         </li>

                     </ul>
                 </li>
                 <li class="full-width divider-menu-h"></li>
                 <li class="full-width">
                     <a href="#!" class="full-width btn-subMenu">
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
                                     ADMINISTRATORS
                                 </div>
                             </a>
                         </li>
                         <li class="full-width">
                             <a href="client.html" class="full-width">
                                 <div class="navLateral-body-cl">
                                     <i class="zmdi zmdi-accounts"></i>
                                 </div>
                                 <div class="navLateral-body-cr hide-on-tablet">
                                     CLIENT
                                 </div>
                             </a>
                         </li>
                     </ul>
                 </li>
                 <li class="full-width divider-menu-h"></li>
                 <li class="full-width">
                     <a href="/product" class="full-width">
                         <div class="navLateral-body-cl">
                             <i class="zmdi zmdi-washing-machine"></i>
                         </div>
                         <div class="navLateral-body-cr hide-on-tablet">
                             PRODUCTS
                         </div>
                     </a>
                 </li>
                 <li class="full-width divider-menu-h"></li>
                 <li class="full-width">
                     <a href="sale" class="full-width">
                         <div class="navLateral-body-cl">
                             <i class="zmdi zmdi-shopping-cart"></i>
                         </div>
                         <div class="navLateral-body-cr hide-on-tablet">
                             SALES
                         </div>
                     </a>
                 </li>
                 <li class="full-width divider-menu-h"></li>
                 <li class="full-width">
                     <a href="inventory.html" class="full-width">
                         <div class="navLateral-body-cl">
                             <i class="zmdi zmdi-store"></i>
                         </div>
                         <div class="navLateral-body-cr hide-on-tablet">
                             INVENTORY
                         </div>
                     </a>
                 </li>
                 <li class="full-width divider-menu-h"></li>
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
