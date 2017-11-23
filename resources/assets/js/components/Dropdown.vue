<template>

    <span :class="{ 'dropdown': true, 'is-active': isActive }">
        <span class="dropdown-trigger">
            <a class="icon is-small"
               href="#"
               @click.prevent="isActive = !isActive"
               aria-haspopup="true">
                <i class="fa fa-angle-down" aria-hidden="true"></i>
            </a>
        </span>

        <div class="dropdown-menu" role="menu">
            <div class="dropdown-content">
                <slot></slot>
            </div>
        </div>
    </span>

</template>

<style lang="less" scoped>

    @import '../../less/colors.less';

    .dropdown {
        height: 1rem;

        &-trigger .fa {
            font-size: 1.5em;
            color: @color-gray-medium;
        }

        a:hover .fa {
            color: @color-white;
        }

        &.is-dark a:hover .fa {
            color: @color-gray-medium;
        }

        &.is-active {
            .fa, a:hover .fa {
                color: @primary;
            }
        }
    }

</style>

<script>

    export default {

        data() {
            return {
                isActive: false
            };
        }

    }

</script>