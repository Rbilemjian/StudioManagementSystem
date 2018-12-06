import { getLocalUser } from "./helpers/auth";

const user = getLocalUser();

export default {
        state: {
            currentUser: user,
            isLoggedIn: !!user,
            loading: false,
            auth_error: null,
            payments: [],
            comments: [],
        },
        getters: {
            isLoading(state) {
                return state.loading;
            },
            isLoggedIn(state) {
                return state.isLoggedIn;
            },
            currentUser(state) {
                return state.currentUser;
            },
            authError(state) {
                return state.auth_error;
            },
            payments(state) {
                return state.payments;
            },
            comments(state) {
                return state.comments;
            }
        },
        mutations: {
            login(state) {
                state.loading = true;
                state.auth_error = null;
            },
            loginSuccess(state, payload) {
                state.auth_error = null;
                state.isLoggedIn = true;
                state.loading = false;
                state.currentUser = Object.assign({}, payload.user, {token: payload.access_token});

                localStorage.setItem("user", JSON.stringify(state.currentUser));
            },
            loginFailed(state, payload) {
                state.loading = false;
                state.auth_error = payload.error;
            },
            logout(state) {
                localStorage.removeItem("user");
                state.isLoggedIn = false;
                state.currentUser = null;
            },
            updatePayments(state, payload) {
                state.payments = payload;
            },
            updateComments(state, payload) {
                state.comments = payload;
            },
            deleteComment(state, payload) {
                var index = state.comments.indexOf(payload);
                if(index > -1) {
                    state.comments.splice(index, 1);
                }
            },
            deletePayment(state, payload) {
                var index = -1;
                for(var i= 0; i < state.payments.length; i++)
                {
                    if(state.payments[i].id == payload)
                    {
                        index = i;
                        break;
                    }
                }
                if(index > -1)
                    state.payments.splice(index, 1);

            }
        },
        actions: {
            login(context) {
                context.commit("login");
            },
            getPayments(context) {
                axios.get('/api/payments')
                .then((response) => {
                    context.commit('updatePayments', response.data.payments);
                });
            },
            getComments(context, payload) {
                axios.get(`/api/postcomments/${payload}`)
                .then((response) => {
                    context.commit('updateComments', response.data.comments);
                });
            },
            deleteComment(context, payload) {
                context.commit('deleteComment', payload);
                axios.post(`/api/deletecomment/${payload.id}`)
                    .catch((e) => {
                        console.log(e);
                    })
            },
            deletePayment(context, payload) {
                context.commit('deletePayment', payload);
                axios.post(`/api/deletepayment/${payload}`)
                    .catch((e) => {
                        console.log(e);
                    })
            }
        },

};
