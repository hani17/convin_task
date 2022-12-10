<template>
    <v-app>
        <v-app-bar color="primary" dark app>
            <v-toolbar-title>ConvertedIn Task</v-toolbar-title>
            <v-spacer></v-spacer>
            <v-toolbar-items>
                <v-btn
                    text
                    v-for="item in menuItems"
                    :key="item.title"
                    exact
                    :to="item.path">
                    <v-icon left dark>{{ item.icon }}</v-icon>
                    {{ item.title }}
                </v-btn>
            </v-toolbar-items>
        </v-app-bar>

        <v-main>
            <router-view></router-view>
        </v-main>
    </v-app>
</template>

<script>
export default {
    name: "App",
    data () {
        return {
            menuItems: [
                { title: 'Tasks', path: '/', icon: 'task' },
                { title: 'Add Task', path: '/tasks/add', icon: 'add_task' },
                { title: 'Statistics', path: '/stats', icon: 'analytics' }
            ]
        }
    }
}
</script>

<style scoped>

</style>
