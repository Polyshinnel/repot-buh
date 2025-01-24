<script setup>

</script>

<template>
    <div class="footer-block">
        <span><b>Copyright © 2024</b> <a href="https://kidsberry.org">Kidsberry</a>. Все права защищены.</span>
        <span><b>Версия</b> 3.1.0</span>
    </div>
</template>

<style scoped lang="scss">
.footer-block{
    width: calc(100% - 40px);
    height: 57px;
    border-top: 1px solid #dee2e6;
    display: flex;
    align-items: center;
    justify-content: space-between;
    color: #7e7e7e;
    padding: 0 20px;

    span{
        a{
            text-decoration: none;
            font-weight: 700;
            color: #007bff;
        }
    }
}
</style>
