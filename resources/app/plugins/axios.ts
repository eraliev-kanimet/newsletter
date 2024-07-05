import axios from "axios";

const _axios = axios.create({
    baseURL: import.meta.env.VITE_APP_URL + '/api'
});

_axios.interceptors.response.use(
    function (response) {
        return response.data
    },
    async function (error) {
        return await Promise.reject(error)
    }
);

export default _axios;
