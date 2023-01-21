<template>
    <!-- ======= events Section ======= -->
    <section id="events" class="services section-bg">
        <div class="container" data-aos="fade-up">
            <div class="section-title">
                <h2 class="c-theme-yellow">
                    {{ translate("Things Happening") }}
                </h2>
            </div>
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <div
                v-for="(event) in Events"
                    :key="event.id"
                    class="col"
                    data-aos="zoom-in"
                    data-aos-delay="200"
                    data-bs-toggle="modal"
                    data-bs-target="#detailsModal"
                    title="Details"
                    @click="fetchEventDetails(event.id)">
                    <div class="card h-100">
                        <img v-if="event.image" :src="event.image" class="card-img-top" alt="..." />
                        <div class="card-body">
                            <h5 class="card-title">{{ event.title }}</h5>
                            <!-- <p class="card-text">
                                This is a wider card with supporting text below
                                as a natural lead-in to additional content. This
                                content is a little bit longer.
                            </p> -->
                        </div>
                        <div class="card-footer">
                            <small class="text-muted"
                                >From :
                            {{ event.start_date }}
                            <br />
                            To :
                            {{ event.end_date }}</small
                            >
                        </div>
                    </div>
                </div>
            </div>


            
        </div>
    </section>

    <!-- Event Details Modal -->
    <div class="modal fade" id="detailsModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="block-content p-4">
                        <h3>{{ eventDetails.title }}</h3>

                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button
                                    class="nav-link active"
                                    id="home-tab"
                                    data-bs-toggle="tab"
                                    data-bs-target="#description"
                                    type="button"
                                    role="tab"
                                    aria-controls="home"
                                    aria-selected="true"
                                >
                                    CALL FOR SUBMISSIONS
                                </button>
                            </li>
                            <!-- <li class="nav-item" role="presentation">
                                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#eligibility" type="button" role="tab" aria-controls="profile" aria-selected="false">Eligibility</button>
                            </li> -->
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div
                                class="tab-pane fade show active"
                                id="description"
                                role="tabpanel"
                                aria-labelledby="home-tab"
                            >
                                {{ eventDetails.description }}
                            </div>
                            <div
                                class="tab-pane fade"
                                id="eligibility"
                                role="tabpanel"
                                aria-labelledby="profile-tab"
                            >
                                {{ eventDetails.eligibility }}
                            </div>
                        </div>

                        <p>
                            <br />
                            <strong>From :</strong>
                            {{ eventDetails.start_date }}

                            <br />
                            <strong>To :</strong>
                            {{ eventDetails.end_date }}
                        </p>

                        <button
                            type="button"
                            class="btn btn-sm btn-success me-2"
                            data-bs-dismiss="modal"
                            data-bs-toggle="modal"
                            data-bs-target="#RegModal"
                            title="Details"
                            @click="
                                EventRegistraionId(
                                    eventDetails.id,
                                    eventDetails.title,
                                    eventDetails.start_date,
                                    eventDetails.end_date
                                )
                            "
                        >
                            {{ translate("Register") }}
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

    <!-- Info About Registration Model -->
    <div class="modal fade" id="RegModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="block-content p-4">
                        <h5>{{ translate("Please fill out the form") }}</h5>
                        <!-- Floating Labels Form -->
                        <form @submit.prevent="submit">
                            <div class="row g-3">
                                <div class="col-12 col-md-12">
                                    <label>{{ translate("Name") }}</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="name"
                                        :class="{
                                            'invalid-bg': formErrors.name,
                                        }"
                                        v-model="form.name"
                                    />

                                    <div
                                        class="invalid-feedback animated fadeIn"
                                        v-if="formErrors.name"
                                    >
                                        {{ formErrors.name[0] }}
                                    </div>
                                </div>

                                <div class="col-12 col-md-12">
                                    <label>{{ translate("Email") }}</label>
                                    <input
                                        type="email"
                                        class="form-control"
                                        id="email"
                                        :class="{
                                            'invalid-bg': formErrors.email,
                                        }"
                                        v-model="form.email"
                                    />

                                    <div
                                        class="invalid-feedback animated fadeIn"
                                        v-if="formErrors.email"
                                    >
                                        {{ formErrors.email[0] }}
                                    </div>
                                </div>

                                <div class="col-12 col-md-12">
                                    <label>{{ translate("Role") }} </label>
                                    <Multiselect
                                        id=""
                                        v-model="form.role"
                                        :options="event_roles"
                                        :searchable="true"
                                        :class="{
                                            'invalid-bg': formErrors.role,
                                        }"
                                    />
                                    <div
                                        class="invalid-feedback animated fadeIn"
                                        v-if="formErrors.role"
                                    >
                                        {{ formErrors.role[0] }}
                                    </div>
                                </div>
                            </div>

                            <div class="mt-5 text-center">
                                <button
                                    v-if="formStatus == 'Yes'"
                                    type="submit"
                                    class="btn btn-success"
                                >
                                    {{ translate("Submit") }}
                                </button>
                                <button
                                    class="btn btn-success"
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

                                <button
                                    type="button"
                                    class="btn btn-dark ms-3"
                                    data-bs-dismiss="modal"
                                    ref="RegModalClose"
                                >
                                    {{ translate("Close") }}
                                </button>
                            </div>
                        </form>
                        <!-- End floating Labels Form -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Multiselect from "@vueform/multiselect";
export default {
    created() {
        this.fetchEvents();
        // this.fetchDropdowns();
    },
    components: {
        Multiselect,
    },
    data() {
        return {
            Events: [],
            eventDetails: [],
            eventId: null,

            form: {
                name: "",
                email: "",
                role: "",
                eventRegId: "",
                eventTitle: "",
                eventStartDate: "",
                eventEndDate: "",
            },

            event_roles: [],
            event_roles: ['Film director', 'Producer', 'Legal owner', 'Film Representative'],
            formErrors: [],
            formStatus: "Yes",
        };
    },
    methods: {
        fetchEvents() {
            axios
                .get(route("api.active-events.fetch"), {
                    headers: {
                        Authorization: "Bearer " + this.$page.props.auth_token,
                    },
                })
                .then((response) => {
                    this.Events = response.data;
                })
                .catch((error) => {
                    toastr.error(error.response.data.message);
                });
        },

        fetchEventDetails(id) {
            axios
                .get(route("api.events.show", id), {
                    headers: {
                        Authorization: "Bearer " + this.$page.props.auth_token,
                    },
                })
                .then((response) => {
                    this.eventDetails = response.data;
                })
                .catch((error) => {
                    toastr.error(error.response.data.message);
                });
        },

        // fetchDropdowns() {
        //     axios
        //         .get(route("api.films.dropdowns.fetch"), {
        //             headers: {
        //                 Authorization: "Bearer " + this.$page.props.auth_token,
        //             },
        //         })
        //         .then((res) => {
        //             this.event_roles =
        //                 res.data.dropdown_options_list.event_roles;
        //         });
        // },

        EventRegistraionId(id, title, start_date, end_date) {
            this.form.eventRegId = id;
            this.form.eventTitle = title;
            this.form.eventStartDate = start_date;
            this.form.eventEndDate = end_date;
        },

        submit() { 
            this.formStatus = "No";
            axios
                .post(route("api.role.registeration"), this.form, {
                    headers: {
                        Authorization: "Bearer " + this.$page.props.auth_token,
                    },
                })
                .then(() => {
                    toastr.success(
                        // this.translate("Email sent please check to verify.")
                        this.translate("Registered for the event successfully.")
                    );
                    this.$refs.RegModalClose.click();
                    this.formStatus = "Yes";
                    this.form.name = "";
                    this.form.email = "";
                    this.form.role = "";
                    this.formErrors = [];
                    
                        this.$inertia.get(route("/"));
                })
                .catch((error) => {
                    toastr.error(error.response.data.message);
                    this.formStatus = "Yes";

                    if (error.response.data.errors) {
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

.c-cursor-pointer {
    cursor: pointer;
}
#events {
    background: black;
}
.c-theme-yellow {
    color: #f5ce34 !important;
}
.section-title h2::after {
    background: #f5ce34 !important;
}
</style>
