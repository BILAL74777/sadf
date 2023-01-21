<template>
  <main id="main" class="main">
    <div class="pagetitle d-flex justify-content-between">
      <div>
        <h1>{{ translate("Training Details") }}</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <Link :href="route('dashboard')">{{
                $page.props.website_name
              }}</Link>
            </li>
            <li class="breadcrumb-item active">
              {{ translate("Training Details") }}
            </li>
          </ol>
        </nav>
      </div>
      <Link class="btn btn-success" :href="route('trainings_for_certificates')"
        ><i class="bi bi-plus-lg"></i>{{ translate(" Go Back") }}
      </Link>
    </div>
    <!-- End Page Title -->
    <section class="section">
      <div class="card">
        <div class="card-body pt-4">
          <!-- <h5 class="card-title">Table with stripped rows</h5> -->

          <!-- Table with stripped rows -->
          <div class="table-reponsive">
            <table class="table table-striped">
              
                <tr>
                   
                  <th scope="col">{{ translate("Company") }}</th>
                   <td>{{ trainings.company }}</td>
                   <th scope="col">{{ translate("Date") }}</th>
                   <td>
                    {{ trainings.date }}
                  </td>

                  </tr>
                  <tr>
                      <th scope="col">{{ translate("City") }}</th>
                      <td>{{ trainings.city }}</td>

                      <th scope="col">{{ translate("Country") }}</th>
                      <td>{{ trainings.country }}</td>

                  </tr>
                  <tr>
                       <th scope="col">{{ translate("Assigned Trainer") }}</th>
                       <td>{{ trainings.assigned_trainer }}</td>
                        <th scope="col">{{ translate("Certificates") }}</th>
                        <td>{{ trainings.certificates }}</td>

                  </tr>
                  <tr>
                       
                      <th scope="col">{{ translate("Status") }}</th>
                      <td>{{ trainings.status }}</td>

                  </tr>
                 
                 <tr>
                   
                    <td class="pt-4">
                        <a
                          type="link" 
                          title="Details"
                          class="btn bg-secondary  btn-secondary"
                          :href="
                            route('trainings_for_certificates.pdf',trainingId)"
                        >
                        Download PDF
                        <!-- <button @click="onClick()">Download PDF</button> -->
                         
                         </a>
                    </td>
                 </tr>

                 
                 
               
               
            </table>
          </div>
        </div>
      </div>
    </section>
  </main>
  <!-- End #main -->

   
</template> 
<script>
import Master from "@/Pages/Backend/Layouts/Master";

export default {
  layout: Master,
  created() {
    this.fetchDetails();
  }, 
  props:['trainingId'],
 
  data() {
    return {
      trainings: [],
      deleteId: null,
    };
  },

  methods: {
    // onClick() {
    //           axios
    //             .get(route("api.trainings_for_certificates_details_fetch",this.trainingId), {
    //               headers: { Authorization: "Bearer " + this.$page.props.auth_token },
    //             }).then((response) => {
    //             console.log(response.data);
    //                let blob = new Blob([response.data], {
    //                         type: 'application/pdf',
    //                     })
    //                     let link = document.createElement('a');
    //                     link.href = window.URL.createObjectURL(new Blob([response.data], { type: 'application/pdf' }));
    //                     link.download = 'test.pdf';
    //                     link.click();
    //           });
    //       },
        

    fetchDetails() {
      axios
        .get(route("api.trainings_for_certificates_details_fetch",this.trainingId), {
          headers: { Authorization: "Bearer " + this.$page.props.auth_token },
        })
        .then((response) => { 
          this.trainings = response.data;
        })
        .catch((error) => {
          toastr.error(error.response.data.message);
        });
      if (this.message) {
        toastr.success(this.message);
      }
    },
    passDeleteId(id) {
      this.deleteId = id;
    },
    deleteThis() {
      axios
        .delete(route("api.training.delete", this.deleteId), {
          headers: { Authorization: "Bearer " + this.$page.props.auth_token },
        })
        .then(() => {
          toastr.success("Training deleted successfully.");
          this.fetchcollectors();
        })
        .catch((error) => {
          toastr.error(error.response.data.message);
        });
    },
  },
};
</script>


<style>
.table td,
.table th {
  vertical-align: middle;
}
</style>