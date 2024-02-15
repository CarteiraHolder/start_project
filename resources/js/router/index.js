import { createWebHistory, createRouter } from "vue-router";
import axiosClient from "@/plugins/axios";
import userStore from '../store/User'
import routes from '@/router/routes'
import { toast } from "vue3-toastify";


const router = createRouter({
    history: createWebHistory(),
    routes,
});

const DEFAULT_TITLE = 'Carteira Holder';
router.beforeEach(async (to, from, next) => {
    document.title = (DEFAULT_TITLE + " - " + to.meta.title) || DEFAULT_TITLE;

    let auth = false;
    await axiosClient
        .get('/Auth/Check')
        .then(() => auth = true)
        .catch(() => auth = false)

    if (userStore.state.user.role == "" && auth)
        await axiosClient.get("/User/Logged").then(({ data }) => {
            userStore.state.user.id = data.id;
            userStore.state.user.name = data.name;
            userStore.state.user.email = data.email;
            userStore.state.user.cpf = data.cpf
            userStore.state.user.profilePicture = data.profilePicture;
            userStore.state.user.role = data.role;
        });

    const role = userStore.state.user.role;
    const requeresAuth = to.matched.some(record => record.meta.requeresAuth)
    const HasRouterRole = to.matched.some(record => record.meta.role)
    const routerRole = to.matched[0].meta.role

    if (requeresAuth && !auth) next('/')
    else if (!requeresAuth && auth || (HasRouterRole && !routerRole.includes(role))) next('/dashboard')
    else next()
})


export default router;