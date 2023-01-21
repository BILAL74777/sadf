<template>
    <main id="main" class="main">
        <div class="pagetitle d-flex justify-content-between">
            <div>
                <h1>{{ translate("Update Event") }}</h1>
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
                            {{ translate("Update Event") }}
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
                            <div class="col-6">
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
                            <div class="col-6 d-flex justify-content-end">
                                <DeleteModal
                                    :deleteId="eventId"
                                    @deleteThis="deleteThis"
                                ></DeleteModal>
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
                            <div class="col-md-12">
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

                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <div class="c-files">
                                                <label
                                                    class="col-6 col-form-label"
                                                    >{{
                                                        translate("Image")
                                                    }}</label
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
                                        
                                        <div
                                            class="col-12 col-md-4"
                                            v-if="existing_image != 'http://crm_shahispace.test//storage/'"
                                        >
                                        
                                            {{ translate("Image") }}
                                            <div
                                                class="col-6 d-flex justify-content-end"
                                            >
                                                <DeleteModal
                                                    :deleteImage="eventId"
                                                    @deleteImage="deleteImage"
                                                ></DeleteModal>
                                            </div>
                                            <ImageZooming
                                                :file="existing_image"
                                                :width="300"
                                            />
                                        </div>
                                    </div>

                                    <div class="row">
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

                                        <div
                                            class="col-12 col-md-4 mt-5"
                                            v-if="existing_catalog != 'http://crm_shahispace.test//storage/'"
                                        >
                                            <div
                                                v-if="existing_catalog != 'http://crm_shahispace.test//storage/'"
                                                class="col-6 d-flex justify-content-end"
                                            >
                                                <DeleteModal
                                                    :deleteCatalog="eventId"
                                                    @deleteCatalog="
                                                        deleteCatalog
                                                    "
                                                ></DeleteModal>
                                            </div>
                                            {{ translate("Catalog") }}
                                            <a
                                                v-if="existing_catalog"
                                                download
                                                :href="
                                                    '/storage/' +
                                                    existing_catalog
                                                "
                                                >{{
                                                    translate("Download File")
                                                }}</a
                                            >
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
    props: ["eventId"],
    components: {
        Datepicker,
    },
    data() {
        return {
            form: {
                id: this.eventId,
                title: "",
                start_date: "",
                end_date: "",
                image: "",
                catalog: "",
            },
            formErrors: [],
            formStatus: 1,
        };
    },
    created() {
        this.fetchEvent();
    },
    methods: {
        fetchEvent() {
            axios
                .get(route("api.events.show", this.eventId), {
                    headers: {
                        Authorization: "Bearer " + this.$page.props.auth_token,
                    },
                })
                .then((response) => {
                    this.form.title = response.data.title;
                    this.form.start_date = response.data.start_date;
                    this.form.end_date = response.data.end_date;
                    this.form.status = response.data.status;
                    this.form.description = response.data.description;
                    this.form.eligibility = response.data.eligibility;
                    this.existing_image = response.data.image;

                    this.existing_catalog = response.data.catalog;
                })
                .catch((error) => {
                    toastr.error(error.response.data.message);
                });
        },
        submit() {
            this.formStatus = 0;
            let formData = new FormData();
            formData.append("id", this.eventId);
            formData.append("title", this.form.title);
            if (this.form.status == "") {
                formData.append("status", false);
            } else {
                formData.append("status", this.form.status);
            }

            if (this.form.start_date) {
                formData.append(
                    "start_date",
                    this.form.start_date.getMonth
                        ? this.form.start_date.toLocaleDateString("en-CA")
                        : this.form.start_date
                        ? this.form.start_date
                        : ""
                );
            }
            if (this.form.end_date) {
                formData.append(
                    "end_date",
                    this.form.end_date.getMonth
                        ? this.form.end_date.toLocaleDateString("en-CA")
                        : this.form.end_date
                        ? this.form.end_date
                        : ""
                );
            }
            formData.append("description", this.form.description);
            formData.append("eligibility", this.form.eligibility);
            formData.append("image", this.form.image);
            formData.append("catalog", this.form.catalog);

            axios
                .post(route("api.events.update"), formData, {
                    headers: {
                        Authorization: "Bearer " + this.$page.props.auth_token,
                    },
                })
                .then((data) => {
                    toastr.success(
                        this.translate("Event updated successfully.")
                    );
                    this.$inertia.get(route("event.details",this.eventId));
                    this.formStatus = 1;
                    
                })
                .catch((error) => {
                    this.formStatus = 1;
                    toastr.error(error.response.data.message);
                    if (error.response.data.errors) {
                        this.formErrors = error.response.data.errors;
                    }
                });
        },
        deleteThis(id) {
            axios
                .delete(route("api.events.delete", id), {
                    headers: {
                        Authorization: "Bearer " + this.$page.props.auth_token,
                    },
                })
                .then(() => {
                    toastr.success("Event deleted successfully.");
                    this.$inertia.get(route("events"));
                })
                .catch((error) => {
                    toastr.error(error.response.data.message);
                });
        },
        deleteImage(id) {
            axios
                .delete(route("api.events.image.delete", id), {
                    headers: {
                        Authorization: "Bearer " + this.$page.props.auth_token,
                    },
                })
                .then(() => {
                    toastr.success("Event image deleted successfully.");
                    this.$inertia.get(route('events.edit',this.eventId));
                    // this.fetchEvent();
                })
                .catch((error) => {
                    toastr.error(error.response.data.message);
                });
        },
        deleteCatalog(id) {
            axios
                .delete(route("api.events.catalog.delete", id), {
                    headers: {
                        Authorization: "Bearer " + this.$page.props.auth_token,
                    },
                })
                .then(() => {
                    toastr.success("Event catalog deleted successfully.");
                    this.$inertia.get(route('events.edit',this.eventId));
                    // this.fetchEvent();
                })
                .catch((error) => {
                    toastr.error(error.response.data.message);
                });
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

#CodeSelect {
    min-height: 58px;
}

.card {
    overflow: visible;
}
</style>
