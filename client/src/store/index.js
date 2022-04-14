import { createStore } from 'vuex';
import { shoeService } from '@/services';
export default createStore({
  state: {
    user: null,
    cart: [],
    shoeInfo: {}
  },
  getters: {
    cartCount(state) {
      return state.cart.length;
    },
    total(state) {
      return state.cart.reduce((acc, value) => {
        return acc + value.shoe.price * value.quantity;
      }, 0);
    }
  },
  mutations: {
    login(state, payload) {
      state.user = payload;
    },
    logout(state) {
      state.user = null;
    },
    async addToCart(state, payload) {
      let check = state.cart.findIndex((value) => value.shoe.id == payload.id);
      if (check == -1) {
        let res = await shoeService.find(payload.id);
        state.cart.push({
          shoe: res.data.shoe,
          color: payload.color,
          size: payload.size,
          quantity: 1
        });
      } else {
        state.cart.forEach((value, index) => {
          if (index == check) {
            value.quantity += 1;
          }
        });
      }
    },
    removeCartItem(state, payload) {
      state.cart = state.cart.filter((value) => {
        return value.shoe.id != payload;
      });
    },
    changeQuantity(state, payload) {
      state.cart.forEach((value) => {
        if (value.shoe.id == payload.id) {
          payload.type == 'increase'
            ? (value.quantity += 1)
            : value.quantity > 1
            ? (value.quantity -= 1)
            : '';
        }
      });
    },
    setShoeInfo(state, payload) {
      state.shoeInfo = payload;
    }
  },
  actions: {
    login({ commit }, user) {
      commit('login', user);
    },
    logout({ commit }) {
      commit('logout');
    },
    addToCart({ commit }, id) {
      commit('addToCart', id);
    },
    removeCartItem({ commit }, id) {
      commit('removeCartItem', id);
    },
    changeQuantity({ commit }, payload) {
      commit('changeQuantity', payload);
    },
    setShoeInfo({ commit }, payload) {
      commit('setShoeInfo', payload);
    }
  },
  modules: {}
});
