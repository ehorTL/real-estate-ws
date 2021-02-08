import VueRouter from "vue-router";
import Vue from "vue";

Vue.use(VueRouter);

import TestComponent from "./components/TestComponent";
import ExampleComponent from "./components/ExampleComponent";

const routes = [
    {
        path: "/",
        component: ExampleComponent
    },
    {
        path: "/hello",
        component: TestComponent
    }
];

export default new VueRouter({
    mode: "history",
    routes
});
