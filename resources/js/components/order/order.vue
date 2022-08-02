<template>
    <div>



        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">

            </div>

            <div class="mb-4">
                <input type="text" v-model="searchTerm" class="form-control" style="width:300px;"
                    :placeholder="$t('order.searchorder')">

                <!-- Search By Name -->
                <!-- <input type="checkbox" v-model="checked" id="checkbox">
            <label for="checkbox">Name</label> -->
            </div>

            <div class="row">
                <div class="col-lg-12 mb-4">
                    <!-- Simple Tables -->
                    <div class="card">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">{{ $t('order.todayorder') }}</h6>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th>{{ $t('order.name') }}</th>
                                        <th>{{ $t('order.totalamount') }}</th>
                                        <th>{{ $t('order.pay') }}</th>
                                        <th>{{ $t('order.due') }}</th>
                                        <th>{{ $t('order.payby') }}</th>
                                        <th>{{ $t('order.action') }}</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="order in filtersearch" :key="order.id">
                                        <td>{{ order.name }}</td>
                                        <td>{{ Number(order.total).toLocaleString() }} IQ</td>
                                        <td>{{ Number(order.pay).toLocaleString() }} IQ</td>
                                        <td>{{ Number(order.due).toLocaleString() }} IQ</td>
                                        <td>{{ order.payby }}</td>

                                        <td>
                                            <router-link :to="{ name: 'view-order', params: { id: order.id } }"
                                                class="btn btn-sm btn-primary">{{ $t('order.view') }}</router-link>

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
            orders: [],
            searchTerm: '',
            // checked:'',
        }
    },
    computed: {
        filtersearch() {

            return this.orders.filter(order => {
                return order.name.match(this.searchTerm)
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
        allOrder() {
            axios.get('/api/orders/')
                .then(({ data }) => (this.orders = data

                ))
                .catch()
        },

    },
    created() {
        this.allOrder();
    }

}
</script>

<style type="text/css">
#em_photo {
    height: 40px;
    widows: 40px;
}
</style>