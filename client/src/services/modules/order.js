import axiosClient from '../axios-client.js';
import common from './common.js';

export const orderService = {
  ...common('orders'),
  async getAllAddressByCustomerId(id) {
    return await axiosClient.get(`/address/customer/${id}`);
  },
  async getAllOrderByCustomerId(id) {
    return await axiosClient.get(`/orders/customer/${id}`);
  },
  async getOrderDetailByOrderId(id) {
    return await axiosClient.get(`/orders/order-detail/${id}`);
  }
};
