<template>
    <div>

        <div>
            <div class="row">
            <router-link to="/category" class="btn-grad"> {{ $t('subsidebar.AllCategories') }}</router-link>
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
                                        <h1 class="h4 text-gray-900 mb-4"> {{ $t('subsidebar.AddCategories') }}</h1>
                                    </div>
                                    <form class="user" @submit.prevent="categoryInsert" enctype="mutlipart/form-dta">
                                        <div class="form-group">

                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" id="exampleInputFirstName"
                                                        :placeholder="$t('category.entercategory')" v-model="form.category_name">
                                                    <small class="text-danger" v-if="errors.category_name">{{ errors.category_name[0]
                                                    }}</small>
                                                </div>
                                            </div>

                                        </div>

                                      

                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block">{{ $t('category.submit') }}</button>
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


export default {
    created() {
        if (!User.loggedIn()) {
            this.$router.push({ name: '/' })
        }
    },

    data() {
        return {
            form: {
                category_name: null,
               
            },
            errors: {

            }
        }
    },
    methods: {
        categoryInsert() {
            axios.post('https://nihadtalal.herokuapp.com/api/category',this.form)
            .then(() => {
                this.$router.push({name: 'category'})
                Notification.success()
            })
            .catch(error => this.errors = (error.response.data.errors))
        }
    }

}
</script>

<style type="text/css">
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