<template>

    <!-- ======= Cta Section ======= -->
    <section id="quiz-section">
        <div class="container" data-aos="zoom-in">
            <div class="row">
                <div class="col-lg-9 text-center text-lg-start">
                     
                </div>
                <div class="col-lg-7 mt-5 mt-lg-0 d-flex align-items-stretch">
                    <form @submit.prevent="submit" class="php-email-form">
                     
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">{{translate('First name')}}</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    :class="{ 'invalid-bg': formErrors.first_name }"
                                     v-model="form.first_name"
                                />
                                <div
                                    class="invalid-feedback animated fadeIn"
                                    v-if="formErrors.first_name"
                                >
                                    {{ formErrors.first_name[0] }}
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">{{translate('Last name')}}</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    :class="{ 'invalid-bg': formErrors.last_name }"
                                     v-model="form.last_name"
                                />
                                <div
                                    class="invalid-feedback animated fadeIn"
                                    v-if="formErrors.last_name"
                                >
                                    {{ formErrors.last_name[0] }}
                                </div>
                            </div>

                            <div class="col-md-12 mb-6">
                                <label class="form-label">Your Email</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    :class="{ 'invalid-bg': formErrors.email }"
                                    v-model="form.email"
                                />
                                <div
                                    class="invalid-feedback animated fadeIn"
                                    v-if="formErrors.email"
                                >
                                    {{ formErrors.email[0] }}
                                </div>
                            </div>
                        </div>

                        

                        
                        <div class="text-center">
                            <button type="submit"   class="btn mt-4 btn-success">
                                {{translate('Send Message')}}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>


</template>
<script>
export default { 
    created() {
        // this.fatchCatalogs();
    },

    data() {
        return {
            form: {
                first_name: "",
                last_name: "",
                email: "", 
            },
            formErrors:[],
        };
    },
    methods: {
         
        submit() { 
            axios
                .post(route("api.quiz.apply"), this.form, {
                    headers: {
                        Authorization: "Bearer " + this.$page.props.auth_token,
                    },
                })
                .then((data) => {
                    
                    toastr.success("Message sent successfully.");
                    this.form = {
                        first_name: "",
                        last_name: "",
                        email: "" 
                    };
                    this.formErrors = []; 
                    
                })
                .catch((error) => { 
                    toastr.error(error.response.data.message);

                    if (error.response.data.errors) {
                        this.formErrors = error.response.data.errors;
                    }
                });
                
        },
         
    },
};
</script>

<style>
 #quiz-section
 {
    background-color:rgba(61, 8, 8, 0.599) !important;
    color:white;
    font-weight: bold;
 }
 
 </style>
