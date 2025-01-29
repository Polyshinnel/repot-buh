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
            <div class="workspace-body">
                <div class="workspace-body__title">
                    <h1>Работа с чеками</h1>

                    <ul class="breadcrumbs">
                        <li><a href="/">Главная</a>&nbsp;/&nbsp;</li>
                        <li>Чеки</li>
                    </ul>
                </div>

                <div class="workspace-area">
                    <div class="workspace-area__title">
                        <h2>Работа с чеками</h2>
                    </div>

                    <div class="workspace-area__body">
                        <slot></slot>
                    </div>
                </div>
            </div>
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
    background: #f4f6f9;
}

.workspace-body__title{
    display: flex;
    align-items: center;
    justify-content: space-between;

    h1{
        font-weight: 300;
        font-size: 28px;
        color: #212529;
    }
}

.breadcrumbs{
    display: flex;
    align-items: center;
    list-style: none;

    a{
        text-decoration: none;
        color: #0c84ff;
    }

    color: #212529;
}

.workspace-area{
    width: 100%;
    background: #fff;
    margin-top: 20px;
    border-radius: 5px;

    .workspace-area__title{
        height: 46px;
        display: flex;
        padding: 0 15px;
        align-items: center;
        border-bottom: 1px solid #dee2e6;

        h2{
            color: #212529;
            font-size: 18px;
            font-weight: 300;
        }
    }

    .workspace-area__body{
        padding: 15px;
    }
}
</style>
