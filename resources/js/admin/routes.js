// example for lazy loading
// const Dashboard = () => import(/* webpackChunkName: "Dashboard" */'./pages/Dashboard.vue')

let routes = [
    {
        path: "/admin/dashboard",
        name: 'Dashboard',
        component: require('./pages/Dashboard').default
    },
    {
        path: "/admin/users",
        name: 'Users',
        component: require('./pages/Users').default,
        children: [
            /* {
                path: "",
                name: 'DefaultComponent',
                component: require('./pages/DefaultComponent').default,
            }, */
            {
                path: ":id/edit",
                name: 'UserEdit',
                component: require('./pages/UserEdit').default,
            },
            {
                path: "/admin/roles",
                name: 'Roles',
                component: require('./pages/Roles').default
            }
        ]
    },
];

export default new VueRouter({
    mode: 'history',
    routes,
    scrollBehavior(to, from, savedPosition) {
        if (savedPosition) {
            return savedPosition;
        }

        if (to.hash) {
            const element = document.querySelector(to.hash);

            return window.scrollTo({
                top: element.offsetTop,
                behavior: 'smooth'
            });
        }
    },
});