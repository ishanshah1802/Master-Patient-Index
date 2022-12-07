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
                class="fas fa-tachometer-alt mr-1"></i>Dashboard</router-link>
          </li>
          <li class="breadcrumb-item">
            <router-link to="/patientdashboard" class="text-decoration-none">Patient Dashboard</router-link>
          </li>
          <li class="breadcrumb-item active" aria-current="page">
            <router-link to="/patientinfo" class="text-decoration-none text-muted">Personal Information</router-link>
          </li>
        </ul>
      </nav>
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12 mt-3">
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Personal Information</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                  </div>
                </div>

                <div class="card-body">
                  <div class="form-group row">
                    <div class="box-header text-muted text-lg">
                      <i>Patient Info / ID:&nbsp;</i>
                      <input class="bg-secondary rounded-circle text-center" style="height: 30px; width: 35px;"
                        type="text" v-model="patientId" disabled value="Patient ID" />
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="row">
                      <div class="col-lg-4">
                        <!-- name and marital status and dob-->
                        <div class="form-group">
                          <label>Patient Name <span class="required-mark" style="color: red;">*</span></label>
                          <div class="input-group">
                            <input type="text" class="form-control" placeholder="Patient Name" v-model="patientName"
                              disabled />
                          </div>
                          <!-- /.input group -->
                        </div>
                        <!-- /.form group -->
                      </div>
                      <div class="col-lg-4">
                        <label>Date of Birth <span class="required-mark" style="color: red;">*</span></label>
                        <div class="input-group">
                          <input type="date" class="form-control" v-model="patientDOB" disabled />
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <label>Marital Status <span class="required-mark" style="color: red;">*</span></label>
                        <select class="form-control select2" style="width: 100%" v-model="patientMaritalStatus"
                          disabled>
                          <option selected disabled hidden>
                            Select Marital Status
                          </option>
                          <option>Single</option>
                          <option>Married</option>
                          <option>Seperated</option>
                          <option>Divorced</option>
                          <option>Widowed</option>
                        </select>
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-lg-4">
                        <label>Blood Group <span class="required-mark" style="color: red;">*</span></label>
                        <select class="form-control select2" style="width: 100%" v-model="patientBloodGroup" disabled>
                          <option selected disabled hidden>
                            Select Blood Group
                          </option>
                          <option>A+</option>
                          <option>A-</option>
                          <option>B+</option>
                          <option>B-</option>
                          <option>O+</option>
                          <option>O-</option>
                          <option>AB+</option>
                          <option>AB-</option>
                        </select>
                      </div>
                      <div class="col-lg-4">
                        <label>Occupation <span class="required-mark" style="color: red;">*</span></label>
                        <select class="form-control select2" style="width: 100%" v-model="patientOccupation" disabled>
                          <option selected disabled hidden>
                            Select Occupation
                          </option>
                          <option>Goverment Job</option>
                          <option>Private Job</option>
                          <option>Service</option>
                          <option>Business</option>
                          <option>Education</option>
                          <option>Agriculture</option>
                          <option>Housemaker</option>
                          <option>Other</option>
                        </select>
                      </div>
                      <div class="col-lg-4">
                        <label>Phone Number <span class="required-mark" style="color: red;">*</span></label>
                        <div class="input-group">
                          <input type="tel" v-model="patientPhoneNumber" class="form-control" disabled
                            placeholder="[0-9]{10}" maxlength="10" minlength="10" pattern="[0-9]{10}" />
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="form-group row">
                    <div class="col-lg-4">
                      <label>Gender <span class="required-mark" style="color: red;">*</span></label>
                      <select class="form-control select2" style="width: 100%" v-model="patientGender" disabled>
                        <option selected disabled hidden>Select Gender</option>
                        <option>Male</option>
                        <option>Female</option>
                        <option>Other</option>
                      </select>
                    </div>
                    <div class="col-lg-4">
                      <label>Email </label>
                      <div class="input-group">
                        <input type="email" v-model="patientEmail" class="form-control" placeholder="Email" disabled />
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <label>Create Password <span class="required-mark" style="color: red;">*</span></label>
                      <div class="input-group">
                        <input type="text" v-model="patientPassword" disabled class="form-control"
                          placeholder="Create Password" />
                      </div>
                    </div>
                  </div>

                  <div class="form-group row">
                    <div class="col-lg-4">
                      <label>Height <span class="required-mark" style="color: red;">*</span></label>
                      <input type="tel" v-model="patientHeight" disabled class="form-control"
                        placeholder="Height in Feet and Inches" maxlength="10" minlength="10" pattern="[0-9]{10}" />
                    </div>
                    <div class="col-lg-4">
                      <label>Weight <span class="required-mark" style="color: red;">*</span></label>
                      <input type="email" disabled v-model="patientWeight" class="form-control"
                        placeholder="Weight in Kilograms" />
                    </div>
                    <div class="col-lg-4">
                      <label>Address <span class="required-mark" style="color: red;">*</span></label>
                      <textarea class="form-control" rows="1" v-model="patientAddress" disabled placeholder="Address"
                        style="resize: none"></textarea>
                    </div>
                  </div>

                  <div class="form-group row">
                    <div class="text-muted text-lg">
                      <i>Emergency Details</i>
                    </div>
                  </div>

                  <div class="form-group row">
                    <div class="col-lg-4">
                      <label>Person Name <span class="required-mark" style="color: red;">*</span></label>
                      <div class="input-group">
                        <input type="text" v-model="guardianName" class="form-control" disabled
                          placeholder="Person Name" />
                      </div>
                    </div>

                    <div class="col-lg-4">
                      <label>Relation <span class="required-mark" style="color: red;">*</span></label>
                      <select class="form-control select2" style="width: 100%" v-model="guardianRelation" disabled>
                        <option selected disabled hidden>
                          Select Relation
                        </option>
                        <option>Grand Father</option>
                        <option>Grand Mother</option>
                        <option>Father</option>
                        <option>Mother</option>
                        <option>Brother</option>
                        <option>Sister</option>
                        <option>Other</option>
                      </select>
                    </div>

                    <div class="col-lg-4">
                      <label>Phone Number <span class="required-mark" style="color: red;">*</span></label>
                      <div class="input-group">
                        <input type="tel" v-model="guardianPhoneNumber" disabled class="form-control"
                          placeholder="[0-9]{10}" maxlength="10" minlength="10" pattern="[0-9]{10}" />
                      </div>
                    </div>
                  </div>
                </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary text-md" @click="editPatient">
                    Edit
                  </button>
                </div>
              </div>

              <!-- Edit Patient -->

              <div v-if="editPatientId == -1 ? 0 : 1" class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Edit Personal Information</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" @click="closeEditPatient">
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                </div>

                <div class="card-body">
                  <div class="form-group row">
                    <div class="box-header text-muted text-lg">
                      <i>Patient Info</i>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="row">
                      <div class="col-lg-4">
                        <!-- name and marital status and dob-->
                        <div class="form-group">
                          <label>Patient Name <span class="required-mark" style="color: red;">*</span></label>
                          <div class="input-group">
                            <input type="text" class="form-control" placeholder="Patient Name"
                              v-model="editPatientName" />
                          </div>
                          <!-- /.input group -->
                        </div>
                        <!-- /.form group -->
                      </div>
                      <div class="col-lg-4">
                        <label>Date of Birth <span class="required-mark" style="color: red;">*</span></label>
                        <div class="input-group">
                          <input type="date" class="form-control" v-model="editPatientDOB" required />
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <label>Marital Status <span class="required-mark" style="color: red;">*</span></label>
                        <select class="form-control select2" style="width: 100%" v-model="editPatientMaritalStatus">
                          <option selected disabled hidden>
                            Select Marital Status
                          </option>
                          <option>Single</option>
                          <option>Married</option>
                          <option>Seperated</option>
                          <option>Divorced</option>
                          <option>Widowed</option>
                        </select>
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-lg-4">
                        <label>Blood Group <span class="required-mark" style="color: red;">*</span></label>
                        <select class="form-control select2" style="width: 100%" v-model="editPatientBloodGroup">
                          <option selected disabled hidden>
                            Select Blood Group
                          </option>
                          <option>A+</option>
                          <option>A-</option>
                          <option>B+</option>
                          <option>B-</option>
                          <option>O+</option>
                          <option>O-</option>
                          <option>AB+</option>
                          <option>AB-</option>
                        </select>
                      </div>
                      <div class="col-lg-4">
                        <label>Occupation <span class="required-mark" style="color: red;">*</span></label>
                        <select class="form-control select2" style="width: 100%" v-model="editPatientOccupation">
                          <option selected disabled hidden>
                            Select Occupation
                          </option>
                          <option>Goverment Job</option>
                          <option>Private Job</option>
                          <option>Service</option>
                          <option>Business</option>
                          <option>Education</option>
                          <option>Agriculture</option>
                          <option>Housemaker</option>
                          <option>Other</option>
                        </select>
                      </div>
                      <div class="col-lg-4">
                        <label>Phone Number <span class="required-mark" style="color: red;">*</span></label>
                        <div class="input-group">
                          <input type="tel" v-model="editPatientPhoneNumber" class="form-control"
                            placeholder="[0-9]{10}" maxlength="10" minlength="10" pattern="[0-9]{10}" />
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="form-group row">
                    <div class="col-lg-4">
                      <label>Gender <span class="required-mark" style="color: red;">*</span></label>
                      <select class="form-control select2" style="width: 100%" placeholder="Select Gender"
                        v-model="editPatientGender">
                        <option selected disabled hidden>Select Gender</option>
                        <option>Male</option>
                        <option>Female</option>
                        <option>Other</option>
                      </select>
                    </div>
                    <div class="col-lg-4">
                      <label>Email </label>
                      <div class="input-group">
                        <input type="email" v-model="editPatientEmail" class="form-control" placeholder="Email" />
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <label>Create Password <span class="required-mark" style="color: red;">*</span></label>
                      <div class="input-group">
                        <input type="text" v-model="editPatientPassword" class="form-control"
                          placeholder="Create Password" />
                      </div>
                    </div>
                  </div>

                  <div class="form-group row">
                    <div class="col-lg-4">
                      <label>Height <span class="required-mark" style="color: red;">*</span></label>
                      <input type="tel" v-model="editPatientHeight" class="form-control"
                        placeholder="Height in Feet and Inches" maxlength="10" minlength="10" pattern="[0-9]{10}" />
                    </div>
                    <div class="col-lg-4">
                      <label>Weight <span class="required-mark" style="color: red;">*</span></label>
                      <input type="email" v-model="editPatientWeight" class="form-control"
                        placeholder="Weight in Kilograms" />
                    </div>
                    <div class="col-lg-4">
                      <label>Address <span class="required-mark" style="color: red;">*</span></label>
                      <textarea class="form-control" rows="1" v-model="editPatientAddress" placeholder="Address"
                        style="resize: none"></textarea>
                    </div>
                  </div>

                  <div class="form-group row">
                    <div class="text-muted text-lg">
                      <i>Emergency Details</i>
                    </div>
                  </div>

                  <div class="form-group row">
                    <div class="col-lg-4">
                      <label>Person Name <span class="required-mark" style="color: red;">*</span></label>
                      <div class="input-group">
                        <input type="text" v-model="editGuardianName" class="form-control" placeholder="Person Name" />
                      </div>
                    </div>

                    <div class="col-lg-4">
                      <label>Relation <span class="required-mark" style="color: red;">*</span></label>
                      <select class="form-control select2" style="width: 100%" v-model="editGuardianRelation">
                        <option selected disabled hidden>
                          Select Relation
                        </option>
                        <option>Grand Father</option>
                        <option>Grand Mother</option>
                        <option>Father</option>
                        <option>Mother</option>
                        <option>Brother</option>
                        <option>Sister</option>
                        <option>Other</option>
                      </select>
                    </div>

                    <div class="col-lg-4">
                      <label>Phone Number <span class="required-mark" style="color: red;">*</span></label>
                      <div class="input-group">
                        <input type="tel" v-model="editGuardianPhoneNumber" class="form-control" placeholder="[0-9]{10}"
                          maxlength="10" minlength="10" pattern="[0-9]{10}" />
                      </div>
                    </div>
                  </div>
                </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary text-md" @click="updatePatient">
                    Update
                  </button>
                  <button type="reset" class="btn btn-primary ml-3 text-md" @click="resetEditPatient">
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
    name: "PatientInfo",
    data() {
      return {
        patientId: "",
        patientName: "",
        patientDOB: "",
        patientMaritalStatus: "",
        patientBloodGroup: "",
        patientOccupation: "",
        patientPhoneNumber: "",
        patientEmail: "",
        patientGender: "",
        patientHeight: "",
        patientPassword: "",
        patientWeight: "",
        patientAddress: "",
        guardianName: "",
        guardianRelation: "",
        guardianPhoneNumber: "",
        editPatientId: -1,
        editPatientName: "",
        editPatientDOB: "",
        editPatientMaritalStatus: "",
        editPatientBloodGroup: "",
        editPatientOccupation: "",
        editPatientPhoneNumber: "",
        editPatientEmail: "",
        editPatientGender: "",
        editPatientHeight: "",
        editPatientWeight: "",
        editPatientAddress: "",
        editGuardianName: "",
        editGuardianRelation: "",
        editGuardianPhoneNumber: "",
        editPatientPassword: "",
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
            this.patientMaritalStatus = response.data.patient_marital_status;
            this.patientBloodGroup = response.data.patient_blood_group;
            this.patientOccupation = response.data.patient_occupation;
            this.patientPhoneNumber = response.data.patient_phone_number;
            this.patientEmail = response.data.patient_email;
            this.patientGender = response.data.patient_gender;
            this.patientHeight = response.data.patient_height;
            this.patientPassword = response.data.patient_password;
            this.patientWeight = response.data.patient_weight;
            this.patientAddress = response.data.patient_address;
            this.guardianName = response.data.guardian_name;
            this.guardianRelation = response.data.guardian_relation;
            this.guardianPhoneNumber = response.data.guardian_phone_number;
          })
          .catch((err) => {
            console.log(err);
            toastr["error"]("Something went Wrong.");
          });
      },

      editPatient: function (
        patient_id,
        patient_name,
        patient_dob,
        patient_marital_status,
        patient_blood_group,
        patient_occupation,
        patient_phone_number,
        patient_email,
        patient_gender,
        patient_height,
        patient_weight,
        patient_address,
        guardian_name,
        guardian_relation,
        guardian_phone_number,
        patient_password
      ) {
        this.editPatientId = patient_id;
        this.editPatientName = patient_name;
        this.editPatientDOB = patient_dob;
        this.editPatientMaritalStatus = patient_marital_status;
        this.editPatientBloodGroup = patient_blood_group;
        this.editPatientOccupation = patient_occupation;
        this.editPatientPhoneNumber = patient_phone_number;
        this.editPatientEmail = patient_email;
        this.editPatientGender = patient_gender;
        this.editPatientHeight = patient_height;
        this.editPatientWeight = patient_weight;
        this.editPatientAddress = patient_address;
        this.editGuardianName = guardian_name;
        this.editGuardianRelation = guardian_relation;
        this.editGuardianPhoneNumber = guardian_phone_number;
        this.editPatientPassword = patient_password;
        this.getEditPatient();
        toastr["info"]("Please Scroll Down...");
      },

      updatePatient: function () {
        axios
          .put("../api/editpatient/" + this.editPatientId, {
            editPatientId: this.editPatientId,
            editPatientName: this.editPatientName,
            editPatientDOB: this.editPatientDOB,
            editPatientMaritalStatus: this.editPatientMaritalStatus,
            editPatientBloodGroup: this.editPatientBloodGroup,
            editPatientOccupation: this.editPatientOccupation,
            editPatientPhoneNumber: this.editPatientPhoneNumber,
            editPatientEmail: this.editPatientEmail,
            editPatientGender: this.editPatientGender,
            editPatientHeight: this.editPatientHeight,
            editPatientWeight: this.editPatientWeight,
            editPatientAddress: this.editPatientAddress,
            editGuardianName: this.editGuardianName,
            editGuardianRelation: this.editGuardianRelation,
            editGuardianPhoneNumber: this.editGuardianPhoneNumber,
            editPatientPassword: this.editPatientPassword,
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
                  html: "<h5 style='color:#9C9794'>Patient Details Updated Successfully...</h5>",
                  icon: "success",
                })
                .then((result) => {
                  this.resetEditPatient();
                  this.editPatientId = -1;
                  location.reload();
                });
            }
          })
          .catch((err) => {
            console.log(err.res.data.message);
            toastr["error"]("Something went Wrong!");
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

      getEditPatient: function () {
        axios
          .get("../api/getpatient")
          .then((response) => {
            this.editPatientId = response.data.patient_id;
            this.editPatientName = response.data.patient_name;
            this.editPatientDOB = response.data.patient_dob;
            this.editPatientMaritalStatus = response.data.patient_marital_status;
            this.editPatientBloodGroup = response.data.patient_blood_group;
            this.editPatientOccupation = response.data.patient_occupation;
            this.editPatientPhoneNumber = response.data.patient_phone_number;
            this.editPatientEmail = response.data.patient_email;
            this.editPatientGender = response.data.patient_gender;
            this.editPatientHeight = response.data.patient_height;
            this.editPatientPassword = response.data.patient_password;
            this.editPatientWeight = response.data.patient_weight;
            this.editPatientAddress = response.data.patient_address;
            this.editGuardianName = response.data.guardian_name;
            this.editGuardianRelation = response.data.guardian_relation;
            this.editGuardianPhoneNumber = response.data.guardian_phone_number;

          })
          .catch((err) => {
            console.log(err);
            toastr["error"]("Something went Wrong.");
          });
      },

      resetEditPatient: function () {
        this.editPatientName = "";
        this.editPatientDOB = "";
        this.editPatientMaritalStatus = "";
        this.editPatientBloodGroup = "";
        this.editPatientOccupation = "";
        this.editPatientPhoneNumber = "";
        this.editPatientEmail = "";
        this.editPatientGender = "";
        this.editPatientHeight = "";
        this.editPatientWeight = "";
        this.editPatientAddress = "";
        this.editGuardianName = "";
        this.editGuardianRelation = "";
        this.editGuardianPhoneNumber = "";
        this.editPatientPassword = "";
      },

      closeEditPatient: function () {
        this.editPatientId = -1;
      },
    },
  };
</script>