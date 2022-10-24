import { defineStore } from 'pinia'

export const usePlayersCountStore = defineStore({
    id: 'playersCount',
    state: () => ({
        count: null,
        loading: false,
        error: null,
    }),
    getters: {

    },
    actions: {
        async fetchPlayersCount() {
            this.count = null
            this.loading = true
            try {
                this.count = await fetch('/api/players/')
                    .then((response) => response.json())
            } catch (error) {
                this.error = error
            } finally {
                this.loading = false
            }
        },
    }
})
