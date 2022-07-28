<template>
    <div>

        <div>
            <div class="row">
                <router-link to="/store-employee" class="btn-grad"> {{ $t('subsidebar.AddEmployee') }}</router-link>
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
                            <h6 class="m-0 font-weight-bold text-primary">Employee List</h6>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Name</th>
                                        <th>Photo</th>
                                        <th>Phone</th>
                                        <th>Salary</th>
                                        <th>Joining Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="employee in filtersearch" :key="employee.id">
                                        <td>{{ employee.name }}</td>
                                        <td><img :src="employee.photo" id="em_photo" alt=""></td>
                                        <td>{{ employee.phone }}</td>
                                        <td>{{ employee.salary }}</td>
                                        <td>{{ employee.joining_date }}</td>
                                        <td><router-link :to="{name:'pay-salary', params: {id:employee.id}}" class="btn btn-sm btn-primary">Pay Salary</router-link>
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
       
    },
    created() {
        this.allEmployee();
    }

}
</script>

<style type="text/css">
#em_photo {
    height: 40px;
    widows: 40px;
}
</style>