<template>
    <div class="payment-new">
        <form @submit.prevent="add">
            <table class="table">
                <tr>
                    <th>Payed By</th>
                    <td>
                        <input type="text" class="form-control" v-model="payment.payed_by"/>
                    </td>
                </tr>
                <tr>
                    <th>Payed To</th>
                    <td>
                        <input type="text" class="form-control" v-model="payment.payed_to"/>
                    </td>
                </tr>
                <tr>
                    <th>Amount ($)</th>
                    <td>
                        <input type="number" class="form-control" v-model="payment.amount"/>
                    </td>
                </tr>
                <tr>
                    <th>Notes</th>
                    <td>
                        <input type="text" class="form-control" v-model="payment.notes"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <router-link to="/payments" class="btn btn-danger">Cancel</router-link>
                    </td>
                    <td class="text-right">
                        <input type="submit" value="Create" class="btn btn-primary" style="text-align:right;">
                    </td>
                </tr>
            </table>
        </form>
        <div class="errors" v-if="errors">
            <ul style="list-style:none; margin-left:0px; padding-left:0px; text-align:center">
                <li v-for="(fieldsError, fieldName) in  errors" :key="fieldName">
                    {{ fieldsError.join('\n') }}
                </li>
            </ul>
        </div>
    </div>

</template>

<script>
    import validate from 'validate.js';

    export default {
        name: 'new',
        data() {
            return {
                payment: {
                    payed_by: '',
                    payed_to: '',
                    amount: '',
                    notes: '',
                },
                errors: null
            };
        },
        computed: {
            currentUser() {
                return this.$store.getters.currentUser;
            }
        },
        methods: {
            add() {
                this.errors = null;

                const constraints = this.getConstraints();

                const errors = validate(this.$data.payment, constraints);

                if(errors)
                {
                    this.errors = errors;
                    return;
                }

                axios.post('/api/createpayment', this.$data.payment)
                .then((response) => {
                    this.$router.push('/payments');
                });

            },
            getConstraints() {
                return {
                    payed_by: {
                        presence: true,
                        length: {
                            minimum: 3,
                            message: 'must be at least 3 characters long'
                        }
                    },
                    payed_to: {
                        presence: true,
                        length: {
                            minimum: 3,
                            message: 'must be at least 3 characters long'
                        }
                    },
                    amount: {
                        presence: true,
                        numericality: {
                            greaterThan:0
                        }
                    },
                    notes: {
                        presence: true,
                        length: {
                            minimum: 1,
                            message: 'cannot be blank'
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
