import common from './common.js';
import axiosClient from '../axios-client.js';

export const reviewService = {
  ...common('reviews'),
  async getReviewsByShoeId(id, page = 1) {
    return await axiosClient.get(`reviews/shoe/${id}?page=${page}`);
  }
};
