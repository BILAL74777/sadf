<template>
    <section id="hero" class="d-flex align-items-center">
        <div class="container">
            <div class="row">
                <div
                    class="col-lg-6 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1"
                    data-aos="fade-up"
                    data-aos-delay="200"
                >
                    <h1>Better Solutions For Your Business</h1>
                    <h2>
                        We are team of talented designers making websites with
                        Bootstrap
                    </h2>
                    <div
                        class="d-flex justify-content-center justify-content-lg-start"
                    >
                        <a href="#about" class="btn-get-started scrollto"
                            >Get Started</a
                        >
                        <a
                            href="https://www.youtube.com/watch?v=jDDaplaOz7Q"
                            class="glightbox btn-watch-video"
                            ><i class="bi bi-play-circle"></i
                            ><span>Watch Video</span></a
                        >
                    </div>
                </div>
                <div
                    class="col-lg-6 order-1 order-lg-2 hero-img"
                    data-aos="zoom-in"
                    data-aos-delay="200"
                >
                    <img
                        src="assets/img/hero-img.png"
                        class="img-fluid animated"
                        alt=""
                        @error="setAltImg"
                    />
                </div>
            </div>
        </div>
    </section>

    <!-- End Cliens Section -->
    <Clients />

    <!-- End About Us Section -->
    <AboutUs />

    <!-- End Why Us Section -->
    <WhyUs />

    <!-- End Skills Section -->
    <Skills />

    <!-- End Services Section -->
    <Services />

    <!-- End Cta Section -->
    <Cta />

    <!-- Portfolio component -->
    <portfolio />

    <!-- End Team Section -->
    <Team />

    <!--  Pricing  -->
    <Pricing />

    <!--  Frequently Asked Questions -->
    <Faq />

    <!-- Contact component -->
    <contact />
</template>

<script>
import Master from "@/Pages/Layouts/Master";

import Clients from "@/Pages/Clients";
import WhyUs from "@/Pages/WhyUs";
import AboutUs from "@/Pages/AboutUs";
import Portfolio from "@/Pages/Portfolio";
import Pricing from "@/Pages/Pricing";
import Contact from "@/Pages/Contact";
import Faq from "@/Pages/Faq";
import Team from "@/Pages/Team";
import Services from "@/Pages/Services";
import Cta from "@/Pages/Cta";
import Skills from "@/Pages/Skills";
export default {
    components: {
        Clients,
        AboutUs,
        WhyUs,
        Services,
        Portfolio,
        Pricing,
        Skills,
        Contact,
        Team,
        Cta,
        Faq,
    },
    layout: Master,
    data() {
        return {};
    },
    methods: {
        setAltImg(event) {
            event.target.src = "/images/default.jpg";
        },
    },
};
</script>

<style></style>
