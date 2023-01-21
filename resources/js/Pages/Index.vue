<template>
    <Head>
        <!-- <title>Home Component</title> -->
        <!-- <title>{{ seo.title }}</title>

        <meta name="keywords" :content="seo.keyword" />
        <meta name="image" :content="'/storage/' + seo.image" />
        <meta name="description" :content="seo.description" /> -->

        <!-- <link rel="icon" type="image/svg+xml" href="/favicon.svg" /> -->
    </Head>
    <section id="hero" class="d-flex align-items-center">
        <div class="container">
            <div class="pt-4 pt-lg-0" data-aos="fade-up" data-aos-delay="200">
                <h1>{{ hero_title }}</h1>
                <p class="text-white c-text-adjust">
                    {{hero_description}}
                </p>
                
                <div
                    class="d-flex justify-content-center justify-content-lg-start"
                >
                    <a href="#events" class="btn-get-started c-btn-orange">{{
                        translate("Join an Event")
                    }}</a>
                    
                </div>
                
            </div>
            
        </div>
        <video playsinline="playsinline"
            autoplay="autoplay"
            muted="muted"
            loop="loop"
            id="video"
            class="position-absolute start-0 end-0 top-0 bottom-0 w-100 h-100"
            style="object-fit: fill; z-index: -1;">
            <source src="/images/lasa_film_festival_no_logo.mp4" type="video/mp4" muted loop autoplay>
        </video>
    </section>
    

    <!-- End Cliens Section -->
    <!-- <Clients /> -->
    <Events />

    <CarouselComponent />

    <AboutUs />

    <!-- End Why Us Section -->
    <!-- <WhyUs /> -->

    <!-- End Skills Section -->
    <!-- <Skills /> -->

    <!-- End Services Section -->
    <!-- <Services /> -->

    <!-- Portfolio component -->
    <!-- <portfolio /> -->

    <!-- End Team Section -->
    <!-- <Team /> -->

    <!-- End Cta Section -->
    <Cta />
    <Quiz />

    <!--  Frequently Asked Questions -->
    <!-- <Faq /> -->

    <!-- Contact component -->
    <!-- <contact /> -->

    <!-- ======= Footer ======= -->
    <footer id="footer">
       
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6 footer-contact">
                        
                        <h3 class="c-theme-yellow">{{ $page.props.website_name }}</h3>
                        <p>
                            5689 Tygejoww Glod
                            <br/>
                            Pittsburgh, AP 45857 <br />
                            <strong>(232) 245-8595<br /></strong>
                            <strong>crm@abcxyz.xyz<br /></strong>
                            <br>
                            <a :href="route('login')" class="c-theme-yellow c-font-20"><i class="bi bi-shield-lock-fill"></i></a>
                            
                        </p>
                    </div>

                   
                </div>
            </div>
        </div>
    </footer>

    <!-- End Footer -->
</template>

<script>
import Master from "@/Pages/Layouts/Master";

import { Head } from "@inertiajs/inertia-vue3";
// import Clients from "@/Pages/Clients";
// import WhyUs from "@/Pages/WhyUs";
import Events from "@/Pages/Events";
import AboutUs from "@/Pages/AboutUs";
import CarouselComponent from "@/Pages/CarouselComponent";
// import Portfolio from "@/Pages/Portfolio";
// import Pricing from "@/Pages/Pricing";
import Contact from "@/Pages/Contact";
// import Faq from "@/Pages/Faq";
// import Team from "@/Pages/Team";
// import Services from "@/Pages/Services";
import Cta from "@/Pages/Cta";
import Quiz from "@/Pages/Quiz";
// import Skills from "@/Pages/Skills";
export default {
    layout: Master,
    created() {
        this.fetchHero();
    },
    components: {
        // Clients,
        AboutUs,
        CarouselComponent,
        // WhyUs,
        Events,
        // Services,
        // Portfolio,
        // Pricing,
        // Skills,
        Contact,
        // Team,
        Cta,
        Quiz,
        // Faq,
        Head,
    },
    props: ["seo"],
    data() {
        return {
            hero_title:"",
            hero_description:"",
        };
    },
    methods:{
        fetchHero() {
            axios
                .get(route("api.fetch.hero"), {
                    headers: {
                        Authorization: "Bearer " + this.$page.props.auth_token,
                    },
                })
                .then((response) => {
                    const myJSON = JSON.parse(response.data.value);
                    this.hero_title = myJSON[0].title;
                    this.hero_description = myJSON[0].description;
                    
                })
                .catch((error) => {
                    toastr.error(error.response.data.message);
                });
        },
    },
};
</script>

<style>
.c-btn-orange {
    background: #eb6814 !important;
}
.c-btn-orange:hover {
    background: #e87831 !important;
}
.c-text-adjust{
    text-align: justify;
    width: 50%!important;
}
@media only screen and (max-width: 576px) {
    .c-text-adjust{
        text-align: justify;
        width: 100%!important;
    }
}
.c-theme-yellow{
    color: #f5ce34 !important;
}
#footer .footer-top .footer-contact p{
    color: white !important;
}
.copyright{
    color: #5e5e5e !important;
}
#footer .footer-bottom{
    color: #5e5e5e !important;
}
.credits a{
    color: #5e5e5e !important;
}
.back-to-top{
    background: #eb6814 !important;
}
.c-font-20{
    font-size: 20px;
}
#hero {
    
    background:none;
}


</style>
