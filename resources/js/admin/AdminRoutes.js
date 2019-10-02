let routes = [
    {
        path: "/admin/pages",
        component: require('./pages/Pages').default
    },
];

export default new VueRouter({
    mode: 'history',
    routes
});