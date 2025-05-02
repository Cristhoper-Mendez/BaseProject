
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="#" class="brand-link">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="brand-image img-circle elevation-3" >
        <span class="brand-text font-weight" style="color: white">PANEL DE CONTROL</span>
    </a>

    <div class="sidebar">

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="true">

                <!-- ROLES Y PERMISO -->
                @can('sidebar.roles.y.permisos')
                 <li class="nav-item">

                     <a href="#" class="nav-link nav-">
                     <i class="fas fa-folder"></i>
                        <p>
                            Roles y Permisos
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        <li class="nav-item" >
                            <a href="{{ route('admin.roles.index') }}" target="frameprincipal" class="nav-link">
                            <i class="fas fa-check-circle mr-2"></i>
                                <p>Rol y Permisos</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.permisos.index') }}" target="frameprincipal" class="nav-link">
                            <i class="fas fa-user-circle mr-2"></i>
                                <p>Usuario</p>
                            </a>
                        </li>

                    </ul>
                 </li>
                @endcan

                <li class="nav-item">

                    <a href="#" class="nav-link nav-">
                    <i class="fas fa-folder"></i>
                       <p>
                           Calculadora
                           <i class="fas fa-angle-left right"></i>
                       </p>
                   </a>

                   <ul class="nav nav-treeview">
                       <li class="nav-item">
                           <a href="{{ route('calculadora.index') }}" target="frameprincipal" class="nav-link">
                           <i class="fas fa-calculator mr-2"></i>
                               <p>Calculadora</p>
                           </a>
                       </li>
                   </ul>
                </li>


            </ul>
        </nav>


    </div>
</aside>






