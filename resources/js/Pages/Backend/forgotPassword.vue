<template>
    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect" />
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet"
    />

    <main>
        <div class="container">
            <section
                class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4"
            >
                <div class="container">
                    <div class="row justify-content-center">
                        <div
                            class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center"
                        >
                            <div class="d-flex justify-content-center py-4">
                                <a
                                    href="index.html"
                                    class="logo d-flex align-items-center w-auto"
                                >
                                    <!-- <img src="/backend/assets/img/logo.png" alt="" /> -->
                                    <span class="d-none d-lg-block"
                                        >Portfolio Cast</span
                                    >
                                </a>
                            </div>
                            <!-- End Logo -->

                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="pt-4 pb-2">
                                        <h5
                                            class="card-title text-center pb-0 fs-4"
                                        >
                                            {{
                                                translate(
                                                    " Forgot Your Password"
                                                )
                                            }}
                                        </h5>
                                        <p class="text-center small"></p>
                                    </div>

                                    <form
                                        class="row g-3"
                                        @submit.prevent="submit"
                                    >
                                        <div class="col-12">
                                            <label
                                                for="email"
                                                class="form-label"
                                                >{{ translate("Email") }}</label
                                            >
                                            <input
                                                type="email"
                                                class="form-control"
                                                :class="{
                                                    'invalid-bg':
                                                        formErrors.email,
                                                }"
                                                id="email"
                                                v-model="form.email"
                                                :placeholder="
                                                    translate('Email')
                                                "
                                                autocomplete="current-email"
                                            />
                                            <div
                                                v-if="formErrors.email"
                                                class="invalid-feedback"
                                            >
                                                {{ formErrors.email[0] }}
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="mt-5">
                                                <button
                                                    v-if="formStatus == 'Yes'"
                                                    class="btn btn-success w-100"
                                                    type="submit"
                                                >
                                                    {{
                                                        translate("Send Email")
                                                    }}
                                                </button>

                                                <button
                                                    class="btn btn-success w-100"
                                                    type="submit"
                                                    disabled
                                                    v-else
                                                >
                                                    {{
                                                        translate("Send Email")
                                                    }}
                                                    <span
                                                        class="spinner-border spinner-border-sm"
                                                        role="status"
                                                        aria-hidden="true"
                                                    ></span>
                                                </button>
                                            </div>
                                        </div>
                                    </form>

                                    <Link :href="route('login')">
                                        {{ translate("Login") }}
                                    </Link>
                                </div>
                            </div>

                            <div class="credits">
                                <!-- All the links in the footer should remain intact. -->
                                <!-- You can delete the links only if you purchased the pro version. -->
                                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
                                <!-- Designed by
                                <a href="https://bootstrapmade.com/"
                                    >BootstrapMade</a
                                > -->
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
    <!-- End #main -->
</template>

<script>
export default {
    data() {
        return {
            form: {
                email: "",
            },
            formStatus: "Yes",
            formErrors: [],
        };
    },
    methods: {
        submit() {
            this.formStatus = "No";
            axios
                .post(route("api.forgot-password"), this.form)
                .then(() => {
                    toastr.success(
                        "Email sent to your email address please check your email."
                    );
                    this.$inertia.get(route("login"));
                })
                .catch((error) => {
                    this.formStatus = "Yes";
                    if (error.response.data.errors) {
                        this.formErrors = error.response.data.errors;
                    }
                });
        },
    },
};
</script>

<style scoped>
@import "~/backend/assets/vendor/bootstrap/css/bootstrap.min.css";
@import "~/backend/assets/vendor/bootstrap-icons/bootstrap-icons.css";
@import "~/backend/assets/vendor/remixicon/remixicon.css";
@import "~/backend/assets/vendor/boxicons/css/boxicons.min.css";
@import "~/backend/assets/vendor/quill/quill.snow.css";
@import "~/backend/assets/vendor/quill/quill.bubble.css";
@import "~/backend/assets/vendor/simple-datatables/style.css";
@import "~/backend/assets/css/style.css";
@import "toastr";

.invalid-feedback {
    display: block;
}
.invalid-bg {
    border-color: #f8d4d4 !important;
    background-color: #f8d4d4 !important;
}
</style>
