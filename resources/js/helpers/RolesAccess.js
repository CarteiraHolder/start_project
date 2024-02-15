import { RoleEnum } from "./RoleEnum.js";


//regra de acesso das rotas, menu verticar e horizontal.
export const RolesAccess = {
    user: {
        menu: [
            RoleEnum.admin,


        ],
        dashboard: [
            RoleEnum.admin,


        ],
        list: [
            RoleEnum.admin,


        ],
        register: [
            RoleEnum.admin,


        ],
        udpate: [
            RoleEnum.admin,


        ],
    },



    test: {
        menu: [RoleEnum.admin],
        route: [RoleEnum.admin],
    },
    profile: {
        all: [
            RoleEnum.admin,
            RoleEnum.user
        ],
    },
    settings: {
        all: [
            RoleEnum.admin,
        ],
    },


}