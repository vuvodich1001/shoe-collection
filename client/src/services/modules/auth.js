import axiosClient from '../axios-client.js';

export const authService = {
  async login(user) {
    return await axiosClient.post('/auth/login', user);
  },
  async register(user) {
    return await axiosClient.post('/auth/register', user);
  },
  async logout() {
    await axiosClient.post('/auth/logout');
    localStorage.removeItem('token');
  }
};
