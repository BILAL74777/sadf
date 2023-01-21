<template>
  <main id="main" class="main">
    <div class="pagetitle d-flex justify-content-between">
      <div>
        <h1>{{ translate("Add New Unit") }}</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <Link :href="route('dashboard')">{{
                $page.props.website_name
              }}</Link>
            </li>
            <li class="breadcrumb-item">
              {{ translate("Unit") }}
            </li>
            <li class="breadcrumb-item active">
              {{ translate("Add New Unit") }}
            </li>
          </ol>
        </nav>
      </div>
      <Link class="btn btn-success" :href="route('unit')">{{
        translate("Go To Tasks")
      }}</Link>
    </div>

    <!-- End Page Title -->
    <section class="section">
      <div class="card">
        <div class="card-body pt-4">
          <!-- <h5 class="card-title">Add New Unit</h5> -->

          <!-- Floating Labels Form -->
          <form @submit.prevent="submit">
            <div class="row g-3">

              <div class="col-12 col-md-6">
                <label for="type">{{ translate("Type") }}</label>
                <input
                  type="text"
                  class="form-control"
                  id="type"
                  :class="{ 'invalid-bg': formErrors.type }"
                  v-model="form.type"
                />

                <div
                  class="invalid-feedback animated fadeIn"
                  v-if="formErrors.type"
                >
                  {{ formErrors.type[0] }}
                </div>
              </div>

              <div class="col-12 col-md-6">
                <label for="model">{{ translate("Model") }}</label>
                <input
                  type="text"
                  class="form-control"
                  id="model"
                  :class="{ 'invalid-bg': formErrors.model }"
                  v-model="form.model"
                />

                <div
                  class="invalid-feedback animated fadeIn"
                  v-if="formErrors.model"
                >
                  {{ formErrors.model[0] }}
                </div>
              </div>

              <div class="col-12 col-md-6">
                <label for="version">{{ translate("Version") }}</label>
                 <input
                    type="text"
                    class="form-control"
                    id="version"
                    :class="{ 'invalid-bg': formErrors.version }"
                    v-model="form.version"
                />
                <div
                  class="invalid-feedback animated fadeIn"
                  v-if="formErrors.version"
                >
                  {{ formErrors.version[0] }}
                </div>
              </div>

              <div class="col-12 col-md-6">
                <label for="year">{{ translate("Year") }}</label>
                 <input
                    type="text"
                    class="form-control"
                    id="year"
                    :class="{ 'invalid-bg': formErrors.year }"
                    v-model="form.year"
                />
                <div
                  class="invalid-feedback animated fadeIn"
                  v-if="formErrors.year"
                >
                  {{ formErrors.year[0] }}
                </div>
              </div>

              <div class="col-12 col-md-6">
                <label for="max_speed">{{ translate("Max Speed") }}</label>
                 <input
                    type="text"
                    class="form-control"
                    id="max_speed"
                    :class="{ 'invalid-bg': formErrors.max_speed }"
                    v-model="form.max_speed"
                />
                <div
                  class="invalid-feedback animated fadeIn"
                  v-if="formErrors.max_speed"
                >
                  {{ formErrors.max_speed[0] }}
                </div>
              </div>

              <div class="col-12 col-md-6">
                <label for="weight">{{ translate("Weight") }}</label>
                 <input
                    type="text"
                    class="form-control"
                    id="weight"
                    :class="{ 'invalid-bg': formErrors.weight }"
                    v-model="form.weight"
                />
                <div
                  class="invalid-feedback animated fadeIn"
                  v-if="formErrors.weight"
                >
                  {{ formErrors.weight[0] }}
                </div>
              </div>

              <div class="col-12 col-md-6">
                <label for="color">{{ translate("Color") }}</label>
                 <input
                    type="text"
                    class="form-control"
                    id="color"
                    :class="{ 'invalid-bg': formErrors.color }"
                    v-model="form.color"
                />
                <div
                  class="invalid-feedback animated fadeIn"
                  v-if="formErrors.color"
                >
                  {{ formErrors.color[0] }}
                </div>
              </div>

              <div class="col-12 col-md-6">
                <label for="load">{{ translate("Load") }}</label>
                 <input
                    type="text"
                    class="form-control"
                    id="load"
                    :class="{ 'invalid-bg': formErrors.load }"
                    v-model="form.load"
                />
                <div
                  class="invalid-feedback animated fadeIn"
                  v-if="formErrors.load"
                >
                  {{ formErrors.load[0] }}
                </div>
              </div>

              <div class="col-12 col-md-6">
                <label for="fuel">{{ translate("Fuel") }}</label>
                 <input
                    type="text"
                    class="form-control"
                    id="fuel"
                    :class="{ 'invalid-bg': formErrors.fuel }"
                    v-model="form.fuel"
                />
                <div
                  class="invalid-feedback animated fadeIn"
                  v-if="formErrors.fuel"
                >
                  {{ formErrors.fuel[0] }}
                </div>
              </div>

              <div class="col-12 col-md-6">
                <label for="kilometer">{{ translate("Kilometers") }}</label>
                 <input
                    type="text"
                    class="form-control"
                    id="kilometer"
                    :class="{ 'invalid-bg': formErrors.kilometer }"
                    v-model="form.kilometer"
                />
                <div
                  class="invalid-feedback animated fadeIn"
                  v-if="formErrors.kilometer"
                >
                  {{ formErrors.kilometer[0] }}
                </div>
              </div>

              <div class="col-12 col-md-6">
                <label for="height">{{ translate("Height") }}</label>
                 <input
                    type="text"
                    class="form-control"
                    id="height"
                    :class="{ 'invalid-bg': formErrors.height }"
                    v-model="form.height"
                />
                <div
                  class="invalid-feedback animated fadeIn"
                  v-if="formErrors.height"
                >
                  {{ formErrors.height[0] }}
                </div>
              </div>

              <div class="col-12 col-md-6">
                <label for="lenght">{{ translate("Lenght") }}</label>
                 <input
                    type="text"
                    class="form-control"
                    id="lenght"
                    :class="{ 'invalid-bg': formErrors.lenght }"
                    v-model="form.lenght"
                />
                <div
                  class="invalid-feedback animated fadeIn"
                  v-if="formErrors.lenght"
                >
                  {{ formErrors.lenght[0] }}
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
        type: "",
        model: "",
        version: "",
        year: "",
        max_speed: "",
        weight: "",
        color: "",
        load: "",
        fuel: "",
        kilometer: "",
        height: "",
        lenght: "",
      },
      formErrors: [],
      formStatus: "Yes",
 
    };
  },
  methods: {
    submit() {
      this.formStatus = "No";
      let formData = new FormData();
       
      formData.append("type",this.form.type);
      formData.append("model",this.form.model);
      formData.append("version",this.form.version);
      formData.append("year",this.form.year);
      formData.append("max_speed",this.form.max_speed);
      formData.append("weight",this.form.weight);
      formData.append("color",this.form.color);
      formData.append("load",this.form.load);
      formData.append("fuel",this.form.fuel);
      formData.append("kilometer",this.form.kilometer);
      formData.append("height",this.form.height);
      formData.append("lenght",this.form.lenght);
        
      axios
        .post(route("api.unit.store"), formData, {
          headers: {
            Authorization: "Bearer " + this.$page.props.auth_token,
          },
        })
        .then((data) => {
          toastr.success("Unit added successfully.");
          this.$inertia.get(route("unit"));
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