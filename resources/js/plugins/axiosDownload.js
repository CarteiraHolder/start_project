import axios from 'axios'
import router from "@/router";
import store from '../store/RequestError'
import { toast } from "vue3-toastify";

const axiosDownload = axios.create({ baseURL: '/api' })

// Request interceptor for API calls
axiosDownload.interceptors.request.use(config => {
    config.headers.Authorization = `Bearer ${localStorage.token}`
    config.headers['Content-Type'] = `blob`
    return config
})

axiosDownload.defaults.withCredentials = true;

// Response interceptor for API calls
axiosDownload.interceptors.response.use(response => response,
    async function (error) {
        // Error Auth
        if (error.response.status === 401 && error.response.config.url !== '/Auth/Check') {
            router.push({ path: "/" })
        }
        // Error Request validation
        if (error.response.status === 422) {
            store.state.errors = error.response.data.errors
        }
        // Error emit controller
        if (error.response.status === 403) {
            toast.warning(error.response.data.message, {
                // toastId: error.response.config.url,
                transition: toast.TRANSITIONS.BOUNCE,
                dangerouslyHTMLString: true,
            });
        }
        // Critical error
        if (error.response.status === 500) {
            toast.error('Aconteceu um erro inesperado, tente novamente mais tarde', {
                toastId: error.response.config.url,
                transition: toast.TRANSITIONS.BOUNCE,
                dangerouslyHTMLString: true,
            });
        }

        return Promise.reject(error);
    }
);


export default axiosDownload