<template>

    <Head>
        <!-- <title>Home Component</title> -->
        <title>{{global_seo.title}}</title>

        <meta name="keywords" :content="global_seo.keyword">
        <meta name="image" :content="'/storage/' +global_seo.image">
        <meta name="description" :content="global_seo.description" />


        <!-- <link rel="icon" type="image/svg+xml" href="/favicon.svg" /> -->
    </Head>

    <section class="container c-height-90vh">

        <div class="card c-mt-4">
             
            <div class="card-body">

                <b class="text-theme">{{translate('You have successfully applied to the event.')}}</b>
                
            </div>
        </div>
    </section>

</template>

 
<script>
import Master from "@/Pages/Layouts/Master";
import { Head } from '@inertiajs/inertia-vue3';
 

export default {
    layout: Master,
    props: ['global_seo'],
    components: {
        Head,
         
    },
     
    data() {
        return {
             
    }
}
     
};
</script>
<style scoped>
    .c-mt-4{
        margin-top: 4rem;
    }
    .c-height-90vh{
        height: 90vh;
    }
    .text-theme {
        color: #8B2D88 !important;
    }
</style>
 