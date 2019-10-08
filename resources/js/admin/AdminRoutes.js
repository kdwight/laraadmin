let routes = [
    {
        path: "/admin/pages",
        name: 'PagesIndex',
        component: require('./pages/PagesIndex').default
    },
    {
        path: "/admin/pages/create",
        name: 'PageCreate',
        component: require('./pages/PageCreate').default
    },
    {
        path: "/admin/pages/:id/edit",
        name: 'PageEdit',
        component: require('./pages/PageEdit').default,
        props: true
    },

    {
        path: "/admin/users",
        name: 'UsersIndex',
        component: require('./pages/UsersIndex').default
    },
    {
        path: "/admin/users/create",
        name: 'UserCreate',
        component: require('./pages/UserCreate').default
    },
    {
        path: "/admin/users/:id/edit",
        name: 'UserEdit',
        component: require('./pages/UserEdit').default,
        props: true
    },
    {
        path: "/admin/roles",
        name: 'Roles',
        component: require('./pages/Roles').default
    },
];

export default new VueRouter({
    mode: 'history',
    routes
});