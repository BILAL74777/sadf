<template>
    <main id="main" class="main">
        <div class="pagetitle d-flex justify-content-between">
            <div>
                <h1>{{translate('Add New Language') }} </h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <Link :href="route('dashboard')">{{translate('Home') }} </Link>
                        </li>
                        <li class="breadcrumb-item ">{{translate('Languages') }}</li>
                        <li class="breadcrumb-item active">{{translate('Add New Language') }}</li>
                    </ol>
                </nav>
            </div>
            <Link class="btn btn-success" :href="route('languages')"> {{ translate('Go to Languages') }} </Link>
        </div>
    
        <!-- End Page Title -->
        <section class="section">
            <div class="card">
                <div class="card-body pt-4">
                    <h5 class="card-title">{{translate('Add New Language') }}</h5>

                    <!-- Floating Labels Form -->
                    <form @submit.prevent="submit">
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

                            <div class="col-12 col-md-6">
                                
                                <Multiselect
                                class="form-select"
                                id="CodeSelect"
                                v-model="form.code"
                                :options="code_options"
                                :searchable="true"
                                :class="{ 'invalid-bg': formErrors.code }"
                                :placeholder="translate('Choose Country')"
                                />
                                 <div
                                    class="invalid-feedback animated fadeIn"
                                    v-if="formErrors.code"
                                >
                                    {{ formErrors.code[0] }}
                                </div>
                                
                            </div>
                            
                            
                        </div>
                    
                   
                        <button type="submit" class="btn btn-success mt-3">
                           {{ translate('Save') }}
                        </button>
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
import Multiselect from '@vueform/multiselect';
export default {
    layout: Master,
    components: {
        Multiselect
    },
    // props: ["countries"],
    created() {
        this.loadCountries();
    },
    data() {
        return {
            form: {
                name: '',
                code: '',
            },
            // code_options: this.countries,
            code_options: [],
            formErrors : [],
        };
    },
    methods: {
        loadCountries(){
            axios.get(route('api.countries'),
            {
                headers: {
                    "Authorization" : 'Bearer ' + this.$page.props.auth_token,
                    }

            }).then((response) => {
                this.code_options = response.data;
                // console.log(this.code_options);
                // toastr.success("Language added successfully.");
                // this.$inertia.get(route('admin.languages'));
            });
        },
        submit() {
            // console.log(this.form);
            axios.post(route('api.languages.store'),this.form,
            {
                headers: {
                    "Authorization" : 'Bearer ' + this.$page.props.auth_token,
                }
            }).then((data) => {
                // console.log(data);
                toastr.success("Language added successfully.");
                this.$inertia.get(route('languages'));
            }).catch(error => {
                console.log(error.response.data);
                toastr.error(error.response.data.message);

                if(error.response.data.errors){
                    this.formErrors = error.response.data.errors;
                }
            });
        },
    },
};
</script>


<style>
@import '@vueform/multiselect/themes/default.css';

.c-file-padding{
    padding: 1rem .75rem !important;
}
.invalid-feedback {
    display: block !important;
}
.invalid-bg {
    border-color: #f8d4d4 !important;
    background-color: #f8d4d4 !important;
}

#CodeSelect{
    min-height: 58px;
}
.card{
    overflow: visible;
}
</style>