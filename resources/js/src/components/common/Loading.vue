<script setup>

import {faCircleNotch} from "@fortawesome/free-solid-svg-icons";
import {FontAwesomeIcon} from "@fortawesome/vue-fontawesome";
</script>

<template>
    <div class="loading-block">
        <font-awesome-icon :icon="faCircleNotch" class="rotate" />
    </div>
</template>

<style scoped>
    .loading-block{
        height: 500px;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 40px;
        color: #0c84ff;
    }

    @keyframes spin {
        from {
            transform: rotate(0deg);
        }
        to {
            transform: rotate(360deg);
        }
    }

    .rotate {
        animation: spin 2s linear infinite;
    }
</style>
