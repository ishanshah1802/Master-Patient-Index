<template>
  <div>
    <aside></aside>
    <div class="content-wrapper">
      <nav class="navbar navbar-dark">
        <div></div>
        <ul class="breadcrumb navbar navbar-dark">
          <li class="breadcrumb-item">
            <router-link to="/dashboard" class="text-decoration-none"
              ><i class="fas fa-tachometer-alt mr-1"></i>Dashboard</router-link
            >
          </li>
          <li class="breadcrumb-item">
            <router-link
              to="/patientregister"
              class="text-decoration-none text-muted"
              >Patient Registration</router-link
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
                  <h3 class="card-title">Personal Information</h3>
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
                            <input
                              type="text"
                              class="form-control"
                              placeholder="Patient Name"
                              v-model="patientName"
                            />
                          </div>
                          <!-- /.input group -->
                        </div>
                        <!-- /.form group -->
                      </div>
                      <div class="col-lg-4">
                        <label>Date of Birth <span class="required-mark" style="color: red;">*</span></label>
                        <div class="input-group">
                          <input
                            type="date"
                            class="form-control"
                            v-model="patientDOB"
                            required
                          />
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <label>Marital Status <span class="required-mark" style="color: red;">*</span></label>
                        <select
                          class="form-control select2"
                          style="width: 100%"
                          v-model="patientMaritalStatus"
                        >
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
                        <select
                          class="form-control select2"
                          style="width: 100%"
                          v-model="patientBloodGroup"
                        >
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
                        <select
                          class="form-control select2"
                          style="width: 100%"
                          v-model="patientOccupation"
                        >
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
                          <input
                            type="tel"
                            v-model="patientPhoneNumber"
                            class="form-control"
                            placeholder="[0-9]{10}"
                            maxlength="10"
                            minlength="10"
                            pattern="[0-9]{10}"
                          />
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="form-group row">
                    <div class="col-lg-4">
                        <label>Gender <span class="required-mark" style="color: red;">*</span></label>
                        <select
                            class="form-control select2"
                            style="width: 100%" placeholder="Select Gender"
                            v-model="patientGender"
                            >
                            <option selected disabled hidden>
                                Select Gender
                            </option>
                            <option>Male</option>
                            <option>Female</option>
                            <option>Other</option>
                            </select>
                    </div>
                    <div class="col-lg-4">
                      <label>Email</label>
                      <div class="input-group">
                        <input
                          type="email"
                          v-model="patientEmail"
                          class="form-control"
                          placeholder="Email"
                        />
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <label>Create Password <span class="required-mark" style="color: red;">*</span></label>
                      <div class="input-group">
                        <input
                          type="text"
                          v-model="patientPassword"
                          class="form-control"
                          placeholder="Create Password"
                        />
                      </div>
                    </div>
                  </div>

                  <div class="form-group row">
                    <div class="col-lg-4">
                      <label>Height <span class="required-mark" style="color: red;">*</span></label>
                      <input
                        type="tel"
                        v-model="patientHeight"
                        class="form-control"
                        placeholder="Height in Feet and Inches"
                        maxlength="10"
                        minlength="10"
                        pattern="[0-9]{10}"
                      />
                    </div>
                    <div class="col-lg-4">
                      <label>Weight <span class="required-mark" style="color: red;">*</span></label>
                      <input
                        type="email"
                        v-model="patientWeight"
                        class="form-control"
                        placeholder="Weight in Kilograms"
                      />
                    </div>
                    <div class="col-lg-4">
                      <label>Address <span class="required-mark" style="color: red;">*</span></label>
                      <textarea
                        class="form-control"
                        rows="1"
                        v-model="patientAddress"
                        placeholder="Address"
                        style="resize: none"
                      ></textarea>
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
                        <input
                          type="text"
                          v-model="guardianName"
                          class="form-control"
                          placeholder="Person Name"
                        />
                      </div>
                    </div>

                    <div class="col-lg-4">
                      <label>Relation <span class="required-mark" style="color: red;">*</span></label>
                      <select
                        class="form-control select2"
                        style="width: 100%"
                        v-model="guardianRelation"
                      >
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
                        <input
                          type="tel"
                          v-model="guardianPhoneNumber"
                          class="form-control"
                          placeholder="[0-9]{10}"
                          maxlength="10"
                          minlength="10"
                          pattern="[0-9]{10}"
                        />
                      </div>
                    </div>
                  </div>
                </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary text-md" @click="addNewPatient">
                    Add
                  </button>
                  <button type="reset" class="btn btn-primary ml-3 text-md" @click="resetNewPatient">
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
    };
  },

  methods: {
    addNewPatient: function () {
      let payload = {
        patientName : this.patientName,
        patientDOB : this.patientDOB,
        patientMaritalStatus : this.patientMaritalStatus,
        patientBloodGroup : this.patientBloodGroup,
        patientOccupation : this.patientOccupation,
        patientPhoneNumber : this.patientPhoneNumber,
        patientEmail : this.patientEmail,
        patientGender : this.patientGender,
        patientHeight : this.patientHeight,
        patientWeight : this.patientWeight,
        patientAddress : this.patientAddress,
        patientPassword : this.patientPassword,
        guardianName : this.guardianName,
        guardianRelation : this.guardianRelation,
        guardianPhoneNumber : this.guardianPhoneNumber,
      };
      axios
        .post("/api/addpatient", payload)
        .then((res) => {
          if (res.data.status == 1) {
            swal
              .fire({
                title: "Success",
                html: "<h5 style='color:#9C9794'>Patient Added Successfully</h5>",
                icon: "success",
              })
              .then(() => {
                this.resetNewPatient();
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

    resetNewPatient: function () {
      this.patientName = "";
      this.patientDOB = "";
      this.patientMaritalStatus = "";
      this.patientBloodGroup = "";
      this.patientOccupation = "";
      this.patientPhoneNumber = "";
      this.patientEmail = "";
      this.patientGender = "";
      this.patientHeight = "";
      this.patientWeight = "";
      this.patientAddress = "";
      this.guardianName = "";
      this.guardianRelation = "";
      this.guardianPhoneNumber = "";
      this.patientPassword = "";
    },
  },
};
</script>