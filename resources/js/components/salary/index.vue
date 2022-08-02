<template>
    <div>

        <div>
            <div class="row">
                <router-link to="/given-salary" class="btn btn-primary"> {{ $t('salary.paysalary') }}</router-link>
            </div>
        </div>

        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
               
            </div>

            <div class="mb-4">
                <input type="text" v-model="searchTerm" class="form-control" style="width:300px;"
                    :placeholder="$t('salary.salarysearch') ">

                <!-- Search By Name -->
                <!-- <input type="checkbox" v-model="checked" id="checkbox">
            <label for="checkbox">Name</label> -->
            </div>

            <div class="row">
                <div class="col-lg-12 mb-4">
                    <!-- Simple Tables -->
                    <div class="card">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">{{ $t('salary.salarydetails') }}</h6>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th>{{ $t('salary.monthname') }}</th>
                                         <th>{{ $t('salary.details') }}</th>
                                        
                                    
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="salary in filtersearch" :key="salary.id">
                                        <td>{{ salary.salary_month }}</td>
                                    
                                        <td><router-link :to="{name:'view-salary', params: {id:salary.salary_month}}" class="btn btn-sm btn-primary">{{ $t('salary.viewsalary') }}</router-link>
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
            salaries: [],
            searchTerm: '',
            // checked:'',
        }
    },
    computed: {
        filtersearch() {

            return this.salaries.filter(salary => {
                return salary.salary_month.match(this.searchTerm)
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
        allSalary() {
            axios.get('/api/salary/')
                .then(({ data }) => (this.salaries = data

                ))
                .catch()
        },
       
    },
    created() {
        this.allSalary();
    }

}
</script>

<style type="text/css">
#em_photo {
    height: 40px;
    widows: 40px;
}
</style>