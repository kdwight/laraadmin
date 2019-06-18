import UserEdit from './pages/UserEdit'
import Roles from './pages/Roles'
import UsersTable from './components/UsersTable'
import NotFound from './components/NotFound';

export default {
    mode: 'history',

    routes: [
        {
            path: '*',
            component: NotFound
        },
        {
            path: '/admin/users',
            name: 'users.index',
            component: UsersTable,
            props: {
                fetchUrl: "/admin/users",
                columns: ['username', 'type']
            }
        },
        {
            path: '/admin/users/:id/edit',
            name: 'users.edit',
            component: UserEdit
        },
        {
            path: '/admin/roles',
            name: 'user.roles',
            component: Roles,
        },
    ],
};