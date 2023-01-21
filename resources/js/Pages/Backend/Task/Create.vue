<template>
  <main id="main" class="main">
    <div class="pagetitle d-flex justify-content-between">
      <div>
        <h1>{{ translate("Add New Task") }}</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <Link :href="route('dashboard')">{{
                $page.props.website_name
              }}</Link>
            </li>
            <li class="breadcrumb-item">
              {{ translate("Task") }}
            </li>
            <li class="breadcrumb-item active">
              {{ translate("Add New Task") }}
            </li>
          </ol>
        </nav>
      </div>
      <Link class="btn btn-success" :href="route('task')">{{
        translate("Go To Tasks")
      }}</Link>
    </div>

    <!-- End Page Title -->
    <section class="section">
      <div class="card">
        <div class="card-body pt-4">
          <!-- <h5 class="card-title">Add New Task</h5> -->

          <!-- Floating Labels Form -->
          <form @submit.prevent="submit">
            <div class="row g-3">
              <div class="col-12 col-md-12">
                <label for="type">{{ translate("Name") }}</label>
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
                <label for="description">{{ translate("Due") }}</label>
                 <input
                    type="text"
                    class="form-control"
                    id="due"
                    :class="{ 'invalid-bg': formErrors.due }"
                    v-model="form.due"
                />
                <div
                  class="invalid-feedback animated fadeIn"
                  v-if="formErrors.due"
                >
                  {{ formErrors.due[0] }}
                </div>
              </div>

              <div class="col-12 col-md-6">
                <label for="assign_by">{{ translate("Assign To") }}</label>
                 <input
                    type="text"
                    class="form-control"
                    id="assign_to"
                    :class="{ 'invalid-bg': formErrors.assign_to }"
                    v-model="form.assign_to"
                />
                <div
                  class="invalid-feedback animated fadeIn"
                  v-if="formErrors.assign_to"
                >
                  {{ formErrors.assign_to[0] }}
                </div>
              </div>
              <div class="col-12 col-md-6">
                <label for="assign_by">{{ translate("Assigned By") }}</label>
                 <input
                    type="text"
                    class="form-control"
                    id="assign_by"
                    :class="{ 'invalid-bg': formErrors.assign_by }"
                    v-model="form.assign_by"
                />
                <div
                  class="invalid-feedback animated fadeIn"
                  v-if="formErrors.assign_by"
                >
                  {{ formErrors.assign_by[0] }}
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
import { maska } from "maska";
import "vue-tel-input/dist/vue-tel-input.css"; 
import Datepicker from "vue3-date-time-picker";
import "vue3-date-time-picker/dist/main.css";
import Multiselect from "@vueform/multiselect";

export default {
  layout: Master,
  created() {
 
  },
  directives: { maska },
  components: {
    Multiselect,
    Datepicker,
  },
  data() {
    return {
      form: {
        name: "",
        due: "",
        assign_to: "",
        assign_by: "",
        
      },
      formErrors: [],
      formStatus: "Yes",
 
    };
  },
  methods: {
    submit() {
      this.formStatus = "No";
      let formData = new FormData();
      formData.append("name", this.form.name);
      formData.append("due", this.form.due);
      formData.append("assign_to", this.form.assign_to);
      formData.append("assign_by", this.form.assign_by);
        
      axios
        .post(route("api.task.store"), formData, {
          headers: {
            Authorization: "Bearer " + this.$page.props.auth_token,
          },
        })
        .then((data) => {
          toastr.success("Task added successfully.");
          this.$inertia.get(route("task"));
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

#CodeSelect {
  min-height: 58px;
}
.card {
  overflow: visible;
}
</style>