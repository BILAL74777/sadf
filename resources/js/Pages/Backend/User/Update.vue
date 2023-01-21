<template>
  <main id="main" class="main">
    <div class="pagetitle d-flex justify-content-between">
      <div>
        <h1>{{ translate("Update User") }}</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <Link :href="route('dashboard')">{{
                $page.props.website_name
              }}</Link>
            </li>
            <li class="breadcrumb-item">
              {{ translate("User") }}
            </li>
            <li class="breadcrumb-item active">
              {{ translate("Update User") }}
            </li>
          </ol>
        </nav>
      </div>
      <Link class="btn btn-success" :href="route('user')">{{
        translate("Go to Users")
      }}</Link>
    </div>

    <!-- End Page Title -->
    <section class="section">
      <div class="card">
        <div class="card-body pt-4">
          <!-- <h5 class="card-title">Add New Client</h5> -->

          <!-- Floating Labels Form -->
          <form @submit.prevent="submit">
            <div class="row g-3">
              <div class="col-12 col-md-6">
                <label for="name">{{ translate("Name") }}</label>
                <input
                  type="text"
                  class="form-control"
                  id="name"
                  :class="{ 'invalid-bg': formErrors.name }"
                  v-model="form.name"
                />

                <div
                  class="invalid-feedback animated fadeIn"
                  v-if="formErrors.name"
                >
                  {{ formErrors.name[0] }}
                </div>
              </div>

               



              <div class="col-12 col-md-6">
                <label for="email">{{ translate("Email") }}</label>
                <input
                  type="email"
                  class="form-control"
                  id="email"
                  :class="{ 'invalid-bg': formErrors.email }"
                  v-model="form.email"
                />

                <div
                  class="invalid-feedback animated fadeIn"
                  v-if="formErrors.email"
                >
                  {{ formErrors.email[0] }}
                </div>
              </div>

              
              <div class="col-12 col-md-6">
                <label for="role">{{
                  translate("Role")
                }}</label>
                <Multiselect
                  class="form-select"
                  v-model="form.role"
                  :options="role_options" 
                  :searchable="true"
                  :class="{
                    'invalid-bg': formErrors.role,
                  }"
                />

                <div
                  class="invalid-feedback animated fadeIn"
                  v-if="formErrors.role"
                >
                  {{ formErrors.role[0] }}
                </div>
              </div>


               

              
              
            </div>
            <div class="mt-5">
              <button
                type="submit"
                class="btn btn-success"
                v-if="formStatus == 'Yes'"
              >
                {{ translate("Save") }}
              </button>
              <button class="btn btn-success" type="button" disabled v-else>
                {{ translate("Save") }}
                <span
                  class="spinner-border spinner-border-sm"
                  role="status"
                  aria-hidden="true"
                ></span>
              </button>
            </div>
          </form>
          <!-- End floating Labels Form -->
        </div>
      </div>
    </section>
  </main>
  <!-- End #main -->
</template>

<script>
import Master from "@/Pages/Backend/Layouts/Master";
import "vue-tel-input/dist/vue-tel-input.css";
import Datepicker from "vue3-date-time-picker";
import "vue3-date-time-picker/dist/main.css";
import Multiselect from "@vueform/multiselect";
import { VueTelInput } from "vue-tel-input";
export default {
  layout: Master,
  props: ["userId"],
  created() {
    this.fetchCopanies();
    this.fetchCustomerRecord();
  },
  
  components: {
    Datepicker,
    Multiselect,
    VueTelInput,
  },
  data() {
    return { 
      phone_error: "",
      phone_object: null,
      phone2_error: "",
      phone2_object: null,

      form: {
        name: "", 
        email: "",
        role: "",
        
      },
      formErrors: [],
      formStatus: "Yes", 
      role_options: ['Salesman','Manager','Admin'], 
    };
  },
  methods: {
    fetchCopanies() {
      axios
        .get(route("api.companies.pluck"), {
          headers: {
            Authorization: "Bearer " + this.$page.props.auth_token,
          },
        })
        .then((response) => {
          this.company_options = response.data;
        })
        .catch((error) => {
          toastr.error(error.response.data.message);
        });
    },
    fetchCustomerRecord() {
      axios
        .get(route("api.user.show", this.userId), {
          headers: { Authorization: "Bearer " + this.$page.props.auth_token },
        })
        .then((response) => {

          this.form.name = response.data.name;
          this.form.email = response.data.email;
          this.form.role = response.data.role;
           
 
        })
        .catch((error) => {
          toastr.error(error.response.data.message);
        });
    },
    
    submit() {
      this.formStatus = "No";
      let formData = new FormData();
      formData.append("id", this.userId);
      formData.append("name", this.form.name);
      formData.append("email", this.form.email);
      formData.append("role", this.form.role); 
       
       
      axios
        .post(route("api.user.update"), formData, {
          headers: {
            Authorization: "Bearer " + this.$page.props.auth_token,
          },
        })
        .then((data) => {
          toastr.success("User added successfully.");
          this.$inertia.get(route("user"));
        })
        .catch((error) => {
          toastr.error(error.response.data.message);

          if (error.response.data.errors) {
            this.formStatus = "Yes";
            this.formErrors = error.response.data.errors;
          }
        });
    },

    
     
  },
};
</script>


<style>
@import "@vueform/multiselect/themes/default.css";
.c-file-padding {
  padding: 1rem 0.75rem !important;
}
.invalid-feedback {
  display: block !important;
}
.invalid-bg {
  border-color: #f8d4d4 !important;
  background-color: #f8d4d4 !important;
}
</style>