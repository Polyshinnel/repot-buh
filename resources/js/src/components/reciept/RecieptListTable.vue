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

const tableData = [
    {
        id: 1,
        name: 'pr-1035',
        customer: 'Нестеров Андрей Вадимович',
        email: 'polyshinnel@gmail.com',
        phone: '+79030264456',
        amount: '1800',
        refunded: '1000',
        status: 1,
        updated_at: '31.01.2025 12:11:01'
    },
    {
        id: 1,
        name: 'pr-1035',
        customer: 'Нестеров Андрей Вадимович',
        email: 'polyshinnel@gmail.com',
        phone: '+79030264456',
        amount: '1800',
        refunded: '1000',
        status: 1,
        updated_at: '31.01.2025 12:11:01'
    },
    {
        id: 1,
        name: 'pr-1035',
        customer: 'Нестеров Андрей Вадимович',
        email: 'polyshinnel@gmail.com',
        phone: '+79030264456',
        amount: '1800',
        refunded: '1000',
        status: 1,
        updated_at: '31.01.2025 12:11:01'
    },
    {
        id: 1,
        name: 'pr-1035',
        customer: 'Нестеров Андрей Вадимович',
        email: 'polyshinnel@gmail.com',
        phone: '+79030264456',
        amount: '1800',
        refunded: '1000',
        status: 1,
        updated_at: '31.01.2025 12:11:01'
    },
    {
        id: 1,
        name: 'pr-1035',
        customer: 'Нестеров Андрей Вадимович',
        email: 'polyshinnel@gmail.com',
        phone: '+79030264456',
        amount: '1800',
        refunded: '1000',
        status: 1,
        updated_at: '31.01.2025 12:11:01'
    },
    {
        id: 1,
        name: 'pr-1035',
        customer: 'Нестеров Андрей Вадимович',
        email: 'polyshinnel@gmail.com',
        phone: '+79030264456',
        amount: '1800',
        refunded: '1000',
        status: 1,
        updated_at: '31.01.2025 12:11:01'
    },
    {
        id: 1,
        name: 'pr-1035',
        customer: 'Нестеров Андрей Вадимович',
        email: 'polyshinnel@gmail.com',
        phone: '+79030264456',
        amount: '1800',
        refunded: '1000',
        status: 1,
        updated_at: '31.01.2025 12:11:01'
    },
    {
        id: 1,
        name: 'pr-1035',
        customer: 'Нестеров Андрей Вадимович',
        email: 'polyshinnel@gmail.com',
        phone: '+79030264456',
        amount: '1800',
        refunded: '1000',
        status: 1,
        updated_at: '31.01.2025 12:11:01'
    },
    {
        id: 1,
        name: 'pr-1035',
        customer: 'Нестеров Андрей Вадимович',
        email: 'polyshinnel@gmail.com',
        phone: '+79030264456',
        amount: '1800',
        refunded: '1000',
        status: 1,
        updated_at: '31.01.2025 12:11:01'
    },
    {
        id: 1,
        name: 'pr-1035',
        customer: 'Нестеров Андрей Вадимович',
        email: 'polyshinnel@gmail.com',
        phone: '+79030264456',
        amount: '1800',
        refunded: '1000',
        status: 1,
        updated_at: '31.01.2025 12:11:01'
    },
    {
        id: 1,
        name: 'pr-1035',
        customer: 'Нестеров Андрей Вадимович',
        email: 'polyshinnel@gmail.com',
        phone: '+79030264456',
        amount: '1800',
        refunded: '1000',
        status: 1,
        updated_at: '31.01.2025 12:11:01'
    },
    {
        id: 1,
        name: 'pr-1035',
        customer: 'Нестеров Андрей Вадимович',
        email: 'polyshinnel@gmail.com',
        phone: '+79030264456',
        amount: '1800',
        refunded: '1000',
        status: 1,
        updated_at: '31.01.2025 12:11:01'
    },
    {
        id: 1,
        name: 'pr-1035',
        customer: 'Нестеров Андрей Вадимович',
        email: 'polyshinnel@gmail.com',
        phone: '+79030264456',
        amount: '1800',
        refunded: '1000',
        status: 1,
        updated_at: '31.01.2025 12:11:01'
    },
    {
        id: 1,
        name: 'pr-1035',
        customer: 'Нестеров Андрей Вадимович',
        email: 'polyshinnel@gmail.com',
        phone: '+79030264456',
        amount: '1800',
        refunded: '1000',
        status: 1,
        updated_at: '31.01.2025 12:11:01'
    },
    {
        id: 1,
        name: 'pr-1035',
        customer: 'Нестеров Андрей Вадимович',
        email: 'polyshinnel@gmail.com',
        phone: '+79030264456',
        amount: '1800',
        refunded: '1000',
        status: 1,
        updated_at: '31.01.2025 12:11:01'
    },
    {
        id: 1,
        name: 'pr-1035',
        customer: 'Нестеров Андрей Вадимович',
        email: 'polyshinnel@gmail.com',
        phone: '+79030264456',
        amount: '1800',
        refunded: '1000',
        status: 1,
        updated_at: '31.01.2025 12:11:01'
    },
    {
        id: 1,
        name: 'pr-1035',
        customer: 'Нестеров Андрей Вадимович',
        email: 'polyshinnel@gmail.com',
        phone: '+79030264456',
        amount: '1800',
        refunded: '1000',
        status: 1,
        updated_at: '31.01.2025 12:11:01'
    },
    {
        id: 1,
        name: 'pr-1035',
        customer: 'Нестеров Андрей Вадимович',
        email: 'polyshinnel@gmail.com',
        phone: '+79030264456',
        amount: '1800',
        refunded: '1000',
        status: 1,
        updated_at: '31.01.2025 12:11:01'
    },
    {
        id: 1,
        name: 'pr-1035',
        customer: 'Нестеров Андрей Вадимович',
        email: 'polyshinnel@gmail.com',
        phone: '+79030264456',
        amount: '1800',
        refunded: '1000',
        status: 1,
        updated_at: '31.01.2025 12:11:01'
    },
]
</script>

<template>
    <div class="table-block">
        <el-table :data="tableData" style="width: 100%">
            <el-table-column fixed prop="id" label="ID" width="50"/>
            <el-table-column fixed prop="name" label="Заказ" width="100">
                <template #default="scope">
                    <el-tag type="primary">{{scope.row.name}}</el-tag>
                </template>
            </el-table-column>
            <el-table-column fixed prop="customer" label="ФИО" width="200"/>
            <el-table-column fixed prop="email" label="Email" width="200"/>
            <el-table-column fixed prop="phone" label="Телефон"/>
            <el-table-column fixed prop="amount" label="Сумма чека"/>
            <el-table-column fixed prop="refunded" label="Сумма возврата"/>
            <el-table-column fixed prop="status" label="Статус" width="100">
                <template #default="scope">
                    <el-tag type="success" v-if="scope.row.status == 1">Отправлен</el-tag>
                    <el-tag type="info" v-if="scope.row.status == 2">Отправляется</el-tag>
                    <el-tag type="warning" v-if="scope.row.status == 0">Не отправлен</el-tag>
                </template>
            </el-table-column>
            <el-table-column fixed prop="updated_at" label="Дата создания"/>
            <el-table-column label="Операции" min-width="150">
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
.table-block {
    width: 100%;
    height: 100%;
}
</style>
