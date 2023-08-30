<template>
    <b-form @submit.prevent="createTeam">
        <b-form-group label="Name" label-for="name" label-cols="3">
            <b-form-input id="name" v-model="form.name" type="text" required placeholder="Enter name" />
        </b-form-group>

        <b-form-group label="Founded" label-for="founded" label-cols="3">
            <b-form-input id="founded" v-model="form.founded" type="text" required placeholder="Enter founded" />
        </b-form-group>

        <b-form-group label="Stadium" label-for="stadium" label-cols="3">
            <b-form-input id="stadium" v-model="form.stadium" type="text" required placeholder="Enter stadium" />
        </b-form-group>

        <b-form-group label="Location" label-for="location" label-cols="3">
            <b-form-input id="location" v-model="form.location" type="text" required placeholder="Enter location" />
        </b-form-group>

        <b-form-group label="Colour" label-for="colour" label-cols="3">
            <b-form-input id="colour" v-model="form.colour" type="color" required placeholder="Choose colour" />
        </b-form-group>

        <b-form-group label="Secondary Colour" label-for="secondary_colour" label-cols="3">
            <b-form-input id="secondary_colour" v-model="form['secondary_colour']" type="color" required
                placeholder="Choose secondary colour" />
        </b-form-group>

        <b-button type="submit" variant="primary">Create</b-button>
    </b-form>
</template>

<script>
import axios from "axios";
import eventBus from "./eventBus";


export default {
    data() {
        return {
            form: {
                name: "",
                founded: "",
                stadium: "",
                location: "",
                colour: "#000000",
                'secondary_colour': "#ffffff"
            },
        };
    },
    methods: {
        async createTeam() {
            await axios.post("/api/teams", this.form);
            this.sendCustomEvent();
        },

        sendCustomEvent() {
            eventBus.$emit('team-created')
        }


    },
};
</script>
