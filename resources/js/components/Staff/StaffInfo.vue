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
            <router-link to="/dashboard" class="text-decoration-none"><i
                class="fas fa-tachometer-alt mr-1"></i>Dashboard</router-link>
          </li>
          <li class="breadcrumb-item">
            <router-link to="/staffdashboard" class="text-decoration-none">Staff Dashboard</router-link>
          </li>
          <li class="breadcrumb-item active">
            <router-link to="/staffinfo" class="text-decoration-none text-muted">Personal Information</router-link>
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
                      <i>Staff Info / ID:&nbsp;</i>
                      <input class="bg-secondary rounded-circle text-center" style="height: 30px; width: 35px;"
                        type="text" v-model="staffId" disabled value="Staff ID" />
                    </div>
                  </div>

                  <div class="box-body">
                    <div class="row">
                      <div class="col-lg-4">
                        <div class="form-group">
                          <label>Employee Name <span class="required-mark" style="color: red;">*</span></label>
                          <div class="input-group">
                            <input type="text" class="form-control" placeholder="Employee Name" v-model="staffName"
                              disabled />
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <label>Date of Birth <span class="required-mark" style="color: red;">*</span></label>
                        <div class="input-group">
                          <div class="input-group-addon">
                            <!-- <i class="fa fa-calendar"></i> -->
                          </div>
                          <input type="date" class="form-control" placeholder="dd/mm/yyyy" v-model="staffDOB"
                            disabled />
                        </div>
                      </div>

                      <div class="col-lg-4">
                        <label>Marital Status <span class="required-mark" style="color: red;">*</span></label>
                        <div class="input-group">
                          <input type="text" class="form-control" placeholder="Marital Status"
                            v-model="staffMaritalStatus" disabled />
                        </div>
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="row">
                        <div class="col-lg-4">
                          <label>Designation <span class="required-mark" style="color: red;">*</span></label>
                          <div class="input-group">
                            <input type="tel" class="form-control" placeholder="Designation" v-model="staffDesignation"
                              disabled />
                          </div>
                        </div>
                        <div class="col-lg-4">
                          <label>Department <span class="required-mark" style="color: red;">*</span></label>
                          <div class="input-group">
                            <input type="text" class="form-control" placeholder="Department" v-model="staffDept"
                              disabled />
                          </div>
                        </div>
                        <div class="col-lg-4">
                          <label>Blood Group <span class="required-mark" style="color: red;">*</span></label>
                          <div class="input-group">
                            <input type="text" class="form-control" placeholder="Blood Group" v-model="staffBloodGroup"
                              disabled />
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-lg-4">
                        <label>Gender <span class="required-mark" style="color: red;">*</span></label>
                        <div class="input-group">
                          <input type="text" class="form-control" placeholder="Gender" v-model="staffGender" disabled />
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <label>Phone Number <span class="required-mark" style="color: red;">*</span></label>
                        <div class="input-group">
                          <div class="input-group-addon">
                            <!-- <i class="fa fa-phone"></i> -->
                          </div>
                          <input type="tel" class="form-control" placeholder="[0-9]{10}" maxlength="10" minlength="10"
                            pattern="[0-9]{10}" disabled v-model="staffPhoneNumber" />
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <label>Email </label>
                        <div class="input-group">
                          <span class="input-group-addon">
                            <!-- <i class="fa fa-envelope"></i -->
                          </span>
                          <input type="email" class="form-control" placeholder="Email" v-model="staffEmail" disabled />
                        </div>
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="row">
                        <div class="col-lg-4">
                          <label>Address <span class="required-mark" style="color: red;">*</span></label>
                          <div class="input-group">
                            <input type="text" class="form-control" placeholder="Address" v-model="staffAddress"
                              disabled />
                          </div>
                        </div>

                        <div class="col-lg-4">
                          <label>Password <span class="required-mark" style="color: red;">*</span></label>
                          <div class="input-group">
                            <input type="text" class="form-control" placeholder="Password" v-model="staffPassword"
                              disabled>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary text-md" @click="editStaff">
                    Edit
                  </button>
                </div>
              </div>

              <div v-if="editStaffId == -1 ? 0 : 1" class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Edit Personal Information</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" @click="closeEditStaff">
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                </div>

                <div class="card-body">
                  <div class="form-group row">
                    <div class="box-header text-muted text-lg">
                      <i>Staff Info</i>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label>Employee Name <span class="required-mark" style="color: red;">*</span></label>
                        <div class="input-group">
                          <input type="text" class="form-control" placeholder="Employee Name" v-model="editStaffName" />
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <label>Date of Birth <span class="required-mark" style="color: red;">*</span></label>
                      <div class="input-group">
                        <div class="input-group-addon">
                          <!-- <i class="fa fa-calendar"></i> -->
                        </div>
                        <input type="date" class="form-control" placeholder="dd/mm/yyyy" v-model="editStaffDOB" />
                      </div>
                    </div>

                    <div class="col-lg-4">
                      <label>Marital Status <span class="required-mark" style="color: red;">*</span></label>
                      <select class="form-control select2" style="width: 100%" v-model="editStaffMaritalStatus">
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

                  <div class="form-group">
                    <div class="row">
                      <div class="col-lg-4">
                        <label>Designation <span class="required-mark" style="color: red;">*</span></label>
                        <div class="input-group">
                          <input type="tel" class="form-control" placeholder="Designation"
                            v-model="editStaffDesignation" />
                        </div>
                      </div>

                      <div class="col-lg-4">
                        <label>Medical Department <span class="required-mark" style="color: red;">*</span></label>
                        <div class="input-group">
                          <select class="form-control select2" style="width: 100%" v-model="editStaffDept">
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
                        <label>Blood Group <span class="required-mark" style="color: red;">*</span></label>
                        <select class="form-control select2" style="width: 100%" v-model="editStaffBloodGroup">
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
                    </div>
                  </div>

                      <div class="form-group row">
                        <div class="col-lg-4">
                          <label>Gender <span class="required-mark" style="color: red;">*</span></label>
                          <select class="form-control select2" style="width: 100%" v-model="editStaffGender">
                            <option selected disabled hidden>Select Gender</option>
                            <option>Male</option>
                            <option>Female</option>
                            <option>Other</option>
                          </select>
                        </div>
                        <div class="col-lg-4">
                          <label>Phone Number <span class="required-mark" style="color: red;">*</span></label>
                          <div class="input-group">
                            <div class="input-group-addon">
                              <!-- <i class="fa fa-phone"></i> -->
                            </div>
                            <input type="tel" class="form-control" placeholder="[0-9]{10}" maxlength="10" minlength="10"
                              pattern="[0-9]{10}" v-model="editStaffPhoneNumber" />
                          </div>
                        </div>
                        <div class="col-lg-4">
                          <label>Email </label>
                          <div class="input-group">
                            <span class="input-group-addon">
                              <!-- <i class="fa fa-envelope"></i -->
                            </span>
                            <input type="email" class="form-control" placeholder="Email" v-model="editStaffEmail" />
                          </div>
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="row">
                          <div class="col-lg-4">
                            <label>Address <span class="required-mark" style="color: red;">*</span></label>
                            <div class="input-group">
                              <input type="text" class="form-control" placeholder="Address"
                                v-model="editStaffAddress" />
                            </div>
                          </div>

                          <div class="col-lg-4">
                            <label>Password:</label>
                            <div class="input-group">
                              <input type="text" class="form-control" placeholder="Password"
                                v-model="editStaffPassword">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary text-md" @click="updateStaff">
                        Update
                      </button>
                      <button type="reset" class="btn btn-primary ml-3 text-md" @click="resetEditStaff">
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
  import axios from "axios";

  toastr.options = {
    closeButton: true,
    closeDuration: 200,
    progressBar: true,
    newsOnTop: true,
    positionClass: "toast-top-center",
  };

  export default {
    name: "StaffInfo",
    data() {
      return {
        staffId: "",
        staffName: "",
        staffDOB: "",
        staffMaritalStatus: "",
        staffBloodGroup: "",
        staffDesignation: "",
        staffDept: "",
        staffPhoneNumber: "",
        staffEmail: "",
        staffGender: "",
        staffPassword: "",
        staffAddress: "",
        editStaffId: -1,
        editStaffName: "",
        editStaffDOB: "",
        editStaffMaritalStatus: "",
        editStaffBloodGroup: "",
        editStaffDesignation: "",
        editStaffDept: "",
        editStaffPhoneNumber: "",
        editStaffEmail: "",
        editStaffGender: "",
        editStaffPassword: "",
        editStaffAddress: "",
      };
    },
    created() {
      this.getStaff();
    },
    methods: {
      getStaff: function () {
        axios
          .get("../api/getstaff")
          .then((response) => {
            this.staffId = response.data.staff_id;
            this.staffName = response.data.staff_name;
            this.staffDOB = response.data.staff_dob;
            this.staffMaritalStatus = response.data.staff_marital_status;
            this.staffBloodGroup = response.data.staff_blood_group;
            this.staffDept = response.data.staff_department;
            this.staffDesignation = response.data.staff_designation;
            this.staffPhoneNumber = response.data.staff_phone_number;
            this.staffEmail = response.data.staff_email;
            this.staffGender = response.data.staff_gender;
            this.staffPassword = response.data.staff_password;
            this.staffAddress = response.data.staff_address;
          })
          .catch((err) => {
            console.log(err);
            toastr["error"]("Something went Wrong.");
          });
      },

      editStaff: function (
        staff_id,
        staff_name,
        staff_dob,
        staff_marital_status,
        staff_blood_group,
        staff_designation,
        staff_department,
        staff_phone_number,
        staff_email,
        staff_gender,
        staff_address,
        staff_password
      ) {
        this.editStaffId = staff_id;
        this.editStaffName = staff_name;
        this.editStaffDOB = staff_dob;
        this.editStaffMaritalStatus = staff_marital_status;
        this.editStaffBloodGroup = staff_blood_group;
        this.editStaffDesignation = staff_designation;
        this.editStaffDept = staff_department;
        this.editStaffPhoneNumber = staff_phone_number;
        this.editStaffEmail = staff_email;
        this.editStaffGender = staff_gender;
        this.editStaffAddress = staff_address;
        this.editStaffPassword = staff_password;
        this.getEditStaff();
        toastr["info"]("Please Scroll Down...");
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

      updateStaff: function () {
        axios
          .put("../api/editstaff/" + this.editStaffId, {
            editStaffId: this.editStaffId,
            editStaffName: this.editStaffName,
            editStaffDOB: this.editStaffDOB,
            editStaffMaritalStatus: this.editStaffMaritalStatus,
            editStaffBloodGroup: this.editStaffBloodGroup,
            editStaffDesignation: this.editStaffDesignation,
            editStaffDept: this.editStaffDept,
            editStaffPhoneNumber: this.editStaffPhoneNumber,
            editStaffEmail: this.editStaffEmail,
            editStaffGender: this.editStaffGender,
            editStaffAddress: this.editStaffAddress,
            editStaffPassword: this.editStaffPassword,
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
                  html: "<h5 style='color:#9C9794'>Staff Details Updated Successfully...</h5>",
                  icon: "success",
                })
                .then((result) => {
                  this.resetEditStaff();
                  this.editStaffId = -1;
                  location.reload();
                });
            }
          })
          .catch((err) => {
            console.log(err.res.data.message);
            toastr["error"]("Something went Wrong!");
          });
      },

      getEditStaff: function () {
        axios
          .get("../api/getstaff")
          .then((response) => {
            this.editStaffId = response.data.staff_id;
            this.editStaffName = response.data.staff_name;
            this.editStaffDOB = response.data.staff_dob;
            this.editStaffMaritalStatus = response.data.staff_marital_status;
            this.editStaffBloodGroup = response.data.staff_blood_group;
            this.editStaffDesignation = response.data.staff_designation;
            this.editStaffDept = response.data.staff_department;
            this.editStaffPhoneNumber = response.data.staff_phone_number;
            this.editStaffEmail = response.data.staff_email;
            this.editStaffGender = response.data.staff_gender;
            this.editStaffPassword = response.data.staff_password;
            this.editStaffAddress = response.data.staff_address;
          })
          .catch((err) => {
            console.log(err);
            toastr["error"]("Something went Wrong.");
          });
      },

      resetEditStaff: function () {
        this.editStaffName = "";
        this.editStaffDOB = "";
        this.editStaffMaritalStatus = "";
        this.editStaffBloodGroup = "";
        this.editStaffDesignation = "";
        this.editStaffDept = "";
        this.editStaffPhoneNumber = "";
        this.editStaffEmail = "";
        this.editStaffGender = "";
        this.editStaffAddress = "";
        this.editStaffPassword = "";
      },

      closeEditStaff: function () {
        this.editStaffId = -1;
      },
    },
  };
</script>