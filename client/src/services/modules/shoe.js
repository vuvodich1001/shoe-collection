import common from './common.js';
import axiosClient from '../axios-client.js';
export const shoeService = {
  ...common('shoes'),
  async shoeRelated(id) {
    return await axiosClient.get(`/shoes/related-shoe/${id}}`);
  },
  async findShoe(id) {
    return await axiosClient.get(`/shoes/${id}?method=update`);
  }
};
