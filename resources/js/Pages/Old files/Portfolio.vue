<template>
    <!-- ======= Portfolio Section ======= -->
    <section id="portfolio" class="portfolio">
        <div class="container" data-aos="fade-up">
            <div class="section-title">
                <h2>Portfolio</h2>
                <p>Dummy paragraph text</p>
            </div>

            <ul
                id="portfolio-flters"
                class="d-flex justify-content-center"
                data-aos="fade-up"
                data-aos-delay="100"
            >
                <li
                    v-on:click="fetchPortfolio"
                    v-if="Status === 'All'"
                    class="filter-active"
                >
                    All
                </li>

                <li v-on:click="fetchPortfolio" v-else>All</li>

                <li
                    v-on:click="fetchMobileApp"
                    v-if="Status === 'Mobile App'"
                    class="filter-active"
                >
                    Mobile App
                </li>
                <li v-on:click="fetchMobileApp" v-else>Mobile App</li>

                <li
                    v-on:click="fetchWebApp"
                    v-if="Status === 'Web App'"
                    class="filter-active"
                >
                    Web App
                </li>
                <li v-on:click="fetchWebApp" v-else>Web App</li>
            </ul>

            <div
                class="row portfolio-container"
                data-aos="fade-up"
                data-aos-delay="200"
            >
                <div class="row">
                    <div
                        class="col-lg-4 col-md-6 portfolio-item filter-web"
                        v-for="(portflio, index) in portfolio"
                        :key="index"
                    >
                        <div class="portfolio-img">
                            <a href="#">
                                <img
                                    :src="'/storage/' + portflio.image1"
                                    class="img-fluid"
                                    @error="setAltImg"
                                    alt=""
                                />
                            </a>
                        </div>
                        <!-- <div class="portfolio-info">

              <h4>{{ portflio.name }}</h4>
              <p>{{ portflio.category }}</p>

              <a 
                  href="assets/img/portfolio/portfolio-9.jpg" 
                  data-gallery="portfolioGallery" 
                  class="portfolio-lightbox preview-link" 
                  title="Web 3">
                <i class="bx bx-plus"></i>
              </a>


              <a 
                :href="route('portfolio_details.show', portflio.id)"
                class="details-link" 
                title="More Details">
                <i class="bx bx-link"></i>

              </a>



            </div> -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Portfolio Section -->
</template>

<script>
export default {
    created() {
        this.fetchPortfolio();
    },
    data() {
        return {
            portfolio: [],
            Status: [],
        };
    },
    methods: {
        fetchMobileApp: function (event) {
            axios
                .get(route("api.portfolioMobileApp"), {
                    headers: {
                        Authorization: "Bearer " + this.$page.props.auth_token,
                    },
                })
                .then((response) => {
                    this.portfolio = response.data;
                    this.Status = "Mobile App";
                    console.log(this.Status);
                })
                .catch((error) => {
                    toastr.error(error.response.data.message);
                });
        },

        fetchWebApp: function (event) {
            axios
                .get(route("api.portfolioWebApp"), {
                    headers: {
                        Authorization: "Bearer " + this.$page.props.auth_token,
                    },
                })
                .then((response) => {
                    this.portfolio = response.data;
                    this.Status = "Web App";
                    console.log(this.Status);
                })
                .catch((error) => {
                    toastr.error(error.response.data.message);
                });
        },

        fetchPortfolio() {
            axios
                .get(route("api.portfolio"), {
                    headers: {
                        Authorization: "Bearer " + this.$page.props.auth_token,
                    },
                })
                .then((response) => {
                    this.portfolio = response.data;
                    this.Status = "All";
                    console.log(this.Status);
                })
                .catch((error) => {
                    toastr.error(error.response.data.message);
                });
        },
        setAltImg(event) {
            event.target.src = "/images/default.jpg";
        },
    },
};
</script>
