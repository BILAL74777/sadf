<template>
    <main id="main" class="main">
        <div class="pagetitle d-flex justify-content-between">
            <div>
                <h1>{{ translate("Update Contact") }}</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <Link :href="route('dashboard')">{{
                                $page.props.website_name
                            }}</Link>
                        </li>
                        <li class="breadcrumb-item">
                            {{ translate("Contact") }}
                        </li>
                        <li class="breadcrumb-item active">
                            {{ translate("Update Contact") }}
                        </li>
                    </ol>
                </nav>
            </div>
            <Link class="btn btn-success" :href="route('contact')">{{
                translate("Go to Contact")
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
                                <label for="type">{{
                                    translate("Contact Type")
                                }}</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="contact_type"
                                    :class="{
                                        'invalid-bg': formErrors.contact_type,
                                    }"
                                    v-model="form.contact_type"
                                />

                                <div
                                    class="invalid-feedback animated fadeIn"
                                    v-if="formErrors.contact_type"
                                >
                                    {{ formErrors.contact_type[0] }}
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <label for="description">{{
                                    translate("Contact Description")
                                }}</label>
                                <textarea
                                    type="description"
                                    class="form-control"
                                    id="description"
                                    :class="{
                                        'invalid-bg': formErrors.description,
                                    }"
                                    v-model="form.description"
                                >
                                </textarea>

                                <div
                                    class="invalid-feedback animated fadeIn"
                                    v-if="formErrors.description"
                                >
                                    {{ formErrors.description[0] }}
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <label for="date">
                                    {{ translate("Date") }}
                                </label>
                                <Datepicker
                                    :enableTimePicker="false"
                                    :class="{
                                        'invalid-bg': formErrors.date,
                                    }"
                                    v-model="form.date"
                                >
                                </Datepicker>
                                <div
                                    class="invalid-feedback animated fadeIn"
                                    v-if="formErrors.date"
                                >
                                    {{ formErrors.date[0] }}
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
import Datepicker from "vue3-date-time-picker";
import "vue3-date-time-picker/dist/main.css";
import Multiselect from "@vueform/multiselect";
export default {
    layout: Master,
    props: ["contactId"],
    directives: { maska },
    components: {
        Multiselect,
        Datepicker,
    },
    created() {
        this.fetchContactRecord();
    },

    data() {
        return {
            form: {
                contact_type: "",
                description: "",
                date: "",
            },
            formErrors: [],
            formStatus: "Yes",
        };
    },
    methods: {
        fetchContactRecord() {
            axios
                .get(route("api.contact.show", this.contactId), {
                    headers: {
                        Authorization: "Bearer " + this.$page.props.auth_token,
                    },
                })
                .then((response) => {
                    this.form.contact_type = response.data.type;
                    this.form.description = response.data.description;

                    this.form.date =
                        response.data.date == "null" ? "" : response.data.date;

                    this.fetchCountries();
                })
                .catch((error) => {
                    toastr.error(error.response.data.message);
                });
        },
        submit() {
            this.formStatus = "No";
            let formData = new FormData();
            formData.append("id", this.contactId);
            formData.append("contact_type", this.form.contact_type);
            formData.append("description", this.form.description);

            if (this.form.date) {
                formData.append(
                    "date",
                    this.form.date.getMonth
                        ? this.form.date.toLocaleDateString("en-CA")
                        : this.form.date
                        ? this.form.date
                        : ""
                );
            }
            axios
                .post(route("api.contact.update"), formData, {
                    headers: {
                        Authorization: "Bearer " + this.$page.props.auth_token,
                    },
                })
                .then((data) => {
                    toastr.success("Contact added successfully.");
                    this.$inertia.get(route("contact"));
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
