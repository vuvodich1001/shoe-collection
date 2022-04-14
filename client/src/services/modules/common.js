import axiosClient from '../axios-client.js';
export default function (resource) {
  return {
    async all(queryParams = '', page = 1) {
      console.log(`/${resource}?page=${page}&${queryParams}`);
      return await axiosClient.get(`/${resource}?page=${page}&${queryParams}`);
    },
    async create(value) {
      return await axiosClient.post(`/${resource}`, value);
    },
    async delete(id) {
      return await axiosClient.delete(`/${resource}/${id}`);
    },
    async update(id, value) {
      return await axiosClient.put(`/${resource}/${id}`, value);
    },
    async find(id) {
      return await axiosClient.get(`/${resource}/${id}`);
    }
  };
}
