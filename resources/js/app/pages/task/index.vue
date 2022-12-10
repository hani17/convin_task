<template>
    <v-container>
        <v-row dense class="justify-content-center">
            <v-col cols="4"></v-col>
            <v-col cols="4">
                <h1 class="my-6">Tasks</h1>
                <task-card v-for="item in items" :key="item.id" :item="item"/>
            </v-col>
        </v-row>
        <div class="text-xs-center mt-6 mb-10">
            <v-pagination
                v-if="items.length > 0 && pagination.last_page > 1"
                v-model="pagination.current_page"
                :length="pagination.last_page"
                :total-visible="10"
                @input="paginate"
            ></v-pagination>
        </div>
    </v-container>
</template>

<script>
import TaskCard from '../../components/task-card'
import { getTasks } from "../../api/task";
import {searchAdmins} from "../../api/users";
export default {
    name: "Tasks",
    components: {
        TaskCard:TaskCard
    },
    data: () => ({
        items: [],
        loading:false,
        pagination: {},
    }),
    watch: {
        "$route.query"() {
            this.getTasks();
        },
    },
    mounted () {
        this.getTasks();
    },

    methods: {
        getTasks () {
            const page = this.$route.query.page;
            this.loading = true;
            getTasks(page).then(res => {
                this.items = res.data;
                this.pagination = res.meta;
            }).catch(err => {
                console.log(err)
            }).finally(() => (this.loading = false))
        },
        paginate(page = 1) {
            if (page != this.$route.query.page) {
                this.loading = true;
                this.$router
                    .replace({ query: { ...this.$route.query, page: page } })
                    .then(() => {})
                    .catch((err) => {});
            }
        }
    }
}
</script>

<style scoped>

</style>
