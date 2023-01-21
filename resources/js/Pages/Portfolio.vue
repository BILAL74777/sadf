<template>
   <!-- ======= Portfolio Section ======= -->
    <section id="portfolio" class="portfolio">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>{{translate('Portfolio')}} </h2>
          <p>
            {{translate('Dummy paragraph text')}}
          </p>
        </div>

        <ul id="portfolio-flters" class="d-flex justify-content-center" data-aos="fade-up" data-aos-delay="100">
          
          <li 
            v-on:click="fetchPortfolio"
            :class="[status === 'All' ? 'filter-active' : '']">
            All 
          </li>

          <li 
            v-on:click="fetchMobileApp" 
            :class="[status === 'Mobile App' ? 'filter-active' : '']"
            >
            Mobile App
          </li>

           <li 
            v-on:click="fetchWebApp" 
            :class="[status === 'Web App' ? 'filter-active' : '']"
            >
            Web App
          </li>
          
        </ul>

        <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">


          <div class="row"> 
          <div class="col-lg-4 col-md-6 portfolio-item filter-web" v-for="(portflio, index) in portfolio" :key="index">
            <div class="portfolio-img">
               
                <Link :href="route('portfolio_details.show', portflio.id)">

                <img :src="'/storage/' + portflio.image1" 
                class="img-fluid" 
                alt="">
                </Link>


            </div>
            <!-- <div class="portfolio-info">

              <h4>{{ portflio.name }}</h4>
              <p>{{ portflio.category }}</p>

              <a 
                  href="assets/img/portfolio/portfolio-9.jpg" 
                  data-gallery="portfolioGallery" 
                  class="portfolio-lightbox preview-link" 
                  title="Web 3">
                <i class="bx bx-plus"></i>
              </a>


              <a 
                :href="route('portfolio_details.show', portflio.id)"
                class="details-link" 
                title="More Details">
                <i class="bx bx-link"></i>

              </a>



            </div> -->
          </div>
        </div>

          

        </div>

      </div>
    </section><!-- End Portfolio Section -->

    

</template>



<script>
export default {
     created() {
        this.fetchPortfolio();

    },
    data() {
        return {
            portfolio: [],
            status: '',
             
        };
    },
    methods: {
      fetchMobileApp:function (event) {
            axios.get(route('api.portfolioMobileApp'),{
                headers: {"Authorization" : 'Bearer ' + this.$page.props.auth_token}
            }).then((response) => {
                this.portfolio = response.data;
                this.status = "Mobile App";
                // console.log(this.Status);

                 
            }).catch(error => {
                toastr.error(error.response.data.message);
            });
        },

        fetchWebApp:function (event) {
            axios.get(route('api.portfolioWebApp'),{
                headers: {"Authorization" : 'Bearer ' + this.$page.props.auth_token}
            }).then((response) => {
                this.portfolio = response.data;
                this.status = "Web App";
                // console.log(this.Status);
            }).catch(error => {
                toastr.error(error.response.data.message);

            });
        },

        fetchPortfolio(){
            axios.get(route('api.portfolio'),{
                headers: {"Authorization" : 'Bearer ' + this.$page.props.auth_token}
            }).then((response) => {
                this.portfolio = response.data;
                this.status = "All";
                //  console.log(this.Status);
                
            }).catch(error => {
                toastr.error(error.response.data.message);
            });
        },
    },
};
</script>
