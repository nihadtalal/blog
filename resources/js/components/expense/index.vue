<template>
    <div>

        <div>
            <div class="row">
                <router-link to="/store-expense" class="btn-grad"> {{ $t('subsidebar.AddExpense') }}</router-link>
            </div>
        </div>

        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                
            </div>

            <div class="mb-4">
                <input type="text" v-model="searchTerm" class="form-control" style="width:300px;"
                    :placeholder="$t('expense.expensesearch')">

                <!-- Search By Name -->
                <!-- <input type="checkbox" v-model="checked" id="checkbox">
            <label for="checkbox">Name</label> -->
            </div>

            <div class="row">
                <div class="col-lg-12 mb-4">
                    <!-- Simple Tables -->
                    <div class="card">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">{{ $t('expense.expenselist') }}</h6>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th>{{ $t('expense.details') }}</th>
                                           <th>{{ $t('expense.amount') }}</th>
                                              <th>{{ $t('expense.date') }}</th>
                                          <th>{{ $t('expense.action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="expense in filtersearch" :key="expense.id">
                                        <td>{{ expense.details }}</td>
                                          <td>{{ expense.amount }}</td>
                                            <td>{{ expense.expense_date }}</td>
                                        <td><router-link :to="{name:'edit-expense', params: {id:expense.id}}" class="btn btn-sm btn-primary">{{ $t('expense.edit') }}</router-link>
                                            <a @click="deleteExpense(expense.id)"
                                                class="btn btn-sm btn-danger" style="color:white">{{ $t('expense.delete') }}</a>
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
            expenses: [],
            searchTerm: '',
            // checked:'',
        }
    },
    computed: {
        filtersearch() {

            return this.expenses.filter(expense => {
                return expense.details.match(this.searchTerm)
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
        allExpense() {
            axios.get('/api/expense/')
                .then(({ data }) => (this.expenses = data

                ))
                .catch()
        },
        deleteExpense(id) {

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
                     axios.delete('/api/expense/'+id)
                     .then(()=>{
                        this.expenses = this.expenses.filter(expense => {
                            return expense.id !=id
                        })
                     })
                     .catch(()=>{
                        this.$router.push({
                            name:'expense'
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
        this.allExpense();
    }

}
</script>

<style type="text/css">
#em_photo {
    height: 40px;
    widows: 40px;
}
</style>