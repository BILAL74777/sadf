<template>
    <main id="main" class="main">
        <div class="pagetitle d-flex justify-content-between">
            <div>
                <h1>{{ translate("Events") }}</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <Link :href="route('dashboard')">{{
                                $page.props.website_name
                            }}</Link>
                        </li>
                        <li class="breadcrumb-item active">
                            {{ translate("Events") }}
                        </li>
                    </ol>
                </nav>
            </div>
            <Link class="btn btn-success" :href="route('events.add')"
                ><i class="bi bi-plus-lg"></i> {{ translate("Add New Event") }}
            </Link>
        </div>
        <!-- End Page Title -->
        <section class="section">
            <div class="card">
                <div class="card-body pt-4">
                    <!-- <h5 class="card-title">Table with stripped rows</h5> -->

                    <!-- Table with stripped rows -->
                    <div class="table-reponsive">
                        <div class="card">
                            <div class="card-body pt-4">
                                <div class="d-flex justify-content-between">
                                    <!-- Floating Labels Form -->
                                   
                                        <div class="row g-3">
                                            <div class="input-group">
                                                <div class="form-outline">
                                                    <input
                                                        type="text"
                                                        v-model="form.title"
                                                         
                                                        class="form-control"
                                                        id="title"
                                                        :placeholder="
                                                            translate(
                                                                'Search event title'
                                                            )
                                                        "
                                                        :class="{
                                                            'invalid-bg':
                                                                formErrors.title,
                                                        }"
                                                    />

                                                    <div
                                                        class="invalid-feedback animated fadeIn"
                                                        v-if="formErrors.title"
                                                    >
                                                        {{
                                                            formErrors.title[0]
                                                        }}
                                                    </div>
                                                    <!-- <label class="form-label" for="form1">Search</label> -->
                                                </div>
                                                <button
                                                @click="search(null)" 
                                                    class="btn btn-success"
                                                >
                                                    <i class="bi bi-search"></i>
                                                </button>

                                                <button
                                                    class="btn"
                                                    type="button"
                                                    v-if="formStatus != 1"
                                                >
                                                    <span
                                                        class="spinner-border spinner-border-sm"
                                                        role="status"
                                                        aria-hidden="true"
                                                    ></span>
                                                </button>
                                            </div>

                                            <!-- <div class="col-12 col-md-6">
                                                            <label for="title">{{ translate("Event title") }}</label>
                                                            <input type="text" class="form-control" id="title"
                                                                :class="{ 'invalid-bg': formErrors.title }" v-model="form.title" />

                                                            <div class="invalid-feedback animated fadeIn" v-if="formErrors.title">
                                                                {{ formErrors.title[0] }}
                                                            </div>
                                                        </div>                                                      -->
                                        </div>
                                    
                                    <!-- End floating Labels Form -->

                                    <!-- <button
                                        type="submit"
                                        class="btn btn-sm btn-success fs-6"
                                        @click="download"
                                        v-if="downloadBtnStatus == 1"
                                    >
                                        {{
                                            translate(
                                                "Download Working Document"
                                            )
                                        }}
                                    </button>
                                    <button
                                        class="btn btn-success"
                                        type="button"
                                        disabled
                                        v-else
                                    >
                                        {{
                                            translate(
                                                "Download Working Document"
                                            )
                                        }}
                                        <span
                                            class="spinner-border spinner-border-sm"
                                            role="status"
                                            aria-hidden="true"
                                        ></span>
                                    </button> -->
                                </div>
                            </div>
                        </div>

                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-center">#</th>
                                    <th scope="col">
                                        {{ translate("Event title") }}
                                    </th>
                                    <th scope="col">
                                        {{ translate("Event start date") }}
                                    </th>
                                    <th scope="col">
                                        {{ translate("Event end date") }}
                                    </th>

                                    <th scope="col" class="text-center">
                                        {{ translate("Actions") }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="(event, index) in events"
                                    :key="event.id"
                                >
                                    <th class="text-center">{{ index + 1 }}</th>
                                    <td>
                                        <Link
                                            class="fs-6 text-theme"
                                            :title="translate('Details')"
                                            :href="
                                                route('event.details', event.id)
                                            "
                                        >
                                            {{ event.title }}
                                        </Link>
                                    </td>
                                    <td>{{ event.start_date }}</td>
                                    <td>{{ event.end_date }}</td>

                                    <td class="text-center">
                                        <div class="d-flex">
                                            <div class="d-inline-block me-2">
                                                {{ translate("Off") }}
                                            </div>
                                            <div
                                                class="form-check form-switch d-inline-block"
                                            >
                                                <input
                                                    class="form-check-input"
                                                    type="checkbox"
                                                    :class="{
                                                        'invalid-bg':
                                                            formErrors.status,
                                                    }"
                                                    v-model="event.status"
                                                    checked
                                                    @change="
                                                        statusChanage(
                                                            event.id,
                                                            event.status
                                                        )
                                                    "
                                                />
                                                <label
                                                    class="form-check-label"
                                                    >{{
                                                        translate("On")
                                                    }}</label
                                                >
                                            </div>

                                            <div
                                                class="invalid-feedback animated fadeIn"
                                                v-if="formErrors.status"
                                            >
                                                {{ formErrors.status[0] }}
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <!-- <nav
                            aria-label="Page navigation example"
                            v-if="
                                pagination.next_page_url ||
                                pagination.prev_page_url
                            "
                        >
                            <ul class="pagination">
                                <li
                                    class="page-item"
                                    v-for="(links, index) in pagination.links"
                                    :key="index"
                                    :class="[
                                        { active: links.active },
                                        {
                                            disabled:
                                                index == 0 &&
                                                !pagination.prev_page_url,
                                        },
                                        {
                                            disabled:
                                                index ==
                                                    pagination.links.length -
                                                        1 &&
                                                !pagination.next_page_url,
                                        },
                                    ]"
                                >
                                    <a
                                        v-if="
                                            index == 0 ||
                                            index == pagination.links.length - 1
                                        "
                                        class="page-link"
                                        href="#"
                                        @click="search(links.url)"
                                        v-html="links.label"
                                    ></a>
                                    <a
                                        v-else
                                        class="page-link"
                                        href="#"
                                        @click="search(links.url)"
                                        >{{ links.label }}</a
                                    >
                                </li>
                            </ul>
                        </nav> -->
                        <div class="text-center">
                            <button v-if="pagination.next_page_url" @click="search(pagination.next_page_url)" class="btn btn-success">{{translate("Load More")}}</button>
                        </div>
                    </div>
                    <!-- End Table with stripped rows -->
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
    created() {
        this.search(this.default_url);
    },
    data() {
        return {
            default_url: route("api.event.search"),
            events: [],
            deleteId: null,

            form: {
                title: "",
                status: "",
            },
            // event object is used for to updated directly status from the index page.
            event: {
                status: [],
            },
            formErrors: [],
            formStatus: 1,
            downloadBtnStatus: 1,
            events_ids: [],
            pagination: {},
            firstTimeLoadCheck:0,
        };
    },
    methods: {
        makePagination(res) { 
            let pagination = {
                links: res.links,
                current_page: res.current_page,
                last_page: res.last_page,
                next_page_url: res.next_page_url,
                prev_page_url: res.prev_page_url,
            }; 
            this.pagination = pagination;
        },

        search(page_url) {
            // if no page url then it means that search button is clicked
             if (!page_url) {
                this.firstTimeLoadCheck = 1;
             }
             page_url = page_url || this.default_url;

            this.formStatus = 0;
            // this.formStatus = 0;
            let formData = new FormData();
 
            if (this.form.title == null) {
                formData.append("title", "");
            } else {
                formData.append("title", this.form.title);
            }
            // formData.append("status", this.form.status);

            axios
                .post(page_url, formData, {
                    headers: {
                        Authorization: "Bearer " + this.$page.props.auth_token,
                    },
                })
                .then((response) => {
                    this.formStatus = 1;
                    
                    if(this.firstTimeLoadCheck == 1)
                    {
                        this.events = response.data.events.data;
                        this.events_ids = response.data.events_ids;
                        toastr.success("Event searched successfully.");
                        this.firstTimeLoadCheck = 0;
                    }else{
                        this.events = this.events.concat(response.data.events.data);
                        this.events_ids = this.events_ids.concat(response.data.events_ids);
                    }

                    this.makePagination(response.data.events);
                })
                .catch((error) => {
                    this.formStatus = 1;
                    toastr.error(error.response.data.message);
                    if (error.response.data.errors) {
                        this.formErrors = error.response.data.errors;
                    }
                });
        },

        // download() {
        //     this.downloadBtnStatus = 0;
        //     axios
        //         .post(route("api.events.download"), this.events_ids, {
        //             headers: {
        //                 Authorization: "Bearer " + this.$page.props.auth_token,
        //             },
        //         })
        //         .then((response) => {
        //             this.downloadBtnStatus = 1;
        //             toastr.success("Event list downloaded.");
        //             window.location.href = response.data; 
        //         })
        //         .catch((error) => {
        //             this.downloadBtnStatus = 1;
        //             toastr.error(error.response.data.message);
        //         });
        // },
        statusChanage(event_id, event_status) {
            let formData = new FormData();
            formData.append("event_id", event_id);
            formData.append("status", event_status);

            axios
                .post(route("api.events.status.change"), formData, {
                    headers: {
                        Authorization: "Bearer " + this.$page.props.auth_token,
                    },
                })
                .then((response) => {
                    toastr.success("Status changed successfully.");
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
.pagination .page-item.active .page-link {
    background-color: #8b2d88 !important;
    border-color: #8b2d88 !important;
    z-index: 3;
    color: white !important;
}
.pagination .page-link {
    color: #8b2d88 !important;
}
</style>
