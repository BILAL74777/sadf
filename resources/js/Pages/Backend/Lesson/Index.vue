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
            <Link class="btn btn-success" :href="route('lesson.add')"
                ><i class="bi bi-plus-lg"></i>{{ translate("Add New Lesson") }}
            </Link>
        </div>
        <!-- End Page Title -->
        <section class="section">
            <div class="card">
                <div class="card-body pt-4">
                    <!-- <h5 class="card-title">Table with stripped rows</h5> -->

                    <!-- Table with stripped rows -->
                    <div class="table-reponsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-center">#</th>
                                    <th scope="col">{{ translate("Title") }}</th>
                                    <th scope="col">
                                        {{ translate("Description") }}
                                    </th>
                                     

                                    <th scope="col" class="text-center">
                                        
                                        {{ translate("Actions") }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="(lesson, index) in Lessons"
                                    :key="lesson.id"
                                >
                                    <th class="text-center">{{ index + 1 }}</th>
                                    <td>
                                        <Link :href="route('lesson.details',lesson.id)">
                                            {{ lesson.title }}
                                        </Link>
                                    </td>
                                    <td>{{ lesson.descriptions }}</td> 

                                    <td class="text-center">
                                        <div class="btn-group">
                                            <Link
                                                type="button"
                                                class="btn btn-sm fs-6"
                                                title="Edit"
                                                :href="
                                                    route(
                                                        'lesson.edit',
                                                        lesson.id
                                                    )
                                                "
                                            >
                                                <i class="bi bi-pencil"></i>
                                            </Link>
                                            <button
                                                type="button"
                                                class="btn btn-sm fs-6"
                                                data-bs-toggle="modal"
                                                data-bs-target="#deleteModal"
                                                title="Delete"
                                                @click="
                                                    passDeleteId(lesson.id)
                                                "
                                            >
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- End Table with stripped rows -->
                </div>
            </div>
        </section>
    </main>
    <!-- End #main -->

    <!-- delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="block-content text-center p-4">
                        <h2>
                            {{ translate("Are you sure?") }}
                        </h2>

                        <button
                            type="button"
                            class="btn btn-sm btn-danger me-2"
                            data-bs-dismiss="modal"
                            @click="deleteThis"
                        >
                            {{ translate("Yes, delete it!") }}
                        </button>

                        <button
                            type="button"
                            class="btn btn-sm btn-dark"
                            data-bs-dismiss="modal"
                        >
                            {{ translate("Close") }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Master from "@/Pages/Backend/Layouts/Master";

export default {
    layout: Master,
    components: {},
    created() {
        this.fetchLessons();
    },
    data() {
        return {
            Lessons: [],
            deleteId: null,
        };
    },
    methods: {
        fetchLessons() {
            axios
                .get(route("api.fetch.lesson"), {
                    headers: {
                        Authorization: "Bearer " + this.$page.props.auth_token,
                    },
                })
                .then((response) => {
                    this.Lessons = response.data;
                })
                .catch((error) => {
                    toastr.error(error.response.data.message);
                });
        },
        passDeleteId(id) {
            this.deleteId = id;
        },
        deleteThis() {
            axios
                .delete(route("api.lesson.delete", this.deleteId), {
                    headers: {
                        Authorization: "Bearer " + this.$page.props.auth_token,
                    },
                })
                .then(() => {
                    toastr.success("Lesson deleted successfully.");
                    this.fetchLessons();
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
