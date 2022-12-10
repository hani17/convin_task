import Vue from "vue";
import Router from "vue-router";

import Task from "../pages/task";
import AddTask from "../pages/task/add";
import Stats from "../pages/stats"

Vue.use(Router);

const routingMap = [
    {
        path: "/",
        name: 'tasks',
        component: Task,
        meta:{
            title: "View Tasks"
        }
    },
    {
        path: "/tasks/add",
        name: 'add_task',
        component: AddTask,
        meta:{
            title: "Add Task"
        }
    },
    {
        path: "/stats",
        name: 'stats',
        component: Stats,
        meta:{
            title: "Statistics"
        }
    }
];

export default new Router({
    mode: "history",
    routes: routingMap,
    scrollBehavior(to, from, savedPosition) {
        if (savedPosition) {
            return savedPosition;
        }else if(to.params.savePosition){
            return {}
        } else {
            return { x: 0, y: 0 };
        }
    }
});
