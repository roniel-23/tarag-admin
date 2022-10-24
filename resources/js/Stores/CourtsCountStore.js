import { defineStore } from 'pinia'

export const useCourtsCountStore = defineStore({
    id: 'courtsCount',
    state: () => ({
        count: null,
        loading: false,
        error: null,
    }),
    getters: {

    },
    actions: {
        async fetchCourtsCount() {
            this.count = null
            this.loading = true
            try {
                this.count = await fetch('/api/courts/')
                    .then((response) => response.json())
            } catch (error) {
                this.error = error
            } finally {
                this.loading = false
            }
        },
    }
})
