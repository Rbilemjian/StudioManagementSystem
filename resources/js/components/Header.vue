<template>
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
        <div class="container">
            <router-link class="navbar-brand" to="/">Payment Logger</router-link>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <template v-if="!currentUser">
                        <li>
                            <router-link to="/login" class="nav-link">Login</router-link>
                        </li>
                        <li>
                            <router-link to="/register" class="nav-link">Register</router-link>
                        </li>
                    </template>
                    <template v-else>
                        <li class="nav-item dropdown">
                            <li>
                                <router-link to="/" class="nav-link">Home</router-link>
                            </li>
                            <li>
                                <router-link to="/payments" class="nav-link">Payments</router-link>
                            </li>

                            <li class="nav-item dropdown">
                                   <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false" aria-haspopup="true">
                                       {{ currentUser.name }} <span class="caret"></span>
                                   </a>

                                   <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                       <a href="#!" @click.prevent="logout" class="dropdown-item">Logout</a>
                                   </div>
                            </li>
                        </li>
                    </template>
                </ul>
            </div>
        </div>
    </nav>
</template>
<script>

    import {logout} from '../helpers/auth';

    export default {
        name: 'app-header',
        created() {
            if( this.$store.getters.isLoggedIn )
            {
                axios.defaults.headers.common["Authorization"] = 'Bearer ' + this.$store.getters.currentUser.token;
            }
        },
        methods: {
            logout() {
                logout();
                this.$store.commit('logout');
                this.$router.push('/login');
            }
        },
        computed: {
            currentUser() {
                return this.$store.getters.currentUser
            }
        }
    }
</script>
