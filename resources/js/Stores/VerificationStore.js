import { defineStore } from 'pinia'

export const useVerificationStore = defineStore({
    id: 'verification',
    state: () => ({
        verification: null,
        v_loading: false,
        v_error: null,
    }),
    getters: {

    },
    actions: {
        async fetchUserVerification(id) {
            this.verification = null
            this.v_loading = true
            try {
                this.verification = await fetch(`/api/verification/${id}`)
                    .then((response) => response.json())
            } catch (v_error) {
                this.v_error = v_error
            } finally {
                this.v_loading = false
            }
        },
    }
})
