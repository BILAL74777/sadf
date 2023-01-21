<template>
  <main id="main" class="main">
    <div class="pagetitle d-flex justify-content-between">
      <div>
        <h1>{{ translate("Training") }}</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <Link :href="route('dashboard')">{{
                $page.props.website_name
              }}</Link>
            </li>
            <li class="breadcrumb-item active">
              {{ translate("Training") }}
            </li>
          </ol>
        </nav>
      </div>
      <Link class="btn btn-success" :href="route('training.add')"
        ><i class="bi bi-plus-lg"></i>{{ translate("Add New Training") }}
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
              <thead>
                <tr>
                  <th scope="col" class="text-center">#</th>
                  <th scope="col">{{ translate("Company") }}</th>
                  <th scope="col">{{ translate("Date") }}</th>
                  <th scope="col">{{ translate("City") }}</th>
                  <th scope="col">{{ translate("Country") }}</th>
                  <th scope="col">{{ translate("Assigned Trainer") }}</th>
                  <th scope="col">{{ translate("Certificates") }}</th>
                  <th scope="col">{{ translate("Status") }}</th>

                  <th scope="col" class="text-center">Actions</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(training, index) in trainings" :key="training.id">
                  <th class="text-center">{{ index + 1 }}</th>
                  <td>{{ training.company }}</td>
                  <td>
                    {{ training.date }}
                  </td>
                  <td>{{ training.city }}</td>
                  <td>{{ training.country }}</td>
                  <td>{{ training.assigned_trainer }}</td>
                  <td>{{ training.certificates }}</td>
                  <td>{{ training.status }}</td>

                  <td class="text-center">
                    <div class="btn-group">
                      <Link
                        type="button"
                        class="btn btn-sm fs-6"
                        title="Edit"
                        :href="route('training.edit', training.id)"
                      >
                        <i class="bi bi-pencil"></i>
                      </Link>
                      <button
                        type="button"
                        class="btn btn-sm fs-6"
                        data-bs-toggle="modal"
                        data-bs-target="#deleteModal"
                        title="Delete"
                        @click="passDeleteId(training.id)"
                      >
                        <i class="bi bi-trash"></i>
                      </button>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </section>
  </main>
  <!-- End #main -->

  <div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">
          <div class="block-content text-center p-4">
            <h2>
              {{ translate("Are you sure?") }}
            </h2>

            <button
              type="button"
              class="btn btn-sm btn-danger me-2"
              data-bs-dismiss="modal"
              @click="deleteThis"
            >
              {{ translate("Yes, delete it!") }}
            </button>

            <button
              type="button"
              class="btn btn-sm btn-dark"
              data-bs-dismiss="modal"
            >
              {{ translate("Close") }}
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template> 
<script>
import Master from "@/Pages/Backend/Layouts/Master";

export default {
  layout: Master,
  created() {
    this.fetchTrainings();
  },
  props: ["message"],
  data() {
    return {
      trainings: [],
      deleteId: null,
    };
  },

  methods: {
    fetchTrainings() {
      axios
        .get(route("api.fetch.training"), {
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
          this.fetchTrainings();
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