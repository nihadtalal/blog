<template>
    <div>

        <div>
            <div class="row">
                <router-link to="/store-product" class="btn-grad"> {{ $t('subsidebar.AddProduct') }}</router-link>
            </div>
        </div>

        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
               
            </div>

            <div class="mb-4">
                <input type="text" v-model="searchTerm" class="form-control" style="width:300px;"
                    :placeholder="$t('product.searchproduct')">

                <!-- Search By Name -->
                <!-- <input type="checkbox" v-model="checked" id="checkbox">
            <label for="checkbox">Name</label> -->
            </div>

            <div class="row">
                <div class="col-lg-12 mb-4">
                    <!-- Simple Tables -->
                    <div class="card">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">{{ $t('product.productlist') }}</h6>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th>{{ $t('product.name') }}</th>
                                        <th>{{ $t('product.code') }}</th>
                                        <th>{{ $t('product.code') }}</th>
                                        <th>{{ $t('product.buyingprice') }}</th>
                                          <th>{{ $t('product.sellingprice') }}</th>
                                          <th>{{ $t('product.quantityproduct') }}</th>
                                        <th>{{ $t('product.root') }}</th>
                                        <th>{{ $t('product.action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="product in filtersearch" :key="product.id">
                                        <td>{{ product.product_name }}</td>
                                        <td>{{ product.product_code }}</td>
                                        <td><img :src="product.image" id="em_photo" alt=""></td>
                                        
                                        <td>{{ Number(product.buying_price).toLocaleString() }}</td>
                                        <td>{{ Number(product.selling_price).toLocaleString() }}</td>
                                          <td>{{ Number(product.product_quantity).toLocaleString() }}</td>
                                         <td>{{ product.root }}</td>
                                        <td><router-link :to="{name:'edit-product', params: {id:product.id}}" class="btn btn-sm btn-primary">{{ $t('product.edit') }}</router-link>
                                            <a @click="deleteProduct(product.id)"
                                                class="btn btn-sm btn-danger" style="color:white">{{ $t('product.delete') }}</a>
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
        deleteProduct(id) {

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
                     axios.delete('/api/product/'+id)
                     .then(()=>{
                        this.products = this.products.filter(product => {
                            return product.id !=id
                        })
                     })
                     .catch(()=>{
                        this.$router.push({
                            name:'product'
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
        this.allProduct();
    }

}
</script>

<style type="text/css">
#em_photo {
    height: 40px;
    width: 40px;
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