import { defineStore } from 'pinia'

export const usePlayersAddressStore = defineStore({
    id: 'playersAddress',
    state: () => ({
        address: [],
        playerAddress: null,
        loading: false,
        error: null
    }),
    getters: {

    },
    actions: {
        async fetchAddress() {
            this.address = []
            this.loading = true
            try {
              this.address = await fetch('/api/address/')
              .then((response) => response.json()) 
            } catch (error) {
              this.error = error
            } finally {
              this.loading = false
            }
          },
        async fetchPlayerAddress(id) {
            this.playerAddress = null
            this.loading = true
            try {
                this.playerAddress = await fetch(`/api/player/address/${id}`)
                    .then((response) => response.json())
            } catch (error) {
                this.error = error
            } finally {
                this.loading = false
            }
        }
    }
})
