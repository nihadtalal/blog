<template>
  <div>

    <h1>Logout</h1>

  </div>
</template>

<script>
export default {
  created() {
    localStorage.removeItem('token');
    localStorage.removeItem('user');
    //Sweet alert 
    Toast.fire({
      icon: 'success',
      title: 'Logout successfully'
    })

    this.$router.push({ name: '/' })
  }
}
</script>

<style>
</style>