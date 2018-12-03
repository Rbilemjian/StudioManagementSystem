<template>
    <div class="login row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Login</div>
                <div class="card-body">
                    <form @submit.prevent="authenticate">
                        <div class="form-group-row" style="margin-top:10px;">
                            <label for="email">Email</label>
                            <input type="email" v-model="form.email" class="form-control" placeholder="Email Address">
                        </div>
                        <div class="form-group-row" style="margin-top:10px;">
                            <label for="password">Password</label>
                            <input type="password" v-model="form.password" class="form-control" placeholder="Password">
                        </div>
                        <div class="form-group-row text-center" style="margin-top:20px;">
                            <input type="submit" class="btn btn-primary btn-md"><span style="padding-left: 7px" class="glyphicon glyphicon-login" aria-hidden="true"></span></button>
                        </div>
                        <div class="form-group-row" v-if="authError" style="margin-top:20px; margin-bottom:5px;">
                            <p class="error">
                                {{ authError }}
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {login} from '../../helpers/auth';

    export default {
        name: "login",
        data() {
            return {
                form: {
                    email: '',
                    password: ''
                },
                error: null
            };
        },
        methods: {
            authenticate() {
                this.$store.dispatch('login');

                login(this.$data.form)
                    .then((res) => {
                        this.$store.commit("loginSuccess", res);
                        this.$router.push({path: '/'});
                    })
                    .catch((error) => {
                        this.$store.commit("loginFailed", {error});
                    });
            }
        },
        computed: {
            authError() {
                return this.$store.getters.authError;
            }
        }
    }
</script>

<style scoped>

.error {
    text-align: center;
    color: red;
}

</style>
