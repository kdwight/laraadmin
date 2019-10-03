let routes = [
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
];

export default new VueRouter({
    mode: 'history',
    routes
});