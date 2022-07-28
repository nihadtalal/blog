<template>
  <div>

 <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-white">{{ $t('home.dashboard') }}</h1>
           
          </div>

          <div class="row mb-3">
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">{{ $t('home.sellAmount') }}</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800" dir="ltr">{{ Number(todaysell).toLocaleString() }} IQ</div>
                     
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-primary"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Earnings (Annual) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col ml-4">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">{{ $t('home.income') }}</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800" dir="ltr">{{ Number(income).toLocaleString() }} IQ</div>
                    
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-shopping-cart fa-2x text-success"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- New User Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col ml-4">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">{{ $t('home.due') }}</div>
                      <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800" dir="ltr">{{ Number(due).toLocaleString() }} IQ</div>
                      
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-users fa-2x text-info"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col ml-4">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">{{ $t('home.expense') }}</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800" dir="ltr">{{ Number(expense).toLocaleString() }} IQ</div>
                      
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-comments fa-2x text-warning"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>



              <div class="col-lg-12 mb-4">
                    <!-- Simple Tables -->
                    <div class="card">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary"><b>{{ $t('home.outStock') }}</b></h6>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th>{{ $t('home.name') }}</th>
                                        <th>{{ $t('home.code') }}</th>
                                        <th>{{ $t('home.photo') }}</th>
                                           
                                        <th>{{ $t('home.buyingPrice') }}</th>
                                          <th>{{ $t('home.status') }}</th>
                                        <th>{{ $t('home.quantity') }}</th>
                                     
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="product in products" :key="product.id">
                                        <td>{{ product.product_name }}</td>
                                        <td>{{ product.product_code }}</td>
                                        <td><img :src="product.image" id="em_photo" alt=""></td>
                                        
                                        <td>{{ product.buying_price }}</td>
                                         <td v-if="product.product_quantity >=1"><span class="badge badge-success">Available</span></td>
                                          <td v-else><span class="badge badge-danger">{{ $t('home.stockOut') }}</span></td>
                                        <td>{{ product.product_quantity }}</td>
                                       

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
</template>

<script type="text/javascript">


export default {
  created(){
   if(!User.loggedIn()){
    this.$router.push({name:'/'})
   } 
  },

  data(){

    return{
      todaysell:'',
      income: '',
      due: '',
      expense:'',
      products:'',
    }
  },
  mounted(){
    this.TodaySell();
      this.TodayIncome();
        this.TodayDue();
        this.TodayExpense();
        this.StockOut();
  },
  methods:{

    TodaySell(){
      axios.get('/api/today/sell')
            .then(({data}) => (this.todaysell =data))
            .catch(error => this.errors =( error.response.data.errors))
    },

    TodayIncome(){
      axios.get('/api/today/income')
            .then(({data}) => (this.income =data))
            .catch(error => this.errors =( error.response.data.errors))
    },

    TodayDue(){
      axios.get('/api/today/due')
            .then(({data}) => (this.due =data))
            .catch(error => this.errors =( error.response.data.errors))
    },

     TodayExpense(){
      axios.get('/api/today/expense')
            .then(({data}) => (this.expense =data))
            .catch(error => this.errors =( error.response.data.errors))
    },

     StockOut(){
      axios.get('/api/today/stockout')
            .then(({data}) => (this.products =data))
            .catch(error => this.errors =( error.response.data.errors))
    },

  }
  
 
}
</script>


<style>

</style>