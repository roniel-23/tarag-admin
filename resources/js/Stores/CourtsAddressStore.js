import { defineStore } from 'pinia'

export const useCourtsAddressStore = defineStore({
    id: 'courtsAddress',
    state: () => ({
        courtAddress: null,
        loading: false,
        error: null
    }),
    getters: {

    },
    actions: {
        async fetchCourtAddress(id) {
            this.courtAddress = null
            this.loading = true
            try {
                this.courtAddress = await fetch(`/api/court/address/${id}`)
                    .then((response) => response.json())
            } catch (error) {
                this.error = error
            } finally {
                this.loading = false
            }
        }
    }
})
