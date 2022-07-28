<template>
  <div>

    <!-- Container Fluid-->
    <div class="container-fluid" id="container-wrapper">
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-white">{{ $t("pos.posdashboard") }}</h1>

      </div>

      <div class="row mb-3 flex-wrap-reverse">


        <!-- Area Chart -->
        <div class="col-xl-5 col-lg-12">
          <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
              <h6 class="m-0 font-weight-bold text-primary">{{ $t('pos.productInsert') }}</h6>
              <router-link class="btn btn-sm btn-info" to="/store-customer">{{ $t('pos.addCustomer') }}</router-link>
            </div>
            <div class="card-body">
              <!-- Simple Tables -->
              <div class="card">
                <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th colspan="2">{{ $t('pos.name') }}</th>
                        <th style="text-align:center;">{{ $t('pos.qty') }}</th>
                        <th>{{ $t('pos.unit') }}</th>
                        <th>{{ $t('pos.total') }}</th>
                        <th>{{ $t('pos.action') }}</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="cart in carts" :key="cart.id">
                        <td>{{ cart.pro_name }}</td>
                        <td colspan="2">
                          <div class="row">
                            <!-- <button @click.prevent="Decrement(cart.id)" class="btn btn-sm btn-danger"
                              style="width:40px;" v-if="cart.pro_quantity>1">-</button>
                               <button @click.prevent="Decrement(cart.id)" class="btn btn-sm btn-danger"
                              style="width:40px;" v-else disabled>-</button> -->

                            <button @click.prevent="Decrement(cart.id)" class="btn btn-sm btn-danger"
                              style="width:40px;" :disabled="cart.pro_quantity > 1 ? false : true">-</button>

                            <input type="text" class="form-control mx-2" :value="cart.pro_quantity"
                              style="width:50px; text-align: center;" v-if="cart.pro_quantity">
                            <button @click.prevent="Increment(cart.id)" class="btn btn-sm btn-success"
                              style="width:40px;">+</button>
                          </div>
                        </td>

                        <td>{{ Number(cart.product_price).toLocaleString() }}</td>
                        <td>{{ Number(cart.sub_total).toLocaleString() }} IQ</td>

                        <td><a @click="removeItem(cart.id)" class="btn btn-sm btn-danger" style="color:white;">X</a>
                        </td>
                      </tr>

                    </tbody>
                  </table>
                </div>
                <div class="card-footer">
                  <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center">{{
                        $t('pos.totalQuantity')
                    }} :
                      <strong>{{ qty }}</strong>

                    </li>



                    <li class="list-group-item d-flex justify-content-between align-items-center">{{ $t('pos.subtotal')
                    }} :
                      <strong dir="ltr">{{ Number(subtotal).toLocaleString() }} IQ</strong>

                    </li>




                    <li class="list-group-item d-flex justify-content-between align-items-center">{{ $t('pos.discount')
                    }} :
                      <strong dir="ltr">{{ vats.vat }} %</strong>

                    </li>



                    <li class="list-group-item d-flex justify-content-between align-items-center">{{
                        $t('pos.totalamount')
                    }} :
                      <!-- vat  <strong>{{ subtotal*vats.vat / 100 + subtotal }} IQ</strong> -->
                      <strong dir="ltr">{{ Number(subtotal - (subtotal * vats.vat / 100)).toLocaleString() }}
                        IQ</strong>

                    </li>

                  </ul>

                  <form class="mt-3" @submit.prevent="orderdone">
                    <label for="form-control">{{ $t('pos.customerName') }}</label>
                    <select class="form-control" v-model="customer_id">


                      <option :value="customer.id" v-for="customer in customers" :key="customer.id">{{ customer.name }}
                      </option>
                    </select>
                    <label for="" style="float:right;">{{ $t('pos.pay') }}</label>
                    <input type="text" class="form-control" required="" v-model="pay" :change="pay">

                    <!-- <label for="">{{ $t('pos.due') }}</label>
                    <input type="text" class="form-control" required="" v-model="pay"> -->

                    <label for="" style="float:right;">{{ $t('pos.due') }}</label>
                    <input type="text" class="form-control" :value="dueamount" readonly>

                    <label for="form-control" style="float:right;">{{ $t('pos.payby') }}</label>
                    <div class="mb-3">
                      <select class="form-control" v-model="payby">

                        <option value="HandCash">Hand Cash</option>
                        <!-- <option value="Cheaque">Cheaque</option>
                        <option value="GiftCard">Gift Card</option> -->
                      </select>
                    </div>
                    <button type="submit" class="btn btn-success">اضافة</button>

                  </form>



                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Pie Chart -->
        <div class="col-xl-7 col-lg-12">
          <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
              <h6 class="m-0 font-weight-bold text-primary">{{ $t('pos.productsold') }}</h6>
              <div>


                <!-- Search By Name -->
                <!-- <input type="checkbox" v-model="checked" id="checkbox">
            <label for="checkbox">Name</label> -->
              </div>



            </div>
            <!--Category Wis Product-->
            <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item" role="presentation">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
                  aria-selected="true">{{ $t('pos.allProduct') }}</a>
              </li>
              <li class="nav-item" role="presentation" v-for="category in categories" :key="category.id">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                  aria-controls="profile" aria-selected="false" @click="subproduct(category.id)">{{
                      category.category_name
                  }}</a>
              </li>
            </ul>
            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                <!--Tab One All Product-->

                <div class="m-2">
                  <input type="text" v-model="searchTerm" class="form-control" style="width:100%;"
                    :placeholder="$t('pos.searchproduct')">
                </div>


                <div class="card-body">
                  <div class="row">
                    <div class="col-lg-3 col-md-4 col-sm-6 col-4 " v-for="product in filtersearch" :key="product.id">

                      <button class="btn btn-sm" @click.prevent="AddToCart(product.id)"
                        :disabled="product.product_quantity <= 0 && product.product_quantity ? true : false">
                        <div class="card mb-3" style="width: 8.5rem;">
                          <div class="d-flex justify-content-center">
                            <img :src="product.image" id="em_photo" class="card-img-top">
                          </div>



                          <div class="card-body pb-0 d-flex justify-content-center">

                            <h6 class="card-title">{{ product.product_name }}</h6>
                          </div>
                          <div class="pb-3 d-flex justify-content-center">
                            <span class="badge badge-success" v-if="product.product_quantity >= 1">{{
                                $t('pos.available')
                            }} {{
    product.product_quantity
}}</span>
                            <span class="badge badge-danger" v-else>{{ $t('home.stockOut') }}</span>
                          </div>
                        </div>
                      </button>
                    </div>
                  </div>
                </div>

                <!--End One All Product-->


              </div>
              <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">


                <!--Tab Two All Categories-->
                <div class="m-2">
                  <input type="text" v-model="searchTerm" class="form-control" style="width:100%;"
                    placeholder="Search Product">
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-lg-3 col-md-4 col-sm-6 col-4 " v-for="getproduct in filtersearchcat"
                      :key="getproduct.id">

                      <button class="btn btn-sm" @click.prevent="AddToCart(getproduct.id)"
                        :disabled="getproduct.product_quantity <= 0 && getproduct.product_quantity ? true : false">
                        <div class="card mb-3" style="width: 8.5rem;">
                          <div class="d-flex justify-content-center">
                            <img :src="getproduct.image" id="em_photo" class="card-img-top">
                          </div>



                          <div class="card-body pb-0 d-flex justify-content-center">

                            <h6 class="card-title">{{ getproduct.product_name }}</h6>
                          </div>
                          <div class="pb-3 d-flex justify-content-center">
                            <span class="badge badge-success" v-if="getproduct.product_quantity >= 1">{{
                                $t('pos.available')
                            }} {{getproduct.product_quantity}}</span>
                            <span class="badge badge-danger" v-else>{{ $t('home.stockOut') }}</span>
                          </div>
                        </div>
                      </button>
                    </div>
                  </div>
                </div>

                <!--End One All Categories-->


              </div>
            </div>
            <!--End Category Wis Product-->

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
  created() {
    this.allProduct();
    this.allCategory();
    this.allCustomer();
    this.cartProduct();
    this.vat();
    Reload.$on('AfterAdd', () => {
      this.cartProduct();
    });
    //update the product quantity
    Reload.$on('UpdateQty', () => {
      this.allProduct();
    })
  },

  data() {
    return {
      customer_id: '',
      pay: 0,
      due: '',
      payby: '',
      products: [],
      categories: [],
      customers: [],
      getproducts: [],
      searchTerm: '',
      carts: [],
      vats: '',
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

    },


    filtersearchcat() {

      return this.getproducts.filter(product => {
        return product.product_name.match(this.searchTerm)
      })
    },

    qty() {
      let sum = 0;
      for (let i = 0; i < this.carts.length; i++) {
        sum += (parseFloat(this.carts[i].pro_quantity));
      }
      return sum;
    },

    subtotal() {
      let sum = 0;
      for (let i = 0; i < this.carts.length; i++) {
        sum += (parseFloat(this.carts[i].pro_quantity)) * (parseFloat(this.carts[i].product_price));
      }

      return sum;
    },

    total() {
      let total = this.subtotal - (this.subtotal * this.vats.vat / 100);
      return total;
    },



    dueamount() {
      let sum = (parseInt(this.pay - this.total));
      this.due = sum
      return sum;
    },
  },
  methods: {
    //Cart Methods Here
    AddToCart(id) {
      axios.get('/api/addToCart/' + id)
        .then(() => {

          Reload.$emit('AfterAdd');
          //update the product quantity
          Reload.$emit('UpdateQty');
          Notification.cart_success()
        }
        )
        .catch()
    },

    //update the product quantity


    cartProduct() {
      axios.get('/api/cart/product/')
        .then(({ data }) => (this.carts = data

        ))
        .catch()
    },
    removeItem(id) {
      axios.get('/api/remove/cart/' + id)
        .then(() => {
          Reload.$emit('UpdateQty');
          Reload.$emit('AfterAdd');
          Notification.cart_delete()
        })
        .catch()
    },

    Increment(id) {
      axios.get('/api/increment/' + id)
        .then(() => {
          Reload.$emit('UpdateQty');
          Reload.$emit('AfterAdd');
          // Notification.success()
        }
        )
        .catch()
    },
    Decrement(id) {
      axios.get('/api/decrement/' + id)
        .then(() => {
          Reload.$emit('UpdateQty');
          Reload.$emit('AfterAdd');
          // Notification.success()
        }
        )
        .catch()
    },
    //End Cart Methods
    allProduct() {
      axios.get('/api/product/')
        .then(({ data }) => (this.products = data

        ))
        .catch()
    },

    vat() {
      axios.get('/api/vat/')
        .then(({ data }) => (this.vats = data

        ))
        .catch()
    },
    orderdone() {
      let total = this.subtotal - (this.subtotal * this.vats.vat / 100);
      var data = { qty: this.qty, subtotal: this.subtotal, customer_id: this.customer_id, payby: this.payby, pay: this.pay, due: this.due, vats: this.vats.vat, total: total }
      if(this.due<0)
      {
         Notification.errordue()
      }else{
      axios.post('/api/orderdone', data)
        .then(() => {
          Notification.success()
          this.$router.push({ name: 'home' })
        })
      }

    },

    allCategory() {
      axios.get('/api/category/')
        .then(({ data }) => (this.categories = data

        ))
        .catch()
    },

    allCustomer() {
      axios.get('/api/customer/')
        .then(({ data }) => (this.customers = data

        ))
        .catch()
    },
    subproduct(id) {
      axios.get('/api/getting/product/' + id)
        .then(({ data }) => (this.getproducts = data

        ))
        .catch()
    },


  }

}
</script>

<style type="text/css" scoped>
#em_photo {
  height: 100px;
  width: 135px;
}
</style>