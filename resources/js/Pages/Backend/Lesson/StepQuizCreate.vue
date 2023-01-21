<template>
    <main id="main" class="main">
        <div class="pagetitle d-flex justify-content-between">
            <div>
                <h1>{{ translate("Add Question and Answers") }}</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <Link :href="route('dashboard')">{{
                                $page.props.website_name
                            }}</Link>
                        </li>
                        <li class="breadcrumb-item">
                            {{ translate("Step") }}
                        </li>
                        <li class="breadcrumb-item active">
                            {{ translate("Add Question and Answers") }}
                        </li>
                    </ol>
                </nav>
            </div>
            <Link class="btn btn-success" :href="route('lesson.details',this.lesson_id)">{{
                translate("Go To Lessons")
            }}</Link>
        </div>

        <!-- End Page Title -->
        <section class="section">
            <div class="card">
                <div class="card-body pt-4">
                    <!-- <h5 class="card-title">Add New Step</h5> -->

                    <!-- Floating Labels Form -->
                    <form @submit.prevent="submit">
                        <div class="row g-3">
                            

                            <div class="col-12 col-md-12">
                                <label for="question">{{
                                    translate("Question")
                                }}</label>
                                <textarea
                                    type="question"
                                    class="form-control"
                                    id="question"
                                    :class="{
                                        'invalid-bg': formErrors.question,
                                    }"
                                    v-model="form.question"
                                >
                                </textarea>

                                <div
                                    class="invalid-feedback animated fadeIn"
                                    v-if="formErrors.question"
                                >
                                    {{ formErrors.question[0] }}
                                </div>
                            </div>


                            <div class="col-12 col-md-12">
                                <label for="type">{{
                                    translate("Answer 1")
                                }}</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="answer1"
                                    :class="{
                                        'invalid-bg': formErrors.answer1,
                                    }"
                                    v-model="form.answer1"
                                />

                                <div
                                    class="invalid-feedback animated fadeIn"
                                    v-if="formErrors.answer1"
                                >
                                    {{ formErrors.answer1[0] }}
                                </div>
                            </div>

                            <div class="col-12 col-md-12">
                                <label for="type">{{
                                    translate("Answer 2")
                                }}</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="answer2"
                                    :class="{
                                        'invalid-bg': formErrors.answer2,
                                    }"
                                    v-model="form.answer2"
                                />

                                <div
                                    class="invalid-feedback animated fadeIn"
                                    v-if="formErrors.answer2"
                                >
                                    {{ formErrors.answer2[0] }}
                                </div>
                            </div>

                            <div class="col-12 col-md-12">
                                <label for="type">{{
                                    translate("Answer 3")
                                }}</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="answer3"
                                    :class="{
                                        'invalid-bg': formErrors.answer3,
                                    }"
                                    v-model="form.answer3"
                                />

                                <div
                                    class="invalid-feedback animated fadeIn"
                                    v-if="formErrors.answer3"
                                >
                                    {{ formErrors.answer3[0] }}
                                </div>
                            </div>

                            <div class="col-12 col-md-12">
                                <label for="type">{{
                                    translate("Correct Answer")
                                }}</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="correct_answer"
                                    :class="{
                                        'invalid-bg': formErrors.correct_answer,
                                    }"
                                    v-model="form.correct_answer"
                                />

                                <div
                                    class="invalid-feedback animated fadeIn"
                                    v-if="formErrors.correct_answer"
                                >
                                    {{ formErrors.correct_answer[0] }}
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
    props:['step_id','lesson_id'],
    directives: { maska },
    components: {
        Multiselect,
        Datepicker,
    },
    data() {
        return {
            form: {
                step_id:this.step_id,
                question: "",
                answer1: "", 
                answer2: "", 
                answer3: "", 
                correct_answer: "", 
            },
            formErrors: [],
            formStatus: 1,
        };
    },
    methods: {
        submit() {
            this.formStatus = 0;
             
            axios
                .post(route("api.step.question.store"), this.form, {
                    headers: {
                        Authorization: "Bearer " + this.$page.props.auth_token,
                    },
                })
                .then((data) => {
                    toastr.success("Question added successfully.");
                    this.formStatus = 1;
                    this.$inertia.get(route("lesson.details",this.lesson_id));
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
