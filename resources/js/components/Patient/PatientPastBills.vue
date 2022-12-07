<template>
    <div>
        <aside></aside>
        <div class="content-wrapper">
            <nav class="navbar navbar-dark">
                <div>
                    <button type="logout" class="btn btn-danger text-md" @click="logoutPatient">
            Logout <i class="fas fa-power-off"></i>
          </button>
                </div>
                <ul class="breadcrumb navbar navbar-dark">
                    <li class="breadcrumb-item">
                        <router-link to="/dashboard" class="text-decoration-none"><i
                                class="fas fa-tachometer-alt mr-1"></i>Dashboard
                        </router-link>
                    </li>
                    <li class="breadcrumb-item">
                        <router-link to="/patientdashboard" class="text-decoration-none">Patient Dashboard</router-link>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <router-link to="/patientpastbills" class="text-decoration-none text-muted">Past Bills
                        </router-link>
                    </li>
                </ul>
            </nav>
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12 mt-3">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Past Bills</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body table-responsive">
                                    <div class="
                      d-flex
                      justify-content-between
                      align-content-center
                      mb-2
                    ">
                                        <div class="d-flex">
                                            <div>
                                                <div class="d-flex align-items-center ml-4">
                                                    <label for="paginate" class="text-nowrap mr-2 mb-0 text-md">
                                                        Per Page
                                                    </label>
                                                    <select v-model="paginate" class="form-control form-control-sm">
                                                        <option value="10">10</option>
                                                        <option value="20">20</option>
                                                        <option value="30">30</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <input v-model="search" type="search" class="form-control"
                                                placeholder="Search By ..." />
                                        </div>
                                    </div>

                                    <div class="p-0">
                                        <table class="
                        table table-hover table-bordered table-striped table-sm
                      ">
                                            <thead class="text-md">
                                                <tr>
                                                    <th width="5%">Sr. No.</th>
                                                    <th width="10%">
                                                        <a href="#"
                                                            @click.prevent="updateSorting('bill_id')">Bill
                                                            ID</a>
                                                        <span v-if="sort_field == 'bill_id' ? 1 : 0">
                                                            <span v-if="sort_direction == 'asc' ? 1 : 0">&uarr;</span>
                                                            <span v-if="sort_direction == 'desc' ? 1 : 0">&darr;</span>
                                                        </span>
                                                    </th>
                                                    <th width="15%">
                                                        <a href="#"
                                                            @click.prevent="updateSorting('medical_dept')">Medical
                                                            Department</a>
                                                        <span v-if="sort_field == 'medical_dept' ? 1 : 0">
                                                            <span v-if="sort_direction == 'asc' ? 1 : 0">&uarr;</span>
                                                            <span v-if="sort_direction == 'desc' ? 1 : 0">&darr;</span>
                                                        </span>
                                                    </th>
                                                    <th width="15%">Symptoms</th>
                                                    <th width="15%">
                                                        <a href="#"
                                                            @click.prevent="updateSorting('appointment_date')">Appointment
                                                            Date and Time</a>
                                                        <span v-if="sort_field == 'appointment_date' ? 1 : 0">
                                                            <span v-if="sort_direction == 'asc' ? 1 : 0">&uarr;</span>
                                                            <span v-if="sort_direction == 'desc' ? 1 : 0">&darr;</span>
                                                        </span>
                                                    </th>
                                                    <th width="8%">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-md" v-for="(bill, index) in bills.data"
                                                v-bind:key="bill.bill_id">
                                                <tr>
                                                    <td class="text-light">{{ index + 1 }}</td>
                                                    <td class="text-light">
                                                        {{ bill.bill_id }}
                                                    </td>
                                                    <td class="text-light">
                                                        {{ bill.medical_dept }}
                                                    </td>
                                                    <td class="text-light">{{ bill.symptoms }}</td>
                                                    <td class="text-light">
                                                        {{ bill.appointment_date }}&nbsp;-&nbsp;{{
                                                        bill.appointment_time
                                                        }}
                                                    </td>
                                                    <td class="text-center">

                                                        <button class="btn btn-danger btn-sm text-md" @click="
                                generatePDF(bill.patient_id,bill.appointment_id)
                              ">
                                                            <i class="fas fa-file-pdf"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-sm-6 offset-5">
                                            <pagination :data="bills"
                                                @pagination-change-page="getAllBills">
                                            </pagination>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</template>

<script>
import swal from "sweetalert2";

export default {
  name: "PatientPastBills",
  data() {
    return {
      bills: {},
      paginate: "10",
      search: "",
      sort_direction: "desc",
      sort_field: "appointment_date",
    };
  },
  mounted() {
    this.getAllBills();
  },
  watch: {
    paginate: function () {
      this.getAllBills();
    },
    search: function () {
      this.getAllBills();
    },
  },

  methods: {
    getAllBills: function (page = 1) {
      axios
        .get(
          "../api/getpatientbills?page=" +
            page +
            "&paginate=" +
            this.paginate +
            "&search=" +
            this.search +
            "&sortdirection=" +
            this.sort_direction +
            "&sortfield=" +
            this.sort_field
        )
        .then((response, err) => {
          if (err) {
          }
          this.bills = response.data;
        });
    },

    logoutPatient: function () {
      swal
        .fire({
          title: "Success",
          html: "<h5 style='color:#9C9794'>Logout Successfully...</h5>",
          icon: "success",
        })
        .then((result) => {
          this.$router.push({ name: 'PatientLogin'})
        });
    },

    updateSorting: function (field) {
      if (this.sort_field == field) {
        this.sort_direction = this.sort_direction == "asc" ? "desc" : "asc";
      } else {
        this.sort_field = field;
      }
      this.getAllBills(this.bills.current_page);
    },

    generatePDF: function (patient_id, appointment_id) {
        axios
        .get(
          "../generatebillpdf/" + patient_id + "/" + appointment_id
        )
        .then((response, err) => {
          if (err) {
          toastr["error"]("Something went Wrong!");
          }
          window.location = "/generatebillpdf/" + patient_id + "/" + appointment_id;
        });
    }
  }
};
</script>