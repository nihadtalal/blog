<template>
    <div>

        <div>
            <div class="row">
                <router-link to="/store-employee" class="btn btn-primary"> {{ $t('stock.addproduct') }}</router-link>
            </div>
        </div>

        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">

            </div>

            <div class="mb-4">
                <input type="text" v-model="searchTerm" class="form-control" style="width:300px;"
                    :placeholder="$t('stock.addproduct') ">

                <!-- Search By Name -->
                <!-- <input type="checkbox" v-model="checked" id="checkbox">
            <label for="checkbox">Name</label> -->
            </div>

            <div class="row">
                <div class="col-lg-12 mb-4">
                    <!-- Simple Tables -->
                    <div class="card">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">{{ $t('stock.stocklist') }}</h6>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th>{{ $t('stock.name') }}</th>
                                        <th>{{ $t('stock.code') }}</th>
                                        <th>{{ $t('stock.photo') }}</th>
                                        <th>{{ $t('stock.category') }}</th>
                                        <th>{{ $t('stock.buyingprice') }}</th>
                                        <th>{{ $t('stock.status') }}</th>
                                        <th>{{ $t('stock.quantity') }}</th>
                                        <th>{{ $t('stock.action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="product in filtersearch" :key="product.id">
                                        <td>{{ product.product_name }}</td>
                                        <td>{{ product.product_code }}</td>
                                        <td><img :src="product.image" id="em_photo" alt=""></td>
                                        <td>{{ product.category_name }}</td>
                                        <td>{{ product.buying_price }}</td>
                                        <td v-if="product.product_quantity >= 1"><span
                                                class="badge badge-success">{{ $t('stock.available') }}</span></td>
                                        <td v-else><span class="badge badge-danger">{{ $t('stock.stockout') }}</span></td>
                                        <td>{{ product.product_quantity }}</td>
                                        <td>
                                            <router-link :to="{ name: 'edit-stock', params: { id: product.id } }"
                                                class="btn btn-sm btn-primary">{{ $t('stock.edit') }}</router-link>

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
            products: [],
            searchTerm: '',
            // checked:'',
        }
    },
    computed: {
        filtersearch() {

            return this.products.filter(product => {
                return product.product_name.match(this.searchTerm)
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
        allProduct() {
            axios.get('/api/product/')
                .then(({ data }) => (this.products = data

                ))
                .catch()
        },

    },
    created() {
        this.allProduct();
    }

}
</script>

<style type="text/css">
#em_photo {
    height: 40px;
    widows: 40px;
}
</style>