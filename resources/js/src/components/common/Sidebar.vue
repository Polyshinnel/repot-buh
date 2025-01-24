<script setup>
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import {faCog, faCreditCard, faReceipt, faRetweet, faTachometerAlt} from '@fortawesome/free-solid-svg-icons';
</script>

<template>
<div class="sidebar-block">
    <div class="sidebar-title">Кидсберри отчеты</div>
    <div class="sidebar-name">Имя пользователя</div>
    <ul class="sidebar-menu">
        <li>
            <a href="/">
                <div class="sidebar-menu-item">
                    <font-awesome-icon :icon="faTachometerAlt" />
                    <span>Дашборд</span>
                </div>
            </a>
        </li>

        <li>
            <a href="/payments">
                <div class="sidebar-menu-item">
                    <font-awesome-icon :icon="faCreditCard" />
                    <span>Платежи</span>
                </div>
            </a>
        </li>

        <li>
            <a href="/returning">
                <div class="sidebar-menu-item">
                    <font-awesome-icon :icon="faRetweet" />
                    <span>Возвраты</span>
                </div>
            </a>
        </li>

        <li>
            <a href="/reciept">
                <div class="sidebar-menu-item">
                    <font-awesome-icon :icon="faReceipt" />
                    <span>Чеки</span>
                </div>
            </a>
        </li>

        <li>
            <a href="/settings">
                <div class="sidebar-menu-item">
                    <font-awesome-icon :icon="faCog" />
                    <span>Настройки</span>
                </div>
            </a>
        </li>
    </ul>
</div>
</template>

<style scoped lang="scss">
.sidebar-block{
    background: #343a40;
    width: 250px;
    height: 100vh;
}
</style>
