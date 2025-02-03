<script setup>

import {faCircleNotch} from "@fortawesome/free-solid-svg-icons";
import {FontAwesomeIcon} from "@fortawesome/vue-fontawesome";
</script>

<template>
    <div class="loading-btn">
        <font-awesome-icon :icon="faCircleNotch" class="rotate" />
    </div>
</template>

<style scoped>
.loading-btn{
    height: 32px;
    display: flex;
    justify-content: center;
    align-items: center;
    min-width: 50px;
    background: #409EFF;
    color: #fff;
    border-radius: 5px;
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
