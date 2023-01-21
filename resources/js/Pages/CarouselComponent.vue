<template>
    <section>
        <div>
            <div class="col-lg-12">
                <carousel
                    v-if="Carousels && Carousels.length > 0"
                    :settings="settings"
                >
                    <slide v-for="(carousel, i) in Carousels" :key="i">
                        <img
                            :src="carousel.image"
                            :alt="carousel.value"
                            class="img-fluid"
                        />
                        <p class="c-carousel-text">
                            <!-- {{
                                carousels_texts[i]
                                    ? carousels_texts[i].carousel_text
                                    : ""
                            }} -->
                            {{ carousel.description }}
                        </p>
                    </slide>

                    <template v-if="Carousels && Carousels.length > 1" #addons>
                        <navigation />
                        <!-- <pagination /> -->
                    </template>
                </carousel>
            </div>
        </div>
    </section>
</template>

<script>
import { Carousel, Slide, Pagination, Navigation } from "vue3-carousel";
import "vue3-carousel/dist/carousel.css";

export default {
    components: {
        Carousel,
        Slide,
        Pagination,
        Navigation,
    },
    created() {
        this.fatchCarousel();
    },
    data() {
        return {
            settings: {
                itemsToShow: 1,
                autoplay: 3500,
                wrapAround: true,
                dir: "rtl",
                // snapAlign: 'center',
            },
            Carousels: [], 
        };
    },
    methods: {
        fatchCarousel() {
            axios
                .get(route("api.fetch.carousel"), {
                    headers: {
                        Authorization: "Bearer " + this.$page.props.auth_token,
                    },
                })
                .then((response) => {
                    this.Carousels = response.data; 
                    console.log(this.Carousels);
                })
                .catch((error) => {
                    toastr.error(error.response.data.message);
                });
        },
    },
};
</script>

<style scoped>
section {
    padding: 0px !important;
    background-color: black;
}
.c-carousel-text {
    position: absolute;
    padding: 70px;
    color: white;
    font-size: 50px;
    font-weight: bold;
}
</style>

<style>
.carousel--rtl .carousel__prev {
    right: 15px !important;
    transform: unset !important;
    background: black !important;
}
.carousel--rtl .carousel__next {
    left: 15px !important;
    transform: unset !important;
    background: black !important;
}
</style>
