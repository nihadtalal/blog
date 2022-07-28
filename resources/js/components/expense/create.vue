<template>
    <div>

        <div>
            <div class="row">
                <router-link to="/expense" class="btn-grad"> {{ $t('subsidebar.AllExpense') }}</router-link>
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
                                        <h1 class="h4 text-gray-900 mb-4">{{ $t('subsidebar.AddExpense') }}</h1>
                                    </div>
                                    <form class="user" @submit.prevent="expenseInsert" enctype="mutlipart/form-dta">
                                        <div class="form-group">

                                            <div class="form-row mb-4">
                                                <div class="col-md-12">
                                                    <label for="exampleFormControlTextarea1" style="float:right;"><b>{{ $t('expense.expensedetails') }}</b></label>
                                                    <textarea class="form-control" id="exampleFormControlTextarea1"
                                                        rows="3" v-model="form.details"></textarea>
                                                    <small class="text-danger" v-if="errors.details">{{
                                                            errors.details[0]
                                                    }}</small>
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="col-md-12">
                                                    <label for="exampleFormControlTextarea1" style="float:right;"><b>{{ $t('expense.expensedetails') }}</b></label>
                                                    <input type="text" class="form-control number"
                                                        id="exampleInputFirstName"
                                                        v-model="form.amount">
                                                    <small class="text-danger" v-if="errors.amount">{{ errors.amount[0]
                                                    }}</small>
                                                </div>
                                            </div>

                                        </div>



                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block">{{ $t('expense.submit') }}</button>
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
                details: '',
                amount: '',

            },
            errors: {

            }
        }
    },
    methods: {
        expenseInsert() {
            axios.post('/api/expense', this.form)
                .then(() => {
                    this.$router.push({ name: 'expense' })
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
    padding: 10px 30px;
    font-size: 13px;
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