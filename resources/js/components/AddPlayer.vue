<template>
    <div>
        <h2>Add Player</h2>
        <b-form @submit.prevent="addPlayer">
            <b-form-group label="Full Name">
                <b-form-input v-model="player.name" required placeholder="Enter player's full name"></b-form-input>
            </b-form-group>

            <b-form-group label="Position">
                <b-form-input v-model="player.position" required placeholder="Enter player's position"></b-form-input>
            </b-form-group>

            <b-form-group label="Football Team" label-for="teamSelect">
                <b-form-select id="teamSelect" v-model="selectedTeamId">
                    <option disabled value="">Please select a team</option>
                    <b-form-select-option v-for="team in teams" :key="team.id" :value="team.id">
                        {{ team.name }}
                    </b-form-select-option>
                </b-form-select>
            </b-form-group>

            <b-form-group label="Transfer Type" label-for="transferTypeSelect">
                <b-form-select id="transferTypeSelect" v-model="selectedTransferType">
                    <option disabled value="">Please select a transfer type</option>
                    <b-form-select-option value="permanent">Permanent</b-form-select-option>
                    <b-form-select-option value="loan">Loan</b-form-select-option>
                </b-form-select>
            </b-form-group>

            <b-form-group label="Date of Birth">
                <b-form-input type="date" v-model="player.dateOfBirth" required
                    placeholder="Enter player's date of birth"></b-form-input>
            </b-form-group>

            <b-form-group label="Age">
                <b-form-input readonly :value="age" placeholder="Player's age"></b-form-input>
            </b-form-group>

            <b-form-group label="Country">
                <b-form-input v-model="player.country" required placeholder="Enter player's country"></b-form-input>
            </b-form-group>

            <b-button type="submit" variant="primary">Add Player</b-button>
        </b-form>
    </div>
</template>
  
<script>

export default {
    data() {
        return {
            player: {
                name: '',
                position: '',
                team: '',
                dateOfBirth: null,
                country: ''
            },
            teams: [],
            selectedTeamId: null,
            selectedTransferType: null,
        };
    },
    created() {
        axios.get('/api/teams')
            .then(response => {
                this.teams = response.data;
            })
            .catch(error => {
                console.error("Error fetching teams", error);
            });
    },

    methods: {
        addPlayer() {
            const requestData = {
                ...this.player,
                team_id: this.selectedTeamId,
                transfer_type: this.selectedTransferType
            };

            axios.post('/api/teams/add-player', requestData)
                .then(response => {
                    console.log("Player added:", response.data);
                })
                .catch(error => {
                    console.error("Error adding player:", error);
                });
        }
    },
    computed: {
        age() {
            if (!this.player.dateOfBirth) return null;

            const birthDate = new Date(this.player.dateOfBirth);
            const today = new Date();

            let age = today.getFullYear() - birthDate.getFullYear();
            const monthDifference = today.getMonth() - birthDate.getMonth();

            if (monthDifference < 0 || (monthDifference === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }

            return age;
        }
    },

};
</script>
  
<style scoped></style>
  