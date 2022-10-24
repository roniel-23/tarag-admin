import { defineStore } from 'pinia'

export const useCourtDataStore = defineStore({
    id: 'courtData',
    state: () => ({
        courtData: null,
        c_loading: false,
        c_error: null
    }),
    getters: {

    },
    actions: {
        async fetchCourtData(id) {
            this.courtData = null
            this.c_loading = true
            try {
                this.courtData = await fetch(`/api/courtdata/${id}`)
                    .then((response) => response.json())
            } catch (c_error) {
                this.c_error = c_error
            } finally {
                this.c_loading = false
            }
        }
    }
})
