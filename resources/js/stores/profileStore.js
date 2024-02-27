import { defineStore } from 'pinia'

export const useProfileStore = defineStore("profile", {
    state: () => ({
        token: null,
        user: null,
    }),

    actions: {
        setToken(token) {
            this.token = token;
        },

        setUser(user) {
            this.user = user;
        },
        
        logout() {
            this.token = this.user = null;
        }
    },

    persist: true,
})