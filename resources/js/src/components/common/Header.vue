<script setup>
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import {faBars, faTachometerAlt} from "@fortawesome/free-solid-svg-icons";

</script>

<template>
<div class="header-block">
    <div class="header-menu">
        <font-awesome-icon :icon="faBars" />
        <span>Чеки</span>
    </div>
</div>
</template>

<style scoped>
.header-block{
    width: 100%;
    height: 57px;
    display: flex;
    align-items: center;
    border-bottom: 1px solid #dee2e6;

    .header-menu{
        display: flex;
        align-items: center;
        margin-left: 20px;
        color: #7e7e7e;

        span{
            margin-left: 10px;
        }
    }
}
</style>
