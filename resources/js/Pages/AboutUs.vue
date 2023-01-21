<template>
    <!-- ======= About Us Section ======= -->
    <section id="about">
        <div class="container" data-aos="fade-up">
            <div class="section-title">
                <h2 class="c-theme-yellow">{{ translate("Neque porro quisquam est") }}</h2>
            </div>

            <div class="content">
                <div class="accordion" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingThree">
                            <button
                                class="accordion-button collapsed"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#collapseThree"
                                aria-expanded="false"
                                aria-controls="collapseThree"
                            >
                            Lorem ipsum dolor sit amet, 
                            </button>
                        </h2>
                        <div
                            id="collapseThree"
                            class="accordion-collapse collapse"
                            aria-labelledby="headingThree"
                            data-bs-parent="#accordionExample"
                        >
                            <div class="accordion-body">
                                <p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. </p>
                                <p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate <b>October 1 and November 30, 2022</b>.</p>
                                <p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available. Wikipedia</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button
                                class="accordion-button collapsed"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#collapseOne"
                                aria-expanded="false"
                                aria-controls="collapseOne"
                            >
                            Sed dictum sapien eu mauris
                            </button>
                        </h2>
                        <div
                            id="collapseOne"
                            class="accordion-collapse collapse"
                            aria-labelledby="headingOne"
                            data-bs-parent="#accordionExample"
                        >
                        <div class="accordion-body">
                                <p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. </p>
                                <p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate <b>October 1 and November 30, 2022</b>.</p>
                                <p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available. Wikipedia</p>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                            <button
                                class="accordion-button collapsed"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#collapseTwo"
                                aria-expanded="false"
                                aria-controls="collapseTwo"
                            >
                            Nullam id rutrum augue, eget porttitor tellus
                            </button>
                        </h2>
                        <div
                            id="collapseTwo"
                            class="accordion-collapse collapse"
                            aria-labelledby="headingTwo"
                            data-bs-parent="#accordionExample"
                        >
                        <div class="accordion-body">
                                <p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. </p>
                                <p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate <b>October 1 and November 30, 2022</b>.</p>
                                <p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available. Wikipedia</p>
                            </div>
                        </div>
                    </div>

                    
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    props: [],
    created() {
        // this.fetchAbout();
    },
    data() {
        return {
            Title: "",
            Description: "",
        };
    },
    methods: {
        fetchAbout() {
            axios
                .get(route("api.fetch.about"), {
                    headers: {
                        Authorization: "Bearer " + this.$page.props.auth_token,
                    },
                })
                .then((response) => {
                    const myJSON = JSON.parse(response.data.value);
                    this.Title = myJSON[0].title;
                    this.Description = myJSON[0].description;
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
#about{
    background: black !important;
}
.accordion-button:not(.collapsed){
    color: #113b8c !important;
    background-color: #80808030 !important;
}
.accordion-button:focus{
    box-shadow: none !important;
}
.accordion-item:first-of-type, .accordion-item:first-of-type .accordion-button {
    border-top-left-radius: 15px !important;
    border-top-right-radius: 15px !important;
}
.accordion-item:last-of-type, .accordion-item:last-of-type .accordion-button.collapsed{
    border-bottom-right-radius: 15px;
    border-bottom-left-radius: 15px;
}
</style>
