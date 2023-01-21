<template>
    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect" />
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet"
    />

    <main>
        <div class="container">
            <section
                class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4"
            >
                <div class="container">
                    <div class="row justify-content-center">
                        <div
                            class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center"
                        >
                            <div class="d-flex justify-content-center py-4">
                                <Link :href="route('dashboard')">
                                    <img src="/images/logo.png" height="60" alt="logo">
                                    <!-- <span class="d-none d-lg-block"> Portfolio Cast </span> -->
                                </Link>
                            </div>
                            
                             <div class="alert alert-success" role="alert" v-if="message">
                                <strong>
                                    {{ message }}
                                </strong>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
    <!-- End #main -->
</template>

<script>
import Master from "@/Pages/Backend/Layouts/Master";
export default {
    props:['message'],
   
};
</script>

<style scoped>
 
.invalid-feedback {
    display: block;
}
.invalid-bg {
    border-color: #f8d4d4 !important;
    background-color: #f8d4d4 !important;
}
</style>
