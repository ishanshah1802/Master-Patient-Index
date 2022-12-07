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
            <router-link to="/dashboard" class="text-decoration-none"
              ><i class="fas fa-tachometer-alt mr-1"></i>Dashboard</router-link
            >
          </li>
          <li class="breadcrumb-item">
            <router-link to="/staffdashboard" class="text-decoration-none"
              >Staff Dashboard</router-link
            >
          </li>
          <li class="breadcrumb-item active" aria-current="page">
            <router-link
              to="/generatebill"
              class="text-decoration-none text-muted"
              >Generate Bill</router-link
            >
          </li>
        </ul>
      </nav>
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12 mt-3">
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Generate Bill</h3>
                  <div class="card-tools">
                    <button
                      type="button"
                      class="btn btn-tool"
                      data-card-widget="collapse"
                    >
                      <i class="fas fa-minus"></i>
                    </button>
                  </div>
                </div>

                <div class="card-body">
                  <div class="form-group row">
                    <div class="box-header text-muted text-lg">
                      <i>Bill Details</i>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="row">
                      <div class="col-lg-4">
                        <label>Patient ID <span class="required-mark" style="color: red;">*</span></label>
                        <div class="input-group">
                          <input
                            type="text"
                            v-model="patientId"
                            class="form-control"
                            placeholder="Patient ID"
                            required
                            @blur="getPatientDetails"
                          />
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <label>Patient Name <span class="required-mark" style="color: red;">*</span></label>
                        <div class="input-group">
                          <input
                            type="text"
                            v-model="patientName"
                            class="form-control"
                            placeholder="Patient Name"
                            disabled
                          />
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <label>Date of Birth <span class="required-mark" style="color: red;">*</span></label>
                        <div class="input-group">
                          <input
                            type="date"
                            v-model="patientDOB"
                            class="form-control"
                            placeholder="Birth Date"
                            disabled
                          />
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="row">
                      <div class="col-lg-4">
                        <label>Appointment Date and Time <span class="required-mark" style="color: red;">*</span></label>
                        <div class="input-group">
                          <model-select
                            :options="appointmentDate"
                            v-model="selectedAppointmentDate"
                            placeholder="Select Date"
                            @blur="getAppointmentDetails"
                          >
                          </model-select>
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <label
                          >Bill Date
                          <span class="required-mark" style="color: red"
                            >*</span
                          ></label
                        >
                        <div class="input-group">
                          <input
                            type="date"
                            class="form-control"
                            placeholder="dd/mm/yyyy"
                            v-model="billDate"
                            required
                            disabled
                          />
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <label>Age <span class="required-mark" style="color: red;">*</span></label>
                        <div class="input-group">
                          <input
                            type="text"
                            v-model="patientAge"
                            class="form-control"
                            placeholder="Age"
                            disabled
                            required
                          />
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="row">
                      <div class="col-lg-4">
                        <label>Medical Department <span class="required-mark" style="color: red;">*</span></label>
                        <div class="input-group">
                          <input
                            type="text"
                            v-model="medicalDepartment"
                            class="form-control"
                            placeholder="Medical Department"
                            disabled
                          />
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <label>Symptoms <span class="required-mark" style="color: red;">*</span></label>

                        <textarea
                          v-model="symptoms"
                          class="form-control"
                          rows="1"
                          placeholder="Symptoms"
                          style="resize: none"
                          disabled
                        ></textarea>
                      </div>
                      <div class="col-lg-4">
                        <label>Consulting Fees <span class="required-mark" style="color: red;">*</span></label>
                        <div class="input-group">
                          <input
                            type="text"
                            v-model="consultingFees"
                            class="form-control"
                            placeholder="Consulting Fees"
                          />
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary text-md" @click="generatePDF">
                    Generate
                  </button>
                  <button type="reset" class="btn btn-primary ml-3 text-md" @click="resetFields">
                    Reset
                  </button>
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
import toastr from "toastr";
import swal from "sweetalert2";
import { ModelSelect } from "vue-search-select";

toastr.options = {
  closeButton: true,
  closeDuration: 200,
  progressBar: true,
  newestOnTop: true,
  positionClass: "toast-top-center",
};

export default {
  name: "GenerateBill",
  components: {
    ModelSelect,
  },
  data() {
    return {
      patientId: "",
      patientName: "",
      symptoms: "",
      patientAge: "",
      patientDOB: "",
      consultingFees: "",
      medicalDepartment: "",
      appointmentDate: [],
      selectedAppointmentDate: "",
      billDate: "",
      consultingFees: "",
      appointmentId: ""
    };
  },
  methods: {
    getPatientDetails: function () {
      axios
        .get("../api/getpatientdetails/" + this.patientId)
        .then((response) => {
          console.log(response.data);
          this.patientId = response.data[0].patient_id;
          this.patientName = response.data[0].patient_name;
          this.patientDOB = response.data[0].patient_dob;
          this.appointmentDate = response.data.map((appointmentDate) => {
            return {
              value:
                appointmentDate.appointment_date +
                " - " +
                appointmentDate.appointment_time,
              text:
                appointmentDate.appointment_date +
                " - " +
                appointmentDate.appointment_time,
            };
          });
        })
        .catch((err) => {
          console.log(err);
          toastr["error"]("Something went Wrong.");
        });
    },

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

    getAppointmentDetails: function () {
      if (
        this.selectedAppointmentDate == "" ||
        this.selectedAppointmentDate == undefined
      ) {
        this.billDate = "";
        return;
      }

      let splitDateTime = this.selectedAppointmentDate.split(" - ");
      let appDate = splitDateTime[0];
      let appTime = splitDateTime[1];

      axios
        .get("../api/getappointmentdetails/" + appDate + "/" + appTime)
        .then((response) => {
          this.appointmentId = response.data.appointment_id;
          this.billDate = response.data.current_date;
          this.patientAge = response.data.patient_age;
          this.medicalDepartment = response.data.medical_dept;
          this.symptoms = response.data.symptoms;
        })
        .catch((err) => {
          console.log(err);
          toastr["error"]("Something went Wrong!");
        });
    },

    generatePDF: function () {
      let payload = {
        patientId: this.patientId,
        appointmentId: this.appointmentId,
        consultingFees: this.consultingFees
      };
      axios
        .post("/api/addbill", payload)
        .then((res) => {
          if (res.data.status == 1) {
            swal
              .fire({
                title: "Success",
                html: "<h5 style='color:#9C9794'>Bill Generated Successfully.<br>Loading Bill PDF...</h5>",
                icon: "success",
              })
              .then(() => {
                this.resetFields();
                window.location = "/generatebillpdf/" + this.patientId + "/" + this.appointmentId;
              });
          } else if (res.data.status == 0) {
            toastr.info(res.data.message);
          } else {
            toastr.error(res.data.message);
          }
        })
        .catch((err) => {
          toastr.error(res.error.message);
          console.log(res.error.message);
        });
    },

    resetFields: function ()
    {
      location.reload();
    }
  },
};
</script>