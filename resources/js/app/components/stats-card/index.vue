<template>
    <v-card
        color="#385F73"
        dark
        class="my-4"
    >
        <v-card-title class="text-h4">
            {{ item.tasks_count }}
        </v-card-title>


        <v-card-subtitle class="text-h6">{{ item.user.name }}</v-card-subtitle>

    </v-card>
</template>

<script>
export default {
    name: "StatsCard",
    props: {
        item: {
            type: Object
        }
    }
}
</script>

<style scoped>

</style>
