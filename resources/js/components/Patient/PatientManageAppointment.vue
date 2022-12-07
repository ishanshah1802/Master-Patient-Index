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
              ><i class="fas fa-tachometer-alt mr-1"></i>Dashboard
            </router-link>
          </li>
          <li class="breadcrumb-item">
            <router-link to="/patientdashboard" class="text-decoration-none"
              >Patient Dashboard</router-link
            >
          </li>
          <li class="breadcrumb-item active" aria-current="page">
            <router-link
              to="/patientmanageappointment"
              class="text-decoration-none text-muted"
              >Manage Appointment</router-link
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
                  <h3 class="card-title">Manage Appointment</h3>
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
                <div class="card-body table-responsive">
                  <div
                    class="
                      d-flex
                      justify-content-between
                      align-content-center
                      mb-2
                    "
                  >
                    <div class="d-flex">
                      <div>
                        <div class="d-flex align-items-center ml-4">
                          <label
                            for="paginate"
                            class="text-nowrap mr-2 mb-0 text-md"
                          >
                            Per Page
                          </label>
                          <select
                            v-model="paginate"
                            class="form-control form-control-sm"
                          >
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="30">30</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <input
                        v-model="search"
                        type="search"
                        class="form-control"
                        placeholder="Search By ..."
                      />
                    </div>
                  </div>

                  <div class="p-0">
                    <table
                      class="
                        table table-hover table-bordered table-striped table-sm
                      "
                    >
                      <thead class="text-md">
                        <tr>
                          <th width="5%">Sr. No.</th>
                          <th width="10%">
                            <a
                              href="#"
                              @click.prevent="updateSorting('appointment_id')"
                              >Appointment ID</a
                            >
                            <span v-if="sort_field == 'appointment_id' ? 1 : 0">
                              <span v-if="sort_direction == 'asc' ? 1 : 0"
                                >&uarr;</span
                              >
                              <span v-if="sort_direction == 'desc' ? 1 : 0"
                                >&darr;</span
                              >
                            </span>
                          </th>
                          <th width="15%">
                            <a
                              href="#"
                              @click.prevent="updateSorting('medical_dept')"
                              >Medical Department</a
                            >
                            <span v-if="sort_field == 'medical_dept' ? 1 : 0">
                              <span v-if="sort_direction == 'asc' ? 1 : 0"
                                >&uarr;</span
                              >
                              <span v-if="sort_direction == 'desc' ? 1 : 0"
                                >&darr;</span
                              >
                            </span>
                          </th>
                          <th width="15%">Symptoms</th>
                          <th width="15%">
                            <a
                              href="#"
                              @click.prevent="updateSorting('appointment_date')"
                              >Appointment Date and Time</a
                            >
                            <span
                              v-if="sort_field == 'appointment_date' ? 1 : 0"
                            >
                              <span v-if="sort_direction == 'asc' ? 1 : 0"
                                >&uarr;</span
                              >
                              <span v-if="sort_direction == 'desc' ? 1 : 0"
                                >&darr;</span
                              >
                            </span>
                          </th>
                          <th width="8%">Action</th>
                        </tr>
                      </thead>
                      <tbody
                        class="text-md"
                        v-for="(appointment, index) in appointments.data"
                        v-bind:key="appointment.appointment_id"
                      >
                        <tr>
                          <td class="text-light">{{ index + 1 }}</td>
                          <td class="text-light">
                            {{ appointment.appointment_id }}
                          </td>
                          <td class="text-light">
                            {{ appointment.medical_dept }}
                          </td>
                          <td class="text-light">{{ appointment.symptoms }}</td>
                          <td class="text-light">
                            {{ appointment.appointment_date }}&nbsp;-&nbsp;{{
                              appointment.appointment_time
                            }}
                          </td>
                          <td class="text-center">
                            <button
                              class="btn btn-primary btn-sm text-md"
                              @click="
                                editAppointment(
                                  appointment.appointment_id,
                                  appointment.appointment_date,
                                  appointment.appointment_time,
                                  appointment.medical_dept,
                                  appointment.symptoms,
                                  appointment.patient_id,
                                  appointment.note,
                                  appointment.current_date,
                                  appointment.patient_age
                                )
                              "
                            >
                              <i class="fas fa-pen"></i>
                            </button>

                            <button
                              class="btn btn-danger btn-sm text-md"
                              @click="
                                deleteAppointment(appointment.appointment_id)
                              "
                            >
                              <i class="fas fa-trash"></i>
                            </button>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div class="row mt-4">
                    <div class="col-sm-6 offset-5">
                      <pagination
                        :data="appointments"
                        @pagination-change-page="getAllAppointments"
                      >
                      </pagination>
                    </div>
                  </div>
                </div>
              </div>

              <div
                class="card card-primary"
                v-if="editAppointmentId == -1 ? 0 : 1"
              >
                <div class="card-header">
                  <h3 class="card-title">Edit Appointment</h3>
                  <div class="card-tools">
                    <button
                      type="button"
                      class="btn btn-tool"
                      data-card-widget="collapse"
                    >
                      <i class="fas fa-minus"></i>
                    </button>
                    <button
                      type="button"
                      class="btn btn-tool"
                      @click="closeEditAppointment"
                    >
                      <i class="fas fa-times"></i>
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
                            v-model="editPatientId"
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
                            v-model="editPatientName"
                            disabled
                          />
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <label>Current Date <span class="required-mark" style="color: red;">*</span> </label>
                        <div class="input-group">
                          <input
                            type="date"
                            class="form-control"
                            placeholder="dd/mm/yyyy"
                            v-model="editCurrentDate"
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
                            v-model="editPatientDOB"
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
                            v-model="editPatientAge"
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
                            v-model="editAppointmentDate"
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
                            v-model="editAppointmentTime"
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
                            v-model="editMedicalDepartment"
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
                          v-model="editSymptoms"
                        ></textarea>
                      </div>
                      <div class="col-lg-4">
                        <label>Note <i>(if any)</i></label>
                        <div class="input-group">
                          <input
                            type="text"
                            class="form-control"
                            placeholder="Note"
                            v-model="editNote"
                          />
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <button
                    type="submit"
                    class="btn btn-primary text-md"
                    @click="updateAppointment"
                  >
                    Update
                  </button>
                  <button
                    type="reset"
                    class="btn btn-primary ml-3 text-md"
                    @click="resetFields"
                  >
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
  name: "PatientManageAppointment",
  data() {
    return {
      appointments: {},
      paginate: "10",
      search: "",
      sort_direction: "asc",
      sort_field: "appointment_date",
      editAppointmentId: -1,
      status: null,
      message: null,
      errors: null,
      editPatientId: "",
      editPatientName: "",
      editPatientDOB: "",
      editCurrentDate: "",
      editPatientAge: "",
      editAppointmentDate: "",
      editAppointmentTime: "",
      editMedicalDepartment: "",
      editSymptoms: "",
      editNote: "",
    };
  },
  mounted() {
    this.getAllAppointments();
  },
  watch: {
    paginate: function () {
      this.getAllAppointments();
    },
    search: function () {
      this.getAllAppointments();
    },
  },
  methods: {
    getAllAppointments: function (page = 1) {
      axios
        .get(
          "../api/patientmanageappointment?page=" +
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
          this.appointments = response.data;
        });
    },

    updateSorting: function (field) {
      if (this.sort_field == field) {
        this.sort_direction = this.sort_direction == "asc" ? "desc" : "asc";
      } else {
        this.sort_field = field;
      }
      this.getAllAppointments(this.appointments.current_page);
    },

    deleteAppointment: function (appointment_id) {
      axios
        .delete("../api/deleteappointment/" + appointment_id)
        .then((res) => {
          swal
            .fire({
              title: "Success",
              html: "<h5 style='color:#9C9794'>Appointment Deleted Successfully.</h5>",
              icon: "success",
            })
            .then((result) => {
              this.getAllAppointments();
            });
        })
        .catch((err) => {
          console.log(err.res.data.message);
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

    editAppointment: function (
      appointment_id,
      appointment_date,
      appointment_time,
      medical_dept,
      symptoms,
      patient_id,
      note,
      patient_age
    ) {
      axios
        .get("../api/getpatient")
        .then((response) => {
          this.editPatientName = response.data.patient_name;
          this.editPatientDOB = response.data.patient_dob;
          this.editAppointmentId = appointment_id;
          this.editPatientId = patient_id;
          this.editAppointmentDate = appointment_date;
          this.editAppointmentTime = appointment_time;
          this.editSymptoms = symptoms;
          this.editMedicalDepartment = medical_dept;
          this.editNote = note;
          this.editPatientAge = this.getAge(this.editPatientDOB);
          this.editCurrentDate = this.getTodaysDate();
        })
        .catch((err) => {
          console.log(err);
          toastr["error"]("Something went Wrong.");
        });
      toastr["info"]("Please Scroll Down...");
    },

    updateAppointment: function () {
      axios
        .put("../api/editappointment/" + this.editAppointmentId, {
          editPatientId: this.editPatientId,
          editPatientName: this.editPatientName,
          editPatientDOB: this.editPatientDOB,
          editAppointmentId: this.editAppointmentId,
          editAppointmentDate: this.editAppointmentDate,
          editAppointmentTime: this.editAppointmentTime,
          editSymptoms: this.editSymptoms,
          editMedicalDepartment: this.editMedicalDepartment,
          editNote: this.editNote,
          editPatientAge: this.editPatientAge,
          editCurrentDate: this.editCurrentDate,
        })
        .then((res) => {
          if (res.data.status == -1) {
            var errormsg = res.data.message;
            toastr["error"](errormsg);
          } else if (res.data.status == 0) {
            toastr["warning"](res.data.message);
          } else if (res.data.status == 1) {
            swal
              .fire({
                title: "Success",
                html: "<h5 style='color:#9C9794'>Appointment Details Updated Successfully...</h5>",
                icon: "success",
              })
              .then((result) => {
                this.resetFields();
                this.editAppointmentId = -1;
                location.reload();
              });
          }
        })
        .catch((err) => {
          console.log(err.res.data.message);
          toastr["error"]("Something went Wrong!");
        });
    },

    resetFields: function () {
      this.editPatientId = this.editPatientId;
      this.editPatientName = this.editPatientName;
      this.editPatientDOB = this.editPatientDOB;
      this.editCurrentDate = this.getTodaysDate();
      this.editPatientAge = this.getAge(this.editPatientDOB);
      this.editAppointmentDate = "";
      this.editAppointmentTime = "";
      this.editMedicalDepartment = "";
      this.editSymptoms = "";
      this.editNote = "";
    },

    closeEditAppointment: function () {
      this.editAppointmentId = -1;
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
  },
};
</script>