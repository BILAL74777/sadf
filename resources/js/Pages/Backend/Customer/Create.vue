<template>
    <main id="main" class="main">
        <div class="pagetitle d-flex justify-content-between">
            <div>
                <h1>{{ translate("Add New Customer") }}</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <Link :href="route('dashboard')">{{
                                $page.props.website_name
                            }}</Link>
                        </li>
                        <li class="breadcrumb-item">
                            {{ translate("Customer") }}
                        </li>
                        <li class="breadcrumb-item active">
                            {{ translate("Add New Customer") }}
                        </li>
                    </ol>
                </nav>
            </div>
            <Link class="btn btn-success" :href="route('customer')">{{
                translate("Go To Companies")
            }}</Link>
        </div>

        <!-- End Page Title -->
        <section class="section">
            <div class="card">
                <div class="card-body pt-4">
                    <!-- <h5 class="card-title">Add New Customer</h5> -->

                    <!-- Floating Labels Form -->
                    <form @submit.prevent="submit">
                        <div class="row g-3">
                            <div class="col-12 col-md-6">
                                <label for="first_name">{{
                                    translate("First Name")
                                }}</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="first_name"
                                    :class="{
                                        'invalid-bg': formErrors.first_name,
                                    }"
                                    v-model="form.first_name"
                                />

                                <div
                                    class="invalid-feedback animated fadeIn"
                                    v-if="formErrors.first_name"
                                >
                                    {{ formErrors.first_name[0] }}
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <label for="last_name">{{
                                    translate("Last Name")
                                }}</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="last_name"
                                    :class="{
                                        'invalid-bg': formErrors.last_name,
                                    }"
                                    v-model="form.last_name"
                                />

                                <div
                                    class="invalid-feedback animated fadeIn"
                                    v-if="formErrors.last_name"
                                >
                                    {{ formErrors.last_name[0] }}
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <label for="dob">
                                    {{ translate("Date of birth") }}
                                </label>
                                <Datepicker
                                    :enableTimePicker="false"
                                    :class="{
                                        'invalid-bg': formErrors.dob,
                                    }"
                                    v-model="form.dob"
                                >
                                </Datepicker>
                                <div
                                    class="invalid-feedback animated fadeIn"
                                    v-if="formErrors.dob"
                                >
                                    {{ formErrors.dob[0] }}
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <label for="email">{{
                                    translate("Email")
                                }}</label>
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
                                <label for="phone">{{
                                    translate("Phone")
                                }}</label>
                                <vue-tel-input
                                    mode="international"
                                    v-on:validate="phone_validate"
                                    :class="{
                                        'invalid-bg': formErrors.phone,
                                        'invalid-bg': phone_error,
                                    }"
                                    v-model="form.phone"
                                >
                                </vue-tel-input>
                                <div
                                    class="invalid-feedback animated fadeIn"
                                    v-if="formErrors.phone"
                                >
                                    {{ formErrors.phone[0] }}
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <label for="phone2">{{
                                    translate("Phone 2")
                                }}</label>

                                <vue-tel-input
                                    mode="international"
                                    v-model="form.phone2"
                                    v-on:validate="phone2_validate"
                                    :class="{
                                        'invalid-bg': formErrors.phone2,
                                        'invalid-bg': phone2_error,
                                    }"
                                ></vue-tel-input>

                                <div
                                    class="invalid-feedback animated fadeIn"
                                    v-if="formErrors.phone2"
                                >
                                    {{ formErrors.phone2[0] }}
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <label for="allergies">{{
                                    translate("Allergies")
                                }}</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="allergies"
                                    :class="{
                                        'invalid-bg': formErrors.allergies,
                                    }"
                                    v-model="form.allergies"
                                />

                                <div
                                    class="invalid-feedback animated fadeIn"
                                    v-if="formErrors.allergies"
                                >
                                    {{ formErrors.allergies[0] }}
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <label for="activity">{{
                                    translate("Activity")
                                }}</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="activity"
                                    :class="{
                                        'invalid-bg': formErrors.activity,
                                    }"
                                    v-model="form.activity"
                                />

                                <div
                                    class="invalid-feedback animated fadeIn"
                                    v-if="formErrors.activity"
                                >
                                    {{ formErrors.activity[0] }}
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <label for="company">{{
                                    translate("Company")
                                }}</label>
                                <Multiselect
                                    class="form-select"
                                    v-model="form.company"
                                    :options="company_options"
                                    :searchable="true"
                                    :class="{
                                        'invalid-bg': formErrors.company,
                                    }"
                                />

                                <div
                                    class="invalid-feedback animated fadeIn"
                                    v-if="formErrors.company"
                                >
                                    {{ formErrors.company[0] }}
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
                            <button
                                class="btn btn-success"
                                type="button"
                                disabled
                                v-else
                            >
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
    created() {
        this.fetchCopanies();
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
                first_name: "",
                last_name: "",
                dob: "",
                email: "",
                phone: "",
                phone2: "",
                allergies: "",
                activity: "",
                company: "",
            },
            formErrors: [],
            formStatus: "Yes",
            company_options: [],
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

        submit() {
            this.formStatus = "No";
            let formData = new FormData();
            formData.append("first_name", this.form.first_name);
            formData.append("last_name", this.form.last_name);
            formData.append("email", this.form.email);
            formData.append("phone", this.form.phone);
            formData.append("phone2", this.form.phone2);

            formData.append("activity", this.form.activity);

            if (this.form.dob) {
                formData.append(
                    "dob",
                    this.form.dob
                        ? this.form.dob.toLocaleDateString("en-CA")
                        : ""
                );
            }

            if (this.form.allergies == null) {
                formData.append("allergies", "");
            } else {
                formData.append("allergies", this.form.allergies);
            }
            if (this.form.company == null) {
                formData.append("company", "");
            } else {
                formData.append("company", this.form.company);
            }

            axios
                .post(route("api.customer.store"), formData, {
                    headers: {
                        Authorization: "Bearer " + this.$page.props.auth_token,
                    },
                })
                .then((data) => {
                    toastr.success("Customer added successfully.");
                    this.$inertia.get(route("customer"));
                })
                .catch((error) => {
                    toastr.error(error.response.data.message);

                    if (error.response.data.errors) {
                        this.formStatus = "Yes";
                        this.formErrors = error.response.data.errors;
                    }
                });
        },

        phone_validate(phone_object) {
            let phone = phone_object ? phone_object.valid : false;
            if (phone) {
                this.phone_error = false;
            } else {
                this.phone_error = true;
            }
        },
        phone2_validate(phone2_object) {
            let phone2 = phone2_object ? phone2_object.valid : false;
            if (phone2) {
                this.phone2_error = false;
            } else {
                this.phone2_error = true;
            }
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
