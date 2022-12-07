<template>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="/" class="brand-link text-decoration-none">
            <img
                src="../../../../public/dist/img/mpi-logo.png"
                alt="Master Patient Index Logo"
                class="brand-image img-circle elevation-3"
                style="opacity: 0.8"
            />
            <span class="brand-text font-weight-light text-md">Master Patient Index</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul
                    class="nav nav-pills nav-sidebar flex-column"
                    data-widget="treeview"
                    role="menu"
                    data-accordion="false"
                >
                    <li class="nav-item">
                        <router-link to="/dashboard" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p class="text-md">Dashboard</p>
                        </router-link>
                    </li>

                    <!-- <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon nav-icon fa solid fa-user-plus"></i>
                            <p class="text-md">
                                Patient
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <router-link to="/newpatient" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p class="text-md">New Patient</p>
                                </router-link>
                            </li>
                        </ul>
                    </li> -->

                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
</template>

<script>
export default {
    name: "Sidebar"
};
</script>
