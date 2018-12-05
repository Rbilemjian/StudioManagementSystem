<template>
  <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Welcome to Payment Logger</div>

                    <div class="card-body card-body--home">
                        <h2></h2>
                        <div class="col-md-6">
                            <div style="display:inline-block;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div style="height:50px"></div>
    </div>
</template>
<script>
export default {
      name: 'home',
      created() {
          axios.defaults.headers.common["Authorization"] = 'Bearer ' + this.$store.getters.currentUser.token;
      },
      computed: {
          welcome() {
              return this.$store.getters.welcome
          }
      }
  }
</script>
