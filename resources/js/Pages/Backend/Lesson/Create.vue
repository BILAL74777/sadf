<template>
    <main id="main" class="main">
        <div class="pagetitle d-flex justify-content-between">
            <div>
                <h1>{{ translate("Add New Lesson") }}</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <Link :href="route('dashboard')">{{
                                $page.props.website_name
                            }}</Link>
                        </li>
                        <li class="breadcrumb-item">
                            {{ translate("Lesson") }}
                        </li>
                        <li class="breadcrumb-item active">
                            {{ translate("Add New Lesson") }}
                        </li>
                    </ol>
                </nav>
            </div>
            <Link class="btn btn-success" :href="route('lesson')">{{
                translate("Go To Lessons")
            }}</Link>
        </div>

        <!-- End Page Title -->
        <section class="section">
            <div class="card">
                <div class="card-body pt-4">
                    <!-- <h5 class="card-title">Add New Lesson</h5> -->

                    <!-- Floating Labels Form -->
                    <form @submit.prevent="submit">
                        <div class="row g-3">
                            <div class="col-12 col-md-12">
                                <label for="type">{{
                                    translate("Title")
                                }}</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="title"
                                    :class="{
                                        'invalid-bg': formErrors.title,
                                    }"
                                    v-model="form.title"
                                />

                                <div
                                    class="invalid-feedback animated fadeIn"
                                    v-if="formErrors.title"
                                >
                                    {{ formErrors.title[0] }}
                                </div>
                            </div>

                            <div class="col-12 col-md-12">
                                <label for="descriptions">{{
                                    translate("Lesson Description")
                                }}</label>
                                <textarea
                                    type="descriptions"
                                    class="form-control"
                                    id="descriptions"
                                    :class="{
                                        'invalid-bg': formErrors.descriptions,
                                    }"
                                    v-model="form.descriptions"
                                >
                                </textarea>

                                <div
                                    class="invalid-feedback animated fadeIn"
                                    v-if="formErrors.descriptions"
                                >
                                    {{ formErrors.descriptions[0] }}
                                </div>
                            </div>

                           
                        </div>
                        <div class="mt-5">
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
import { maska } from "maska";
import "vue-tel-input/dist/vue-tel-input.css";
import Datepicker from "vue3-date-time-picker";
import "vue3-date-time-picker/dist/main.css";
import Multiselect from "@vueform/multiselect";

export default {
    layout: Master,
    created() {},
    directives: { maska },
    components: {
        Multiselect,
        Datepicker,
    },
    data() {
        return {
            form: {
                title: "",
                descriptions: "", 
            },
            formErrors: [],
            formStatus: 1,
        };
    },
    methods: {
        submit() {
            this.formStatus = 0;
            let formData = new FormData();
            formData.append("title", this.form.title);
            formData.append("descriptions", this.form.descriptions);
 
            axios
                .post(route("api.lesson.store"), formData, {
                    headers: {
                        Authorization: "Bearer " + this.$page.props.auth_token,
                    },
                })
                .then((data) => {
                    toastr.success("Lesson added successfully.");
                    this.formStatus = 1;
                    this.$inertia.get(route("lesson"));
                })
                .catch((error) => {
                    toastr.error(error.response.data.message);

                    this.formStatus = 1;
                    if (error.response.data.errors) {
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
