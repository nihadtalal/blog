<template>
  <div>

    <div class="row justify-content-center ">
      <div class="col-xl-6 col-lg-7 col-md-9 col-sm-9 ">
        <div class="card shadow-sm" style="margin-top:50%">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">{{ $t('login.login') }}</h1>
                  </div>
                  <form class="user" @submit.prevent="login">
                    <div class="form-group">
                      <input type="email" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp"
                        :placeholder="$t('login.enteremail')" v-model="form.email">
                      <small class="text-danger" v-if="errors.email">{{ errors.email[0] }}</small>
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control" id="exampleInputPassword" :placeholder="$t('login.password')"
                        v-model="form.password">
                      <small class="text-danger" v-if="errors.password">{{ errors.password[0] }}</small>
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small" style="line-height: 1.5rem;">
                        <input type="checkbox" class="custom-control-input" id="customCheck">
                        <label class="custom-control-label" for="customCheck">{{$t('login.rememberme')}}</label>
                      </div>
                    </div>
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-block">{{ $t('login.login') }}</button>
                    </div>

                  </form>
                  <hr>
                  <div class="text-center">

                    <router-link class="font-weight-bold small" to="/register">{{ $t('login.createaccount') }}</router-link>

                  </div>
                  <div class="text-center">
                    <!-- <router-link class="font-weight-bold small" to="/forget">{{ $t('login.forget') }}</router-link> -->
                  </div>
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
    if (User.loggedIn()) {
      this.$router.push({ name: 'home' })
    }
  },

  data() {
    return {
      form: {
        email: null,
        password: null,
      },
      errors: {

      }
    }
  },
  methods: {
    login() {
      axios.post('api/auth/login', this.form)
        .then(
          res => {
            User.responseAfterLogin(res)
            //Sweet alert 
            Toast.fire({
              icon: 'success',
              title: 'Signed in successfully'
            })

            this.$router.push({ name: 'home' })

          })


        .catch(error => this.errors = (error.response.data.errors))
        .catch(
          //Sweet alert 
          Toast.fire({
            icon: 'warning',
            title: 'Invalid Email or Password'
          })
        )
    }
  }
}
</script>

<style type="text/css">
</style>