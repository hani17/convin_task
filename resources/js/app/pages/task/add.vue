<template>
    <v-container fluid>
        <v-layout row wrap>
            <v-flex xs12 class="text-center" my-6>
                <h1>Add Task</h1>
            </v-flex>
            <v-flex  xs12 sm6 offset-sm3 mt-3>
                <form @submit.prevent="addTask">
                    <v-layout column>
                        <v-flex>
                            <v-text-field
                                v-model="title"
                                name="title"
                                label="Title"
                                id="title"
                                type="text"
                                required></v-text-field>
                        </v-flex>
                        <v-flex>
                            <v-textarea
                                v-model="description"
                                name="description"
                                label="Description"
                                id="description"
                                type="text"
                                required></v-textarea>
                        </v-flex>
                        <v-flex>
                            <v-autocomplete
                                v-model="selectedAdmin"
                                :items="adminItems"
                                :loading="adminLoading"
                                :search-input.sync="searchAdmin"
                                color="primary"
                                hide-no-data
                                hide-selected
                                item-text="name"
                                item-value="id"
                                label="Select Admin"
                                placeholder="Start typing to Search"
                                prepend-icon="admin_panel_settings"
                                chips
                            ></v-autocomplete>
                        </v-flex>

                        <v-flex>
                            <v-autocomplete
                                v-model="selectedUser"
                                :items="userItems"
                                :loading="userLoading"
                                :search-input.sync="searchUser"
                                color="primary"
                                hide-no-data
                                hide-selected
                                item-text="name"
                                item-value="id"
                                label="Select Assigned To User"
                                placeholder="Start typing to Search"
                                prepend-icon="person"
                                chips
                            ></v-autocomplete>
                        </v-flex>

                        <v-flex class="text-center" mt-5>
                            <v-btn size="lg" color="primary" type="submit">Add</v-btn>
                        </v-flex>
                    </v-layout>
                </form>
            </v-flex>
        </v-layout>
    </v-container>
</template>

<script>
import { searchAdmins, searchUsers } from "../../api/users";
import { createTask } from "../../api/task";

export default {
    data: () => ({
        adminLoading: false,
        userLoading: false,
        title: '',
        description: '',
        selectedAdmin: null,
        selectedUser: null,
        searchAdmin: null,
        searchUser: null,
        adminItems: [],
        userItems : []
    }),

    watch: {
        searchAdmin (val) {
            this.getAdmins(val)
        },

        searchUser (val) {
            this.getUsers(val);
        },
    },

    mounted () {
        this.getAdmins();
        this.getUsers();
    },

    methods: {
        getAdmins (val = '') {
            this.adminLoading = true
            // Lazily load input items
            searchAdmins(val)
                .then(res => {
                    this.adminItems = res.data;
                })
                .catch(err => {
                    console.log(err)
                })
                .finally(() => (this.adminLoading = false))
        },

        getUsers (val = '') {
            this.userLoading = true
            // Lazily load input items
            searchUsers(val)
                .then(res => {
                    this.userItems = res.data;
                })
                .catch(err => {
                    console.log(err)
                })
                .finally(() => (this.userLoading = false))
        },

        addTask () {
            const data = {
                'title' : this.title,
                'description' : this.description,
                'assigned_by_id' : this.selectedAdmin,
                'assigned_to_id' : this.selectedUser
            };
            createTask(data)
                .then(res => {
                    this.$router.push({name: 'tasks'});
                })
                .catch(err => {
                    console.log(err)
                })
        }
    }
};
</script>
