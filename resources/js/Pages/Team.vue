<template>


	<!-- ======= Team Section ======= -->
    <section id="team" class="team section-bg">
        <div class="container" data-aos="fade-up">
            <div class="section-title">
                 <h2> {{translate('Team')}}</h2>
                <p>
                    {{translate('dUMMY TEXT PARAGRAPH')}}
                </p>
            </div>

            <div class="row">

                <div v-for="team in Team" :key="team.id" class="col-lg-6 mt-4">
                    <div
                        class="member d-flex align-items-start"
                        data-aos="zoom-in"
                        data-aos-delay="100"
                    >
                        <div class="pic">
                            
                            <img 
                                :src="'/storage/' + team.image" 
                                 class="img-fluid" 
                                
                            >

                        </div>
                        <div class="member-info">
                            <h4> {{ team.name }} </h4>
                            <span>{{ team.designation }} </span>
                            <p>
                                {{ team.details }} 
                            </p>
                            <div class="social">
                                <a href="{{ team.twitter }} "
                                    ><i class="ri-twitter-fill"></i
                                ></a>
                                <a href="{{ team.facebook }} "
                                    ><i class="ri-facebook-fill"></i
                                ></a>
                                <a href="{{ team.instagram }} "
                                    ><i class="ri-instagram-fill"></i
                                ></a>
                                <a href="{{ team.linkedin }} ">
                                    <i class="ri-linkedin-box-fill"></i>
                                </a>
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
     created() {
        this.fetchTeamMembers();
    },
    data() {
        return {
            Team: [],
             
        };
    },
    methods: {
        fetchTeamMembers(){
            axios.get(route('api.team'),{
                headers: {"Authorization" : 'Bearer ' + this.$page.props.auth_token}
            }).then((response) => {
                this.Team = response.data;
            }).catch(error => {
                toastr.error(error.response.data.message);
            });
        },
    },
};
</script>