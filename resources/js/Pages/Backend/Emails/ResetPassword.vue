<template>
    <main id="main" class="main bg-light">
        <div class="pagetitle d-flex justify-content-between">
            <div>
                <h1>{{ translate("Reset email") }}</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <Link :href="route('dashboard')">{{
                                $page.props.website_name
                            }}</Link>
                        </li>
                        <li class="breadcrumb-item">
                            {{ translate("Reset email") }}
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <QuillEditor
            v-model:content="dataProperty"
            contentType="html"
            toolbar="full"
            theme="snow"
        />
        <button @click="show" class="btn btn-success mt-2">Save</button>
        <div class="content ql-editor" v-html="shoeDescriptions"></div>
    </main>
</template>
<script>
import { QuillEditor } from "@vueup/vue-quill";
import "@vueup/vue-quill/dist/vue-quill.snow.css";
import Master from "@/Pages/Backend/Layouts/Master";

export default {
    layout: Master,
    components: {
        QuillEditor,
    },
    created() {
        this.fetchRecord();
    },
    data() {
        return {
            dataProperty: "",
            shoeDescriptions: "",
        };
    },
    methods: {
        show() {
            let formData = new FormData();
            formData.append("dataProperty", this.dataProperty);

            axios
                .post(route("api.reset.password.email.store"), formData, {
                    headers: {
                        Authorization: "Bearer " + this.$page.props.auth_token,
                    },
                })
                .then((data) => {
                    this.dataProperty = "";
                    toastr.success("Record updated successfully.");
                    this.fetchRecord();
                })
                .catch((error) => {
                    toastr.error(error.response.data.message);

                    if (error.response.data.errors) {
                        this.formErrors = error.response.data.errors;
                    }
                });
        },

        fetchRecord() {
            axios
                .get(route("api.reset.email.fetch"), {
                    headers: {
                        Authorization: "Bearer " + this.$page.props.auth_token,
                    },
                })
                .then((response) => {
                    this.dataProperty = "";
                    const myJSON = JSON.parse(response.data.value);
                    this.shoeDescriptions = myJSON[0].description;
                    this.dataProperty = myJSON[0].description;
                })
                .catch((error) => {
                    toastr.error(error.response.data.message);
                });
        },
    },
};
</script>
