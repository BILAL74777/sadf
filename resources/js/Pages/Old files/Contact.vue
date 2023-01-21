<template>
    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
        <div class="container" data-aos="fade-up">
            <div class="section-title">
                <h2>Contact</h2>
                <p>
                    Magnam dolores commodi suscipit. Necessitatibus eius
                    consequatur ex aliquid fuga eum quidem. Sit sint consectetur
                    velit. Quisquam quos quisquam cupiditate. Et nemo qui
                    impedit suscipit alias ea. Quia fugiat sit in iste officiis
                    commodi quidem hic quas.
                </p>
            </div>

            <div class="row">
                <div class="col-lg-5 d-flex align-items-stretch">
                    <div class="info">
                        <div class="address">
                            <i class="bi bi-geo-alt"></i>
                            <h4>Location:</h4>
                            <p>A108 Adam Street, New York, NY 535022</p>
                        </div>

                        <div class="email">
                            <i class="bi bi-envelope"></i>
                            <h4>Email:</h4>
                            <p>info@example.com</p>
                        </div>

                        <div class="phone">
                            <i class="bi bi-phone"></i>
                            <h4>Call:</h4>
                            <p>+1 5589 55488 55s</p>
                        </div>

                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12097.433213460943!2d-74.0062269!3d40.7101282!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb89d1fe6bc499443!2sDowntown+Conference+Center!5e0!3m2!1smk!2sbg!4v1539943755621"
                            frameborder="0"
                            style="border: 0; width: 100%; height: 290px"
                            allowfullscreen
                        ></iframe>
                    </div>
                </div>

                <div class="col-lg-7 mt-5 mt-lg-0 d-flex align-items-stretch">
                    <form @submit.prevent="submit" class="php-email-form">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">{{
                                    translate("Your Name")
                                }}</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    :class="{ 'invalid-bg': formErrors.name }"
                                    placeholder="Your  Name"
                                    v-model="form.name"
                                />
                                <div
                                    class="invalid-feedback animated fadeIn"
                                    v-if="formErrors.name"
                                >
                                    {{ formErrors.name[0] }}
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Your Email</label>
                                <input
                                    type="email"
                                    class="form-control"
                                    :class="{ 'invalid-bg': formErrors.email }"
                                    placeholder="Your  Email"
                                    v-model="form.email"
                                />
                                <div
                                    class="invalid-feedback animated fadeIn"
                                    v-if="formErrors.email"
                                >
                                    {{ formErrors.email[0] }}
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email">Subject</label>
                            <input
                                type="text"
                                class="form-control"
                                id="subject"
                                placeholder="Subject"
                                :class="{ 'invalid-bg': formErrors.subject }"
                                v-model="form.subject"
                            />
                            <div
                                class="invalid-feedback animated fadeIn"
                                v-if="formErrors.subject"
                            >
                                {{ formErrors.subject[0] }}
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea
                                class="form-control"
                                id="message"
                                placeholder="Message"
                                :class="{ 'invalid-bg': formErrors.message }"
                                v-model="form.message"
                                rows="10"
                            ></textarea>
                            <div
                                class="invalid-feedback animated fadeIn"
                                v-if="formErrors.message"
                            >
                                {{ formErrors.message[0] }}
                            </div>
                        </div>
                        <div class="my-3">
                            <div class="loading">Loading</div>
                            <div class="error-message"></div>
                            <div class="sent-message">
                                Your message has been sent. Thank you!
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn">
                                Send Message
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- End Contact Section -->
</template>

<script>
export default {
    data() {
        return {
            form: {
                name: "",
                email: "",
                subject: "",
                message: "",
            },
            formErrors: [],
        };
    },
    methods: {
        submit() {
            axios
                .post(route("api.contacts.store"), this.form, {
                    headers: {
                        Authorization: "Bearer " + this.$page.props.auth_token,
                    },
                })
                .then((data) => {
                    console.log(data);
                    toastr.success("Message Sent successfully.");
                    // this.$inertia.get(route('/'));
                    this.form = {
                        name: "",
                        email: "",
                        subject: "",
                        message: "",
                    };
                    this.formErrors = [];
                })
                .catch((error) => {
                    console.log(error.response.data);
                    toastr.error(error.response.data.message);

                    if (error.response.data.errors) {
                        this.formErrors = error.response.data.errors;
                    }
                });
        },
    },
};
</script>

<style></style>
