<template>
    <main id="main" class="main">
        <div class="pagetitle d-flex justify-content-between">
            <div>
                <h1>{{ translate("Add New Address") }}</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <Link :href="route('dashboard')">{{
                                $page.props.website_name
                            }}</Link>
                        </li>
                        <li class="breadcrumb-item">
                            {{ translate("Address") }}
                        </li>
                        <li class="breadcrumb-item active">
                            {{ translate("Add New Address") }}
                        </li>
                    </ol>
                </nav>
            </div>
            <Link class="btn btn-success" :href="route('address')">{{
                translate("Go To Companies")
            }}</Link>
        </div>

        <!-- End Page Title -->
        <section class="section">
            <div class="card">
                <div class="card-body pt-4">
                    <!-- <h5 class="card-title">Add New Address</h5> -->

                    <!-- Floating Labels Form -->
                    <form @submit.prevent="submit">
                        <div class="row g-3">
                            <div class="col-12 col-md-6">
                                <label for="street">{{
                                    translate("Street")
                                }}</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="street"
                                    :class="{ 'invalid-bg': formErrors.street }"
                                    v-model="form.street"
                                />

                                <div
                                    class="invalid-feedback animated fadeIn"
                                    v-if="formErrors.street"
                                >
                                    {{ formErrors.street[0] }}
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <label for="street2">{{
                                    translate("Street 2")
                                }}</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="street2"
                                    :class="{
                                        'invalid-bg': formErrors.street2,
                                    }"
                                    v-model="form.street2"
                                />

                                <div
                                    class="invalid-feedback animated fadeIn"
                                    v-if="formErrors.street2"
                                >
                                    {{ formErrors.street2[0] }}
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <label for="apt">{{ translate("APT") }}</label>
                                <input
                                    type="apt"
                                    class="form-control"
                                    id="apt"
                                    :class="{ 'invalid-bg': formErrors.apt }"
                                    v-model="form.apt"
                                />

                                <div
                                    class="invalid-feedback animated fadeIn"
                                    v-if="formErrors.apt"
                                >
                                    {{ formErrors.apt[0] }}
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <label for="country">{{
                                    translate("Country Of Residence")
                                }}</label>
                                <Multiselect
                                    class="form-select"
                                    v-model="form.country"
                                    :options="country_options"
                                    @select="fetchSates()"
                                    :searchable="true"
                                    :class="{
                                        'invalid-bg': formErrors.country,
                                    }"
                                />

                                <div
                                    class="invalid-feedback animated fadeIn"
                                    v-if="formErrors.country"
                                >
                                    {{ formErrors.country[0] }}
                                </div>
                            </div>

                            <div class="col-12 col-md-6" v-if="form.country">
                                <label for="province">{{
                                    translate("State")
                                }}</label>
                                <Multiselect
                                    class="form-select"
                                    v-model="form.state"
                                    :options="state_options"
                                    @select="fetchCities()"
                                    :searchable="true"
                                    :class="{
                                        'invalid-bg': formErrors.state,
                                    }"
                                />

                                <div
                                    class="invalid-feedback animated fadeIn"
                                    v-if="formErrors.state"
                                >
                                    {{ formErrors.state[0] }}
                                </div>
                            </div>

                            <div class="col-12 col-md-6" v-if="form.state">
                                <label for="city">{{
                                    translate("City")
                                }}</label>
                                <Multiselect
                                    class="form-select"
                                    v-model="form.city"
                                    :options="city_options"
                                    :searchable="true"
                                    :class="{
                                        'invalid-bg': formErrors.city,
                                    }"
                                />

                                <div
                                    class="invalid-feedback animated fadeIn"
                                    v-if="formErrors.city"
                                >
                                    {{ formErrors.city[0] }}
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <label for="zip">{{ translate("Zip") }}</label>
                                <input
                                    type="zip"
                                    class="form-control"
                                    id="zip"
                                    :class="{ 'invalid-bg': formErrors.zip }"
                                    v-model="form.zip"
                                />

                                <div
                                    class="invalid-feedback animated fadeIn"
                                    v-if="formErrors.zip"
                                >
                                    {{ formErrors.zip[0] }}
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <label for="xx">{{ translate("XX") }}</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="xx"
                                    :class="{ 'invalid-bg': formErrors.xx }"
                                    v-model="form.xx"
                                />

                                <div
                                    class="invalid-feedback animated fadeIn"
                                    v-if="formErrors.xx"
                                >
                                    {{ formErrors.xx[0] }}
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
import { maska } from "maska";
import "vue-tel-input/dist/vue-tel-input.css";
import Multiselect from "@vueform/multiselect";

export default {
    layout: Master,
    created() {
        this.fetchCountries();
    },
    directives: { maska },
    components: {
        Multiselect,
    },
    data() {
        return {
            form: {
                street: "",
                street2: "",
                apt: "",
                country: "",
                state: "",
                city: "",
                zip: "",
                xx: "",
            },
            formErrors: [],
            formStatus: "Yes",

            country_options: [],
            state_options: [],
            city_options: [],
        };
    },
    methods: {
        fetchCountries() {
            axios
                .get(route("api.countries.pluck"), {
                    headers: {
                        Authorization: "Bearer " + this.$page.props.auth_token,
                    },
                })
                .then((response) => {
                    this.country_options = response.data;
                })
                .catch((error) => {
                    toastr.error(error.response.data.message);
                });
        },
        fetchSates() {
            axios
                .get(route("api.states.pluck", this.form.country), {
                    headers: {
                        Authorization: "Bearer " + this.$page.props.auth_token,
                    },
                })
                .then((response) => {
                    this.state_options = response.data;
                    this.form.state = Object.keys(response.data)[0];
                    this.fetchCities();
                })
                .catch((error) => {
                    toastr.error(error.response.data.message);
                });
        },
        fetchCities() {
            axios
                .get(route("api.cities.pluck", this.form.state), {
                    headers: {
                        Authorization: "Bearer " + this.$page.props.auth_token,
                    },
                })
                .then((response) => {
                    this.city_options = response.data;
                    this.form.city = Object.keys(response.data)[0];
                })
                .catch((error) => {
                    toastr.error(error.response.data.message);
                });
        },

        submit() {
            this.formStatus = "No";
            let formData = new FormData();
            formData.append("street", this.form.street);
            formData.append("street2", this.form.street2);
            formData.append("apt", this.form.apt);

            if (this.form.country == null) {
                formData.append("country", "");
            } else {
                formData.append("country", this.form.country);
            }
            if (this.form.state == null) {
                formData.append("state", "");
            } else {
                formData.append("state", this.form.state);
            }
            if (this.form.city == null) {
                formData.append("city", "");
            } else {
                formData.append("city", this.form.city);
            }

            formData.append("zip", this.form.zip);
            formData.append("xx", this.form.xx);
            axios
                .post(route("api.address.store"), formData, {
                    headers: {
                        Authorization: "Bearer " + this.$page.props.auth_token,
                    },
                })
                .then((data) => {
                    toastr.success("Address added successfully.");
                    this.$inertia.get(route("address"));
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
