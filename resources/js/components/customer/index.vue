<template>
    <div>

        <div>
            <div class="row">
                <router-link to="/store-customer" class="btn btn-primary"> {{ $t('subsidebar.AddCustomer') }}</router-link>
            </div>
        </div>

        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
               
            </div>

            <div class="mb-4">
                <input type="text" v-model="searchTerm" class="form-control" style="width:300px;"
                    placeholder="Search Here">

                <!-- Search By Name -->
                <!-- <input type="checkbox" v-model="checked" id="checkbox">
            <label for="checkbox">Name</label> -->
            </div>

            <div class="row">
                <div class="col-lg-12 mb-4">
                    <!-- Simple Tables -->
                    <div class="card">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Customer List</h6>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Name</th>
                                        <th>Photo</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="customer in filtersearch" :key="customer.id">
                                        <td>{{ customer.name }}</td>
                                        <td><img :src="customer.photo" id="em_photo" alt=""></td>
                                        <td>{{ customer.phone }}</td>
                                        <td>{{ customer.email }}</td>
                                        <td>{{ customer.address }}</td>
                                        <td><router-link :to="{name:'edit-customer', params: {id:customer.id}}" class="btn btn-sm btn-primary">Edit</router-link>
                                            <a @click="deleteCustomer(customer.id)"
                                                class="btn btn-sm btn-danger" style="color:white">Delete</a>
                                        </td>

                                    </tr>

                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer"></div>
                    </div>
                </div>
            </div>
            <!--Row-->
        </div>
        <!---Container Fluid-->
    </div>
</template>

<script type="text/javascript">

export default {
    created() {
        if (!User.loggedIn()) {
            this.$router.push({ name: '/' })
        }
    },
    data() {
        return {
            customers: [],
            searchTerm: '',
            // checked:'',
        }
    },
    computed: {
        filtersearch() {

            return this.customers.filter(customer => {
                return customer.phone.match(this.searchTerm)
            })

            //-----------------Check box Search--------------------

            // if(this.checked== true){
            // return this.employees.filter(employee =>{
            //     return employee.name.match(this.searchTerm)
            // })
            // }else
            // {
            //      return this.employees.filter(employee =>{
            //     return employee.phone.match(this.searchTerm)
            // })
            // }

        }
    },
    methods: {
        allCustomer() {
            axios.get('/api/customer/')
                .then(({ data }) => (this.customers = data

                ))
                .catch()
        },
        deleteCustomer(id) {

            //Sweat Alert Delete 
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                     axios.delete('/api/customer/'+id)
                     .then(()=>{
                        this.customers = this.customers.filter(customer => {
                            return customer.id !=id
                        })
                     })
                     .catch(()=>{
                        this.$router.push({
                            name:'customer'
                        })
                     })
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                }
            })
        }
    },
    created() {
        this.allCustomer();
    }

}
</script>

<style type="text/css">
#em_photo {
    height: 40px;
    widows: 40px;
}
</style>