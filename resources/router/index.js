import Router from "vue-router";
import Vue from "vue";

const Container = () => import('../js/components/containers/Container');
const Dashboard = () => import('../js/components/Dashboard');
const PatientInfo = () => import('../js/components/Patient/PatientInfo');
const StaffInfo = () => import('../js/components/Staff/StaffInfo');
const PatientRegister = () => import('../js/components/Patient/PatientRegister');
const PatientLogin = () => import('../js/components/Patient/PatientLogin');
const StaffLogin = () => import('../js/components/Staff/StaffLogin');
const PatientDashboard = () => import('../js/components/Patient/PatientDashboard');
const PatientAppointment = () => import('../js/components/Patient/PatientAppointment');
const StaffDashboard = () => import('../js/components/Staff/StaffDashboard');
const StaffAppointment = () => import('../js/components/Staff/StaffAppointment');
const PatientManageAppointment = () => import('../js/components/Patient/PatientManageAppointment');
const StaffManageAppointment = () => import('../js/components/Staff/StaffManageAppointment');
const GenerateBill = () => import('../js/components/Staff/GenerateBill');
const PatientPastBills = () => import('../js/components/Patient/PatientPastBills')
const PastBills = () => import('../js/components/Staff/PastBills');

Vue.use(Router);

export default new Router({
    mode: 'hash',
    linkActiveClass: 'active',
    scrollBehavior: () => ({ y: 0 }),
    routes: configRoutes()
})

function configRoutes() {
    return [
        {
            path: '/',
            redirect: "/dashboard",
            name: 'Home',
            component: Container,
            children: [
                {
                    path: "dashboard",
                    name: "Dashboard",
                    component: Dashboard
                },
                {
                    path: "patientregister",
                    name: "PatientRegister",
                    component: PatientRegister
                },
                {
                    path: "patientinfo",
                    name: "PatientInfo",
                    component: PatientInfo
                },
                {
                    path: "patientlogin",
                    name: "PatientLogin",
                    component: PatientLogin
                },
                {
                    path: "stafflogin",
                    name: "StaffLogin",
                    component: StaffLogin
                },
                {
                    path: "staffinfo",
                    name: "StaffInfo",
                    component: StaffInfo
                },
                {
                    path: "patientdashboard",
                    name: "PatientDashboard",
                    component: PatientDashboard
                },
                {
                    path: "patientappointment",
                    name: "PatientAppointment",
                    component: PatientAppointment
                },
                {
                    path: "staffdashboard",
                    name: "StaffDashboard",
                    component: StaffDashboard
                },
                {
                    path: "staffappointment",
                    name: "StaffAppointment",
                    component: StaffAppointment
                },
                {
                    path: "staffmanageappointment",
                    name: "StaffManageAppointment",
                    component: StaffManageAppointment
                },
                {
                    path: "patientmanageappointment",
                    name: "PatientManageAppointment",
                    component: PatientManageAppointment
                },
                {
                    path: "generatebill",
                    name: "GenerateBill",
                    component: GenerateBill
                },
                {
                    path: "patientpastbills",
                    name: "PatientPastBills",
                    component: PatientPastBills
                },
                {
                    path: "pastbills",
                    name: "PastBills",
                    component: PastBills
                }
            ]
        }
    ]
}