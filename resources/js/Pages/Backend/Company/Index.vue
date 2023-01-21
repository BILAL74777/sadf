<template>
    <main id="main" class="main">
        <div class="pagetitle d-flex justify-content-between">
            <div>
                <h1>{{ translate("Company") }}</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <Link :href="route('dashboard')">{{
                                $page.props.website_name
                            }}</Link>
                        </li>
                        <li class="breadcrumb-item active">
                            {{ translate("Company") }}
                        </li>
                    </ol>
                </nav>
            </div>
            <Link class="btn btn-success" :href="route('company.add')"
                ><i class="bi bi-plus-lg"></i>{{ translate("Add New Company") }}
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
                                    <th scope="col">{{ translate("Name") }}</th>
                                    <th scope="col">{{ translate("RCU") }}</th>
                                    <th scope="col">
                                        {{ translate("Country") }}
                                    </th>
                                    <th scope="col">
                                        {{ translate("State") }}
                                    </th>
                                    <th scope="col">{{ translate("City") }}</th>
                                    <th scope="col">{{ translate("Zip") }}</th>

                                    <th scope="col" class="text-center">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="(company, index) in Companies"
                                    :key="company.id"
                                >
                                    <th class="text-center">{{ index + 1 }}</th>
                                    <td>{{ company.name }}</td>
                                    <td>{{ company.rcu }}</td>
                                    <td>{{ company.country }}</td>
                                    <td>{{ company.state }}</td>
                                    <td>{{ company.city }}</td>
                                    <td>{{ company.zip }}</td>

                                    <td class="text-center">
                                        <div class="btn-group">
                                            <Link
                                                type="button"
                                                class="btn btn-sm fs-6"
                                                title="Edit"
                                                :href="
                                                    route(
                                                        'company.edit',
                                                        company.id
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
                                                    passDeleteId(company.id)
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
    created() {
        this.fetchCompanies();
    },
    data() {
        return {
            Companies: [],
            deleteId: null,
        };
    },
    methods: {
        fetchCompanies() {
            axios
                .get(route("api.fetch.company"), {
                    headers: {
                        Authorization: "Bearer " + this.$page.props.auth_token,
                    },
                })
                .then((response) => {
                    this.Companies = response.data;
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
                .delete(route("api.company.delete", this.deleteId), {
                    headers: {
                        Authorization: "Bearer " + this.$page.props.auth_token,
                    },
                })
                .then(() => {
                    toastr.success("Company deleted successfully.");
                    this.fetchCompanies();
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
