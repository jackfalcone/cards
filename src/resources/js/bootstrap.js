import axios from 'axios';

const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
axios.defaults.headers.common['X-CSRF-TOKEN'] = csrfToken;
axios.defaults.headers.common['Content-Type'] = 'application/json';

axios.interceptors.response.use(response => {
    const newCsrfToken = response.headers['x-csrf-token'];
    if (newCsrfToken) {
        document.querySelector('meta[name="csrf-token"]').setAttribute('content', newCsrfToken);
        axios.defaults.headers.common['X-CSRF-TOKEN'] = newCsrfToken;
    }
    return response;
}, error => {
    // Handle the error as needed
    return Promise.reject(error);
});

window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
