import axiosClient from '../axios-client.js';
import common from './common.js';

export const orderService = {
  ...common('orders'),
  async getAllAddressByCustomerId(id) {
    return await axiosClient.get(`/address/customer/${id}`);
  }
};
