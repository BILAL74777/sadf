<template>
    <main id="main" class="main">
        <div class="pagetitle d-flex justify-content-between">
            <div>
                <h1>{{ translate("Add New Event") }}</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <Link :href="route('dashboard')">{{
                                $page.props.website_name
                            }}</Link>
                        </li>
                        <li class="breadcrumb-item">
                            {{ translate("Events") }}
                        </li>
                        <li class="breadcrumb-item active">
                            {{ translate("Add New Event") }}
                        </li>
                    </ol>
                </nav>
            </div>
            <Link class="btn btn-success" :href="route('events')">{{
                translate("Go to Events")
            }}</Link>
        </div>

        <!-- End Page Title -->
        <section class="section">
            <div class="card">
                <div class="card-body pt-4">
                    <!-- <h5 class="card-title">Add New Crew</h5> -->

                    <!-- Floating Labels Form -->
                    <form @submit.prevent="submit">
                        <div class="row g-3">
                            <div class="col-12">
                                <label>{{ translate("Choose Status") }}</label>
                                <br />
                                <div class="d-inline-block me-2">
                                    {{ translate("Off") }}
                                </div>
                                <div
                                    class="form-check form-switch d-inline-block"
                                >
                                    <input
                                        class="form-check-input"
                                        type="checkbox"
                                        :class="{
                                            'invalid-bg': formErrors.status,
                                        }"
                                        v-model="form.status"
                                        checked
                                    />
                                    <label class="form-check-label">{{
                                        translate("On")
                                    }}</label>
                                </div>

                                <div
                                    class="invalid-feedback animated fadeIn"
                                    v-if="formErrors.status"
                                >
                                    {{ formErrors.status[0] }}
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <label for="title">{{
                                    translate("Event title")
                                }}</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="title"
                                    :class="{ 'invalid-bg': formErrors.title }"
                                    v-model="form.title"
                                />

                                <div
                                    class="invalid-feedback animated fadeIn"
                                    v-if="formErrors.title"
                                >
                                    {{ formErrors.title[0] }}
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <label for="phone">{{
                                            translate("Event start date")
                                        }}</label>
                                        <Datepicker
                                            autoApply
                                            :enableTimePicker="false"
                                            :class="{
                                                'invalid-bg':
                                                    formErrors.start_date,
                                            }"
                                            v-model="form.start_date"
                                        >
                                        </Datepicker>

                                        <div
                                            class="invalid-feedback animated fadeIn"
                                            v-if="formErrors.start_date"
                                        >
                                            {{ formErrors.start_date[0] }}
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <label for="phone">{{
                                            translate("Event end date")
                                        }}</label>
                                        <Datepicker
                                        autoApply
                                            :enableTimePicker="false"
                                            :class="{
                                                'invalid-bg':
                                                    formErrors.end_date,
                                            }"
                                            v-model="form.end_date"
                                        >
                                        </Datepicker>

                                        <div
                                            class="invalid-feedback animated fadeIn"
                                            v-if="formErrors.end_date"
                                        >
                                            {{ formErrors.end_date[0] }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <label>{{
                                            translate("Description")
                                        }}</label>
                                        <textarea
                                            class="form-control"
                                            :class="{
                                                'invalid-bg':
                                                    formErrors.description,
                                            }"
                                            v-model="form.description"
                                            rows="3"
                                        ></textarea>

                                        <div
                                            class="invalid-feedback animated fadeIn"
                                            v-if="formErrors.description"
                                        >
                                            {{ formErrors.description[0] }}
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <label>{{
                                            translate("Eligibility")
                                        }}</label>
                                        <textarea
                                            class="form-control"
                                            :class="{
                                                'invalid-bg':
                                                    formErrors.eligibility,
                                            }"
                                            v-model="form.eligibility"
                                            rows="3"
                                        ></textarea>

                                        <div
                                            class="invalid-feedback animated fadeIn"
                                            v-if="formErrors.eligibility"
                                        >
                                            {{ formErrors.eligibility[0] }}
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <div class="c-files">
                                            <label
                                                class="col-6 col-form-label"
                                                >{{ translate("Image") }}</label
                                            >
                                            <input
                                                class="form-control c-file-padding"
                                                :class="{
                                                    'invalid-bg':
                                                        formErrors.image,
                                                }"
                                                type="file"
                                                @input="
                                                    form.image =
                                                        $event.target.files[0]
                                                "
                                                id="image"
                                            />
                                        </div>
                                        <div
                                            class="invalid-feedback animated fadeIn"
                                            v-if="formErrors.image"
                                        >
                                            {{ formErrors.image[0] }}
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <div class="c-files">
                                            <label
                                                class="col-6 col-form-label"
                                                >{{
                                                    translate("Catalog")
                                                }}</label
                                            >
                                            <input
                                                class="form-control c-file-padding"
                                                :class="{
                                                    'invalid-bg':
                                                        formErrors.catalog,
                                                }"
                                                type="file"
                                                @input="
                                                    form.catalog =
                                                        $event.target.files[0]
                                                "
                                                id="catalog"
                                                accept="application/pdf"
                                            />
                                        </div>
                                        <div
                                            class="invalid-feedback animated fadeIn"
                                            v-if="formErrors.catalog"
                                        >
                                            {{ formErrors.catalog[0] }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-2">
                            <button
                                type="submit"
                                class="btn btn-success"
                                v-if="formStatus == 1"
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
import Datepicker from "@vuepic/vue-datepicker";
import "@vuepic/vue-datepicker/dist/main.css";
export default {
    layout: Master,
    components: {
        Datepicker,
    },
    data() {
        return {
            form: {
                title: "",
                start_date: "",
                end_date: "",
                status: "",
                description: "",
                eligibility: "",
                image: "",
                catalog: "",
            },
            formErrors: [],
            formStatus: 1,
        };
    },
    // created(){
    //     console.log('calling');
    // },
    methods: {
        submit() {
            this.formStatus = 0;

            let formData = new FormData();
            formData.append("title", this.form.title);

            if (this.form.status == "") {
                formData.append("status", false);
            } else {
                formData.append("status", this.form.status);
            }
            formData.append(
                "start_date",
                this.form.start_date
                    ? this.form.start_date.toLocaleDateString("en-CA")
                    : ""
            );
            formData.append(
                "end_date",
                this.form.end_date
                    ? this.form.end_date.toLocaleDateString("en-CA")
                    : ""
            );
            formData.append("description", this.form.description);
            formData.append("eligibility", this.form.eligibility);
            formData.append("image", this.form.image);
            formData.append("catalog", this.form.catalog);

            axios
                .post(route("api.events.store"), formData, {
                    headers: {
                        Authorization: "Bearer " + this.$page.props.auth_token,
                    },
                })
                .then((data) => {
                    toastr.success(this.translate("Event added successfully."));
                    this.formStatus = 1;
                    this.$inertia.get(route("events"));
                })
                .catch((error) => {
                    this.formStatus = 1;
                    toastr.error(error.response.data.message);
                    if (error.response.data.errors) {
                        this.formErrors = error.response.data.errors;
                    }
                });
        },
    },
};
</script>

<style>
/*@import '@vueform/multiselect/themes/default.css';*/

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
