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

        &-trigger {
            line-height: 1rem;
        }

        .fa {
            font-size: 1.5em;
            color: @color-gray-medium;
            font-weight: bold;
        }

        a:hover .fa {
            color: @color-white;
        }

        &.is-dark a:hover .fa {
            color: @color-gray-medium;
        }
        &.is-light {
            .fa {
                color: @color-gray-lighter;
            }

            a:hover .fa {
                color: @color-white;
            }
        }

        &.is-active {
            .fa, a:hover .fa {
                color: @color-white;
            }
        }
        &.is-dark.is-active {
            .fa, a:hover .fa {
                color: @primary;
            }
        }

        .icon.is-small {
            font-size: .8rem;
        }
    }

    .dropdown-menu {
        min-width: 6rem;
    }

    .dropdown-content {
        padding: 0;
    }

    .dropdown-item {
        padding: .3rem 1rem;
        text-align: center;

        &:first-child {
            padding-top: .4rem;
        }
        &:last-child {
            padding-bottom: .4rem;
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