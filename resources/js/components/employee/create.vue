<template>
    <div>

        <div>
            <div class="row">
                <router-link to="/employee" class="btn-grad" style="background-color: #00FBA5; border-color: #00FBA5;">
                    {{ $t('subsidebar.AllEmployee') }}</router-link>
            </div>

            <!-- <div class="message">
                <p>{{ $t('messages.failed') }}</p>
            </div> -->

            <!-- <div class="message">
                <p>{{ $t('messages.hello', { name: 'visitor' }) }}</p>
            </div> -->
        </div>

        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-10 col-md-12">
                <div class="card shadow-sm my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="login-form">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">{{ $t('subsidebar.AddEmployee') }}</h1>
                                    </div>
                                    <form class="user" @submit.prevent="employeeInsert" enctype="mutlipart/form-dta">
                                        <div class="form-group">

                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" id="exampleInputFirstName"
                                                        :placeholder="$t('employee.entername')" v-model="form.name">
                                                    <small class="text-danger" v-if="errors.name">{{ errors.name[0]
                                                    }}</small>
                                                </div>


                                                <div class="col-md-6">
                                                    <input type="email" class="form-control" id="exampleInputEmail"
                                                        aria-describedby="emailHelp" :placeholder="$t('employee.enteremail')"
                                                        v-model="form.email">
                                                    <small class="text-danger" v-if="errors.email">{{ errors.email[0]
                                                    }}</small>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="form-group">

                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" id="exampleInputFirstName"
                                                        :placeholder="$t('employee.enteraddress')" v-model="form.address">
                                                    <small class="text-danger" v-if="errors.address">{{
                                                            errors.address[0]
                                                    }}</small>
                                                </div>


                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" id="exampleInputFirstName"
                                                        :placeholder="$t('employee.entersalary')" v-model="form.salary">
                                                    <small class="text-danger" v-if="errors.salary">{{ errors.salary[0]
                                                    }}</small>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="form-group">

                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <input type="date" class="form-control" id="exampleInputFirstName"
                                                        placeholder="Enter Your Joining Date"
                                                        v-model="form.joining_date">
                                                    <small class="text-danger" v-if="errors.joining_date">{{
                                                            errors.joining_date[0]
                                                    }}</small>
                                                </div>


                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" id="exampleInputFirstName"
                                                        :placeholder="$t('employee.enternid')" v-model="form.nid">
                                                    <small class="text-danger" v-if="errors.nid">{{ errors.nid[0]
                                                    }}</small>
                                                </div>
                                            </div>

                                        </div>


                                        <div class="form-group">

                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" id="exampleInputFirstName"
                                                        :placeholder="$t('employee.enterphone')" v-model="form.phone">
                                                    <small class="text-danger" v-if="errors.phone">{{ errors.phone[0]
                                                    }}</small>
                                                </div>


                                                <div class="col-md-6">

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
                                                    <label class="custom-file-label" for="customFile">{{ $t('employee.choosefile') }}</label>

                                                </div>


                                                <div class="col-md-6">
                                                    <img :src="form.photo" alt="" style="height:40px; width:40px">
                                                </div>
                                            </div>

                                        </div>

                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block">{{ $t('employee.submit') }}</button>
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
                name: null,
                email: null,
                phone: null,
                salary: null,
                address: null,
                photo: null,
                nid: null,
                joining_date: null,
            },
            errors: {

            }
        }
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
                    this.form.photo = event.target.result
                    // console.log(event.target.result)
                };
                reader.readAsDataURL(file);
            }
        },
        employeeInsert() {
            axios.post('/api/employee', this.form)
                .then(() => {
                    this.$router.push({ name: 'employee' })
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