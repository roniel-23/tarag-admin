import { defineStore } from 'pinia'

export const useRoomPlayersStore = defineStore({
    id: 'roomPlayers',
    state: () => ({
        players: null,
        loading: false,
        error: null
    }),
    getters: {

    },
    actions: {
        async fetchRoomPlayers(id) {
            this.players = null
            this.loading = true
            try {
                this.players = await fetch(`/api/roomplayers/${id}`)
                    .then((response) => response.json())
            } catch (error) {
                this.error = error
            } finally {
                this.loading = false
            }
        }
    }
})
