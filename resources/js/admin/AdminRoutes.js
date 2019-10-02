let routes = [
    {
        path: "/admin/users",
        component: require('./pages/UsersIndex').default
    },
    {
        path: "/admin/users/create",
        component: require('./pages/UserCreate').default
    },
    {
        path: "/admin/users/:id/edit",
        component: require('./pages/UserEdit').default
    },
];

export default new VueRouter({
    mode: 'history',
    routes
});