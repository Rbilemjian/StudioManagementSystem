<template>
    <div>
        <div class="btn-wrapper">
            <router-link to="/payments/new" class="btn btn-primary btn-sm">New Payment</router-link>
        </div>
        <table class="table">
            <thead>
                <th>Payed By</th>
                <th>Payed To</th>
                <th>Amount</th>
                <th>Date</th>
                <th>Actions</th>
            </thead>
            <tbody>
                <template v-if="!payments">
                    <tr>
                        <td colspan="5" class="text-center">No Payments to Show</td>
                    </tr>
                </template>
                <template v-else>
                    <tr v-for="payment in payments" :key="payment.id">
                        <td>{{ payment.teacher }}</td>
                        <td>{{ payment.student }}</td>
                        <td>${{ payment.amount }}</td>
                        <td>{{ payment.date }}</td>
                        <td>
                            <router-link :to="`/payment/${payment.id}`">View</router-link>
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        name: 'list',
        mounted() {
            this.$store.dispatch('getPayments');
        },
        computed: {
            payments() {
                return this.$store.getters.payments;
            }
        }

    }
</script>

<style scoped>
    .btn-wrapper {
        text-align:right;
        margin-bottom:20px;
    }
</style>
