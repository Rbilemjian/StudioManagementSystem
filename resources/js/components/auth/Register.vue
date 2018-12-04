<template>
    <div class="login row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Register</div>
                <div class="card-body">
                    <form @submit.prevent="register">
                        <div class="form-group-row" style="margin-top:10px;">
                            <label for="name">Name</label>
                            <input type="name" v-model="form.name" class="form-control" placeholder="Name">
                        </div>
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
                        <div class="errors form-group-row" v-if="regErrors" style="margin-top:20px; margin-bottom: 5px; margin-right:0px; margin-left: 0px;">
                            <ul style="list-style:none; margin-left:0px; padding-left:0px; text-align:center">
                                <li v-for="(fieldsError, fieldName) in  regErrors" :key="fieldName">
                                    {{ fieldsError.join('\n') }}
                                </li>
                            </ul>
                        </div>
                        <div class="errors form-group-row text-center" v-if="backendError" style="margin-top:20px; margin-bottom: 5px">
                            {{ backendError }}
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import validate from 'validate.js';
    import {register} from '../../helpers/auth';


    export default {
        name: 'new',
        data() {
            return {
                form: {
                    name: '',
                    email: '',
                    password: ''
                },
                regErrors: null,
                backendError: null,
            };
        },
        methods: {
            register() {
                this.regErrors = null;
                this.backendError = null;

                const constraints = this.getConstraints();
                const regErrors = validate(this.$data.form, constraints);
                if(regErrors)
                {
                    this.regErrors = regErrors;
                    return;
                }

                register(this.$data.form)
                    .then((res) => {
                        this.$store.commit("loginSuccess", res);
                        this.$router.push({path: '/'});
                    })
                    .catch((error) => {
                        this.backendError = error;
                    });

            },
            getConstraints() {
                return {
                    name: {
                        presence: true,
                        length: {
                            minimum: 3,
                            message: 'must be at least 3 characters long'
                        }
                    },
                    email: {
                        presence: true,
                        email: true,
                    },
                    password: {
                        presence: true,
                        length: {
                            minimum: 8,
                            message: 'must be at least 8 characters long'
                        }
                    }
                };
            }

        }
    }
</script>

<style scoped>
.errors {
    color: red;
}
</style>
