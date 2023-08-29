<template>
    <div id="app">
        <b-container class="mt-4">
            <new-team-form class="mb-4 w-50" />

            <b-table striped hover :items="teams" :fields="fields" caption-top responsive :busy.sync="loading">
                <template #cell(actions)="data">
                    <b-button size="sm" @click="deleteTeam(data.item)" variant="danger">
                        Delete
                    </b-button>
                </template>
            </b-table>

            <b-button @click="refresh"> Reseed/Refresh teams </b-button>
        </b-container>
    </div>
</template>

<script>
import axios from "axios";
import NewTeamForm from "./NewTeamForm.vue";
import eventBus from "./eventBus.js"

export default {
    components: { NewTeamForm },
    data() {
        return {
            fields: [
                {
                    key: "name",
                    label: "Name",
                    sortable: true,
                },
                {
                    key: "founded",
                    label: "Founded",
                },
                {
                    key: "stadium",
                    label: "Stadium",
                },
                {
                    key: "location",
                    label: "Location",
                },
                {
                    key: "actions",
                    label: "",
                },
            ],
            teams: [],
            loading: false,
        };
    },
    async created() {
        this.loading = true;
        await this.loadData();
        this.loading = false;
    },
    methods: {
        async loadData() {
            const { data } = await axios.get("/api/teams");
            this.teams = data;
        },
        async deleteTeam(team) {
            await axios.delete(`/api/teams/${team.id}`);
            await this.loadData();
        },
        async refresh() {
            await axios.get('/api/teams/refresh');
            await this.loadData();
        }
    },
    mounted() {
        eventBus.$on('team-created', () => {
            this.loadData();
        })
    },
    beforeDestroy() {
        eventBus.$off('team-created')
    }
};
</script>
