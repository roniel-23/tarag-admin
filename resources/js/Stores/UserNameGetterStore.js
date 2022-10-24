import { defineStore } from 'pinia'

export const useUserNameGetterStore = defineStore({
    id: 'userName',
    state: () => ({
        user: null,
        loading: false,
        error: null
    }),
    getters: {

    },
    actions: {
        async fetchUserName(user_id) {
            this.user = null
            this.loading = true
            try {
                this.user = await fetch(`/api/user/${user_id}`)
                    .then((response) => response.json())
            } catch (error) {
                this.error = error
            } finally {
                this.loading = false
            }
        }
    }
})
