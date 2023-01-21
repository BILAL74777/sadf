<template>
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet"
    />

    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top">
        <div class="container d-flex align-items-center">
            <h1 class="logo me-auto"><a href="index.html">CRM</a></h1>
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

            <nav id="navbar" class="navbar">
                <ul>
                    <li>
                        <a class="nav-link scrollto active" href="#hero"
                            >Home</a
                        >
                    </li>

                    <li>
                        <a class="nav-link scrollto" href="#about">About</a>
                    </li>
                    <li>
                        <a class="nav-link scrollto" href="#services"
                            >Services</a
                        >
                    </li>
                    <li>
                        <a class="nav-link scrollto" href="#portfolio"
                            >Portfolio</a
                        >
                    </li>
                    <!--  <li>
                        <Link class="nav-link" :href="route('project_selections')" :class="{'collapsed': !$page.url.startsWith('/project_selections') }">
                              Project Selection 
                        </Link>
                    </li> -->

                    <!--  <li>
                        <Link class="nav-link" :href="route('talent_profile')" :class="{'collapsed': !$page.url.startsWith('/talent_profile') }">
                              Talent Profile  
                        </Link>
                    </li> -->

                    <!-- <li>
                        <Link class="nav-link" :href="route('normal_users')" :class="{'collapsed': !$page.url.startsWith('normal_users') }">
                              Register User 
                        </Link>
                    </li> -->

                    <li>
                        <a class="nav-link scrollto" href="#team">Team</a>
                    </li>
                    <li class="dropdown">
                        <a href="#"
                            ><span>Drop Down</span>
                            <i class="bi bi-chevron-down"></i
                        ></a>
                        <ul>
                            <li><a href="#">Drop Down 1</a></li>
                            <li class="dropdown">
                                <a href="#"
                                    ><span>Deep Drop Down</span>
                                    <i class="bi bi-chevron-right"></i
                                ></a>
                                <ul>
                                    <li><a href="#">Deep Drop Down 1</a></li>
                                    <li><a href="#">Deep Drop Down 2</a></li>
                                    <li><a href="#">Deep Drop Down 3</a></li>
                                    <li><a href="#">Deep Drop Down 4</a></li>
                                    <li><a href="#">Deep Drop Down 5</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Drop Down 2</a></li>
                            <li><a href="#">Drop Down 3</a></li>
                            <li><a href="#">Drop Down 4</a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="nav-link scrollto" href="#contact">Contact</a>
                    </li>
                    <li>
                        <a class="getstarted scrollto" href="#about"
                            >Get Started</a
                        >
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

    <!-- ======= Footer ======= -->
    <footer id="footer">
        <div class="footer-newsletter">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <h4>Join Our Newsletter</h4>
                        <p>
                            Tamen quem nulla quae legam multos aute sint culpa
                            legam noster magna
                        </p>
                        <form action="" method="post">
                            <input type="email" name="email" /><input
                                type="submit"
                                value="Subscribe"
                            />
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6 footer-contact">
                        <h3>Arsha</h3>
                        <p>
                            A108 Adam Street <br />
                            New York, NY 535022<br />
                            United States <br /><br />
                            <strong>Phone:</strong> +1 5589 55488 55<br />
                            <strong>Email:</strong> info@example.com<br />
                        </p>
                    </div>

                    <div class="col-lg-3 col-md-6 footer-links">
                        <h4>Useful Links</h4>
                        <ul>
                            <li>
                                <i class="bx bx-chevron-right"></i>
                                <a href="#">Home</a>
                            </li>
                            <li>
                                <i class="bx bx-chevron-right"></i>
                                <a href="#">About us</a>
                            </li>
                            <li>
                                <i class="bx bx-chevron-right"></i>
                                <a href="#">Services</a>
                            </li>
                            <li>
                                <i class="bx bx-chevron-right"></i>
                                <a href="#">Terms of service</a>
                            </li>
                            <li>
                                <i class="bx bx-chevron-right"></i>
                                <a href="#">Privacy policy</a>
                            </li>
                        </ul>
                    </div>

                    <div class="col-lg-3 col-md-6 footer-links">
                        <h4>Our Services</h4>
                        <ul>
                            <li>
                                <i class="bx bx-chevron-right"></i>
                                <a href="#">Web Design</a>
                            </li>
                            <li>
                                <i class="bx bx-chevron-right"></i>
                                <a href="#">Web Development</a>
                            </li>
                            <li>
                                <i class="bx bx-chevron-right"></i>
                                <a href="#">Product Management</a>
                            </li>
                            <li>
                                <i class="bx bx-chevron-right"></i>
                                <a href="#">Marketing</a>
                            </li>
                            <li>
                                <i class="bx bx-chevron-right"></i>
                                <a href="#">Graphic Design</a>
                            </li>
                        </ul>
                    </div>

                    <div class="col-lg-3 col-md-6 footer-links">
                        <h4>Our Social Networks</h4>
                        <p>
                            Cras fermentum odio eu feugiat lide par naso tierra
                            videa magna derita valies
                        </p>
                        <div class="social-links mt-3">
                            <a href="#" class="twitter"
                                ><i class="bx bxl-twitter"></i
                            ></a>
                            <a href="#" class="facebook"
                                ><i class="bx bxl-facebook"></i
                            ></a>
                            <a href="#" class="instagram"
                                ><i class="bx bxl-instagram"></i
                            ></a>
                            <a href="#" class="google-plus"
                                ><i class="bx bxl-skype"></i
                            ></a>
                            <a href="#" class="linkedin"
                                ><i class="bx bxl-linkedin"></i
                            ></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container footer-bottom clearfix">
            <div class="copyright">
                &copy; Copyright <strong><span>Arsha</span></strong
                >. All Rights Reserved
            </div>
            <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/arsha-free-bootstrap-html-template-corporate/ -->
                Designed by
                <a href="https://bootstrapmade.com/">BootstrapMade</a>
            </div>
        </div>
    </footer>
    <!-- End Footer -->

    <div id="preloader" v-if="preLoader"></div>
    <a
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
    },
    created() {},
    data() {
        return {
            preLoader: true,
        };
    },
    methods: {
        preLoaderHide() {
            setTimeout(() => {
                this.preLoader = false;
            }, 700);
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
</style>
