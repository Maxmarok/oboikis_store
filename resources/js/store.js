import { defineStore } from 'pinia'

export const useStore = defineStore('store', {
  // items: [],
  // cart: [],
  addToCart(item) {
    Cookies.set('cart', item, { expires: 3, secure: true })
  },

  getFromCart() {
    return Cookies.get('cart')
  },
})