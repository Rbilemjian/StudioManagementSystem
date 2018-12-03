<template>
    <div class="payment-view">
        <table class="table">
            <tr>
                <th style="white-space:nowrap">Payed By</th>
                <td> {{payment.payed_by}} </td>
            </tr>
            <tr>
                <th style="white-space:nowrap">Payed To</th>
                <td> {{payment.payed_to}} </td>
            </tr>
            <tr>
                <th>Amount</th>
                <td> ${{payment.amount}} </td>
            </tr>
            <tr>
                <th>Date</th>
                <td> {{payment.date}} </td>
            </tr>
            <tr>
                <th>Notes</th>
                <td> {{payment.notes}} </td>
            </tr>



        </table>
        <router-link to="/payments" class="btn btn-danger">Back to all Payments</router-link>
        <h3 style="margin-top:30px;">Comments</h3>
        <table class="table">
            <thead>
                <th>User</th>
                <th>Comment</th>
            </thead>
            <tbody>
                <template v-if="!comments.length">
                    <tr>
                        <td colspan="2" class="text-center">
                            No Comments To Show
                        </td>
                    </tr>
                </template>
                <template v-else>
                    <tr v-for="comment in comments">
                        <td style="white-space:nowrap;">{{ comment.user }}</td>
                        <td>{{ comment.text }}</td>
                    </tr>
                </template>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        name: 'view',
        created() {
            axios.get(`/api/paymentandcomments/${this.$route.params.id}`, {
                headers: {
                    "Authorization": `Bearer ${this.currentUser.token}`
                }
            })
            .then((response) => {
                this.payment = response.data.payment;
                this.comments = response.data.comments;
            });
        },
        data() {
            return {
                payment: null,
                comments: null
            }
        },
        computed: {
            currentUser() {
                return this.$store.getters.currentUser;
            }
        }
    }
</script>
