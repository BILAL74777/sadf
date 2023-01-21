<template>
    <main id="main" class="main">
        <div class="pagetitle d-flex justify-content-between">
            <div>
                <h1>{{ translate("Add New Step") }}</h1>
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
                            {{ translate("Add New Step") }}
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
                    <form>
                        <div class="row g-3">
                            

                            <div class="col-12 col-md-12">
                                <label for="question">{{
                                    translate("Title")
                                }}</label>
                                <textarea
                                    type="title"
                                    class="form-control"
                                    id="title"
                                    :class="{
                                        'invalid-bg': formErrors.title,
                                    }"
                                    v-model="form.title"
                                >
                                </textarea>

                                <div
                                    class="invalid-feedback animated fadeIn"
                                    v-if="formErrors.title"
                                >
                                    {{ formErrors.title[0] }}
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
                                <button type="button" @click="addQuestion">Add Question</button> <br><br>
                                <div v-for="(question,index) in questions" :key="index">
                                    <input type="text" placeholder="Question" v-model="question.question" />
                                    <button @click="removeQuestion(question)" class="btn btn-sm btn-danger" type="button"><i class="bi bi-trash"></i></button><br><br>
                                    <button type="button" @click="addAnswer(question)">Add Answer</button>
                                    <div v-for="(answer,answerIndex) in question.answers" :key="answerIndex">
                                        <input type="text" placeholder="Answer" v-model="answer.answer" /><button @click="removeAnswer(question, answer)" class="btn btn-sm btn-danger" type="button"><i class="bi bi-trash"></i></button>
                                        <input type="text" placeholder="Alert" v-model="answer.alert" />
                                        <input type="text" placeholder="Correct" v-model="answer.correct" />
                                        <br><br>
                                    </div>
                                </div><br><br>

                            </div>
 
                           
                        </div>
                        <div class="mt-5">
                            <button
                                @click="submit"
                                type="button"
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
    props:['lesson_id'],
    directives: { maska },
    components: {
        Multiselect,
        Datepicker,
    },
    data() {
        return {
            form: {
                lesson_id:this.lesson_id,
                title: "",
                image: "", 
            },
            formErrors: [],
            formStatus: 1,
            questions:[
                {
                    question: 'question 1',
                    answers:[
                        {
                            answer:'answer 1',
                            alert:'this is answer alert',
                            correct:true
                        },
                        {
                            answer:'answer 2',
                            alert:'this is answer alert',
                            correct:false
                        }
                    ]
                },
            ]
        };
    },
    methods: {
        submit() {
            console.log(this.questions);
            return;
            this.formStatus = 0;
            let formData = new FormData();
 
            formData.append("lesson_id", this.form.lesson_id);
            formData.append("title", this.form.title);
            formData.append("image", this.form.image);

             
            axios
                .post(route("api.step.store"), formData, {
                    headers: {
                        Authorization: "Bearer " + this.$page.props.auth_token,
                    },
                })
                .then((data) => {
                    toastr.success("Step added successfully.");
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
        addQuestion(){
            this.questions.push({
                question: '',
                answers:[
                    {
                        answer:'',
                        alert:'',
                        correct:''
                    }   
                ]
            });

            console.log('adding question');
        },
        removeQuestion(question){
            let id = this.questions.indexOf(question);

            if (id > -1) {
                this.questions.splice(id, 1);
            }
        },
        addAnswer(question){
            let id = this.questions.indexOf(question);
            console.log(id,question);
            console.log(this.questions[id]);
            this.questions[id].answers.push({
                answer:'',
                alert:'',
                correct: null
            });
        },
        removeAnswer(question, answer){
            let questionId = this.questions.indexOf(question);
            let answerId = this.questions[questionId].answers.indexOf(answer);

            if (answerId > -1) {
                this.questions[questionId].answers.splice(answerId, 1);
            }
        }
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
