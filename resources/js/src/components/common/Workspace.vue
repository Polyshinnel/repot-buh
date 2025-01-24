<script setup>

import Header from "@/components/common/Header.vue";
import Footer from "@/components/common/Footer.vue";
import Sidebar from "@/components/common/Sidebar.vue";
</script>

<template>
    <div class="workspace__wrapper">
        <Sidebar />
        <div class="workspace">
            <Header />
            <div class="workspace-body"></div>
            <Footer />
        </div>
    </div>
</template>

<style scoped>
.workspace__wrapper{
    display: flex;
    align-items: flex-start;
}

.workspace{
    width: calc(100% - 250px);
}

.workspace-body{
    height: calc(100vh - 178px);
    padding: 30px;
}
</style>
