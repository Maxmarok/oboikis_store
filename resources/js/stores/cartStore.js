import { defineStore } from 'pinia'
import { ref } from 'vue'

export const useCartStore = defineStore('cart', {
  state: () => ({
    cart: [],
    selected: [],
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

    selectItem(id) {
      let index = this.selected.findIndex(x => x === id)

      if(index >= 0) {
        this.selected.splice(index, 1)
      } else {
        this.selected.push(id)
      }
    },

    selectAllItems(items) {
      this.selected.length === this.cart.length ? this.selected = [] : this.selected = items
    },

    selectItems(ids) {
      
      if(this.selected.length > 0) {
        this.selected = []
      } else {
        ids.forEach(x => {
          this.selected.push(x)
        })
      }
    },

    deselectItems() {
      this.selected = []
    },

    selectedItems() {
      return this.cart.filter(x => this.selected.includes(x.id))
    },
  },
  persist: true,
})