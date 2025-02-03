<script setup>

import Workspace from "@/components/common/Workspace.vue";
import Loading from "@/components/common/Loading.vue";
import Empty from "@/components/common/Empty.vue";
import RecieptListTable from "@/components/reciept/RecieptListTable.vue";
import {onMounted, reactive, ref} from "vue";
import {Plus, Search} from "@element-plus/icons-vue";
import { Fancybox } from "@fancyapps/ui";
import "@fancyapps/ui/dist/fancybox/fancybox.css";
import LoadingBtn from "@/components/common/LoadingBtn.vue";
import axios from "axios";
import {useRouter} from "vue-router";

const router = useRouter();
const reciepts = ref([]);
const loading = ref(false)
const searchOrder = ref('')

const search = ref('')

const loadingOrder = ref(false)

const getReciepts = async () => {
    try {
        const {data} = await axios.post('/api/reciepts');
        reciepts.value = data.reciepts
    } catch (e) {
        console.log(e)
    }
}

const handleSearch = async () => {
    loadingOrder.value = true
    try {
        const {data} = await axios.post('/api/simpla-search', {order: searchOrder.value})
        const id = data.data
        Fancybox.close();
        const url = `/reciept/${id}`
        await router.push(url)
    } catch (e) {
        console.log(e.response.data)
    }
}

const getSearchDialog = () => {
    Fancybox.show([{ src: "#fancy-search", type: "inline" }]);
}


onMounted(() => {
    getReciepts();
})
</script>

<template>
    <Workspace title="Работа с чеками">
        <div class="filter-list">
            <el-input
                v-model="search"
                style="width: 240px"
                placeholder="pr-10104"
                :prefix-icon="Search"
            />

            <el-button type="primary" :icon="Plus" @click="getSearchDialog">Новый чек</el-button>
        </div>
        <Loading v-if="loading" />
        <RecieptListTable v-if="reciepts.length > 0 && !loading" :reciepts="reciepts" class="reciept-table-block"/>
        <Empty v-if="!loading && reciepts.length < 1" />
    </Workspace>

    <div class="fancy-search" id="fancy-search">
        <h2>Номер заказа</h2>
        <p>Введите номер заказа в формате pr-10123</p>
        <div class="input-block">
            <el-input v-model="searchOrder" style="width: 190px" placeholder="pr-10123" />
            <el-button type="primary" class="search-btn" v-if="!loadingOrder" @click="handleSearch">Найти</el-button>
            <LoadingBtn v-if="loadingOrder" class="search-loading" />
        </div>
    </div>
</template>

<style scoped lang="scss">
.filter-list{
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.fancy-search{
    width: 340px;
    border: 1px solid #ccc;
    border-radius: 4px;
    padding: 15px;
    display: none;

    h2{
        font-size: 20px;
    }

    p{
        font-size: 14px;
        margin-top: 10px;
    }

    .input-block{
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 15px;

        .search-btn{
            width: 100px;
        }
    }
}

.search-loading{
    width: 100px;
}

.reciept-table-block{
    margin-top: 20px;
}
</style>
