<script setup>

import {useRouter} from "vue-router";

const router = useRouter()
const handleClick = (id) => {
    console.log(id)
    const path = `/reciept/${id}`
    router.push(path)
}

const handleDelete = (id) => {
    console.log(id)
}

const props = defineProps({
    reciepts: Array
})

</script>

<template>
    <div class="table-block">
        <el-table :data="props.reciepts" height="530" style="width:100%;">

            <el-table-column fixed prop="id" label="ID" width="50"/>
            <el-table-column fixed prop="name" label="Заказ" width="100">
                <template #default="scope">
                    <el-tag type="primary">{{scope.row.name}}</el-tag>
                </template>
            </el-table-column>
            <el-table-column fixed prop="customer" label="ФИО" width="200"/>
            <el-table-column fixed prop="email" label="Email" width="220"/>
            <el-table-column fixed prop="phone" label="Телефон" width="220"/>
            <el-table-column fixed prop="amount" label="Сумма чека" width="150"/>
            <el-table-column fixed prop="refunded" label="Сумма возврата" width="150"/>
            <el-table-column fixed prop="status" label="Статус" width="120">
                <template #default="scope">
                    <el-tag type="success" v-if="scope.row.status == 1">Отправлен</el-tag>
                    <el-tag type="info" v-if="scope.row.status == 2">Отправляется</el-tag>
                    <el-tag type="warning" v-if="scope.row.status == 0">Не отправлен</el-tag>
                </template>
            </el-table-column>
            <el-table-column fixed prop="updated_at" label="Дата создания" width="170"/>
            <el-table-column label="Операции" width="200" fixed>
                <template #default="scope">
                    <el-button type="primary" size="small" @click="handleClick(scope.row.id)">
                        Открыть
                    </el-button>
                    <el-button type="danger" size="small" @click="handleDelete(scope.row.id)">Удалить</el-button>
                </template>
            </el-table-column>
        </el-table>
    </div>
</template>

<style scoped>
.table-block{
    width: 100%;
}
</style>
