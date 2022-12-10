<template>
    <v-card
        color="#385F73"
        dark
        class="my-4"
    >
        <v-card-title class="text-h5">
            {{ item.title }}
        </v-card-title>

        <v-card-text>{{ item.description }}</v-card-text>

        <v-list class="transparent">
            <v-list-item>

                <v-list-item-title>Assigned To</v-list-item-title>

                <v-list-item-subtitle >
                    {{ item.assigned_to.name }}
                </v-list-item-subtitle>

            </v-list-item>

            <v-list-item>

                <v-list-item-title>Assigned By</v-list-item-title>

                <v-list-item-subtitle>
                    {{ item.assigned_by.name }}
                </v-list-item-subtitle>

            </v-list-item>
        </v-list>

    </v-card>
</template>

<script>
export default {
    name: "TaskCard",
    props: {
        item: {
            type: Object
        }
    }
}
</script>

<style scoped>

</style>
