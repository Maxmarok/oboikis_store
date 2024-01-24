import { defineStore } from 'pinia'
import { ref } from 'vue'

export const useInfoStore = defineStore('info', {
  state: () => ({
    phone: null,
    email: null,
    logo: null,
    vk: null,
    telegram: null,
    whatsapp: null,
    viber: null,
    instagram: null,
  }),
  actions: {
    addInfo(info) {
      Object.entries(info).forEach(entry => {
        const [key, value] = entry
        this[key] = value
      })
    },
  },
  persist: true,
})