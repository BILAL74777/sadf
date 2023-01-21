<template>
    <!-- ======= Cliens Section ======= -->
    <section id="cliens" class="cliens section-bg">
        <div class="container">
            <div class="row">
                <div
                    v-for="(client, index) in Clients"
                    class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center"
                >
                    <img
                        :src="'/storage/' + client.image"
                        class="img-fluid"
                        :alt="client.name"
                        @error="setAltImg"
                    />
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    created() {
        this.fetchClients();
    },
    data() {
        return {
            Clients: [],
        };
    },
    methods: {
        fetchClients() {
            axios
                .get(route("api.clients"), {
                    headers: {
                        Authorization: "Bearer " + this.$page.props.auth_token,
                    },
                })
                .then((response) => {
                    this.Clients = response.data;
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
