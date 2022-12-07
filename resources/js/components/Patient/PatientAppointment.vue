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
            <router-link to="/dashboard" class="text-decoration-none"
              ><i class="fas fa-tachometer-alt mr-1"></i>Dashboard</router-link
            >
          </li>
          <li class="breadcrumb-item">
            <router-link to="/patientdashboard" class="text-decoration-none"
              >Patient Dashboard</router-link
            >
          </li>
          <li class="breadcrumb-item active" aria-current="page">
            <router-link
              to="/patientappointment"
              class="text-decoration-none text-muted"
              >Schedule Appointment</router-link
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
                  <h3 class="card-title">New Appointment</h3>
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
                      <i>Appointment Info</i>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="row">
                      <div class="col-lg-4">
                        <label>Patient ID <span class="required-mark" style="color: red;">*</span></label>
                        <div class="input-group">
                          <input
                            type="text"
                            class="form-control"
                            placeholder="Patient ID"
                            v-model="patientId"
                            required
                            disabled
                          />
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <label>Patient Name <span class="required-mark" style="color: red;">*</span></label>
                        <div class="input-group">
                          <input
                            type="text"
                            class="form-control"
                            placeholder="Patient Name"
                            v-model="patientName"
                            disabled
                          />
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <label>Current Date <span class="required-mark" style="color: red;">*</span></label>
                        <div class="input-group">
                          <input
                            type="date"
                            class="form-control"
                            placeholder="dd/mm/yyyy"
                            v-model="currentDate"
                            disabled
                          />
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="row">
                      <div class="col-lg-4">
                        <label>Date of Birth <span class="required-mark" style="color: red;">*</span></label>
                        <div class="input-group">
                          <input
                            type="date"
                            class="form-control"
                            placeholder="Birth Date"
                            v-model="patientDOB"
                            disabled
                          />
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <label>Age <span class="required-mark" style="color: red;">*</span></label>
                        <div class="input-group">
                          <input
                            type="text"
                            class="form-control"
                            placeholder="Age"
                            disabled
                            v-model="patientAge"
                            required
                          />
                        </div>
                      </div>
                      <div class="col-lg-2">
                        <label>Appointment Date <span class="required-mark" style="color: red;">*</span></label>
                        <div class="input-group">
                          <input
                            type="date"
                            class="form-control"
                            placeholder="dd/mm/yyyy"
                            v-model="appointmentDate"
                            required
                          />
                        </div>
                      </div>
                      <div class="col-lg-2">
                        <label>Appointment Time <span class="required-mark" style="color: red;">*</span></label>
                        <div class="input-group">
                          <input
                            type="time"
                            class="form-control"
                            v-model="appointmentTime"
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
                          <select
                            class="form-control select2"
                            style="width: 100%"
                            v-model="medicalDepartment"
                          >
                            <option selected disabled hidden>
                              Select Medical Department
                            </option>
                            <option>Allergic Diseases</option>
                            <option>Cardiology</option>
                            <option>
                              Dermatology (Skin and Venereal Diseases)
                            </option>
                            <option>Ear, Nose and Throat Disorders</option>
                            <option>Gastroenterology / Hepatology</option>
                            <option>Eye Center</option>
                            <option>Infections Diseases</option>
                            <option>Neurology</option>
                            <option>Oncology</option>
                            <option>Pediatrics</option>
                            <option>Psychiatry</option>
                            <option>Psychology</option>
                            <option>Radiology</option>
                            <option>Urology</option>
                            <option>Other</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <label>Symptoms <span class="required-mark" style="color: red;">*</span></label>
                        <textarea
                          class="form-control"
                          rows="1"
                          placeholder="Symptoms"
                          style="resize: none"
                          v-model="symptoms"
                        ></textarea>
                      </div>
                      <div class="col-lg-4">
                        <label>Note <i>(if any)</i></label>
                        <div class="input-group">
                          <input
                            type="text"
                            class="form-control"
                            placeholder="Note"
                            v-model="note"
                          />
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary text-md" @click="scheduleAppointment">
                    Schedule
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

  toastr.options = {
    closeButton: true,
    closeDuration: 200,
    progressBar: true,
    newsOnTop: true,
    positionClass: "toast-top-center",
  };

export default {
  name: "PatientAppointment",
  data() {
    return {
      patientId: "",
      patientName: "",
      patientDOB: "",
      currentDate: "",
      patientAge: "",
      appointmentDate: "",
      appointmentTime: "",
      medicalDepartment: "",
      symptoms: "",
      note: "",
    };
  },
  created() {
    this.getPatient();
  },
  methods: {
    getPatient: function () {
      axios
        .get("../api/getpatient")
        .then((response) => {
          this.patientId = response.data.patient_id;
          this.patientName = response.data.patient_name;
          this.patientDOB = response.data.patient_dob;
          this.currentDate = this.getTodaysDate();
          this.patientAge = this.getAge(response.data.patient_dob);
        })
        .catch((err) => {
          console.log(err);
          toastr["error"]("Something went Wrong.");
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

    scheduleAppointment: function () {
      let payload = {
        patientId : this.patientId,
        currentDate: this.currentDate,
        patientAge: this.patientAge,
        appointmentDate: this.appointmentDate,
        appointmentTime: this.appointmentTime,
        medicalDepartment: this.medicalDepartment,
        symptoms: this.symptoms,
        note: this.note
      };
      axios
        .post("/api/scheduleappointment", payload)
        .then((res) => {
          if (res.data.status == 1) {
            swal
              .fire({
                title: "Success",
                html: "<h5 style='color:#9C9794'>Appointment Scheduled Successfully</h5>",
                icon: "success",
              })
              .then(() => {
                this.resetFields();
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

    getTodaysDate: function () {
      let d = new Date();
      let month = "" + (d.getMonth() + 1);
      let day = "" + d.getDate();
      let year = d.getFullYear();
      if (month < 10) {
        month = "0" + month;
      }
      if (day < 10) {
        day = "0" + day;
      }
      return year + "-" + month + "-" + day;
    },

    getAge: function (patient_dob) {
      var today = new Date();
      var birthDate = new Date(patient_dob);
      var age = today.getFullYear() - birthDate.getFullYear();
      var m = today.getMonth() - birthDate.getMonth();
      if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
        age--;
      }
      return age;
    },

    resetFields: function () {
      this.patientId = this.patientId;
      this.patientName = this.patientName;
      this.patientDOB = this.patientDOB;
      this.currentDate = this.getTodaysDate();
      this.patientAge = this.getAge(this.patientDOB);
      this.appointmentDate = "";
      this.appointmentTime = "";
      this.medicalDepartment = "";
      this.symptoms = "";
      this.note = "";
    },
  },
};
</script>