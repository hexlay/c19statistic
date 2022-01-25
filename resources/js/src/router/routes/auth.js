import Login from "@/views/auth/Login";

export default [
    {
        path: '/login',
        name: 'login',
        component: Login,
        meta: {
            redirectIfLogged: true,
        },
    },
]
