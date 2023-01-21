<template>
    <main id="main" class="main">
        <div class="pagetitle d-flex justify-content-between">
            <div>
                <h1>{{ event.title }}</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <Link :href="route('dashboard')">
                                {{ $page.props.website_name }}
                            </Link>
                        </li>
                        <li class="breadcrumb-item">
                            {{ translate("Companies") }}
                        </li>
                        <li class="breadcrumb-item active">
                            {{ event.title }}
                        </li>
                    </ol>
                </nav>
            </div>
            <div class="btn-group" role="group" aria-label="Basic example">
                <Link class="btn btn-success" :href="route('events')"
                    >{{ translate("Go to all Events") }}
                </Link>
            </div>
        </div>

        <!-- End Page Title -->
        <section class="section">
            <!-- event details code started -->
            <div class="card c-form-card">
                <div class="card-header c-form-card-header">
                    {{ translate("Details") }}
                </div>
                <div class="d-flex justify-content-end p-3">
                    <Link
                        type="button"
                        class="btn btn-sm fs-6"
                        title="Edit"
                        :href="route('events.edit', eventId)"
                    >
                        <i class="bi bi-pencil"></i>
                    </Link>
                </div>
                <div class="col-md-12 p-2">
                    <div class="table-reponsive">
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <th scope="col">
                                        {{ translate("Event name") }}
                                    </th>
                                    <td scope="col">{{ event.title }}</td>
                                </tr>
                                <tr>
                                    <th scope="col">
                                        {{ translate("Start date") }}
                                    </th>
                                    <td scope="col">{{ event.start_date }}</td>
                                </tr>
                                <tr>
                                    <th scope="col">
                                        {{ translate("End date") }}
                                    </th>
                                    <td scope="col">{{ event.end_date }}</td>
                                </tr>

                                <tr>
                                    <th>{{ translate("Description") }}</th>
                                    <td>{{ event.description }}</td>
                                </tr>
                                <tr>
                                    <th>{{ translate("Eligibility") }}</th>
                                    <td>{{ event.eligibility }}</td>
                                </tr>
                                <tr>
                                    <th>{{ translate("Image") }}</th>

                                    <td v-if="event.image != 'http://crm_shahispace.test//storage/'">
                                         
                                        <ImageZooming
                                            :file="event.image"
                                            :width="300"
                                        />
                                    </td>
                                </tr>
                                <tr>
                                    <th>{{ translate("Catalog") }}</th>

                                    <td>
                                        <a
                                            v-if="event.catalog != 'http://crm_shahispace.test//storage/'"
                                            download
                                            :href="event.catalog"
                                            >{{ translate("Download File") }}</a
                                        >
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- <div class="card c-form-card">
                <div class="card-header c-form-card-header">
                    {{ translate("Paticipant films") }}
                </div>

                
                <div class="d-flex justify-content-end p-2">
                    <button
                        v-if="form.id.length > 0"
                        type="button"
                        class="btn btn-success"
                        data-bs-toggle="modal"
                        data-bs-target="#participantSelectRejectModal"
                        :title="translate('Change status')"
                    >
                        {{ translate("Change status") }}
                    </button>
                </div>
                <div class="card">
                    <div class="col-md-12">
                        <div class="table-reponsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">
                                            <input
                                                type="checkbox"
                                                v-model="allSelected"
                                                @change="selectAll"
                                            />
                                        </th>
                                        <th>
                                            {{ translate("Original title") }}
                                        </th>
                                        <th>{{ translate("Lenght") }}</th>
                                        <th>{{ translate("Type") }}</th>
                                        <th>
                                            {{ translate("Director") }}
                                        </th>
                                    </tr>
                                </thead>
 
                                <tbody>
                                    <tr v-for="participant in participants">
                                        <td class="text-center">
                                            <input
                                                type="checkbox"
                                                v-model="form.id"
                                                :value="participant.id"
                                            />
                                        </td>
                                        <td>
                                            <Link
                                                class="fs-6 text-theme"
                                                :title="translate('Details')"
                                                :href="
                                                    route('event.applied.films.details', [participant.film_id,eventId])
                                                "
                                            > 
                                                {{ participant.original_title }}
                                            </Link>
                                        </td>
                                        <td>{{ participant.length }}</td>
                                        <td>{{ participant.type }}</td>
                                        <td>
                                            {{ participant.director }}
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <DeleteModal
                                                    :participantId="
                                                        participant.id
                                                    "
                                                    @deleteParticipant="
                                                        deleteParticipant
                                                    "
                                                ></DeleteModal>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
            </div> -->

            <!-- selected films table starts -->

            <!-- <div class="card c-form-card">
                <div class="card-header c-form-card-header">
                    {{ translate("Selected films") }}
                </div>

                <div class="card">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="ms-5">
                                            {{ translate("Original title") }}
                                        </th>
                                        <th>{{ translate("Lenght") }}</th>
                                        <th>{{ translate("Type") }}</th>
                                        <th>
                                            {{ translate("Director") }}
                                        </th>

                                        <th class="text-center"></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr
                                        v-for="(
                                            participant, index
                                        ) in selected_participants"
                                    >
                                        <td>
                                            <Link
                                                class="fs-6 text-theme"
                                                :title="translate('Details')"
                                                :href="
                                                    route('event.applied.films.details', [participant.film_id,eventId])
                                                "
                                            > 
                                                {{ participant.original_title }}
                                            </Link>
                                        </td>
                                        <td>{{ participant.length }}</td>
                                        <td>{{ participant.type }}</td>
                                        <td>
                                            {{ participant.director }}
                                        </td>

                                        <td class="text-center">
                                            <div class="btn-group">
                                                <DeleteModal
                                                    :deleteId="participant.id"
                                                    @deleteThis="deleteThis"
                                                ></DeleteModal>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
             </div> -->

           
            <!--Status changes model -->
            <!-- <div
                class="modal fade"
                id="participantSelectRejectModal"
                tabindex="-2"
            >
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="block-content text-center p-4">
                                <h2>{{ translate("Change status") }}</h2>

                                <form @submit.prevent="submit">
                                    <div class="row g-3">
                                         <div class="col-12 col-md-12">
                                            <label>{{
                                                translate("Status")
                                            }}</label>
                                            <Multiselect
                                                id="status"
                                                :options="statusOptions"
                                                v-model="form.status"
                                                :searchable="true"
                                                :placeholder="
                                                    translate('Choose status')
                                                "
                                                :class="{
                                                    'invalid-bg':
                                                        formErrors.status,
                                                }"
                                                rows="10"
                                            />

                                            <div
                                                class="invalid-feedback animated fadeIn"
                                                v-if="formErrors.status"
                                            >
                                                {{ formErrors.status[0] }}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-5">
                                        <button
                                            type="submit"
                                            class="btn btn-success"
                                            v-if="formStatus == 'Yes'"
                                        >
                                            {{ translate("Change status") }}
                                        </button>
                                        <button
                                            class="btn btn-success"
                                            type="button"
                                            disabled
                                            v-else
                                        >
                                            {{ translate("Change status") }}
                                            <span
                                                class="spinner-border spinner-border-sm"
                                                role="status"
                                                aria-hidden="true"
                                            ></span>
                                        </button>

                                        <button
                                            type="button"
                                            data-bs-dismiss="modal"
                                            ref="closeBatchModal"
                                            class="btn btn-secondary ms-2"
                                        >
                                            {{ translate("Cancel") }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
        </section>
    </main>
    <!-- End #main -->
</template>

<script>
import Master from "@/Pages/Backend/Layouts/Master";
import Multiselect from "@vueform/multiselect";
export default {
    layout: Master,

    props: ["eventId"],
    components: {
        Multiselect,
    },
    created() {
        this.fetchDetails();
    },
    data() {
        return {
            event: "",
            participants: [],
            selected_participants: [],

            form: {
                status: "",
                id: [],
            },
            formErrors: "",
            formStatus: "Yes",
            statusOptions: ["Select"],
            allSelected: false,
        };
    },
    methods: {
        // async selectAll() {
        //     this.form.status = false;
        //     if (this.allSelected) {
        //         const selected = this.participants.map((u) => u.id);
        //         this.form.id = selected;
        //     } else {
        //         this.form.id = [];
        //     }
        // },
        fetchDetails() {
            axios
                .get(route("api.event-details-fetch", this.eventId), {
                    headers: {
                        Authorization: "Bearer " + this.$page.props.auth_token,
                    },
                })
                .then((response) => {
                    this.event = response.data;
                    // this.participants = response.data.Participants;
                    // this.selected_participants =
                    //     response.data.selected_participants;
                })
                .catch((error) => {
                    toastr.error(error.response.data.message);
                });
        },

        // submit() {
        //     (this.formStatus = "No"),
        //         axios
        //             .post(route("api.participant.status.changer"), this.form, {
        //                 headers: {
        //                     Authorization:
        //                         "Bearer " + this.$page.props.auth_token,
        //                 },
        //             })
        //             .then((response) => {
        //                 toastr.success(
        //                     this.translate("Status changed for participants")
        //                 );
        //                 this.fetchDetails();
        //                 this.allSelected = false;
        //                 this.form.id = [];

        //                 this.formStatus = "Yes";
        //                 this.$refs.closeBatchModal.click();
        //             })
        //             .catch((error) => {
        //                 toastr.error(error.response.data.message);

        //                 this.formStatus = "Yes";
        //                 if (error.response.data.errors) {
        //                     this.formErrors = error.response.data.errors;
        //                 }
        //             });
        // },
        // deleteThis(id) {
        //     axios
        //         .delete(route("api.participant.status.delete", id), {
        //             headers: {
        //                 Authorization: "Bearer " + this.$page.props.auth_token,
        //             },
        //         })
        //         .then(() => {
        //             toastr.success("Status changed successfully.");
        //             this.fetchDetails();
        //         })
        //         .catch((error) => {
        //             toastr.error(error.response.data.message);
        //         });
        // },
        // deleteParticipant(id) {
        //     axios
        //         .delete(route("api.participant.delete", id), {
        //             headers: {
        //                 Authorization: "Bearer " + this.$page.props.auth_token,
        //             },
        //         })
        //         .then(() => {
        //             toastr.success("Participant deleted successfully.");
        //             this.fetchDetails();
        //         })
        //         .catch((error) => {
        //             toastr.error(error.response.data.message);
        //         });
        // },

        setAltImg(event) {
            event.target.src = "/images/default.jpg";
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
</style>
