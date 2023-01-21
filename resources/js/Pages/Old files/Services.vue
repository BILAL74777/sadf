<template>
    <!-- ======= Services Section ======= -->
    <section id="services" class="services section-bg">
        <div class="container" data-aos="fade-up">
            <div class="section-title">
                <h2>Services</h2>
                <p>
                    Magnam dolores commodi suscipit. Necessitatibus eius
                    consequatur ex aliquid fuga eum quidem. Sit sint consectetur
                    velit. Quisquam quos quisquam cupiditate. Et nemo qui
                    impedit suscipit alias ea. Quia fugiat sit in iste officiis
                    commodi quidem hic quas.
                </p>
            </div>

            <div class="row">
                <div
                    v-for="(service, index) in services"
                    :key="service.id"
                    class="col-xl-3 col-md-6 d-flex align-items-stretch mt-4 mt-md-0"
                    data-aos="zoom-in"
                    data-aos-delay="200"
                >
                    <div class="icon-box">
                        <div class="icon"><i class="bx bx-file"></i></div>
                        <h4>
                            <a href="">{{ service.title }}</a>
                        </h4>
                        <p>
                            {{ service.description }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    created() {
        this.fetchServices();
    },
    data() {
        return {
            services: [],
        };
    },
    methods: {
        fetchServices() {
            axios
                .get(route("api.services"), {
                    headers: {
                        Authorization: "Bearer " + this.$page.props.auth_token,
                    },
                })
                .then((response) => {
                    this.services = response.data;
                })
                .catch((error) => {
                    toastr.error(error.response.data.message);
                });
        },
    },
};
</script>
