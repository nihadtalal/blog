<template>
  <div>

    <div class="row justify-content-center">
      <div class="col-xl-6 col-lg-7 col-md-9 col-sm-9 ">
        <div class="card shadow-sm" style="margin-top:50%">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Reset Password</h1>
                  </div>
                  <form class="user">
                    <div class="form-group">
                      <input type="email" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp"
                        placeholder="Enter Existing Email Address">
                    </div>

                    <div class="form-group">
                      <a href="index.html" class="btn btn-primary btn-block">Reset Password</a>
                    </div>

                  </form>
                  <hr>
                  <div class="text-center">

                    <router-link class="font-weight-bold small" to="/">Already have an account?</router-link>

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

<script>
export default {

}
</script>

<style>
</style>