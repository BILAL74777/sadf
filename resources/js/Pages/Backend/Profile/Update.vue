<template>
  <main id="main" class="main">
    <div class="pagetitle d-flex justify-content-between">
      <div>
        <h1>{{ translate("Update Profile") }}</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <Link :href="route('dashboard')">{{
                $page.props.website_name
              }}</Link>
            </li>
            <li class="breadcrumb-item">
              {{ translate("Profile") }}
            </li>
            <li class="breadcrumb-item active">
              {{ translate("Update Profile") }}
            </li>
          </ol>
        </nav>
      </div>
      
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
                <label for="current_password">{{ translate("Old Password") }}</label>
                <input
                  type="password"
                  class="form-control"
                  id="current_password"
                  :class="{ 'invalid-bg': formErrors.current_password }"
                  v-model="form.current_password"
                />

                <div
                  class="invalid-feedback animated fadeIn"
                  v-if="formErrors.current_password"
                >
                  {{ formErrors.current_password[0] }}
                </div>
              </div>
              
              <div class="col-12 col-md-6">
                <label for="new_password">{{ translate("New Password") }}</label>
                <input
                  type="password"
                  class="form-control"
                  id="new_password"
                  :class="{ 'invalid-bg': formErrors.new_password }"
                  v-model="form.new_password"
                />

                <div
                  class="invalid-feedback animated fadeIn"
                  v-if="formErrors.new_password"
                >
                  {{ formErrors.new_password[0] }}
                </div>
              </div>

              <div class="col-12 col-md-6">
                <label for="confirm_password">{{ translate("Confirm Password") }}</label>
                <input
                  type="password"
                  class="form-control"
                  id="confirm_password"
                  :class="{ 'invalid-bg': formErrors.confirm_password }"
                  v-model="form.confirm_password"
                />

                <div
                  class="invalid-feedback animated fadeIn"
                  v-if="formErrors.confirm_password"
                >
                  {{ formErrors.confirm_password[0] }}
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
       
      form: {
        name: "", 
        email: "",
        current_password: "",
        new_password: "",
        confirm_password: "",
        
      },
      formErrors: [],
      formStatus: "Yes", 
       
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
        .get(route("api.profile.show", this.userId), {
          headers: { Authorization: "Bearer " + this.$page.props.auth_token },
        })
        .then((response) => {

          this.form.name = response.data.name;
          this.form.email = response.data.email; 
           
 
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
      formData.append("new_password", this.form.new_password); 
      formData.append("current_password", this.form.current_password); 
      formData.append("confirm_password", this.form.confirm_password); 
       
       
      axios
        .post(route("api.profile.update"), formData, {
          headers: {
            Authorization: "Bearer " + this.$page.props.auth_token,
          },
        })
        .then((data) => {
          toastr.success("Profile added successfully.");
          this.$inertia.get(route("profile"));
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