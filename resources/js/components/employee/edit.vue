<template>
    <div>

        <div>
            <div class="row">
                <router-link to="/employee" class="btn-grad"> {{$t('subsidebar.AllEmployee')}}</router-link>
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
                                        <h1 class="h4 text-gray-900 mb-4">{{ $t('employee.employeeupdate') }}</h1>
                                    </div>
                                    <form class="user" @submit.prevent="employeeUpdate" enctype="mutlipart/form-dta">
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
                                                     <!-- this display for photo upload issue -->
                                                    <img v-if="display.photo" :src="'http://127.0.0.1:8000/'+form.photo" alt="" style="height:40px; width:40px;">
                                                    <img v-if="!display.photo" :src="form.photo" alt="" style="height:40px; width:40px;">
                                                </div>
                                            </div>

                                        </div>

                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block">{{ $t('employee.update') }}</button>
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
                phone: '',
                salary: '',
                address: '',
                photo: '',
                newphoto: '',
                nid: '',
                joining_date: '',
            },
            errors: {

            },
            //this display for photo upload issue
            display:{
                photo:true,
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
                     this.form.photo = event.target.result
                    // console.log(event.target.result)
                };
                reader.readAsDataURL(file);

                 //this display for photo upload issue
                 this.display = false;
            }
        },
        employeeUpdate() {
            let id = this.$route.params.id
            axios.patch('/api/employee/' + id, this.form)
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
</style>