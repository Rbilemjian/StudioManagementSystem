import Home from './components/Home.vue';
import Login from './components/auth/Login.vue';
import PaymentsMain from './components/payments/Main.vue';
import PaymentsList from './components/payments/List.vue';
import NewPayment from './components/payments/New.vue';
import Payment from './components/payments/View.vue';

export const routes = [
    {
        path:'/',
        component: Home,
        meta: {
            requiresAuth: true
        }
    },
    {
        path:'/login',
        component: Login
    },
    {
        path:'/payments',
        component: PaymentsMain,
        meta: {
            requiresAuth: true
        },
        children: [
            {
                path:'/',
                component: PaymentsList
            },
            {
                path:'new',
                component: NewPayment
            },
            {
                path:':id',
                component: Payment
            }
        ]
    }
];
