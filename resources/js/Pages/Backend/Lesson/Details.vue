<template>
    <main id="main" class="main">
        <div class="pagetitle d-flex justify-content-between">
            <div>
                <h1>{{ translate("Lessons") }}</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <Link :href="route('dashboard')">{{
                                $page.props.website_name
                            }}</Link>
                        </li>
                        <li class="breadcrumb-item active">
                            {{ translate("Lessons") }}
                        </li>
                    </ol>
                </nav>
            </div>

            <div class="d-flex">
                <Link class="btn btn-success" :href="route('lesson')">
                    {{ translate("All Lessons") }}
                </Link>
            </div>
        </div>
        <!-- End Page Title -->
        <section class="section">
            <div class="card">
                <div class="card-body pt-4">
                    <div class="col-md-6">
                        <strong>{{ translate("Title") }}</strong>
                    </div>
                    <div class="col-md-12">
                        {{ LessonDetails.title }}
                    </div>
                    <div class="col-md-6">
                        <strong>{{ translate("Descriptions") }}</strong>
                    </div>
                    <div class="col-md-12">
                        {{ LessonDetails.descriptions }}
                    </div>
                </div>
            </div>
            <div class="card card-body p-4">
                <div class="table-responsive">
                    <div class="d-flex justify-content-between">
                        <h5>{{ translate("All steps of this lesson") }}</h5>
                        <Link
                            class="btn btn-success"
                            :href="route('step.add', lesson_id)"
                        >
                            <i class="bi bi-plus-lg"></i>
                            {{ translate("Create step") }}
                        </Link>
                    </div>
                    <div
                        class="card card-body p-4"
                        v-for="(step, index) in LessonSteps"
                        :key="step.id"
                    >
                        <div>
                             
                                <div class="col-md-2">
                                    <strong>{{ translate("Step Title") }}</strong>
                                </div>
                                <div class="col-md-8">
                                    {{ step.title }}
                                </div>
                             
                                <div class="col-md-2 pt-3">
                                    <strong>{{ translate("Step image") }}</strong>
                                </div>
                                <div class="col-md-10">
                                    <ImageZooming :file="step.image" :width="120" />
                                </div>
                             
                                <div class="col-md-12 pt-3">
                                    <Link
                                        class="btn btn-success"
                                        :href="
                                            route('step.question.add', [
                                                step.id,
                                                lesson_id,
                                            ])
                                        "
                                    >
                                        <i class="bi bi-plus-lg"></i>
                                        {{ translate("Create Questions") }}
                                    </Link>
                                </div>
                             
                        </div>

                        <div class="card-body p-4">
                            <div
                                class="row mb-3"
                                v-for="(q_a, index) in step.questions_answers"
                                :key="q_a.id"
                            >
                                <hr />
                                <div class="col-md-2 mt-2">
                                    <strong>
                                        {{ translate("Question") }}
                                        {{ index + 1 }}
                                    </strong>
                                </div>
                                <div class="col-md-10">{{ q_a.question }}</div>

                                <div class="col-md-2 mt-2">
                                    <strong>
                                        {{ translate("Answer 1") }}
                                    </strong>
                                </div>

                                <div class="col-md-10">{{ q_a.answer1 }}</div>
                                <div class="col-md-2 mt-2">
                                    <strong>
                                        {{ translate("Answer 2") }}
                                    </strong>
                                </div>
                                <div class="col-md-10">{{ q_a.answer2 }}</div>

                                <div class="col-md-2 mt-2">
                                    <strong>
                                        {{ translate("Answer 3") }}
                                    </strong>
                                </div>
                                <div class="col-md-10">{{ q_a.answer3 }}</div>

                                <div class="col-md-3 mt-2">
                                    <strong>
                                        {{ translate("Correct answer") }}
                                    </strong>
                                </div>
                                <div class="col-md-8">
                                    {{ q_a.correct_answer }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ translate("Title") }}</th>
                                <th>{{ translate("Image") }}</th>
                                <th class="text-center">{{ translate("Action") }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="(step, index) in LessonSteps"
                                :key="step.id"
                            >
                                <td>{{ index + 1 }}</td>
                                <td>{{ step.title }}</td>
                                
                                <td>
                                         
                                    <ImageZooming
                                        :file="step.image"
                                        :width="80"
                                    />
                                </td>
                                <td class="text-center">
                                    <Link
                                        class="btn btn-success"
                                        :href="route('step.question.add',[step.id,lesson_id])"
                                    >
                                        <i class="bi bi-plus-lg"></i>
                                        {{ translate("Create Questions") }}
                                    </Link>
                                </td>
                            </tr>
                        </tbody>
                    </table> -->
                </div>
            </div>
        </section>
    </main>
    <!-- End #main -->
</template>

<script>
import Master from "@/Pages/Backend/Layouts/Master";

export default {
    layout: Master,
    components: {},
    props: ["lesson_id"],
    created() {
        this.fetchLessonDetails();
        this.fetchLessonStep();
    },
    data() {
        return {
            LessonDetails: [],
            deleteId: null,
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
    },
};
</script>

<style>
.table td,
.table th {
    vertical-align: middle;
}
</style>
