<template>
    <div>

        <div>
            <div class="row">
                <router-link to="/store-supplier" class="btn-grad"> {{ $t('subsidebar.AddSupplier') }}</router-link>
            </div>
        </div>

        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
               
            </div>

            <div class="mb-4">
                <input type="text" v-model="searchTerm" class="form-control" style="width:300px;"
                    :placeholder="$t('supplier.searchsupplier') ">

                <!-- Search By Name -->
                <!-- <input type="checkbox" v-model="checked" id="checkbox">
            <label for="checkbox">Name</label> -->
            </div>

            <div class="row">
                <div class="col-lg-12 mb-4">
                    <!-- Simple Tables -->
                    <div class="card">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">{{ $t('supplier.supplierlist') }}</h6>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th>{{ $t('supplier.name') }}</th>
                                        <th>{{ $t('supplier.photo') }}</th>
                                        <th>{{ $t('supplier.phone') }}</th>
                                        <th>{{ $t('supplier.shopname') }}</th>
                                        <th>{{ $t('supplier.email') }}</th>
                                        <th>{{ $t('supplier.action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="supplier in filtersearch" :key="supplier.id">
                                        <td>{{ supplier.name }}</td>
                                        <td><img :src="supplier.photo" id="em_photo" alt=""></td>
                                        <td>{{ supplier.phone }}</td>
                                         <td>{{ supplier.shopname }}</td>
                                        <td>{{ supplier.email }}</td>
                                        <td><router-link :to="{name:'edit-supplier', params: {id:supplier.id}}" class="btn btn-sm btn-primary">{{ $t('supplier.edit') }}</router-link>
                                            <a @click="deleteSupplier(supplier.id)"
                                                class="btn btn-sm btn-danger" style="color:white">{{ $t('supplier.delete') }}</a>
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
            suppliers: [],
            searchTerm: '',
            // checked:'',
        }
    },
    computed: {
        filtersearch() {

            return this.suppliers.filter(supplier => {
                return supplier.phone.match(this.searchTerm)
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
        allSupplier() {
            axios.get('/api/supplier/')
                .then(({ data }) => (this.suppliers = data

                ))
                .catch()
        },
        deleteSupplier(id) {

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
                     axios.delete('/api/supplier/'+id)
                     .then(()=>{
                        this.suppliers = this.suppliers.filter(supplier => {
                            return supplier.id !=id
                        })
                     })
                     .catch(()=>{
                        this.$router.push({
                            name:'supplier'
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
        this.allSupplier();
    }

}
</script>

<style type="text/css">
#em_photo {
    height: 40px;
    widows: 40px;
}

.btn-grad {
    background-image: linear-gradient(to right, #00FBA5 0%, #01A1FF 51%, #00FBA5 100%);
    margin: 10px;
    padding: 15px 45px;
    text-align: center;
    text-transform: uppercase;
    transition: 0.5s;
    background-size: 200% auto;
    color: white;
    box-shadow: 0 0 20px #eee;
    border-radius: 10px;
    display: block;
}

.btn-grad:hover {
    background-position: right center;
    /* change the direction of the change here */
    color: #fff;
    text-decoration: none;
}
</style>