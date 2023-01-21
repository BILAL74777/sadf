<template>
    <section id="faq" class="faq section-bg">
        <div class="container" data-aos="fade-up">
            <div class="section-title">
                <h2>Frequently Asked Questions Compone</h2>
                <p>
                    Magnam dolores commodi suscipit. Necessitatibus eius
                    consequatur ex aliquid fuga eum quidem. Sit sint consectetur
                    velit. Quisquam quos quisquam cupiditate. Et nemo qui
                    impedit suscipit alias ea. Quia fugiat sit in iste officiis
                    commodi quidem hic quas.
                </p>
            </div>

            <div class="faq-list">
                <ul v-for="(faq, index) in FAQS" :key="faq.id">
                    <li data-aos="fade-up" data-aos-delay="200">
                        <i class="bx bx-help-circle icon-help"></i>
                        <a
                            data-bs-toggle="collapse"
                            :data-bs-target="'#list-' + (index + 1)"
                            class="collapsed"
                            >{{ faq.question }}
                            <i class="bx bx-chevron-down icon-show"></i
                            ><i class="bx bx-chevron-up icon-close"></i
                        ></a>
                        <div
                            :id="'list-' + (index + 1)"
                            class="collapse"
                            data-bs-parent=".faq-list"
                        >
                            <p>
                                {{ faq.answer }}
                            </p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    created() {
        this.fetchFaqs();
    },
    data() {
        return {
            FAQS: [],
        };
    },
    methods: {
        fetchFaqs() {
            axios
                .get(route("api.faqs"), {
                    headers: {
                        Authorization: "Bearer " + this.$page.props.auth_token,
                    },
                })
                .then((response) => {
                    this.FAQS = response.data;
                })
                .catch((error) => {
                    toastr.error(error.response.data.message);
                });
        },
    },
};
</script>
