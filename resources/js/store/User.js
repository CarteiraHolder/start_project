import { createStore } from 'vuex'

// Create a new store instance.
const store = createStore({
    state: {
        user: {
            id: '',
            name: '',
            fullName: '',
            email: '',
            cpf: '',
            profilePicture: null,
            role: '',
        }

    },
    getters: {},
    actions: {
    },
    mutations: {
    },
    modules: {},
})

export default store