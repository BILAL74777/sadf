<template>
  <main id="main" class="main">
    <div class="pagetitle d-flex justify-content-between">
      <div>
        <h1>{{ translate("Update Crew") }}</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <Link :href="route('dashboard')">{{
                $page.props.website_name
              }}</Link>
            </li>
            <li class="breadcrumb-item">
              {{ translate("Crew") }}
            </li>
            <li class="breadcrumb-item active">
              {{ translate("Update Crew") }}
            </li>
          </ol>
        </nav>
      </div>
      <Link class="btn btn-success" :href="route('crew')">{{
        translate("Go to Crews")
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
                <label for="name">{{ translate("Crew Name") }}</label>
                <input
                  type="text"
                  class="form-control"
                  id="name"
                  :placeholder="translate('Crew Name')"
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
                <label for="phone">{{ translate("Crew Phone") }}</label>
                <!-- <input
                                        type="text"
                                        class="form-control"
                                        id="phone" 
                                        placeholder="(###) ###-####"
                                        v-maska="['(###) ###-####', '(###) ###-####']"
                                        :class="{ 'invalid-bg': formErrors.phone }"
                                        v-model="form.phone"
                                    /> -->
                <vue-tel-input
                  mode="international"
                  v-model="form.phone"
                  v-on:validate="phone_Validation"
                  :class="{
                    'invalid-bg': formErrors.phone,
                    'invalid-bg': phone_error,
                  }"
                ></vue-tel-input>

                <div
                  class="invalid-feedback animated fadeIn"
                  v-if="formErrors.phone"
                >
                  {{ formErrors.phone[0] }}
                </div>
              </div>

              <div class="col-12 col-md-6">
                <label for="email">{{ translate("Crew Email") }}</label>
                <input
                  type="email"
                  class="form-control"
                  id="email"
                  :placeholder="translate('Crew Email')"
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
                {{ translate("Update") }}
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
import { VueTelInput } from "vue-tel-input";
import "vue-tel-input/dist/vue-tel-input.css";
export default {
  layout: Master,
  props: ["crewId"],
  directives: { maska },
  components: {
    VueTelInput,
  },
  created() {
    this.fetchCrewRecord();
  },

  data() {
    return {
      phone_object: null,
      phone_error: "",
      form: {
        id: this.crewId,
        name: "",
        phone: "",
        email: "",
      },
      formErrors: [],
      formStatus: "Yes",
    };
  },
  methods: {
    fetchCrewRecord() {
      axios
        .get(route("api.crew.show", this.crewId), {
          headers: { Authorization: "Bearer " + this.$page.props.auth_token },
        })
        .then((response) => {
          this.form.name = response.data.name;
          this.form.phone = response.data.phone;
          this.form.email = response.data.email;
        })
        .catch((error) => {
          toastr.error(error.response.data.message);
        });
    },
    submit() {
      this.formStatus = "No";

      let formData = new FormData();
      formData.append("id", this.form.id);
      formData.append("name", this.form.name);
      formData.append("phone", this.form.phone);
      formData.append("email", this.form.email);

      axios
        .post(route("api.crew.update"), formData, {
          headers: {
            Authorization: "Bearer " + this.$page.props.auth_token,
          },
        })
        .then((data) => {
          toastr.success("Crew updated successfully.");
          this.$inertia.get(route("crew"));
        })
        .catch((error) => {
          toastr.error(error.response.data.message);

          if (error.response.data.errors) {
            this.formStatus = "Yes";
            this.formErrors = error.response.data.errors;
          }
        });
    },

    phone_Validation(phone_object) {
      let test = phone_object ? phone_object.valid : false;
      if (test) {
        //   formErrors.phone_error = '';

        this.phone_error = false;
      } else {
        this.phone_error = true;
      }
    },
  },
};
</script>


<style>
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