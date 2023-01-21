<template>
    <main id="main" class="main">
        <div class="pagetitle d-flex justify-content-between">
            <div>
                <h1>{{ translate("Add New Collector") }}</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <Link :href="route('dashboard')">{{
                                $page.props.website_name
                            }}</Link>
                        </li>
                        <li class="breadcrumb-item">
                            {{ translate("Collector") }}
                        </li>
                        <li class="breadcrumb-item active">
                            {{ translate("Add New Collector") }}
                        </li>
                    </ol>
                </nav>
            </div>
            <Link class="btn btn-success" :href="route('collector')">{{
                translate("Go To Collector")
            }}</Link>
        </div>

        <!-- End Page Title -->
        <section class="section">
            <div class="card">
                <div class="card-body pt-4">
                    <!-- <h5 class="card-title">Add New Collector</h5> -->

                    <!-- Floating Labels Form -->
                    <form @submit.prevent="submit">
                        <div class="row g-3">
                            <div class="col-12 col-md-6">
                                <label for="stats">{{
                                    translate("Choose Status")
                                }}</label>
                                <div class="form-check form-switch">
                                    <input
                                        class="form-check-input"
                                        type="checkbox"
                                        :class="{
                                            'invalid-bg': formErrors.status,
                                        }"
                                        v-model="form.status"
                                        checked
                                    />
                                </div>

                                <div
                                    class="invalid-feedback animated fadeIn"
                                    v-if="formErrors.status"
                                >
                                    {{ formErrors.status[0] }}
                                </div>
                            </div>

                            <div class="col-12 col-md-12">
                                <label for="name">{{
                                    translate("   Name")
                                }}</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="company"
                                    :class="{
                                        'invalid-bg': formErrors.company,
                                    }"
                                    v-model="form.company"
                                />

                                <div
                                    class="invalid-feedback animated fadeIn"
                                    v-if="formErrors.company"
                                >
                                    {{ formErrors.company[0] }}
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <label for="amount">{{
                                    translate("Amount")
                                }}</label>
                                <input
                                    type="amount"
                                    class="form-control"
                                    id="amount"
                                    :class="{ 'invalid-bg': formErrors.amount }"
                                    v-model="form.amount"
                                />

                                <div
                                    class="invalid-feedback animated fadeIn"
                                    v-if="formErrors.amount"
                                >
                                    {{ formErrors.amount[0] }}
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <label for="amount">{{
                                    translate("Date")
                                }}</label>
                                <input
                                    type="date"
                                    class="form-control"
                                    id="date"
                                    :class="{ 'invalid-bg': formErrors.date }"
                                    v-model="form.date"
                                />

                                <div
                                    class="invalid-feedback animated fadeIn"
                                    v-if="formErrors.date"
                                >
                                    {{ formErrors.date[0] }}
                                </div>
                            </div>
                        </div>
                        <div class="mt-5">
                            <button
                                type="submit"
                                class="btn btn-success"
                                v-if="formStatus == 'Yes'"
                            >
                                {{ translate("Save") }}
                            </button>
                            <button
                                class="btn btn-success"
                                type="button"
                                disabled
                                v-else
                            >
                                {{ translate("Save") }}
                                <span
                                    class="spinner-border spinner-border-sm"
                                    role="status"
                                    aria-hidden="true"
                                ></span>
                            </button>
                        </div>
                    </form>
                    <!-- End floating Labels Form -->
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
    created() {},

    components: {},
    data() {
        return {
            form: {
                company: "",
                amount: "",
                date: "",
                status: "",
            },
            formErrors: [],
            formStatus: "Yes",
        };
    },
    methods: {
        submit() {
            this.formStatus = "No";
            let formData = new FormData();
            if (this.form.company == null) {
                formData.append("company", "");
            } else {
                formData.append("company", this.form.company);
            }
            if (this.form.amount == null) {
                formData.append("amount", "");
            } else {
                formData.append("amount", this.form.amount);
            }
            if (this.form.date == null) {
                formData.append("date", "");
            } else {
                formData.append("date", this.form.date);
            }
            if (this.form.status == null) {
                formData.append("status", "");
            } else {
                formData.append("status", this.form.status);
            }
            axios
                .post(route("api.collector.store"), formData, {
                    headers: {
                        Authorization: "Bearer " + this.$page.props.auth_token,
                    },
                })
                .then((data) => {
                    toastr.success("Collector added successfully.");
                    this.$inertia.get(route("collector"));
                })
                .catch((error) => {
                    toastr.error(error.response.data.message);

                    if (error.response.data.errors) {
                        this.formStatus = "Yes";
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
</style>
