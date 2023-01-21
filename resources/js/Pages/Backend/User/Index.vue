<template>
    <main id="main" class="main">
        <div class="pagetitle d-flex justify-content-between">
            <div>
                <h1>{{ translate('Users') }}</h1>
                <nav>
                    <ol class="breadcrumb">
                         <li class="breadcrumb-item">
                            <Link :href="route('dashboard')">{{ $page.props.website_name }}</Link>
                        </li>
                         <li class="breadcrumb-item active">
                            {{ translate('Users') }}
                        </li>
                         
                    </ol>
                </nav>
            </div>
             
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
                                    <th scope="col">{{ translate('Name') }}</th>
                                    <th scope="col">{{ translate('Email') }} </th>
                                    <th scope="col">{{ translate('Role') }} </th>
                                    
                                    
                                    <th scope="col" class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                v-for="(user, index) in Users"
                                :key="user.id"
                                >
                                    <th class="text-center">{{index + 1}}</th>
                                    <td>{{ user.name }}   </td>
                                    <td>{{ user.email }}  </td>
                                    <td>{{ user.role }}</td>  
                                      
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <Link
                                                type="button"
                                                class="btn btn-sm fs-6"
                                                title="Edit"
                                                :href="route('user.edit', user.id)"
                                            >
                                                <i class="bi bi-pencil"></i>
                                            </Link>
                                            <button
                                                type="button"
                                                class="btn btn-sm fs-6"

                                                data-bs-toggle="modal" 
                                                data-bs-target="#deleteModal"
                                                title="Delete"
                                                @click="passDeleteId(user.id)"
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
    created() {
        this.fetchCustomers();
         
    },
    data() {
        return {
            Users: [],
            deleteId: null
        };
    },
    methods: {
        fetchCustomers(){
            axios.get(route('api.fetch.user'),{
                headers: {"Authorization" : 'Bearer ' + this.$page.props.auth_token}
            }).then((response) => { 
                this.Users = response.data;
            }).catch(error => {
                toastr.error(error.response.data.message);
            });
        },
        passDeleteId(id) {
            this.deleteId = id;
        },
        deleteThis(){
            axios.delete(route('api.user.delete', this.deleteId),{
                headers: {"Authorization" : 'Bearer ' + this.$page.props.auth_token}
            }).then(() => {
                toastr.success("Users deleted successfully.");
                this.fetchCustomers();
            }).catch(error => {
                toastr.error(error.response.data.message);
            });
        },
        
    
    },
};

</script>


<style>
.table td, .table th {
   vertical-align: middle;
}
</style>