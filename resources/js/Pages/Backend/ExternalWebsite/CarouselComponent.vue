<template>
    <div>
        <div class="card c-form-card">
            <div class="card-header c-form-card-header">
                {{ translate("Carousel Section") }}
            </div>
            <div class="card-body pt-4">
                <!-- <h5 class="card-title">Add New FAQ</h5> -->

                <!-- Floating Labels Form -->

                <div class="row g-3">
                    <div class="col-12 card">
                        <div class="card-body p-1">
                            <div v-for="(list, index) in CarouselTextList">
                                <div class="row">
                                    <div class="col-md-4">
                                        <ImageZooming
                                            :file="list.image"
                                            :width="250"
                                        />
                                    </div>

                                    <div class="col-md-6">
                                        <textarea
                                            class="form-control"
                                            :class="{
                                                'invalid-bg':
                                                    formErrors.description,
                                            }"
                                            v-model="list.description"
                                            rows="3"
                                        ></textarea>

                                        <input
                                            type="hidden"
                                            v-model="list.image_id"
                                            checked
                                        />
                                    </div>

                                    <div class="col-md-2">
                                        <button
                                            type="button"
                                            v-if="index >= 0"
                                            class="btn"
                                            @click="
                                                removeList(index, list);
                                                submitCarouselText();
                                            "
                                        >
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-12">
                        <Cropper @croppedImg="croppedImgSubmit" />
                        <br />
                      
                        <button v-if="CarouselTextList != ''"
                            type="submit"
                            class="btn btn-success mt-3"
                            @click="submitCarouselText"
                        >
                            {{ translate("Update") }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
// import Master from "@/Pages/Backend/Layouts/Master";
import Cropper from "@/Pages/Backend/ExternalWebsite/Cropper";
export default {
    // layout: Master,
    components: {
        Cropper,
    },
    emits: ["refetchParentDetails"],
    created() {
        this.fetchCarouselText();
    },
    data() {
        return {
            CarouselTextList: [
                {
                    description: "",
                    image_id: "",
                },
            ],
            formStatus: "Yes",
            formErrors: [],
            Carousels: [],
            form: {
                image: "",
            },
            CommentformStatus: 1,
            CarouselTextStatus: 1,
        };
    },
    methods: {
        // addList() {
        //     this.CarouselTextList.push({
        //         carousel_text: "",
        //     });
        // },
        removeList(index, list) {
            var idx = this.CarouselTextList.indexOf(list);
            if (idx > -1) {
                this.CarouselTextList.splice(idx, 1);
            }
        },

        submitCarouselText() {
            this.CarouselTextStatus = 0;
            let formData = new FormData();
            let text_list = this.CarouselTextList;
            formData.append("text_list", JSON.stringify(text_list));
            axios
                .post(route("api.carousel.update"), formData, {
                    headers: {
                        Authorization: "Bearer " + this.$page.props.auth_token,
                    },
                })
                .then(() => {
                    toastr.success("Carousel updated successfully.");
                    this.CarouselTextStatus = 1;
                    this.fetchCarouselText();
                })
                .catch((error) => {
                    this.CarouselTextStatus = 1;
                    toastr.error(error.response.data.message);
                });
        },
        fetchCarouselText() {
            axios
                .get(route("api.admin.carousel.text.fetch"), {
                    headers: {
                        Authorization: "Bearer " + this.$page.props.auth_token,
                    },
                })
                .then((res) => {
                    this.CarouselTextList = res.data;
                })
                .catch((error) => {
                    toastr.error(error.response.data.message);
                });
        },
        croppedImgSubmit(img) {
            this.form.image = img;
            axios
                .post(route("api.carousel.store"), this.form, {
                    headers: {
                        Authorization: "Bearer " + this.$page.props.auth_token,
                    },
                })
                .then((data) => {
                    toastr.success("Caorousel new image added successfully.");
                    // this.$emit('refetchParentDetails')
                    this.form.image = "";
                    this.formErrors = false;
                    this.fetchCarouselText();
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
@import "@vueform/multiselect/themes/default.css";
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
#CodeSelect {
    min-height: 58px;
}
.card {
    overflow: visible;
}
.remove-status {
    margin-left: 15px !important;
    margin-top: 5px !important;
}
</style>
