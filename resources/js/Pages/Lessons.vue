<template>
    <Head>
        <!-- <title>Home Component</title> -->
        <!-- <title>{{ seo.title }}</title>

        <meta name="keywords" :content="seo.keyword" />
        <meta name="image" :content="'/storage/' + seo.image" />
        <meta name="description" :content="seo.description" /> -->

        <!-- <link rel="icon" type="image/svg+xml" href="/favicon.svg" /> -->
    </Head>

    <section class="py-0 pt-5">
        <div class="container card c-form-card bg-light mt-5">
            <div class="card-body pt-5">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">{{ translate("Title") }}</th>
                                <th scope="col">
                                    {{ translate("Description") }}
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="(lesson, index) in Lessons"
                                :key="lesson.id"
                            >
                                <td> {{index+1}} </td>
                                <td> 
                                    <Link :href="route('user.lesson.details',[lesson.id,email])">
                                        {{ lesson.title }}
                                    </Link>     
                                </td>
                                <td> {{ lesson.descriptions }} </td>
                                                                
                            </tr>
                        </tbody>
                    </table>
                </div>
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
    props: ["email"],
    created() {
        this.fetchQuizzes();
    },

    data() {
        return {
            Lessons: [],
        };
    },
    methods: {
        fetchQuizzes() {
            axios
                .get(route("api.get.quiz"), {
                    headers: {
                        Authorization: "Bearer " + this.$page.props.auth_token,
                    },
                })
                .then((res) => {
                    this.Lessons = res.data; 
                });
        }, 
    },
};
</script>
<style src="@vueform/slider/themes/default.css"></style>
<style>

 
.bg-color {
    background-color: #8b2d88;
}
.c-bg-theme-black {
    background: black !important;
}
</style>
