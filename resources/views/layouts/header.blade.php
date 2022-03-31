 <!-- navBar -->
 <div class="full-width navBar">
     <div class="full-width navBar-options">
         <i class="zmdi zmdi-more-vert btn-menu" id="btn-menu"></i>
         <div class="mdl-tooltip" for="btn-menu">Menu</div>
         <nav class="navBar-options-list">
             <ul class="list-unstyle">
                 <li class="btn-Notification" id="notifications">
                     <i class="zmdi zmdi-notifications"></i>
                     <!-- <i class="zmdi zmdi-notifications-active btn-Notification" id="notifications"></i> -->
                     <div class="mdl-tooltip" for="notifications">Notifications</div>
                 </li>
                 <li class="btn-exit" id="btn-exit">
                     <form id="logoutForm" action="{{ route('logout') }}" method="POST">
                         @csrf
                         <i class="zmdi zmdi-power"></i>
                         <div class="mdl-tooltip" for="btn-exit">LogOut</div>
                     </form>

                 </li>
                 <li class="text-condensedLight noLink"><small>{{ Auth::user()->name }}</small></li>
                 <li class="noLink">
                     <figure>
                         <img src="  {{ asset('img/avatar-male.png') }}" alt="Avatar" class="img-responsive">
                     </figure>
                 </li>
             </ul>
         </nav>
     </div>
 </div>
