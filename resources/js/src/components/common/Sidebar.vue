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

        <li class="active">
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

.sidebar-title{
    height: 57px;
    display: flex;
    align-items: center;
    padding-left: 20px;
    border-bottom: 1px solid #4f5962;
    color: #d1d2d3;
}

.sidebar-name{
    height: 57px;
    display: flex;
    align-items: center;
    padding-left: 20px;
    border-bottom: 1px solid #4f5962;
    color: #d1d2d3;
}

.sidebar-menu{
    margin-top: 15px;
    padding: 0 10px;
    li{
        height: 40px;
        display: flex;
        align-items: center;
        padding: 3px 15px;
        border-radius: 3px;
        cursor: pointer;

        a{
            color: #c2c7d0;
            text-decoration: none;
        }

        &:hover{
            background: #494e53;
            a{
                color: #fff;
            }
        }
    }

    .active{
        background: #0c84ff;

        a{
            color: #fff;
        }

        &:hover{
            background: #0c84ff;
            a{
                color: #fff;
            }
        }
    }


}

.sidebar-menu-item{
    span{
        margin-left: 10px;
    }
}
</style>
