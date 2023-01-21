<template>
    <main id="main" class="main">
        <div class="pagetitle d-flex justify-content-between">
            <div>
                <h1>{{ translate("Add New Quiz") }}</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <Link :href="route('dashboard')">{{
                                $page.props.website_name
                            }}</Link>
                        </li>
                        <li class="breadcrumb-item">
                            {{ translate("Quiz") }}
                        </li>
                        <li class="breadcrumb-item active">
                            {{ translate("Add New Quiz") }}
                        </li>
                    </ol>
                </nav>
            </div>
            <Link class="btn btn-success" :href="route('quiz')">{{
                translate("Go To Quizzes")
            }}</Link>
        </div>

        <!-- End Page Title -->
        <section class="section">
            <div class="card">
                <div class="card-body pt-4">
                    <!-- <h5 class="card-title">Add New Quiz</h5> -->

                    <!-- Floating Labels Form -->
                    <form @submit.prevent="submit">
                        <div class="row g-3">
                            <div class="col-12 col-md-6">
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

                            <div class="col-12 col-md-6">
                                <label for="url">{{
                                    translate("Video url")
                                }}</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="video_url"
                                    :class="{
                                        'invalid-bg': formErrors.video_url,
                                    }"
                                    v-model="form.video_url"
                                />

                                <div
                                    class="invalid-feedback animated fadeIn"
                                    v-if="formErrors.video_url"
                                >
                                    {{ formErrors.video_url[0] }}
                                </div>
                            </div>

                            <div
                                v-for="(list, index) in QuestionsList"
                                :key="index"
                            >
                                <div class="card card-body p-3">
                                    <div class="col-12 col-md-12">
                                        <label for="question">{{
                                            translate("Question")
                                        }} {{index+1}}</label>
                                        <div class="c-input-group">
                                            <button
                                                v-if="index > 0"
                                                class="btn"
                                                @click="
                                                    removeQuestionsList(
                                                        index,
                                                        list
                                                    )
                                                "
                                            >
                                                <i class="bi bi-trash"></i>
                                            </button>
                                            <textarea
                                                type="question"
                                                class="form-control"
                                                id="question"
                                                :class="{
                                                    'invalid-bg':
                                                        formErrors.question,
                                                }"
                                                v-model="list.question"
                                            >
                                            </textarea>
                                            <span
                                                @click="addQuestionsList"
                                                class="btn btn-success ms-1"
                                            >
                                                +
                                            </span>
                                        </div>

                                        <div
                                            class="invalid-feedback animated fadeIn"
                                            v-if="formErrors.question"
                                        >
                                            {{ formErrors.question[0] }}
                                        </div>
                                    </div>

                                    <div class="card card-body p-5">
                                        <div
                                        class="col-12 col-md-12" v-for="(ans, index) in list.answer"
                                        :key="index" 
                                    >
                                        <label for="url">{{
                                            translate("Answer")
                                        }} {{index+1}}</label>
                                         
                                             
                                            <input
                                                type="text"
                                                class="form-control"
                                                :class="{
                                                    'invalid-bg':
                                                        formErrors.answer,
                                                }"
                                                v-model="
                                                ans
                                                "
                                            />
                                            <!-- <span
                                                @click="addAnswersList"
                                                class="btn btn-success ms-1"
                                            >
                                                +
                                            </span> -->
                                         

                                        <div
                                            class="invalid-feedback animated fadeIn"
                                            v-if="formErrors.answer"
                                        >
                                            {{ formErrors.answer[0] }}
                                        </div>
                                    </div>

                                    <div
                                    class="col-12 col-md-12 card card-body p-3" 
                                >
                                    <label for="ra">{{
                                        translate("Right Answer")
                                    }}</label>
                                     
                                         
                                        <input
                                            type="text"
                                            class="form-control"
                                            :class="{
                                                'invalid-bg':
                                                    formErrors.rightAnswer,
                                            }"
                                            v-model="
                                            list.rightAnswer
                                            "
                                        />
                                        <!-- <span
                                            @click="addAnswersList"
                                            class="btn btn-success ms-1"
                                        >
                                            +
                                        </span> -->
                                     

                                    <div
                                        class="invalid-feedback animated fadeIn"
                                        v-if="formErrors.rightAnswer"
                                    >
                                        {{ formErrors.rightAnswer[0] }}
                                    </div>
                                </div>
                                    </div>

                                    
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
            QuestionsList: [
                {
                    question: "What is American football called in England?",
                    answer: ["American football", "football", "Handball"],
                    rightAnswer: "American football",
                },
                {
                    question: "What is the largest country in the world?",
                    answer: ["Russia", "Canada", "United States"],
                    rightAnswer: "Russia",
                },
                {
                    question: "What is the 100th digit of Pi?",
                    answer: [9, 4, 7],
                    rightAnswer: 9,
                },
            ],
            AnswersList: [
                {
                    answer: [],
                },
            ],
            form: {
                title: "",
                video_url: "",
            },
            formErrors: [],
            formStatus: "Yes",
        };
    },
    methods: {
        addQuestionsList() {
            this.QuestionsList.push({
                question: [],
            });
        },
        removeQuestionsList(index, list) {
            var idx = this.QuestionsList.indexOf(list);

            if (idx > -1) {
                this.QuestionsList.splice(idx, 1);
            }
        },
        addAnswersList() {
            this.QuestionsList[answer].push({
                answer: [],
            });
        },
        removeAnswersList(index, list) {
            var idx = this.AnswersList.indexOf(list);

            if (idx > -1) {
                this.AnswersList.splice(idx, 1);
            }
        },

        submit() {
            // this.formStatus = "No";
            let formData = new FormData();
            formData.append("title", this.form.title);
            formData.append("video_url", this.form.video_url);

            let questions_answers_list = this.QuestionsList;
            formData.append("questions_answers_list", JSON.stringify(questions_answers_list));

            axios
                .post(route("api.quiz.store"), formData, {
                    headers: {
                        Authorization: "Bearer " + this.$page.props.auth_token,
                    },
                })
                .then((data) => {
                    // this.formStatus = "Yes";
                    toastr.success("Quiz added successfully.");
                    this.$inertia.get(route("quiz"));
                })
                .catch((error) => {
                    toastr.error(error.response.data.message);

                    if (error.response.data.errors) {
                        // this.formStatus = "Yes";
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
