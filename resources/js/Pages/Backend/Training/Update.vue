<template>
  <main id="main" class="main">
    <div class="pagetitle d-flex justify-content-between">
      <div>
        <h1>{{ translate("Update Training") }}</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <Link :href="route('dashboard')">{{
                $page.props.website_name
              }}</Link>
            </li>
            <li class="breadcrumb-item">
              {{ translate("Training") }}
            </li>
            <li class="breadcrumb-item active">
              {{ translate("Update Training") }}
            </li>
          </ol>
        </nav>
      </div>
      <Link class="btn btn-success" :href="route('training')">{{
        translate("Go to Trainings")
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
              <div class="col-12 col-md-12">
                <label for="name">{{ translate("Company") }}</label>
                <input
                  type="text"
                  class="form-control"
                  id="company"
                  :class="{ 'invalid-bg': formErrors.company }"
                  v-model="form.company"
                />

                <div
                  class="invalid-feedback animated fadeIn"
                  v-if="formErrors.company"
                >
                  {{ formErrors.company[0] }}
                </div>
              </div>

              <div class="col-12 col-md-6">
                <label for="amount">{{ translate("Date") }}</label>
                <input
                  type="date"
                  class="form-control"
                  id="date"
                  :class="{ 'invalid-bg': formErrors.date }"
                  v-model="form.date"
                />

                <div
                  class="invalid-feedback animated fadeIn"
                  v-if="formErrors.date"
                >
                  {{ formErrors.date[0] }}
                </div>
              </div>

              <div class="col-12 col-md-6">
                <label for="city">{{ translate("City") }}</label>
                <input
                  type="city"
                  class="form-control"
                  id="city"
                  :class="{ 'invalid-bg': formErrors.city }"
                  v-model="form.city"
                />

                <div
                  class="invalid-feedback animated fadeIn"
                  v-if="formErrors.city"
                >
                  {{ formErrors.city[0] }}
                </div>
              </div>

              <div class="col-12 col-md-6">
                <label for="country">{{ translate("Country") }}</label>
                <input
                  type="country"
                  class="form-control"
                  id="country"
                  :class="{ 'invalid-bg': formErrors.country }"
                  v-model="form.country"
                />

                <div
                  class="invalid-feedback animated fadeIn"
                  v-if="formErrors.country"
                >
                  {{ formErrors.country[0] }}
                </div>
              </div>

              <div class="col-12 col-md-6">
                <label for="assigned_trainer">{{
                  translate("Assigne Trainer")
                }}</label>
                <input
                  type="assigned_trainer"
                  class="form-control"
                  id="assigned_trainer"
                  :class="{ 'invalid-bg': formErrors.assigned_trainer }"
                  v-model="form.assigned_trainer"
                />

                <div
                  class="invalid-feedback animated fadeIn"
                  v-if="formErrors.assigned_trainer"
                >
                  {{ formErrors.assigned_trainer[0] }}
                </div>
              </div>

              <div class="col-12 col-md-6">
                <label for="certificate">{{ translate("Certificate") }}</label>
                <input
                  type="certificate"
                  class="form-control"
                  id="certificate"
                  :class="{ 'invalid-bg': formErrors.certificate }"
                  v-model="form.certificate"
                />

                <div
                  class="invalid-feedback animated fadeIn"
                  v-if="formErrors.certificate"
                >
                  {{ formErrors.certificate[0] }}
                </div>
              </div>

              <div class="col-12 col-md-6">
                <label for="status">{{ translate("Status") }}</label>
                <Multiselect
                  class="form-control"
                  v-model="form.status"
                  :options="Status_option"
                  :searchable="true"
                  :class="{ 'invalid-bg': formErrors.status }"
                />
                <div
                  class="invalid-feedback animated fadeIn"
                  v-if="formErrors.status"
                >
                  {{ formErrors.status[0] }}
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
import Multiselect from "@vueform/multiselect";
export default {
  layout: Master,
  props: ["trainingId"],

  components: {Multiselect},
  created() {
    this.fetchTrainigRecord();
  },

  data() {
    return {
      form: {
        company: "",
        date: "",
        city: "",
        country: "",
        assigned_trainer: "",
        certificate: "",
      },
      Status_option: ["Yes", "No"],
      formErrors: [],
      formStatus: "Yes",
    };
  },
  methods: {
    fetchTrainigRecord() {
      axios
        .get(route("api.training.show", this.trainingId), {
          headers: { Authorization: "Bearer " + this.$page.props.auth_token },
        })
        .then((response) => {
          this.form.company = response.data.company;
          this.form.date = response.data.date;
          this.form.city = response.data.city;
          this.form.country = response.data.country;
          this.form.assigned_trainer = response.data.assigned_trainer;
          this.form.certificate = response.data.certificates;
          this.form.status = response.data.status;
        })
        .catch((error) => {
          toastr.error(error.response.data.message);
        });
    },
    submit() {
      this.formStatus = "No";
      let formData = new FormData();
      formData.append("id", this.trainingId);
      formData.append("company", this.form.company);
      formData.append("date", this.form.date);
      formData.append("city", this.form.city);
      formData.append("country", this.form.country);
      formData.append("assigned_trainer", this.form.assigned_trainer);
      formData.append("certificate", this.form.certificate);
      formData.append("status", this.form.status);

      axios
        .post(route("api.training.update"), formData, {
          headers: {
            Authorization: "Bearer " + this.$page.props.auth_token,
          },
        })
        .then((data) => {
          toastr.success("Training Updated successfully.");
          this.$inertia.get(route("training"));
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