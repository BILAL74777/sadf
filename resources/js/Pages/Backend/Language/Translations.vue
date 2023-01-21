<template>
    <main id="main" class="main">
        <div class="pagetitle d-flex justify-content-between">
            <div>
                <h1>{{ translate("Translations") }}</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <Link :href="route('dashboard')"
                                >{{ translate("Home") }}
                            </Link>
                        </li>
                        <li class="breadcrumb-item">
                            {{ translate("Languages") }}
                        </li>
                        <li class="breadcrumb-item active">
                            {{ translate("Translations") }}
                        </li>
                    </ol>
                </nav>
            </div>
            <Link class="btn btn-success" :href="route('languages')"
                >{{ translate("Go to Languages") }}
            </Link>
        </div>

        <!-- End Page Title -->
        <section class="section">
            <div class="card">
                <div class="card-body pt-4">
                    <div class="row mb-4 mb-md-0">
                        <div class="col-md">
                            <h5 class="card-title">{{ language.name }}</h5>
                        </div>
                        <div class="col-md d-flex align-items-center">
                            <input
                                type="text"
                                v-on:input="searchTranslations"
                                v-model="searchForm.search"
                                placeholder="Search Translations"
                                class="form-control"
                            />
                        </div>
                    </div>
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th width="45%">
                                    {{ translate("Key") }}
                                </th>
                                <th width="45%">{{ translate("Value") }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="(
                                    translation, index
                                ) in translations.data"
                                :key="translation.id"
                            >
                                <td>{{ index + 1 }}</td>
                                <td>{{ translation.lang_key }}</td>
                                <td>
                                    <input
                                        type="text"
                                        class="form-control"
                                        v-model="
                                            form.values[translation.lang_key]
                                        "
                                    />
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <nav
                        aria-label="Page navigation example"
                        v-if="
                            pagination.next_page_url || pagination.prev_page_url
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
                                                pagination.links.length - 1 &&
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
                                    @click="loadTranslations(links.url)"
                                    v-html="links.label"
                                ></a>
                                <a
                                    v-else
                                    class="page-link"
                                    href="#"
                                    @click="loadTranslations(links.url)"
                                    >{{ links.label }}</a
                                >
                            </li>
                        </ul>
                    </nav>
                    <button @click="submit()" class="btn btn-success mt-3">
                        {{ translate("Save") }}
                    </button>
                    <!-- Floating Labels Form -->
                    <!-- <form @submit.prevent="submit">
                        <div class="row g-3">
                            <div class="col-12 col-md-6">
                                <div class="form-floating">
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="name"
                                        placeholder="Name"
                                        :class="{ 'invalid-bg': formErrors.name }"
                                        v-model="form.name"
                                    />
                                    <label for="name">Name</label>
                                </div>
                                <div
                                    class="invalid-feedback animated fadeIn"
                                    v-if="formErrors.name"
                                >
                                    {{ formErrors.name[0] }}
                                </div>
                            </div>

                            
                            
                            
                        </div>
                    
                   
                        <button type="submit" class="btn btn-success mt-3">
                            Save
                        </button>
                    </form> -->
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
    props: ["language_id"],
    created() {
        this.getLanguage();
        this.loadTranslations();
    },
    data() {
        return {
            form: {
                language_id: this.language_id,
                values: {},
            },
            // formErrors : [],
            language: [],
            translations: [],
            pagination: {},

            searchForm: {
                language_id: this.language_id,
                search: "",
            },
        };
    },
    methods: {
        getLanguage() {
            axios
                .get(route("api.languages.show", this.language_id), {
                    headers: {
                        Authorization: "Bearer " + this.$page.props.auth_token,
                    },
                })
                .then((response) => {
                    this.language = response.data;
                    // this.loadTranslations(this.language.id);
                });
        },
        // loadTranslations(page_url){
        //     page_url = page_url || route('api.admin.translations.show', this.language_id);
        //     axios.get(page_url,
        //     {
        //         headers: {
        //             "Authorization" : 'Bearer ' + this.$page.props.auth_token,
        //         }

        //     }).then((response) => {
        //         console.log(response.data);
        //         this.translations = response.data;
        //         this.makePagination(response.data);
        //         this.form.values['File Name'] = 'asdfasdfas';
        //     });
        // },

        loadTranslations(page_url) {
            let formData = new FormData();
            page_url = page_url || route("api.translations.show");
            formData.append("language_id", this.language_id);
            axios
                .post(page_url, formData, {
                    headers: {
                        Authorization: "Bearer " + this.$page.props.auth_token,
                    },
                })
                .then((response) => {
                    this.translations = response.data;
                    response.data.data.forEach((i) => {
                        this.form.values[i.lang_key] = i.lang_value;
                    });
                    // console.log('this.form.values', this.form.values[0])
                    this.makePagination(response.data);
                });
        },

        makePagination(res) {
            // console.log(res.prev_page_url);
            let pagination = {
                links: res.links,
                current_page: res.current_page,
                last_page: res.last_page,
                next_page_url: res.next_page_url,
                prev_page_url: res.prev_page_url,
            };
            this.pagination = pagination;
        },

        submit() {
            axios
                .post(route("api.translations.store"), this.form, {
                    headers: {
                        Authorization: "Bearer " + this.$page.props.auth_token,
                    },
                })
                .then((data) => {
                    toastr.success("Translations added successfully.");
                })
                .catch((error) => {
                    // console.log(error.response.data);
                    toastr.error(error.response.data.message);
                });
        },
        searchTranslations() {
            axios
                .post(route("api.translations.search"), this.searchForm, {
                    headers: {
                        Authorization: "Bearer " + this.$page.props.auth_token,
                    },
                })
                .then((response) => {
                    this.translations = response.data;
                    response.data.data.forEach((i) => {
                        this.form.values[i.lang_key] = i.lang_value;
                    });
                    this.makePagination(response.data);
                })
                .catch((error) => {
                    toastr.error(error.response.data.message);
                });
        },
    },
};
</script>

<style>
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
