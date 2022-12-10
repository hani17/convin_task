<template>
    <v-container>
        <v-row dense class="justify-content-center">
            <v-col cols="4"></v-col>
            <v-col cols="4">
                <h1 class="my-6">Top Users</h1>
                <stats-card v-for="item in items" :key="item.id" :item="item"/>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
import StatsCard from '../../components/stats-card'
import { getStats } from "../../api/stats";

export default {
    name: "Tasks",
    components: {
        StatsCard: StatsCard
    },
    data: () => ({
        items: [],
        loading:false,
        pagination: {},
    }),
    mounted () {
        this.getStats();
    },
    methods: {
        getStats () {
            this.loading = true;
            getStats().then(res => {
                this.items = res.data;
            }).catch(err => {
                console.log(err)
            }).finally(() => (this.loading = false))
        }
    }
}
</script>

<style scoped>

</style>
