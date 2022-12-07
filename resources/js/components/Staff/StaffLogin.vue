<template>
    <div>
        <aside></aside>
        <div class="content-wrapper">
            <section>
                <div class="container py-5">
                    <div class="row d-flex justify-content-center align-items-center h-100">
                        <div class="col col-xl-5">
                            <div class="card" style="border-radius: 1rem">
                                <div class="row g-0">
                                    <div class="col-md-12 col-lg-12 d-flex align-items-center">
                                        <div class="card-body">
                                            <form>
                                                <div class="d-flex align-items-center mb-2 pb-1">
                                                    <span class="h1 fw-bold mb-0"> Staff Login</span>
                                                </div>

                                                <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px">
                                                    Sign into your account
                                                </h5>

                                                <div class="form-outline mb-4">
                                                    <label class="form-label">Phone Number:</label>
                                                    <input type="tel" class="form-control"
                                                    maxlength="10" minlength="10" pattern="[0-9]{10}" v-model="staffPhone">
                                                </div>

                                                <div class="form-outline mb-4">
                                                    <label class="form-label">Password:</label>
                                                    <input type="password"
                                                        class="form-control form-control-lg" v-model="staffPass"/>
                                                </div>

                                                <div class="pt-1 mb-4">
                                                        <button class="btn btn-primary btn-lg btn-block" type="button" @click="staffLogin">Login
                                                        </button>
                                                </div>
                                            </form>
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
import toastr from "toastr";
import swal from "sweetalert2";
import axios from "axios";

toastr.options = {
    closeButton: true,
    closeDuration: 200,
    progressBar: true,
    newestOnTop: true,
    positionClass: "toast-top-center",
};

export default {
    name: "StaffLogin",
    data() {
        return {
            staffPhone : "",
            staffPass :  "",
            status: null,
            message: null,
            errors: null,
        }
    },
    methods : {
        staffLogin: function () {
            if (this.staffPhone == "" || this.staffPass == "") {
                toastr["error"]("All Fields are Required");
            }
            else {
                axios.get("api/stafflogin/" + this.staffPhone + "/" + this.staffPass).then((response) => {
                    if (response.data.status == 1) {
                        swal.fire({
                            title: "Success",
                            html: "<h5 style='color:#9C9794'>Logged in Successfully</h5>",
                            icon: "success",
                        }).then((result) => {
                            this.$router.push({ name: 'StaffDashboard'})
                        });
                    }
                    else if(response.data.status == -1){
                        toastr.info(response.data.message);
                    }
                    else {
                        toastr.error(response.error.message);
                    }
                })
                .catch((err) => {
                    toastr.error(response.error.message);
                    console.log(response.error.message);
                });
            }
        }
    },
};
</script>