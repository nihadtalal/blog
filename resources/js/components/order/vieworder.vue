<template>
    <div>

        <div>
            <div class="row">
                <router-link to="/order" class="btn btn-primary"> {{ $t('order.back') }}</router-link>
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
                                        <h1 class="h4 text-gray-900 mb-4">{{ $t('order.orderdetails') }}</h1>
                                    </div>

                                    <hr>

                                    <div class="row">

                                        <div class="col-lg-6 mb-4">
                                            <!-- Simple Tables -->
                                            <div class="card">
                                                <div
                                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                                
                                                </div>
                                                <div class="table-responsive">
                                                    <ul class="list-group">
                                                        <li class="list-group-item"><b>{{ $t('order.name') }}:</b> {{ orders.name }} </li>
                                                        <li class="list-group-item"><b>{{ $t('order.phone') }}:</b> {{ orders.phone }}
                                                        </li>
                                                        <li class="list-group-item"><b>{{ $t('order.address') }}:</b> {{ orders.address }}
                                                        </li>
                                                        <li class="list-group-item"><b>{{ $t('order.date') }}:</b> {{ orders.order_date }}
                                                        </li>
                                                        <li class="list-group-item"><b>{{ $t('order.paythrough') }}:</b> {{ orders.payby
                                                        }} </li>
                                                    </ul>
                                                </div>
                                                <div class="card-footer"></div>
                                            </div>
                                            <!-- End Simple Tables -->
                                            <hr>
                                        </div>
                                        <div class="col-lg-6">
                                            <!-- Simple Tables -->
                                            <div class="card">
                                                <div
                                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                                
                                                </div>
                                                <div class="table-responsive">
                                                    <ul class="list-group">
                                                        <li class="list-group-item"><b>{{ $t('order.subtotal') }}:</b> {{
                                                                Number(orders.sub_total).toLocaleString()
                                                        }} IQ </li>
                                                        <li class="list-group-item"><b>{{ $t('order.vat') }}:</b> {{ orders.vat }} </li>
                                                        <li class="list-group-item"><b>{{ $t('order.total') }}:</b> {{
                                                                Number(orders.total).toLocaleString()
                                                        }} IQ </li>
                                                        <li class="list-group-item"><b>{{ $t('order.payamount') }}:</b> {{
                                                                Number(orders.pay).toLocaleString()
                                                        }} IQ </li>

                                                        <li class="list-group-item"><b>{{ $t('order.dueamount') }}:</b> {{
                                                                Number(orders.due).toLocaleString()
                                                        }} IQ </li>
                                                    </ul>
                                                </div>
                                                <div class="card-footer"></div>
                                            </div>
                                            <!-- End Simple Tables -->

                                        </div>

                                        <div class="col-lg-12">
                                            <!-- Simple Tables -->
                                            <div class="card">
                                                <div
                                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                                </div>
                                                <div class="table-responsive">
                                                    <table class="table align-items-center table-flush">
                                                        <thead class="thead-light">
                                                            <tr>
                                                                <th>{{ $t('order.productname') }}</th>
                                                                <th>{{ $t('order.productcode') }}</th>
                                                                <th>{{ $t('order.image') }}</th>
                                                                <th>{{ $t('order.qty') }}</th>
                                                                <th>{{ $t('order.unitprice') }}</th>
                                                                <th>{{ $t('order.total') }}</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr v-for="detail in details" :key="detail.id">
                                                                <td>{{ detail.product_name }}</td>
                                                                <td>{{ detail.product_code }}</td>
                                                                <td><img :src="'/' + detail.image" id="em_photo" alt="">
                                                                </td>
                                                                <td>{{ detail.pro_quantity }}</td>
                                                                <td>{{ Number(detail.product_price).toLocaleString() }}
                                                                    IQ</td>
                                                                <td>{{ Number(detail.sub_total).toLocaleString() }} IQ
                                                                </td>


                                                            </tr>

                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="card-footer"></div>
                                            </div>
                                            <!-- End Simple Tables -->

                                        </div>

                                    </div>



                                    <div class="text-center">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script type="text/javascript">
import Axios from 'axios';


export default {
    created() {
        if (!User.loggedIn()) {
            this.$router.push({ name: '/' })
        }
    },

    data() {
        return {

            errors: {

            },
            orders: {},
            details: {},

        }
    },
    created() {
        let id = this.$route.params.id
        axios.get('/api/order/details/' + id)
            .then(({ data }) => (this.orders = data))
            .catch(console.log('error'));

        axios.get('/api/order/orderdetails/' + id)
            .then(({ data }) => (this.details = data))
            .catch(console.log('error'));

    },
    methods: {


    },


}
</script>

<style type="text/css" scoped>
#em_photo {
    height: 40px;
    width: 40px;
}
</style>