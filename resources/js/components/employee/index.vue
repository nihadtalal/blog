<template>
    <div>





        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">

            <div class="row justify-content-around">
                <div class=" mt-3" style="padding-right:">
                    <input type="text" v-model="searchTerm" class="form-control" style="width:;"
                        :placeholder="$t('employee.searchemployee')">
                </div>
                <div class=" mb-4" >
                    <router-link to="/store-employee" class="btn-grad">{{ $t('subsidebar.AddEmployee') }}</router-link>
                </div>

                <!-- Search By Name -->
                <!-- <input type="checkbox" v-model="checked" id="checkbox">
            <label for="checkbox">Name</label> -->
            </div>

            <div class="row justify-content-center">
                
                <div class="col-xl-10 col-lg-10 col-md-12 mb-4">
                    <!-- Simple Tables -->
                    <div class="card">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">{{ $t('employee.employeelist') }}</h6>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th>{{ $t('employee.name') }}</th>
                                        <th>{{ $t('employee.photo') }}</th>
                                        <th>{{ $t('employee.phone') }}</th>
                                        <th>{{ $t('employee.salary') }}</th>
                                        <th>{{ $t('employee.joiningdate') }}</th>
                                        <th>{{ $t('employee.action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="employee in filtersearch" :key="employee.id">
                                        <td>{{ employee.name }}</td>
                                        <td><img :src="employee.photo" id="em_photo" alt=""></td>
                                        <td>{{ employee.phone }}</td>
                                        <td>{{ employee.salary }}</td>
                                        <td>{{ employee.joining_date }}</td>
                                        <td>
                                            <router-link :to="{ name: 'edit-employee', params: { id: employee.id } }"
                                                class="btn btn-sm btn-primary">{{ $t('employee.edit') }}</router-link>
                                            <a @click="deleteEmployee(employee.id)" class="btn btn-sm btn-danger"
                                                style="color:white">{{ $t('employee.delete') }}</a>
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
            employees: [],
            searchTerm: '',
            // checked:'',
        }
    },
    computed: {
        filtersearch() {

            return this.employees.filter(employee => {
                return employee.phone.match(this.searchTerm)
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
        allEmployee() {
            axios.get('/api/employee/')
                .then(({ data }) => (this.employees = data

                ))
                .catch()
        },
        deleteEmployee(id) {

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
                    axios.delete('/api/employee/' + id)
                        .then(() => {
                            this.employees = this.employees.filter(employee => {
                                return employee.id != id
                            })
                        })
                        .catch(() => {
                            this.$router.push({
                                name: 'employee'
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
        this.allEmployee();
    }

}
</script>

<style type="text/css" scoped>
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

@media (max-width: 768px) {
    .container-fluid {
        padding-left: 77px;
    }

}
</style>