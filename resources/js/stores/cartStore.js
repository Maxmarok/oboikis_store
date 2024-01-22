import { defineStore } from 'pinia'
import { ref } from 'vue'

export const useCartStore = defineStore('cart', {
  state: () => ({
    cart: [],
  }),
  actions: {
    addItem(item) {
      let index = this.cart.findIndex(x => x.id === item.id)

      if(index >= 0) {
        this.cart[index] = item
      } else {
        this.cart.push(item)
      }
    },

    removeItem(id) {
      let index = this.cart.findIndex(x => x.id === id)

      if(index >= 0) {
        this.cart.splice(index, 1)
      }
    },
  },
  persist: true,
})