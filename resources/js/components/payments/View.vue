
<template>
    <div class="payment-view">
        <div class="row">
            <div class="col-md-12" style="text-align:right; display:inline-block; margin-bottom:10px;">
                <button class="btn btn-danger btn-sm" v-on:click="deletePayment()">Delete Payment
                    <span class="fa fa-trash" style="margin-left:7px;" aria-hidden = "true"></span>
                </button>
            </div>
        </div>
        <table class="table" style="table-layout:fixed; width:100%;">
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
                <td style="word-wrap:break-word; white-space: normal">
                    {{payment.notes}}
                </td>
            </tr>
        </table>
        <h3 style="margin-top:30px;">Comments</h3>

        <h5 style="margin-top:50px; color:gray;">Contribute to the Conversation:</h5>
        <form @submit.prevent="add">
            <div class="row" style="margin-top:15px;">
                <!-- <div class="col-md-1"></div> -->
                <div class="col-md-12">
                    <textarea class="form-control" rows="4" v-model="newComment.text"/>
                </div>
            </div>
            <div class="col-md-12" style="text-align:right; margin-top:15px;">
                <input type="submit" value="Add Comment" class="btn btn-primary">
            </div>
        </form>
        <div class="errors form-group-row" v-if="errors" style="margin-top:20px; margin-bottom: 5px; margin-right:0px; margin-left: 0px;">
            <ul style="list-style:none; margin-left:0px; padding-left:0px; text-align:center">
                <li v-for="(fieldsError, fieldName) in  errors" :key="fieldName">
                    {{ fieldsError.join('\n') }}
                </li>
            </ul>
        </div>

        <table class="table" style="margin-top:30px;">
            <tbody>
                <template v-if="!comments.length">
                    <tr>
                        <td colspan="2" class="text-center">
                            No Comments To Show
                        </td>
                    </tr>
                </template>
                <template v-else>
                    <tr v-for="comment in this.comments">
                        <td style="white-space:nowrap;">
                            <strong>{{ comment.user }}</strong>
                        </td>
                        <td>
                            <div class="row">
                                <div class="col-md-10">
                                    {{ comment.text }}
                                </div>
                                <div class="col-md-2 text-right">
                                    <div v-if='comment.user == currentUser.name'>
                                        <button class="btn btn-sm btn-danger" v-on:click="deleteComment(comment)">
                                            <span class="fa fa-trash" aria-hidden = "true"></span>
                                        </button>
                                    </div>

                                </div>
                            </div>
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>
    </div>
</template>

<script>
    import validate from 'validate.js';
    import {mapGetters} from 'vuex';
    export default {
        name: 'view',
        created() {
            axios.get(`/api/payments/${this.$route.params.id}`)
            .then((response) => {
                this.payment = response.data.payment;
                this.$store.dispatch('getComments', this.newComment.payment_id);
            });
        },
        data() {
            return {
                payment: null,
                newComment: {
                    user: '',
                    text: '',
                    payment_id: this.$route.params.id,
                },
                errors: null
            }
        },
        computed: {
            currentUser() {
                return this.$store.getters.currentUser;
            },
            ...mapGetters([
                'comments'
            ])
        },
        methods: {
            add() {
                this.errors = null;

                this.newComment.user = this.$store.getters.currentUser.name;

                const constraints = this.getConstraints();

                const errors = validate(this.$data.newComment, constraints);

                if(errors)
                {
                    this.errors = errors;
                    return;
                }
                axios.post('/api/createcomment', this.newComment)
                .then((response) => {
                    this.$store.dispatch('getComments', this.newComment.payment_id);
                    this.newComment.text = '';
                });

            },
            deleteComment(comment) {
                this.$store.dispatch('deleteComment', comment);
            },
            deletePayment() {
                var id = this.$route.params.id
                this.$store.dispatch('deletePayment', id);
                this.$router.push({path: '/payments'});
            },
            getConstraints() {
                return {
                    text: {
                        presence: true,
                        length: {
                            minimum: 1,
                            message: ' of comment cannot be empty'
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
