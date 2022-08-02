<template>
    <div>

        <div>
            <div class="row">
                <router-link to="/salary" class="btn btn-primary"> {{ $t('salary.back') }}</router-link>
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
                                        <h1 class="h4 text-gray-900 mb-4">{{ $t('salary.updatesalary') }}</h1>
                                    </div>
                                    <form class="user" @submit.prevent="SalaryUpdate">
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

                                                <input type="hidden" v-model="form.employee_id">
                                                <div class="col-md-6">
                                                     <label for="exampleFormControlSelect1"><b>{{ $t('salary.amount') }}</b></label>
                                                    <input type="text" class="form-control" id="exampleInputFirstName"
                                                        placeholder="Enter Your Amount" v-model="form.amount">
                                                    <small class="text-danger" v-if="errors.amount">{{ errors.amount[0]
                                                    }}</small>
                                                </div>
                                            </div>

                                        </div>

                                      



                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block">{{ $t('salary.update') }}</button>
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
                amount: '',
                employee_id:'',
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
        axios.get('/api/edit/salary/' + id)
            .then(({ data }) => (this.form = data))
            .catch(console.log('error'))
    },
    methods: {
     
        SalaryUpdate() {
            let id = this.$route.params.id
            axios.post('/api/salary/update/' + id, this.form)
                .then(() => {
                    this.$router.push({ name: 'salary' })
                    Notification.success()
                })
                .catch(error => this.errors = (error.response.data.errors))
        }
    }

}
</script>

<style type="text/css">
</style>