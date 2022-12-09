import Vue from "vue";
import Router from "vue-router";

Vue.use(Router);

const routingMap = [
    // {
    //     path: "/",
    //     component: Layout,
    //     redirect: "/dashboard",
    //     children: [
    //         {
    //             path: "/dashboard",
    //             component: () => import("../pages/home/index.vue"),
    //             name: "Dashboard",
    //             meta:{
    //                 title: "dashboard"
    //             }
    //         }
    //     ]
    // },
    // {
    //     path: "/login",
    //     component: () => import("../pages/login/index.vue"),
    //     meta:{
    //         title: "login"
    //     }
    // }
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
