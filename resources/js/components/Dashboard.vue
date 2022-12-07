<template>
  <div>
    <aside></aside>
    <div class="content-wrapper">
      <nav class="navbar navbar-dark">
        <div></div>
        <ul class="breadcrumb navbar-dark">
          <li class="breadcrumb-item active" aria-current="page">
            <router-link to="/dashboard" class="text-decoration-none text-muted"><i
                class="fas fa-tachometer-alt mr-1"></i>Dashboard
            </router-link>
          </li>
        </ul>
      </nav>
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-3 col-6 mt-3">
              <!-- small card -->
              <div class="small-box bg-info">
                <div class="inner">
                  <h4><b>Patient</b></h4>
                  <h4><b>Registration</b></h4>
                </div>
                <div class="icon">
                  <i class="nav-icon nav-icon fa solid fa-user-plus fa-lg"></i>
                </div>
                <router-link to="/patientregister" class="nav-link small-box-footer">
                  Register &nbsp;<i class="fas fa-arrow-circle-right"></i>
                </router-link>
              </div>
            </div>

            <div class="col-lg-3 col-6 mt-3">
              <!-- small card -->
              <div class="small-box bg-success">
                <div class="inner">
                  <h4><b>Patient</b></h4>
                  <h4><b>Management</b></h4>
                </div>
                <div class="icon">
                  <i class="nav-icon nav-icon fa solid fa-hospital-user fa-lg"></i>
                </div>
                <router-link to="/patientlogin" class="nav-link small-box-footer">
                  Login &nbsp;<i class="fas fa-arrow-circle-right"></i>
                </router-link>
              </div>
            </div>

            <div class="col-lg-3 col-6 mt-3">
              <!-- small card -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h4><b>Staff</b></h4>
                  <h4><b>Management</b></h4>
                </div>
                <div class="icon">
                  <i class="nav-icon nav-icon fa solid fa-users fa-lg"></i>
                </div>
                <router-link to="/stafflogin" class="nav-link small-box-footer">
                  Login &nbsp;<i class="fas fa-arrow-circle-right"></i>
                </router-link>
              </div>
            </div>
          </div>
          <!-- ./col -->
        </div>
      </section>
    </div>
  </div>
</template>

<script>
  export default {
    name: "Dashboard",
  };
</script>