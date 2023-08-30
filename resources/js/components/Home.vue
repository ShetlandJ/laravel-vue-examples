<template>
    <div id="app">
        <b-container class="mt-4">
            <new-team-form class="mb-4 w-50" />

            <b-form-group label="Search">
                <b-input-group>
                    <b-form-input v-model="searchQuery" placeholder="Enter search term"></b-form-input>
                    <b-input-group-append>
                        <b-button @click="search" variant="primary">Search</b-button>
                    </b-input-group-append>
                </b-input-group>
            </b-form-group>

            <b-table striped hover :items="filteredData" :fields="fields" caption-top responsive :busy.sync="loading">
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
            searchQuery: "",
            filteredTeams: [],
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
            this.filteredData = data;
        },
        async deleteTeam(team) {
            await axios.delete(`/api/teams/${team.id}`);
            await this.loadData();
        },
        async refresh() {
            await axios.get('/api/teams/refresh');
            await this.loadData();
        },
        async search() {
            const query = this.searchQuery.toLowerCase().trim();
            if (query) {
                this.filteredTeams = this.teams.filter(team => {
                    return (
                        team.name.toLowerCase().includes(query) ||
                        team.location.toLowerCase().includes(query) ||
                        team.stadium.toLowerCase().includes(query)
                    );
                });
            } else {
                this.filteredTeams = this.teams;
            }
        },

    },
    computed: {
        filteredData() {
            if (this.searchQuery) {
                return this.filteredTeams;
            }
            return this.teams;
        },
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
