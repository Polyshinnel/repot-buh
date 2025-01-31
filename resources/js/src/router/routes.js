import MainRecieptPage from "../pages/MainRecieptPage.vue";
import RecieptItem from "@/pages/RecieptItem.vue";

const routes = [
    {
        path: '/',
        name: 'home',
        component: MainRecieptPage
    },
    {
        path: '/reciept/1',
        name: 'reciept-item',
        component: RecieptItem
    },
]

export default routes
