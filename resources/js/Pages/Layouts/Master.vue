<template>
    
    
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet"
    />
    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top">
        <div class="container d-flex align-items-center">
            <h1 class="logo me-auto">
                <a href="/">
                    <img src="/images/logo.png" alt="logo" />
                </a>
            </h1>
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

            <nav id="navbar" class="navbar">
                <ul>
                    <!-- <li>
                        <a class="nav-link scrollto active" href="#hero"
                            >{{translate('Home')}}</a
                        >
                    </li>
                    
                    <li>
                        <a class="nav-link scrollto" href="#about">About</a>
                    </li>
                    <li>
                        <a class="nav-link scrollto" href="#services"
                            >{{translate('Services')}}</a
                        >
                    </li>
                    <li>
                        <a class="nav-link scrollto" href="#portfolio"
                            >{{translate('Portfolio')}}</a
                        >
                    </li>
                    <li><a class="nav-link scrollto" href="#team">{{translate('Team')}}</a></li>
                    
                    <li>
                        <a class="nav-link scrollto" href="#contact">Contact</a>
                    </li>
                    <li>
                        <a class="getstarted scrollto" href="#about"
                            >Get Started</a
                        >
                    </li> -->

                    <li class="dropdown">
                        <a href="#"
                            ><span>{{ user_language_name }}</span>
                            <i class="bi bi-chevron-down"></i
                        ></a>
                        <ul>
                            <li
                                v-for="(language, index) in languages"
                                :key="index"
                                :class="[
                                    language.code == $page.props.user_language
                                        ? 'lang-active'
                                        : '',
                                ]"
                            >
                             
                                <a
                                    href="javascript:void(0)"
                                    @click="changeLang(language.code)"
                                    >{{ language.name }}</a
                                >
                            </li>
                        </ul>
                    </li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav>
            <!-- .navbar -->
        </div>
    </header>
    <!-- End Header -->

    <!-- ======= Hero Section ======= -->

    <!-- End Hero -->

    <main id="main">
        <!-- added other pages code here -->
        <slot></slot>
    </main>
    <!-- End #main -->

    <footer id="footer">
        <div class="container footer-bottom clearfix">
            <div class="copyright">
                &copy; {{ translate("Copyright") }}
                <strong
                    ><span>{{ $page.props.website_name }}</span></strong
                >. {{ translate("All Rights Reserved") }}
            </div>
            <div class="credits">
                Designed by
                <a href="https://bootstrapmade.com/">BootstrapMade</a>
            </div>
        </div>
    </footer>

    <div id="preloader" ref="preloader" v-if="preLoader"></div>
    <a
        ref="back_top_top"
        href="#"
        class="back-to-top d-flex align-items-center justify-content-center"
        ><i class="bi bi-arrow-up-short"></i
    ></a>
</template>

<script>
import AOS from "aos";
export default {
    mounted() {
        let mainJs = document.createElement("script");
        mainJs.setAttribute("src", "/assets/js/main.js");
        document.head.appendChild(mainJs);

        this.preLoaderHide();

        AOS.init();

        // preloader
        let preloader = this.$refs.preloader;
        if (preloader) {
            window.addEventListener('load', () => {
            preloader.remove()
            });
        }
    },
    components: {},
    created() {
        this.fatchLanguages(); 
    },

    data() {
        return {
            preLoader: true,
            footer_links: [
                {
                    title: "",
                    link: "",
                },
            ],

            form: {
                default_language: this.$page.props.user_language ?? '',
            },
            formErrors: "",
            languages: [],
            site_name: "",
            logo: "",
            footer_logo: "",
            whatsapp: "",
            email: "",
            facebook: "",
            instagram: "",
            twitter: "",
            youtube: "",
            address: "",
            phone_number: "",
            user_language_name:""
        };
    },
    methods: {
        preLoaderHide() {
            setTimeout(() => {
                this.preLoader = false;
            }, 700);
        },
        fatchLanguages() {
            axios
                .get(route("api.front_end.languages.data"), {
                    headers: {
                        Authorization: "Bearer " + this.$page.props.auth_token,
                    },
                })
                .then((response) => {
                    this.languages = response.data;
                    // getting user default language name from langauges array
                    this.user_language_name = response.data.filter(p => p.code == this.$page.props.user_language)[0].name;
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
        fatchSettings() {
            axios
                .get(route("api.settings-fetch"), {
                    headers: {
                        Authorization: "Bearer " + this.$page.props.auth_token,
                    },
                })
                .then((response) => {
                    this.footer_links = JSON.parse(response.data.footer_links);

                    this.site_name = response.data.site_name;

                    this.logo = response.data.logo;

                    this.footer_logo = response.data.footer_logo;

                    this.whatsapp = response.data.whatsapp;

                    this.email = response.data.email;

                    this.facebook = response.data.facebook;

                    this.instagram = response.data.instagram;

                    this.twitter = response.data.twitter;

                    this.youtube = response.data.youtube;

                    this.address = response.data.address;

                    this.phone_number = response.data.phone_number;
                })
                .catch((error) => {
                    toastr.error(error.response.data.message);
                });
        },
    },
};
</script>

<style>
@import "aos/dist/aos.css";
@import "~/assets/vendor/bootstrap/css/bootstrap.min.css";
@import "~/assets/vendor/bootstrap-icons/bootstrap-icons.css";
@import "~/assets/vendor/boxicons/css/boxicons.min.css";
@import "~/assets/vendor/glightbox/css/glightbox.min.css";
@import "~/assets/vendor/remixicon/remixicon.css";
@import "~/assets/vendor/swiper/swiper-bundle.min.css";
@import "~/assets/css/style.css";
@import "~/assets/css/custom.css";

@import "toastr";

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

.c-form-card {
    padding: 0px !important;
    border-top-left-radius: 15px !important;
    border-top-right-radius: 15px !important;
}
.c-form-card-header {
    background: #8b2d88 !important;
    color: #fff !important;
    font-size: 1.5rem !important;
    border-top-left-radius: 15px !important;
    border-top-right-radius: 15px !important;
}
#header {
    background: black;
}
/* .navbar a:hover{
    color: #ec6816 !important;
} */

/* .navbar a:hover, .navbar .active, .navbar .active:focus, .navbar li:hover > a{
    color: black !important;
} */
/* .dropdown a:hover{
    color: #ec6816 !important;
} */

/* .lang-active a:hover {
    background: #ec6816 !important;
    color: white !important;
} */
.navbar a:hover, .navbar .active, .navbar .active:focus, .navbar li:hover > a{
    color: #ec6816 !important;
}
.lang-active a, .lang-active a:hover {
    background: #ec6816 !important;
    color: black !important;
}
</style>

<style scoped>
.navbar-mobile ul {
    bottom: unset !important;
}
.navbar-mobile{
    background: none;
}
</style>