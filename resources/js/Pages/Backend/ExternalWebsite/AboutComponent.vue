<template>
    <div>
        <div class="card c-form-card">
            <div class="card-header c-form-card-header">
                {{ translate("Hero Section") }}
            </div>
            <div class="card-body pt-4">
                <!-- <h5 class="card-title">Add New FAQ</h5> -->

                <!-- Floating Labels Form -->
                <form @submit.prevent="submit">
                    <div class="row g-3">
                        <div class="col-12 col-md-6">
                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control"
                                    id="hero_title"
                                    placeholder="Title"
                                    :class="{
                                        'invalid-bg': formErrors.hero_title,
                                    }"
                                    v-model="form.hero_title"
                                />
                                <label for="hero_title"
                                    >{{ translate("Title") }}
                                </label>
                            </div>
                            <div
                                class="invalid-feedback animated fadeIn"
                                v-if="formErrors.hero_title"
                            >
                                {{ formErrors.hero_title[0] }}
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-floating">
                                <textarea
                                    class="form-control"
                                    id="description"
                                    placeholder="Answer"
                                    :class="{
                                        'invalid-bg': formErrors.description,
                                    }"
                                    v-model="form.description"
                                    rows="6"
                                    style="height: 100px"
                                >
                                </textarea>
                                <label for="description">{{
                                    translate("Description")
                                }}</label>
                            </div>
                            <div
                                class="invalid-feedback animated fadeIn"
                                v-if="formErrors.description"
                            >
                                {{ formErrors.description[0] }}
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success mt-3">
                        {{ translate("Save") }}
                    </button>
                </form>
                <!-- End floating Labels Form -->
            </div>
        </div>
    </div>
</template>

<script>
// import Master from "@/Pages/Backend/Layouts/Master";
export default {
    // layout: Master,
    emits: ["refetchParentDetails"],
    created() {
        this.fetchHero();
    },
    data() {
        return {
            formStatus: "Yes",
            formErrors: [],

            form: {
                hero_title: "",
                description: null,
            },
        };
    },
    methods: {
        submit() {
            axios
                .post(route("api.hero.store"), this.form, {
                    headers: {
                        Authorization: "Bearer " + this.$page.props.auth_token,
                    },
                })
                .then((data) => {
                    toastr.success("Hero section updated successfully.");
                    this.$emit("refetchParentDetails");
                })
                .catch((error) => {
                    toastr.error(error.response.data.message);

                    if (error.response.data.errors) {
                        this.formErrors = error.response.data.errors;
                    }
                });
        },

        fetchHero() {
            axios
                .get(route("api.fetch.hero"), {
                    headers: {
                        Authorization: "Bearer " + this.$page.props.auth_token,
                    },
                })
                .then((response) => {
                    const myJSON = JSON.parse(response.data.value);
                    
                    this.form.hero_title = myJSON[0].title;
                    this.form.description = myJSON[0].description;
                })
                .catch((error) => {
                    toastr.error(error.response.data.message);
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

.remove-status {
    margin-left: 15px !important;
    margin-top: 5px !important;
}
</style>
