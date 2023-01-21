<template>
    <main id="main" class="main">
        <div class="pagetitle d-flex justify-content-between">
            <div>
                <h1>{{ translate("Collector") }}</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <Link :href="route('dashboard')">{{
                                $page.props.website_name
                            }}</Link>
                        </li>
                        <li class="breadcrumb-item active">
                            {{ translate("Collector") }}
                        </li>
                    </ol>
                </nav>
            </div>
            <Link class="btn btn-success" :href="route('collector.add')"
                ><i class="bi bi-plus-lg"></i
                >{{ translate("Add New Collector") }}
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
                                        {{ translate("Company") }}
                                    </th>
                                    <th scope="col">
                                        {{ translate("Amount") }}
                                    </th>
                                    <th scope="col">{{ translate("Date") }}</th>
                                    <th scope="col">
                                        {{ translate("Status") }}
                                    </th>

                                    <th scope="col" class="text-center">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="(collector, index) in collectors"
                                    :key="collector.id"
                                >
                                    <th class="text-center">{{ index + 1 }}</th>
                                    <td>{{ collector.company }}</td>
                                    <td>
                                        {{ collector.amount }}
                                        <!-- <input type="text" id="donation_{{ $iteration }}" :value="collector.amount"/> -->
                                        <input
                                            type="hidden"
                                            id="collection_id"
                                            :value="collector.id"
                                        />
                                        <input
                                            type="hidden"
                                            id="amount"
                                            :value="collector.amount"
                                        />
                                        <input
                                            type="hidden"
                                            id="company"
                                            :value="collector.company"
                                        />
                                    </td>
                                    <td>{{ collector.date }}</td>
                                    <td>{{ collector.status }}</td>

                                    <td class="text-center">
                                        <div class="btn-group">
                                            <button
                                                type="button"
                                                class="btn btn-sm fs-6"
                                                data-bs-toggle="modal"
                                                data-bs-target="#deleteModal"
                                                title="Delete"
                                                @click="
                                                    passDeleteId(collector.id)
                                                "
                                            >
                                                <i class="bi bi-trash"></i>
                                            </button>

                                            <Link
                                                type="button"
                                                class="btn btn-sm fs-6"
                                                title="Edit"
                                                :href="
                                                    route(
                                                        'collector.edit',
                                                        collector.id
                                                    )
                                                "
                                            >
                                                <i class="bi bi-link"></i>
                                            </Link>

                                            <Link
                                                type="button"
                                                class="btn btn-sm"
                                                title="Edit"
                                                id="paypal-button-container"
                                            >
                                            </Link>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <Link
                        type="button"
                        class="btn btn-sm fs-6 btn-success"
                        title="Edit"
                        :href="
                            route(
                                'send-collection.email',
                                '969cabea-11a3-4e58-951c-be69ab8aeb46'
                            )
                        "
                    >
                        <i>Email Sent</i>
                    </Link>
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
        this.fetchcollectors();
    },
    props: ["message"],
    data() {
        return {
            collectors: [],
            deleteId: null,
        };
    },

    methods: {
        fetchcollectors() {
            axios
                .get(route("api.fetch.collector"), {
                    headers: {
                        Authorization: "Bearer " + this.$page.props.auth_token,
                    },
                })
                .then((response) => {
                    this.collectors = response.data;
                })
                .catch((error) => {
                    toastr.error(error.response.data.message);
                });
            if (this.message) {
                toastr.success(this.message);
            }
        },
        passDeleteId(id) {
            this.deleteId = id;
        },
        deleteThis() {
            axios
                .delete(route("api.collector.delete", this.deleteId), {
                    headers: {
                        Authorization: "Bearer " + this.$page.props.auth_token,
                    },
                })
                .then(() => {
                    toastr.success("Collector deleted successfully.");
                    this.fetchcollectors();
                })
                .catch((error) => {
                    toastr.error(error.response.data.message);
                });
        },
    },
};
paypal
    .Buttons({
        createOrder: function (data, actions) {
            var amounts = document.getElementById("amount").value;
            return actions.order.create({
                purchase_units: [
                    {
                        amount: {
                            value: amounts,
                        },
                    },
                ],
            });
        },
        onApprove: function (data, actions) {
            // console.log(data);
            return actions.order.capture().then(function (details) {
                var amounts = document.getElementById("amount").value;
                var company = document.getElementById("company").value;
                var collection_id =
                    document.getElementById("collection_id").value;

                // window.location.href='/save_order/'+amounts+'/'+company+'/'+details.status+'/'+details.payer.email_address+'/'+details.payer.name.given_name + ' ' + details.payer.name.surname+'/'+details.payer.payer_id+'/'+details.tansaction_id;

                window.location.href =
                    "/save_order/" +
                    amounts +
                    "/" +
                    company +
                    "/" +
                    collection_id +
                    "/" +
                    details.status +
                    "/" +
                    details.payer.email_address +
                    "/" +
                    details.payer.name.given_name +
                    " " +
                    details.payer.name.surname +
                    "/" +
                    details.payer.payer_id +
                    "/" +
                    details.tansaction_id;
            });
        },
    })
    .render("#paypal-button-container");
</script>

<style>
.table td,
.table th {
    vertical-align: middle;
}
</style>
