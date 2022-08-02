<template>
    <div>

        <div>
            <div class="row">
                <router-link to="/employee" class="btn-grad"> {{ $t('subsidebar.AllEmployee') }}</router-link>
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
                                        <h1 class="h4 text-gray-900 mb-4">{{ $t('salary.paysalary') }}</h1>
                                    </div>
                                    <form class="user" @submit.prevent="SalaryPaid">
                                        <div class="form-group">

                                            <div class="form-row">
                                                <div class="col-md-6">
                                                     <label for="exampleFormControlSelect1"><b>{{ $t('salary.name') }}</b></label>
                                                    <input type="text" class="form-control" id="exampleInputFirstName"
                                                        placeholder="Enter Your Full Name" v-model="form.name">
                                                    <small class="text-danger" v-if="errors.name">{{ errors.name[0]
                                                    }}</small>
                                                </div>


                                                <div class="col-md-6">
                                                     <label for="exampleFormControlSelect1"><b>{{ $t('salary.email') }}</b></label>
                                                    <input type="email" class="form-control" id="exampleInputEmail"
                                                        aria-describedby="emailHelp" placeholder="Enter Email Address"
                                                        v-model="form.email">
                                                    <small class="text-danger" v-if="errors.email">{{ errors.email[0]
                                                    }}</small>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="form-group">

                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <label for="exampleFormControlSelect1"><b>{{ $t('salary.month') }}</b></label>
                                                    <select class="form-control" id="exampleFormControlSelect1"
                                                        v-model="form.salary_month">
                                                        <option selected value='Janaury'>{{ $t('salary.january') }}</option>
                                                        <option value='February'>{{ $t('salary.february') }}</option>
                                                        <option value='March'>{{ $t('salary.march') }}</option>
                                                        <option value='April'>{{ $t('salary.april') }}</option>
                                                        <option value='May'>{{ $t('salary.may') }}</option>
                                                        <option value='June'>{{ $t('salary.june') }}</option>
                                                        <option value='July'>{{ $t('salary.july') }}</option>
                                                        <option value='August'>{{ $t('salary.august') }}</option>
                                                        <option value='September'>{{ $t('salary.september') }}</option>
                                                        <option value='October'>{{ $t('salary.october') }}</option>
                                                        <option value='November'>{{ $t('salary.november') }}</option>
                                                        <option value='December'>{{ $t('salary.december') }}</option>




                                                    </select>
                                                    <small class="text-danger" v-if="errors.salary_month">{{
                                                            errors.salary_month[0]
                                                    }}</small>
                                                </div>


                                                <div class="col-md-6">
                                                     <label for="exampleFormControlSelect1"><b>{{ $t('salary.salary') }}</b></label>
                                                    <input type="text" class="form-control" id="exampleInputFirstName"
                                                        placeholder="Enter Your Salary" v-model="form.salary">
                                                    <small class="text-danger" v-if="errors.salary">{{ errors.salary[0]
                                                    }}</small>
                                                </div>
                                            </div>

                                        </div>

                                      



                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block">{{ $t('salary.paynow') }}</button>
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
                name: '',
                email: '',
                salary_month: '',
                salary: '',
            },
            errors: {

            },
            //this display for photo upload issue
            display: {
                photo: true,
            }

        }
    },
    created() {
        let id = this.$route.params.id
        axios.get('/api/employee/' + id)
            .then(({ data }) => (this.form = data))
            .catch(console.log('error'))
    },
    methods: {
     
        SalaryPaid() {
            let id = this.$route.params.id
            axios.post('/api/salary/paid/' + id, this.form)
                .then(() => {
                    this.$router.push({ name: 'given-salary' })
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