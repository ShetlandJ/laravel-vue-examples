<template>
    <div id="app">
        <b-container class="mt-4">
            <AddPlayer class="mb-4 w-50" />
            <h2>Players</h2>
            <b-form-group label="Search">
                <b-input-group>
                    <b-form-input v-model="searchQuery" placeholder="Search players..."></b-form-input>
                    <b-input-group-append>
                        <b-button @click="search" variant="primary">Search</b-button>
                    </b-input-group-append>
                </b-input-group>
            </b-form-group>

            <b-table striped hover :items="filteredPlayers" :fields="playerFields" caption-top responsive :busy="loading"
                @row-clicked="openEditModal">

                <template #cell(actions)="data">
                    <b-button size="sm" @click="deletePlayer(data.item)" variant="danger">
                        Delete
                    </b-button>
                </template>

                <template #cell(teams)="data">
                    <div v-if="data.item.teams && data.item.teams.length">
                        <ul>
                            <li v-for="team in data.item.teams" :key="team.id">{{ team.name }}</li>
                        </ul>
                    </div>
                    <div v-else>
                        No associated team.
                    </div>
                </template>
            </b-table>

            <b-modal ref="editPlayerModal" title="Edit Player" hide-footer>
                <b-form @submit.prevent="updatePlayer">
                    <b-form-group label="Full Name">
                        <b-form-input v-model="editingPlayer.name" required
                            placeholder="Enter player's full name"></b-form-input>
                    </b-form-group>

                    <b-form-group label="Position">
                        <b-form-input v-model="editingPlayer.position" required
                            placeholder="Enter player's position"></b-form-input>
                    </b-form-group>

                    <b-form-group label="Football Team" label-for="editTeamSelect">
                        <b-form-select id="editTeamSelect" v-model="editingPlayer.team_id">
                            <option disabled value="">Please select a team</option>
                            <b-form-select-option v-for="team in teams" :key="team.id" :value="team.id">
                                {{ team.name }}
                            </b-form-select-option>
                        </b-form-select>
                    </b-form-group>

                    <b-form-group label="Transfer Type" label-for="editTransferTypeSelect">
                        <b-form-select id="editTransferTypeSelect" v-model="editingPlayer.transfer_type">
                            <option disabled value="">Please select a transfer type</option>
                            <b-form-select-option value="permanent">Permanent</b-form-select-option>
                            <b-form-select-option value="loan">Loan</b-form-select-option>
                        </b-form-select>
                    </b-form-group>

                    <b-form-group label="Date of Birth">
                        <b-form-input type="date" v-model="editingPlayer.dateOfBirth" required
                            placeholder="Enter player's date of birth"></b-form-input>
                    </b-form-group>

                    <b-form-group label="Age">
                        <b-form-input readonly :value="calculateAge(editingPlayer.dateOfBirth)"
                            placeholder="Player's age"></b-form-input>
                    </b-form-group>

                    <b-form-group label="Country">
                        <b-form-input v-model="editingPlayer.country" required
                            placeholder="Enter player's country"></b-form-input>
                    </b-form-group>

                    <b-button type="submit" variant="success">Save</b-button>
                </b-form>
            </b-modal>
        </b-container>
    </div>
</template>

<script>
import AddPlayer from "./AddPlayer.vue";
import axios from "axios";

export default {
    components: { AddPlayer },
    data() {
        return {
            originalPlayers: [],
            players: [],
            teams: [],
            searchQuery: '',
            loading: false,
            editingPlayer: {},
            playerFields: ['name', 'position', 'dateOfBirth', 'country', 'teams', 'actions']
        };
    },
    computed: {
        filteredPlayers() {
            if (this.searchQuery) {
                return this.players.filter(player => player.name.includes(this.searchQuery));
            }
            return this.players;
        }
    },
    methods: {
        getTeamName(player) {
            if (!player.teams || !player.teams.length) return '';
            const latestTeam = player.teams[player.teams.length - 1];
            const team = this.teams.find(t => t.id === latestTeam.id);
            return team ? team.name : '';
        },
        openEditModal(player) {
            this.editingPlayer = { ...player };
            this.$refs.editPlayerModal.show();
        },
        deletePlayer(player) {
            axios.delete(`/api/players/${player.id}`)
                .then(() => {
                    const index = this.players.findIndex(p => p.id === player.id);
                    if (index !== -1) {
                        this.players.splice(index, 1);
                    }
                    alert("Player deleted successfully!");
                })
                .catch(error => {
                    console.error("Error deleting player", error);
                    alert("Error deleting player. Please try again.");
                });
        },

        updatePlayer() {
            axios.put(`/api/players/${this.editingPlayer.id}`, this.editingPlayer)
                .then(response => {
                    const index = this.players.findIndex(p => p.id === this.editingPlayer.id);
                    if (index !== -1) {
                        this.players[index] = response.data;
                    }
                    this.$refs.editPlayerModal.hide();
                    alert("Player updated successfully!");
                })
                .catch(error => {
                    console.error("Error updating player", error);
                    alert("Error updating player. Please try again.");
                });
        },

        calculateAge(dateOfBirth) {
            const dob = new Date(dateOfBirth);
            const today = new Date();
            let age = today.getFullYear() - dob.getFullYear();
            const monthDifference = today.getMonth() - dob.getMonth();

            if (monthDifference < 0 || (monthDifference === 0 && today.getDate() < dob.getDate())) {
                age--;
            }

            return age;
        },

        search() {
            const query = this.searchQuery.toLowerCase().trim();
            if (query) {
                this.players = this.players.filter(player => {
                    return (
                        player.name.toLowerCase().includes(query) ||
                        player.position.toLowerCase().includes(query) ||
                        player.country.toLowerCase().includes(query)
                    );
                });
            } else {
                this.players = this.originalPlayers;
            }
        }

    },
    created() {
        this.loading = true;
        axios.get('/api/players')
            .then(response => {
                this.players = response.data;
                this.originalPlayers = [...response.data];
            })
            .catch(error => {
                console.error("Error fetching players with teams", error);
            })
            .finally(() => {
                this.loading = false;
            });

        axios.get('/api/teams')
            .then(response => {
                this.teams = response.data;
            })
            .catch(error => {
                console.error("Error fetching teams", error);
            })
            .finally(() => {
                this.loading = false;
            });
    }
};
</script>

<style scoped></style>
