<template>
  <div>
    <aside></aside>
    <div class="content-wrapper">
      <nav class="navbar navbar-dark">
        <div>
          <button type="logout" class="btn btn-danger text-md" @click="logoutStaff">
            Logout <i class="fas fa-power-off"></i>
          </button>
        </div>
        <ul class="breadcrumb navbar navbar-dark">
          <li class="breadcrumb-item">
            <router-link to="/dashboard" class="text-decoration-none"><i class="fas fa-tachometer-alt mr-1"></i>Dashboard</router-link>
          </li>
          <li class="breadcrumb-item active">
            <router-link to="/staffdashboard" class="text-decoration-none text-muted" >Staff Dashboard</router-link>
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
                  <h4><b>Personal</b></h4>
                  <h4><b>Information</b></h4>
                </div>
                <div class="icon">
                  <i class="nav-icon nav-icon fa solid fa-info-circle fa-lg"></i>
                </div>
                <router-link to="/staffinfo" class="nav-link small-box-footer">
                  See / Edit Info &nbsp;<i
                    class="fas fa-arrow-circle-right"
                  ></i>
                </router-link>
              </div>
            </div>

            <div class="col-lg-3 col-6 mt-3">
              <!-- small card -->
              <div class="small-box bg-success">
                <div class="inner">
                  <h4><b>Schedule</b></h4>
                  <h4><b>Appointment</b></h4>
                </div>
                <div class="icon">
                  <i class="nav-icon nav-icon fa solid fa-calendar-check fa-lg"></i>
                </div>
                <router-link to="/staffappointment" class="nav-link small-box-footer">
                  Schedule &nbsp;<i
                    class="fas fa-arrow-circle-right"
                  ></i>
                </router-link>
              </div>
            </div>

            <div class="col-lg-3 col-6 mt-3">
              <!-- small card -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h4><b>Manage</b></h4>
                  <h4><b>Appointment</b></h4>
                </div>
                <div class="icon">
                  <i class="nav-icon nav-icon fa solid fa-calendar-plus fa-lg"></i>
                </div>
                <router-link to="/staffmanageappointment" class="nav-link small-box-footer">
                  Manage &nbsp;<i
                    class="fas fa-arrow-circle-right"
                  ></i>
                </router-link>
              </div>
            </div>

            <div class="col-lg-3 col-6 mt-3">
              <!-- small card -->
              <div class="small-box bg-danger">
                <div class="inner">
                  <h4><b>Generate</b></h4>
                  <h4><b>Bill</b></h4>
                </div>
                <div class="icon">
                  <i class="nav-icon nav-icon fa solid fa-print fa-lg"></i>
                </div>
                <router-link to="/generatebill" class="nav-link small-box-footer">
                  Generate &nbsp;<i
                    class="fas fa-arrow-circle-right"
                  ></i>
                </router-link>
              </div>
            </div>

          </div>
          <div class="row">
            <div class="col-lg-3 col-6 mt-3">
              <!-- small card -->
              <div class="small-box bg-pink">
                <div class="inner">
                  <h4><b>Past</b></h4>
                  <h4><b>Bills</b></h4>
                </div>
                <div class="icon">
                  <i class="nav-icon nav-icon fa solid fa-file-invoice fa-lg"></i>
                </div>
                <router-link to="/pastbills" class="nav-link small-box-footer">
                  Show &nbsp;<i
                    class="fas fa-arrow-circle-right"
                  ></i>
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
import swal from "sweetalert2";

export default {
  name: "StaffDashboard",

  methods: {
    logoutStaff: function () {
      swal
        .fire({
          title: "Success",
          html: "<h5 style='color:#9C9794'>Logout Successfully...</h5>",
          icon: "success",
        })
        .then((result) => {
          this.$router.push({ name: 'StaffLogin'})
        });
    },
  }
};
</script>