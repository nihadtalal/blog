<template>
    <div>

        <div>
            <div class="row">
                <router-link to="/order" class="btn btn-primary"> {{ $t('order.todayorder') }}</router-link>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-10 col-md-12">
                <div class="card shadow-sm my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="login-form">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">{{ $t('order.searchorder') }}</h1>
                                    </div>
                                    <form class="user" @submit.prevent="searchDate" enctype="mutlipart/form-dta">
                                        <div class="form-group">

                                            <div class="form-row">
                                                <div class="col-md-12">
                                                    <label for="exampleFormControlDate"><b>{{ $t('order.searchbydate') }}</b></label>
                                                    <input type="date" class="form-control" id="exampleInputFirstName"
                                                        required v-model="date">


                                                </div>
                                            </div>

                                        </div>



                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block">{{ $t('order.search') }}</button>
                                        </div>

                                    </form>
                                    <hr>



                                    <div class="text-center">
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>


                </div>
                <div class="card shadow-sm my-5">
                    <div class='card-body p-0'>

                        <div class="row">
                            <div class="col-lg-12">
                                <!-- Simple Tables -->
                                <div class="card">
                                    <div
                                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                        <h6 class="m-0 font-weight-bold text-primary">{{ $t('order.orderdetails') }}</h6>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table align-items-center table-flush">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>{{ $t('order.productname') }}</th>
                                                    <th>{{ $t('order.qty') }}</th>
                                                    <th>{{ $t('order.subtotal') }}</th>
                                                    <th>{{ $t('order.vat') }}</th>
                                                    <th>{{ $t('order.total') }}</th>
                                                    <th>{{ $t('order.pay') }}</th>
                                                    <th>{{ $t('order.due') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="order in orders" :key="order.id">
                                                    <td>{{ order.name }}</td>
                                                    <td>{{ order.qty }}</td>
                                                    <td>{{ Number(order.sub_total).toLocaleString() }} IQ</td>
                                                    <td>{{ order.vat }}</td>
                                                    <td>{{ Number(order.total).toLocaleString() }} IQ</td>
                                                    <td>{{ Number(order.pay).toLocaleString() }} IQ</td>
                                                    <td>{{ Number(order.due).toLocaleString() }} IQ</td>


                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="card-footer"></div>
                                </div>
                                <!-- End Simple Tables -->

                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
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

            date: '',
            orders: {}

        }
    },
    methods: {
        searchDate() {
            var data = { date: this.date }
            axios.post('api/search/order/', data)
                .then(({ data }) => (this.orders = data))
                .catch(error => this.errors = (error.response.data.errors))
        },
    }

}
</script>

<style type="text/css">
</style>