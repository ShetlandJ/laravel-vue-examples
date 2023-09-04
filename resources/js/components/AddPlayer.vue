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

            <b-form-group label="Team">
                <b-form-input v-model="player.team" required placeholder="Enter player's team"></b-form-input>
            </b-form-group>

            <b-form-group label="Age">
                <b-form-input type="number" v-model="player.age" required placeholder="Enter player's age"></b-form-input>
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
                age: null,
                country: ''
            }
        };
    },
    methods: {
        addPlayer() {
            console.log("Player details:", this.player);
        }
    }
};
</script>
  
<style scoped></style>
  