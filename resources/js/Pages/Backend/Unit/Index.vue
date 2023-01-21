<template>
    <main id="main" class="main">
        <div class="pagetitle d-flex justify-content-between">
            <div>
                <h1>{{ translate('Units') }}</h1>
                <nav>
                    <ol class="breadcrumb">
                         <li class="breadcrumb-item">
                            <Link :href="route('dashboard')">{{ $page.props.website_name }}</Link>
                        </li>
                         <li class="breadcrumb-item active">
                            {{ translate('Units') }}
                        </li>
                         
                    </ol>
                </nav>
            </div>
            <Link class="btn btn-success" :href="route('unit.add')"><i class="bi bi-plus-lg"></i>{{ translate('Add New Units') }} </Link>
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
                                    <th scope="col">{{ translate('Type') }}</th>
                                    <th scope="col">{{ translate('Model') }} </th>
                                    <th scope="col">{{ translate('Version') }} </th> 
                                    <th scope="col">{{ translate('Year') }} </th> 
                                    <th scope="col">{{ translate('Max Speed') }} </th> 
                                    <th scope="col">{{ translate('Weight') }} </th> 
                                    <th scope="col">{{ translate('Color') }} </th> 
                                    <th scope="col">{{ translate('Load') }} </th> 
                                    <th scope="col">{{ translate('Fuel') }} </th> 
                                    <th scope="col">{{ translate('Kilometers') }} </th> 
                                    <th scope="col">{{ translate('Height') }} </th> 
                                    <th scope="col">{{ translate('Lenght') }} </th> 
                                                                      
                                    <th scope="col" class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                v-for="(unit, index) in Units"
                                :key="unit.id"
                                >
                                    <th class="text-center">{{index + 1}}</th>
                                    <td>{{ unit.type }}   </td>
                                    <td>{{ unit.model }}  </td>
                                    <td>{{ unit.version }}</td> 
                                    <td>{{ unit.year }}</td> 
                                    <td>{{ unit.max_speed }}</td> 
                                    <td>{{ unit.weight }}</td> 
                                    <td>{{ unit.color }}</td> 
                                    <td>{{ unit.load }}</td> 
                                    <td>{{ unit.fuel }}</td> 
                                    <td>{{ unit.kilometer }}</td> 
                                    <td>{{ unit.height }}</td> 
                                    <td>{{ unit.lenght }}</td> 
                                    
                                    
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <Link
                                                type="button"
                                                class="btn btn-sm fs-6"
                                                title="Edit"
                                                :href="route('unit.edit', unit.id)"
                                            >
                                                <i class="bi bi-pencil"></i>
                                            </Link>
                                            <button
                                                type="button"
                                                class="btn btn-sm fs-6"

                                                data-bs-toggle="modal" 
                                                data-bs-target="#deleteModal"
                                                title="Delete"
                                                @click="passDeleteId(unit.id)"
                                            >
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- End Table with stripped rows -->
                </div>
            </div>
            
        </section>
    </main>
    <!-- End #main -->
    

    <!-- delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
            
            <div class="modal-body">
                <div class="block-content text-center p-4">
                        <h2 >
                            {{ translate('Are you sure?') }}
                        </h2>

                        <button
                            type="button"
                            class="btn btn-sm btn-danger me-2"
                            data-bs-dismiss="modal"
                            @click="deleteThis"
                        >
                            {{ translate('Yes, delete it!') }}
                        </button>
                        
                        <button
                            type="button"
                            class="btn btn-sm btn-dark"
                            data-bs-dismiss="modal"
                        >
                             {{ translate('Close') }}
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
    components: {
    
  },
    created() {
        this.fetchContacts();
    },
    data() {
        return {
            Units: [],
            deleteId: null
        };
    },
    methods: {
        fetchContacts(){
            axios.get(route('api.fetch.unit'),{
                headers: {"Authorization" : 'Bearer ' + this.$page.props.auth_token}
            }).then((response) => { 
                this.Units = response.data;
            }).catch(error => {
                toastr.error(error.response.data.message);
            });
        },
        passDeleteId(id) {
            this.deleteId = id;
        },
        deleteThis(){
            axios.delete(route('api.unit.delete', this.deleteId),{
                headers: {"Authorization" : 'Bearer ' + this.$page.props.auth_token}
            }).then(() => {
                toastr.success("Task deleted successfully.");
                this.fetchContacts();
            }).catch(error => {
                toastr.error(error.response.data.message);
            });
        }
    },
};
</script>


<style>
.table td, .table th {
   vertical-align: middle;
}
</style>