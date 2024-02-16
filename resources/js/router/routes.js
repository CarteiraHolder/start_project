import { RolesAccess } from '../helpers/RolesAccess.js'
// NO AUTH
import Login from "@/pages/login/Login.vue";
import NewPassword from "@/pages/login/NewPassword.vue";
import ForgotPassword from "@/pages/login/ForgotPassword.vue";
import LoginRegister from "@/pages/login/Register.vue";

// AUTH
import Dashboard from "@/pages/Dashboard.vue"

// User
import UserNavigationTop from "@/pages/user/NavigationTop.vue"
import UserList from "@/pages/user/List.vue"
import UserRegister from "@/pages/user/Register.vue"
import UserUpdate from "@/pages/user/Update.vue"

// Profile
import Profile from "@/pages/profile/Profile.vue"
import ChagePassword from "@/pages/profile/ChagePassword.vue"
import ProfileNavigationTop from "@/pages/profile/NavigationTop.vue"

// Settings
import Settings from "@/pages/settings/Settings.vue"
import UpdateSettings from "@/pages/settings/UpdateSettings.vue"
import SettingsNavigationTop from "@/pages/settings/NavigationTop.vue"

import Teste from "@/pages/Teste.vue"


const routes = [
    // NÃO LOGADA
    {
        path: "/",
        name: "Acessar",
        component: Login,
        meta: { requeresAuth: false, title: 'Acessar' },
    },
    {
        path: "/nova-senha/:hash",
        name: "Nova Senha",
        component: NewPassword,
        meta: { requeresAuth: false, title: 'Nova Senha' },
    },
    {
        path: "/esqueci-minha-senha",
        name: "Esqueci minha senha",
        component: ForgotPassword,
        meta: { requeresAuth: false, title: 'Esqueci minha senha' },
    },
    {
        path: "/cadastre-se",
        name: "Cadastre-se",
        component: LoginRegister,
        meta: { requeresAuth: false, title: 'Cadastre-se' },
    },
    // NÃO LOGADA

    {
        id: 1,
        path: "/dashboard",
        name: "Dashboard",
        component: Dashboard,
        meta: { requeresAuth: true, title: 'Dashboard' },
    },

    // USUARIOS
    {
        path: "/usuario/dashboard",
        name: "Dashboard Usuário",
        components: { default: Dashboard, navigation: UserNavigationTop },
        meta: { requeresAuth: true, role: RolesAccess.user.dashboard, title: 'Dashboard Usuário' },
    },
    {
        path: "/usuario/listar",
        name: "Listagem Usuário",
        components: { default: UserList, navigation: UserNavigationTop },
        meta: { requeresAuth: true, role: RolesAccess.user.list, title: 'Listagem Usuário' },
    },
    {
        path: "/usuario/cadastrar",
        name: "Cadastrar Usuário",
        components: { default: UserRegister, navigation: UserNavigationTop },
        meta: { requeresAuth: true, role: RolesAccess.user.register, title: 'Cadastrar Usuário' },
    },
    {
        path: "/usuario/atualizar/:id",
        name: "Atualziar Usuário",
        components: { default: UserUpdate, navigation: UserNavigationTop },
        meta: { requeresAuth: true, role: RolesAccess.user.udpate, title: 'Atualizar Usuário' },
    },
    // USUARIOS

    // PROFILE
    {
        path: "/perfil/meu-cadastro",
        name: "Meu Cadastro",
        components: { default: Profile, navigation: ProfileNavigationTop },
        meta: { requeresAuth: true, role: RolesAccess.profile.all, title: 'Meu Cadastro' },
    },
    {
        path: "/perfil/trocar-senha",
        name: "Trocar Senha",
        components: { default: ChagePassword, navigation: ProfileNavigationTop },
        meta: { requeresAuth: true, role: RolesAccess.profile.all, title: 'Trocar Senha' },
    },
    // PROFILE

    // SETTINGS
    {
        path: "/configuracoes/dashboard",
        name: "Configurações",
        components: { default: Settings, navigation: SettingsNavigationTop },
        meta: { requeresAuth: true, role: RolesAccess.settings.all, title: 'Configurações' },
    },
    {
        path: "/configuracoes/editar",
        name: "Atualziar Configurações",
        components: { default: UpdateSettings, navigation: SettingsNavigationTop },
        meta: { requeresAuth: true, role: RolesAccess.settings.all, title: 'Atualziar Configurações' },
    },
    // SETTINGS

    {
        path: "/teste",
        name: "Teste",
        component: Teste,
        meta: { requeresAuth: true, role: RolesAccess.test.route, title: 'TESTE' },
    },
];

export default routes