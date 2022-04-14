import axios from 'axios';

const axiosClient = axios.create({
  baseURL: process.env.VUE_APP_API,
  headers: {
    'content-type': 'application/json'
  }
});

axiosClient.interceptors.request.use(
  (config) => {
    let token = localStorage.getItem('token');

    if (token) {
      config.headers['Authorization'] = `Bearer ${token}`;
    }

    return config;
  },

  (error) => {
    return Promise.reject(error);
  }
);

export default axiosClient;
