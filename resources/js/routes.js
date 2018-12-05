import Home from './components/Home.vue';
import Login from './components/auth/Login.vue';
import Register from './components/auth/Register.vue';
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
        path:'/register',
        component: Register
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
                component: PaymentsList,
                meta: {
                    requiresAuth: true
                }
            },
            {
                path:'new',
                component: NewPayment,
                meta: {
                    requiresAuth: true
                }
            },
            {
                path:':id',
                component: Payment,
                meta: {
                    requiresAuth: true
                }
            }
        ]
    }
];
