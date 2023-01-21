<template>
    <main id="main" class="main">
        <div class="pagetitle d-flex justify-content-between">
            <div>
                <h1>{{ translate("Scheduled Emails") }}</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <Link :href="route('dashboard')">{{
                                $page.props.website_name
                            }}</Link>
                        </li>
                        <li class="breadcrumb-item active">
                            {{ translate("Scheduled Emails") }}
                        </li>
                    </ol>
                </nav>
            </div>
            <Link class="btn btn-success" :href="route('weekly-report-email')"
                ><i class="bi bi-plus-lg"></i> {{ translate("Add new Email") }}
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
                                    <th scope="col">
                                        {{ translate("Event") }}
                                    </th>
                                    <th scope="col">
                                        {{ translate("Subject") }}
                                    </th>
                                    <th scope="col">
                                        {{ translate("Contents") }}
                                    </th>
                                    <th scope="col">
                                        {{ translate("Day") }}
                                    </th>
                                    <th scope="col">
                                        {{ translate("Time") }}
                                    </th>

                                    <th scope="col" class="text-center">
                                        {{ translate("Action") }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="(email, index) in scheduledEmails"
                                    :key="email.id"
                                >
                                    <th class="text-center">{{ index + 1 }}</th>
                                    <td>{{ email.event }}</td>
                                    <td>{{ email.subject }}</td>
                                    <td> 
                                        <div class="content ql-editor" v-html="email.content"></div>
                                    </td>  
                                    <td>{{ email.day }}</td>
                                    <td>{{ email.time }}</td>

                                    <td class="text-center">
                                        <div class="btn-group">
                                            <Link
                                                type="button"
                                                class="btn btn-sm fs-6"
                                                title="Edit"
                                                :href="
                                                    route('scheduled.emails.edit', email.id)
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
                                                @click="passDeleteId(email.id)"
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
    created() {
        this.fetchCrews();
    },
    data() {
        return {
            scheduledEmails: [],
            deleteId: null,
        };
    },
    methods: {
        fetchCrews() {
            axios
                .get(route("api.fetch.scheduled.emails"), {
                    headers: {
                        Authorization: "Bearer " + this.$page.props.auth_token,
                    },
                })
                .then((response) => {
                    this.scheduledEmails = response.data;
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
                .delete(route("api.scheduled.emails.delete", this.deleteId), {
                    headers: {
                        Authorization: "Bearer " + this.$page.props.auth_token,
                    },
                })
                .then(() => {
                    toastr.success("Scheduled Emails deleted successfully.");
                    this.fetchCrews();
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
