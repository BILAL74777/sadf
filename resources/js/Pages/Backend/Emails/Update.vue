<template>
    <main id="main" class="main bg-light">
        <div class="pagetitle d-flex justify-content-between">
            <div>
                <h1>{{ translate("Update Weekly report") }}</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <Link :href="route('dashboard')">{{
                                $page.props.website_name
                            }}</Link>
                        </li>
                        <li class="breadcrumb-item">
                            {{ translate("Update Weekly Report Email") }}
                        </li>
                    </ol>
                </nav>
            </div>
            <Link class="btn btn-success" :href="route('sheduled.email.index')"
                >  {{ translate("Show all Scheduled Emails") }}
            </Link>
        </div>
        <div class="row g-3">
            <div> 
                <div class="col-12 col-md-12">
                    <label>{{
                        translate("Mailing Group")
                    }}</label>
                    <Multiselect
                        v-model="form.mailing_option"
                        :placeholder="translate('Choose')"
                        mode="tags"
                        :options="subscribers"
                        :searchable="true" 
                        :class="{
                            'invalid-bg': formErrors.mailing_option,
                        }"
                    />
                    <div
                        class="invalid-feedback animated fadeIn"
                        v-if="formErrors.mailing_option"
                    >
                        {{ formErrors.mailing_option[0] }}
                    </div>
                </div>

                <div class="col-12 col-md-12">
                    <label>{{
                        translate("Subject")
                    }}</label>
                    <input
                        type="text"
                        class="form-control"
                        :class="{
                            'invalid-bg': formErrors.subject,
                        }"
                        v-model="form.subject"
                    />
                    

                    <div
                        class="invalid-feedback animated fadeIn"
                        v-if="formErrors.subject"
                    >
                        {{ formErrors.subject[0] }}
                    </div>
                </div>
                 
                    <div class="col-12 col-md-12">
                        <label>{{
                            translate("Content")
                        }}</label>
                        <QuillEditor
                            v-model:content="contents"
                            contentType="html"
                            toolbar="full"
                            theme="snow"
                        />
                        <div
                            class="invalid-feedback animated fadeIn"
                            v-if="formErrors.content"
                        >
                            {{ formErrors.content[0] }}
                        </div>

                        
                        <div class="content ql-editor" v-html="existingContent"></div>
                    </div>


                   
                 

                <div class="row">

                    <div class="col-12 col-md-6">
                        <label for="phone">{{
                            translate("Time")
                        }}</label>
                        <Datepicker
                                time-picker   
                                placeholder="Select Time"  
                                 
                            :class="{
                                'invalid-bg':
                                    formErrors.time,
                            }"
                            v-model="form.time"
                        >
                        </Datepicker>
                        <!-- <input type="time" v-model="form.time"> -->

                        <div
                            class="invalid-feedback animated fadeIn"
                            v-if="formErrors.time"
                        >
                            {{ formErrors.time[0] }}
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <label>{{
                            translate("Day")
                        }}</label>
                        <Multiselect
                            v-model="form.day"
                            :placeholder="translate('Choose')" 
                            :options="days"
                            :searchable="true" 
                            :class="{
                                'invalid-bg': formErrors.day,
                            }"
                        />
                        <div
                            class="invalid-feedback animated fadeIn"
                            v-if="formErrors.day"
                        >
                            {{ formErrors.day[0] }}
                        </div>
                    </div>


                </div>
                



                 

                <div class="mt-2">
                    <button
                        @click="submit"
                        class="btn btn-success"
                        v-if="formStatus == 1"
                    >
                        {{ translate("Send") }}
                    </button>
                    <button
                        class="btn btn-success"
                        type="button"
                        disabled
                        v-else
                    >
                        {{ translate("Send") }}
                        <span
                            class="spinner-border spinner-border-sm"
                            role="status"
                            aria-hidden="true"
                        ></span>
                    </button>
                </div>
            </div>
        </div>
    </main>
</template>
<script>
import { QuillEditor } from "@vueup/vue-quill";
import "@vueup/vue-quill/dist/vue-quill.snow.css";
import Master from "@/Pages/Backend/Layouts/Master";
import Multiselect from "@vueform/multiselect";
import "@vuepic/vue-datepicker/dist/main.css";
import Datepicker from "@vuepic/vue-datepicker";

export default {
    layout: Master,
    components: {
        QuillEditor,
        Multiselect,
        Datepicker
    },
    props: ["id","events_subscribers"],
    created() {
        this.fetchRecord();
         
    },
    setup() {
        // const time = ref();
        
        
    },
    data() {
        return {
            dataProperty: "",
            shoeDescriptions: "",
            form: {
                id:this.id,
                mailing_option: [],
                subject: "",
                content: "",
                time: "",
                day: "",
            },
            contents: "",
            formStatus:1,
            formErrors:[],
            subscribers: this.events_subscribers,
            existingContent:'',
            days:["Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday"],
            existing_time:'',
        };
    },
    methods: {

        fetchRecord() {
            axios
                .get(route("api.scheduled.emails.show", this.id), {
                    headers: {
                        Authorization: "Bearer " + this.$page.props.auth_token,
                    },
                })
                .then((response) => { 
                    console.log("fetched "+response.data.existing_selection);
                    this.form.subject = response.data.Record.subject;
                    this.existingContent = response.data.Record.content;
                    this.form.day = response.data.Record.day;
                    this.form.time = response.data.Record.time;  
                    var timeObject = {hours: response.data.Record.hours, minutes: response.data.Record.minuts, seconds: 0};
                    this.form.mailing_option =  response.data.existing_selection;
                    this.form.time = timeObject; 
                      
                    // console.log("this"+timeObject.replace(/\'/gi,''));
                   
                    // console.log(timeObject.replace(/"|'/g, ''));
                    // console.log(str);
                    
                    

                })
                .catch((error) => {
                    toastr.error(error.response.data.message);
                });
        },
        submit() { 

             
            this.formStatus = 0;
            let formData = new FormData();
             
            formData.append("content", this.contents);
            
            if (this.form.mailing_option == null) {
                formData.append("mailing_option", "");
            } else {
                formData.append("mailing_option", this.form.mailing_option);
            }
            formData.append("time", JSON.stringify(this.form.time));
            formData.append("subject", this.form.subject); 
            formData.append("day", this.form.day); 
            formData.append("id", this.form.id); 
            // formData.append("time", this.form.time); 
            
            axios
                .post(route("api.scheduled.emails.update"),formData, {
                    headers: {
                        Authorization: "Bearer " + this.$page.props.auth_token,
                    },
                })
                .then((response) => {
                    toastr.success(this.translate("Updated successfully."));
                    this.formStatus = 1;

                    this.$inertia.get(route("sheduled.email.index"));
                    
                })
                .catch((error) => {
                    this.formStatus = 1;
                    toastr.error(error.response.data.message);
                    if (error.response.data.errors) {
                        this.formErrors = error.response.data.errors;
                    }
                });
        },

        // show() {
        //     let formData = new FormData();
        //     formData.append("dataProperty", this.dataProperty);

        //     axios
        //         .post(route("api.weekly-report.email.store"), formData, {
        //             headers: {
        //                 Authorization: "Bearer " + this.$page.props.auth_token,
        //             },
        //         })
        //         .then((data) => {
        //             this.dataProperty = "";
        //             toastr.success("Record updated successfully.");
        //             this.fetchRecord();
        //         })
        //         .catch((error) => {
        //             toastr.error(error.response.data.message);

        //             if (error.response.data.errors) {
        //                 this.formErrors = error.response.data.errors;
        //             }
        //         });
        // },

        // fetchRecord() {
        //     axios
        //         .get(route("api.weekly-report.email.fetch"), {
        //             headers: {
        //                 Authorization: "Bearer " + this.$page.props.auth_token,
        //             },
        //         })
        //         .then((response) => {
        //             this.dataProperty = "";
        //             const myJSON = JSON.parse(response.data.value);
        //             this.shoeDescriptions = myJSON[0].description;
        //             this.dataProperty = myJSON[0].description;
        //         })
        //         .catch((error) => {
        //             toastr.error(error.response.data.message);
        //         });
        // },
    },
};
</script>
<style>
    @import "@vueform/multiselect/themes/default.css";
</style>
