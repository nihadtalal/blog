<template>
    <div>

        <div>
            <div class="row">
                <router-link to="/employee" class="btn-grad"> {{ $t('subsidebar.AllProduct') }}</router-link>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="card shadow-sm my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="login-form">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">{{ $t('product.productupdate') }}</h1>
                                    </div>
                                    <form class="user" @submit.prevent="productUpdate" enctype="mutlipart/form-dta">
                                        <div class="form-group">

                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" id="exampleInputFirstName"
                                                        :placeholder="$t('product.enterproduct')"
                                                        v-model="form.product_name">
                                                    <small class="text-danger" v-if="errors.product_name">{{
                                                            errors.product_name[0]
                                                    }}</small>
                                                </div>


                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" id="exampleInputProductCode"
                                                        :placeholder="$t('product.entercode')" v-model="form.product_code">
                                                    <small class="text-danger" v-if="errors.product_code">{{
                                                            errors.product_code[0]
                                                    }}</small>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="form-group">

                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    
                                                    <select class="form-control" id="exampleFormControlSelect1" v-model="form.supplier_id">
                                                       <option selected>{{ $t('product.entersupplier') }}</option>
                                                        <option v-for="supplier in suppliers" :value="supplier.id" :key="supplier.id" >{{ supplier.name }}</option>
                                                        
                                                    </select>
                                                    <small class="text-danger" v-if="errors.supplier_id">{{
                                                            errors.supplier_id[0]
                                                    }}</small>
                                                </div>


                                                <div class="col-md-6">
                                                    
                                                    <select class="form-control" id="exampleFormControlSelect1" v-model="form.category_id" >
                                                        <option selected>{{ $t('product.entercategory') }}</option>
                                                        <option v-for="category in categories" :value="category.id" :key="category.id" >{{ category.category_name }}</option>
                                                     
                                                    </select>
                                                    <small class="text-danger" v-if="errors.category_id">{{ errors.category_id[0]
                                                    }}</small>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="form-group">

                                            <div class="form-row">
                                                  <div class="col-md-4">
                                                    <input type="text" class="form-control" id="exampleInputFirstName"
                                                        :placeholder="$t('product.enterroot')"
                                                        v-model="form.root">
                                                    <small class="text-danger" v-if="errors.root">{{
                                                            errors.root[0]
                                                    }}</small>
                                                </div>

                                                 <div class="col-md-4">
                                                    <input type="text" class="form-control" id="exampleInputFirstName"
                                                        :placeholder="$t('product.buyingprice')"
                                                        v-model="form.buying_price">
                                                    <small class="text-danger" v-if="errors.buying_price">{{
                                                            errors.buying_price[0]
                                                    }}</small>
                                                </div>


                                                <div class="col-md-4">
                                                    <input type="text" class="form-control" id="exampleInputProductCode"
                                                        :placeholder="$t('product.sellingprice')" v-model="form.selling_price">
                                                    <small class="text-danger" v-if="errors.selling_price">{{
                                                            errors.selling_price[0]
                                                    }}</small>
                                                </div>
                                            </div>

                                        </div>


                                        <div class="form-group">

                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <input type="date" class="form-control" id="exampleInputFirstName"
                                                        placeholder="enter date" v-model="form.buying_date">
                                                    <small class="text-danger" v-if="errors.buying_date">{{ errors.buying_date[0]
                                                    }}</small>
                                                </div>


                                                 <div class="col-md-6">
                                                    <input type="text" class="form-control" id="exampleInputFirstName"
                                                        :placeholder="$t('product.quantityproduct')" v-model="form.product_quantity">
                                                    <small class="text-danger" v-if="errors.product_quantity">{{ errors.product_quantity[0]
                                                    }}</small>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="form-group">

                                            <div class="form-row">
                                                <div class="col-md-6">

                                                    <input type="file" class="custom-file-input" id="customFile"
                                                        @change="onFileSelected">
                                                    <small class="text-danger" v-if="errors.photo">{{ errors.photo[0]
                                                    }}</small>
                                                    <label class="custom-file-label" for="customFile">{{ $t('product.choosefile') }}
                                                        </label>

                                                </div>


                                                <div class="col-md-6">
                                                    <!-- this display for photo upload issue -->
                                                    <img v-if="display.photo" :src="'http://127.0.0.1:8000/' + form.image"
                                                        alt="" style="height:40px; width:40px;">
                                                    <img v-if="!display.photo" :src="form.image" alt=""
                                                        style="height:40px; width:40px;">
                                                </div>
                                            </div>

                                        </div>

                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block">{{ $t('product.update') }}</button>
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
            form: {
                category_id: '',
                product_name: '',
                product_code: '',
                root: '',
                buying_price: '',
                selling_price: '',
                supplier_id: '',
                buying_date: '',
                newphoto:'',
                image: '',
                product_quantity: '',
            },
            errors: {

            },
            //this display for photo upload issue
            display: {
                photo: true,
            },
            categories: {},
            suppliers: {},

        }
    },
    created() {
        let id = this.$route.params.id
        axios.get('/api/product/' + id)
            .then(({ data }) => (this.form = data))
            .catch(console.log('error'));

            //Category Collected
             axios.get('/api/category')
        .then(({data})=>(this.categories = data))

            //Supplier Collected
         axios.get('/api/supplier')
        .then(({data})=>(this.suppliers = data))
    },
    methods: {
        onFileSelected(event) {
            // console.log(event)

            //upload image less than 1mb
            let file = event.target.files[0];
            if (file.size > 1048770) {
                Notification.image_validation()
            } else {
                let reader = new FileReader();
                reader.onload = event => {
                    this.form.newphoto = event.target.result
                    this.form.image = event.target.result
                    // console.log(event.target.result)
                };
                reader.readAsDataURL(file);

                //this display for photo upload issue
                this.display = false;
            }
        },
        productUpdate() {
            let id = this.$route.params.id
            axios.patch('/api/product/' + id, this.form)
                .then(() => {
                    this.$router.push({ name: 'product' })
                    Notification.success()
                })
                .catch(error => this.errors = (error.response.data.errors))
        }
    },
  

}
</script>

<style type="text/css">
</style>