import { defineStore } from 'pinia'

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
    catalog: null,
  }),
  actions: {
    addInfo(info) {
      Object.entries(info).forEach(entry => {
        const [key, value] = entry
        this[key] = value
      })
    },
    addCatalog(catalog) {
      this.catalog = catalog
    },
  },
  persist: true,
})