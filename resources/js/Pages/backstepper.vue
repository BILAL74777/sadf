<template>
    <Head>
        <!-- <title>Home Component</title> -->
        <!-- <title>{{ seo.title }}</title>

        <meta name="keywords" :content="seo.keyword" />
        <meta name="image" :content="'/storage/' + seo.image" />
        <meta name="description" :content="seo.description" /> -->

        <!-- <link rel="icon" type="image/svg+xml" href="/favicon.svg" /> -->
    </Head>

    <section class="py-0">
        <div class="card c-form-card c-bg-theme-black">
            <div class="card-body pt-5">
                <form @submit.prevent="submit" id="regForm">
                    <div class="row pb-5">
                        <div v-if="activePhase == 1">
                            <!-- General info group  -->
                            <div class="card c-form-card">
                                <div class="card-header c-form-card-header">
                                    {{
                                        translate(
                                            "This is stepper redirected with "
                                        )
                                    }}{{ email }}
                                </div>
                                <div class="card-body pt-4">
                                     
                                    <div
                                        class="row g-3"
                                        v-for="(quiz, index) in Lessons"
                                    >
                                        <div v-if="index <= 2">
                                            <div>
                                                <h3>
                                                    Title : {{ quiz.title }}
                                                </h3>
                                                <h3>
                                                    Videl URL :
                                                    {{ quiz.video_url }}
                                                </h3> 
                                                <span v-for="(question, index) in quiz.questions">
                                                    {{ question.question }}
                                                </span>
                                                
                                                Question :  

                                                <div
                                                    v-for="answer in question.answers"
                                                >
                                                    <input
                                                        type="radio"
                                                        name="option"
                                                        id="option"
                                                        :value="answer.answer"
                                                    />
                                                    {{ answer.answer }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div style="margin: 200px">
                                        <div style="float: right">
                                            <!-- <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button> -->
                                            <button
                                                class="btn btn-success"
                                                @click="goToStep(1, 1)"
                                            >
                                                Next
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div v-if="activePhase == 2">
                            <!-- mode group started -->
                            <div class="card c-form-card">
                                <div class="card-header c-form-card-header">
                                    {{ translate("STEP 2") }}
                                </div>
                                <div class="card-body pt-4">
                                    <div class="row g-3">
                                        <div
                                            class="row g-3"
                                            v-for="(quiz, index) in Lessons"
                                        >
                                            <div
                                                v-if="index >= 3 && index <= 5"
                                            >
                                                <h3>
                                                    Title : {{ quiz.title }}
                                                </h3>
                                                <h3>
                                                    Videl URL :
                                                    {{ quiz.video_url }}
                                                </h3>

                                                Question : {{ quiz.question }}

                                                <div
                                                    v-for="answer in quiz.answers"
                                                >
                                                    <input
                                                        type="radio"
                                                        name="option"
                                                        id="option"
                                                        :value="answer.answer"
                                                    />
                                                    {{ answer.answer }}
                                                </div>
                                            </div>
                                        </div>

                                        <div
                                            style="overflow: auto; margin: auto"
                                        >
                                            <div style="float: right">
                                                <button
                                                    type="button"
                                                    class="btn btn-secondary"
                                                    @click="nextPrev(2)"
                                                >
                                                    Previous
                                                </button>
                                                <button
                                                    type="submit"
                                                    class="btn btn-success ms-1"
                                                    @click="goToStep(2)"
                                                >
                                                    Next
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Mode group ended -->
                        </div>

                        <!-- author group starts -->
                        <div v-if="activePhase == 3">
                            <div class="card c-form-card">
                                <div class="card-header c-form-card-header">
                                    {{ translate("STEP 3") }}
                                </div>
                                <div class="card-body pt-4">
                                    <div class="row g-3">
                                        
                                        <div
                                            class="row g-3"
                                            v-for="(quiz, index) in Lessons"
                                        >
                                            <div
                                                v-if="index >= 6 && index <= 8"
                                            >
                                                <h3>
                                                    Title : {{ quiz.title }}
                                                </h3>
                                                <h3>
                                                    Videl URL :
                                                    {{ quiz.video_url }}
                                                </h3>

                                                Question : {{ quiz.question }}

                                                <div
                                                    v-for="answer in quiz.answers"
                                                >
                                                    <input
                                                        type="radio"
                                                        name="option"
                                                        id="option"
                                                        :value="answer.answer"
                                                    />
                                                    {{ answer.answer }}
                                                </div>
                                            </div>
                                        </div>

                                        <div
                                            style="overflow: auto; margin: 10px"
                                        >
                                            <div style="float: right">
                                                <button
                                                    type="button"
                                                    class="btn btn-secondary"
                                                    @click="nextPrev(3)"
                                                >
                                                    Previous
                                                </button>
                                                <button
                                                    type="submit"
                                                    class="btn btn-success ms-1"
                                                    @click="goToStep(3, 3)"
                                                >
                                                    Next
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- authors group ended -->

                        <div v-if="activePhase == 4">
                            <!-- mode group started -->
                            <div class="card c-form-card">
                                <div class="card-header c-form-card-header">
                                    {{ translate("STEP 4") }}
                                </div>
                                <div class="card-body pt-4">
                                    <div class="row g-3">
                                        <div
                                            class="row g-3"
                                            v-for="(quiz, index) in Lessons"
                                        >
                                            <div
                                                v-if="index >= 9 && index <= 11"
                                            >
                                                <h3>
                                                    Title : {{ quiz.title }}
                                                </h3>
                                                <h3>
                                                    Videl URL :
                                                    {{ quiz.video_url }}
                                                </h3>

                                                Question : {{ quiz.question }}

                                                <div
                                                    v-for="answer in quiz.answers"
                                                >
                                                    <input
                                                        type="radio"
                                                        name="option"
                                                        id="option"
                                                        :value="answer.answer"
                                                    />
                                                    {{ answer.answer }}
                                                </div>
                                            </div>
                                        </div>

                                        <div
                                            style="overflow: auto; margin: 10px"
                                        >
                                            <div style="float: right">
                                                <button
                                                    type="button"
                                                    class="btn btn-secondary"
                                                    @click="nextPrev(4)"
                                                >
                                                    Previous
                                                </button>
                                                <button
                                                    type="submit"
                                                    class="btn btn-success ms-1"
                                                    @click="goToStep(4)"
                                                >
                                                    Next
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Mode group ended -->
                        </div>

                        <div v-if="activePhase == 5">
                            <!-- Technology  group card start -->
                            <div class="card c-form-card">
                                <div class="card-header c-form-card-header">
                                    {{ translate("STEP 5") }}
                                </div>
                                <div class="card-body pt-4">
                                    <div class="row g-3">
                                        
                                        <div
                                            class="row g-3"
                                            v-for="(quiz, index) in Lessons"
                                        >
                                            <div
                                                v-if="index >= 12 && index <= 14"
                                            >
                                                <h3>
                                                    Title : {{ quiz.title }}
                                                </h3>
                                                <h3>
                                                    Videl URL :
                                                    {{ quiz.video_url }}
                                                </h3>
 
                                                Question : {{ quiz.questions.question }}

                                                <div
                                                    v-for="answer in quiz.answers"
                                                >
                                                    <input
                                                        type="radio"
                                                        name="option"
                                                        id="option"
                                                        :value="answer.answer"
                                                    />
                                                    {{ answer.answer }}
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div style="overflow: auto; margin: 10px">
                                        <div style="float: right">
                                            <button
                                                type="button"
                                                class="btn btn-secondary"
                                                @click="nextPrev(5)"
                                            >
                                                Previous
                                            </button>
                                            <button
                                                v-if="formStatus == 1"
                                                type="submit"
                                                class="btn btn-success ms-1"
                                                @click="goToStep(5)"
                                            >
                                                {{ translate("Submit") }}
                                            </button>

                                            <button
                                                class="btn btn-success ms-1"
                                                type="button"
                                                disabled
                                                v-else
                                            >
                                                {{ translate("Submit") }}
                                                <span
                                                    class="spinner-border spinner-border-sm"
                                                    role="status"
                                                    aria-hidden="true"
                                                ></span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Technology  group card close -->
                        </div>

                        <!-- Circles which indicates the steps of the form: -->
                        <div
                            style="text-align: center; margin-top: 40px"
                            v-if="activePhase != 11"
                        >
                            <span
                                v-if="
                                    activePhase == 1 ||
                                    activePhase == 2 ||
                                    activePhase == 3 ||
                                    activePhase == 4 ||
                                    activePhase == 5
                                "
                                class="step bg-color"
                            ></span>
                            <span v-else class="step"></span>
                            <span
                                v-if="
                                    activePhase == 2 ||
                                    activePhase == 3 ||
                                    activePhase == 4 ||
                                    activePhase == 5
                                "
                                class="step bg-color"
                            ></span>
                            <span v-else class="step"></span>
                            <span
                                v-if="
                                    activePhase == 3 ||
                                    activePhase == 4 ||
                                    activePhase == 5
                                "
                                class="step bg-color"
                            ></span>
                            <span v-else class="step"></span>
                            <span
                                v-if="activePhase == 4 || activePhase == 5"
                                class="step bg-color"
                            ></span>
                            <span v-else class="step"></span>
                            <span
                                v-if="activePhase == 5"
                                class="step bg-color"
                            ></span>
                            <span v-else class="step"></span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</template>

<script>
import Master from "@/Pages/Layouts/Master";
import { Head } from "@inertiajs/inertia-vue3";
import Multiselect from "@vueform/multiselect";
import Slider from "@vueform/slider";
import Datepicker from "@vuepic/vue-datepicker";
import "@vuepic/vue-datepicker/dist/main.css";

export default {
    layout: Master,
    components: {
        Head,
        Multiselect,
        Datepicker,
        Slider,
    },
    props: ["email","lesson_id"],
    created() {
         
        this.fetchLessonDetails();
        this.fetchLessonStep();
    },

    data() {
        return {
            formErrors: [],
            formErrors: [],
            formStatus: 1,
            first_step: "",
            activePhase: 1,
            Lessons: [],
            LessonDetails: [], 
            LessonSteps: [],
        };
    },
    methods: {
        fetchLessonDetails() {
            axios
                .get(route("api.fetch.lesson.details", this.lesson_id), {
                    headers: {
                        Authorization: "Bearer " + this.$page.props.auth_token,
                    },
                })
                .then((response) => {
                    this.LessonDetails = response.data;
                })
                .catch((error) => {
                    toastr.error(error.response.data.message);
                });
        },

        fetchLessonStep() {
            axios
                .get(route("api.fetch.lesson.step", this.lesson_id), {
                    headers: {
                        Authorization: "Bearer " + this.$page.props.auth_token,
                    },
                })
                .then((response) => {
                    this.LessonSteps = response.data;
                    console.log(this.LessonSteps);
                })
                .catch((error) => {
                    toastr.error(error.response.data.message);
                });
        },
         
        goToStep(step, po2) {
            // this.formStatus = 0;
            let formData = new FormData();

            // formData.append("answer1", this.form.answer1);

            if (step == 1) {
                step++;
                this.activePhase = step;
            } else if (step == 2) {
                step++;
                this.activePhase = step;
            } else if (step == 3) {
                step++;
                this.activePhase = step;
            } else if (step == 4) {
                step++;
                this.activePhase = step;
            } else if (step == 5) {
                this.formStatus = 0;
                axios
                    .post(route("api.get.certificate"), formData, {
                        headers: {
                            Authorization:
                                "Bearer " + this.$page.props.auth_token,
                        },
                    })
                    .then(() => {
                        toastr.success(
                            this.translate("You applied successfully.")
                        );
                        this.$inertia.get(route("success.message"));

                        // step = 1;
                        // this.activePhase = step;
                        // this.formStatus = 1;
                    })
                    .catch((error) => {
                        this.formStatus = 1;
                        toastr.error(error.response.data.message);
                        if (error.response.data.errors) {
                            this.formErrors = error.response.data.errors;
                        }
                    });
            }

            this.activePhase = step;
        },
        enableModeSpecify: function (e) {
            if (this.modeSpecifyEnable == 0) {
                this.modeSpecifyEnable = 1;
            } else {
                this.modeSpecifyEnable = 0;
            }
        },
        nextPrev(step) {
            this.activePhase = step - 1;
        },
        getYearRange() {
            let last_6_year = moment().subtract(7, "y").format("YYYY");
            let next_year = moment().add(1, "y").format("YYYY");
            return [last_6_year, next_year];
        },
        imageDropperDataPassing(files) {
            this.form.photo_gallery = files;
        },

        PosterDropperDataPassing(file) {
            this.form.poster = file;
        },
        ScreenShotDropperDataPassing(file) {
            this.form.screen_shot = file;
        },
    },
};
</script>
<style src="@vueform/slider/themes/default.css"></style>
<style>
#regForm {
    background-color: #ffffff;
    margin: 80px auto;
    width: 70%;
    min-width: 300px;
    border-top-left-radius: 15px !important;
    border-top-right-radius: 15px !important;
}

h1 {
    text-align: center;
}

input {
    padding: 10px;
    width: 100%;
    font-size: 17px;
    border: 1px solid #aaaaaa;
}

/* Mark input boxes that gets an error on validation: */
input.invalid {
    background-color: #ffdddd;
}

/* Hide all steps by default: */
.tab {
    display: none;
}

#hero {
    height: 0vh !important;
}

#prevBtn {
    background-color: #bbbbbb;
}

/* Make circles that indicate the steps of the form: */
.step {
    height: 15px;
    width: 15px;
    margin: 0 2px;
    background-color: #bbbbbb;
    border: none;
    border-radius: 50%;
    display: inline-block;
}

.bg-color {
    background-color: #8b2d88;
}
.c-bg-theme-black {
    background: black !important;
}
</style>
