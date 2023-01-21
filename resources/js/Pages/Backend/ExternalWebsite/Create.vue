<template>
    <main id="main" class="main">
        <div class="pagetitle d-flex justify-content-between">
            <div>
                <h1>
                    {{ translate("External Website") }}
                </h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <Link :href="route('dashboard')">{{
                                $page.props.website_name
                            }}</Link>
                        </li>
                        <li class="breadcrumb-item active">
                            {{ translate("Films") }}
                        </li>
                    </ol>
                </nav>
            </div>
            <!-- <Link class="btn btn-primary" :href="route('admin.teams')">{{ translate('Add New Seo') }} </Link> -->
        </div>

        <!-- End Page Title -->
        <section class="section">
            <WebsiteNameComponent />
            <AboutComponent />
            <CarouselComponent />
            <GlobalSeoComponent />
        </section>
    </main>
    <!-- End #main -->
</template>

<script>
import Master from "@/Pages/Backend/Layouts/Master";
import GlobalSeoComponent from "@/Pages/Backend/ExternalWebsite/GlobalSeoComponent";
import AboutComponent from "@/Pages/Backend/ExternalWebsite/AboutComponent";
import CarouselComponent from "@/Pages/Backend/ExternalWebsite/CarouselComponent";
import WebsiteNameComponent from "@/Pages/Backend/ExternalWebsite/WebsiteNameComponent";
import Multiselect from "@vueform/multiselect";
export default {
    layout: Master,

    components: {
        Multiselect,
        GlobalSeoComponent,
        AboutComponent,
        CarouselComponent,
        WebsiteNameComponent,
    },
    data() {
        return {};
    },
    methods: {
        refetchParentDetails() {
            this.fetchSeo();
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
</style>
