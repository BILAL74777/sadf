<template>

    <!-- ======= Cta Section ======= -->
    <section id="cta" class="cta">
        <div class="container" data-aos="zoom-in">
            <div class="row">
                <div class="col-lg-9 text-center text-lg-start">
                    <!-- <h3>{{ translate('Previous Events') }}</h3> -->
                    <!-- <p>
                        {{ translate('Dummy paragraph') }}
                    </p> -->
                </div>
                <div class="col-lg-3 cta-btn-container text-center">
                    
                     

                    <div class="dropdown">
                        <a class="cta-btn align-middle dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" href="#">
                        
                            {{ translate('CATALOGS OF PAST FESTIVALS') }}
                         
                        </a>

                        <ul class="dropdown-menu">
                            <!-- Lorem ipsum -->
                            <!-- <li
                                v-for="(catalog, index) in Catalogs"
                                :key="index"   
                            >
                                <a v-if="catalog.catalog" download :href="'/storage/' + catalog.catalog" class="dropdown-item">{{ catalog.title }}</a>
                                <a v-else href="javascript:void(0)" class="dropdown-item">{{ catalog.title }}</a>

                            </li> -->
                             
                        </ul>
                    </div>

        
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
         Catalogs:[],
        };
    },
    methods: {
         
        fatchCatalogs() {
            axios
                .get(route("api.front_end.catalog.fetch"), {
                    headers: {
                        Authorization: "Bearer " + this.$page.props.auth_token,
                    },
                })
                .then((response) => {
                    this.Catalogs = response.data;
                })
                .catch((error) => {
                    toastr.error(error.response.data.message);
                });
        },
        changeLang(code) {
             
            let formData = new FormData();
            formData.append("default_language", code);

            axios
                .post(route("api.user.default.language"), formData)
                .then((data) => {
                    // toastr.success("Language changed successfully.");
                    window.location.reload();
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
/* .dropdown:hover .dropdown-menu {
    display: block;
 }
 .dropdown-menu, .dropdown-menu .show{

    inset: 0px 0px auto auto;
    margin: 0px;
    transform: translate3d(-9px, 64px, 0px);
     
 } */
 
 </style>
