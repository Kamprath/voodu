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
            <div class="dropdown-content fade-in" v-if="isActive">
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
                transition: opacity 150ms linear, color 150ms linear;
                opacity: .5;
            }

            a:hover .fa {
                color: @color-white;
                opacity: 1;
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
        &.is-light.is-active {
            .fa {
                color: @color-white;
                opacity: 1;
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
        padding: .5rem .8rem;
        text-align: center;
        font-family: Roboto, Helvetica, sans-serif;
        font-size: .85rem;
        line-height: .75rem;

        &:first-child {
            padding-top: .6rem;
        }
        &:last-child {
            padding-bottom: .6rem;
        }

        a {
            font-size: .75rem;
        }
    }

</style>

<script>

    export default {

        data() {
            return {
                isActive: false
            };
        },

        mounted() {
            // close dropdown if anything other than toggle link was clicked
            document.querySelector('body').addEventListener('click', function(e) {
                if (!e.target.parentNode.parentNode.classList.contains('dropdown-trigger')) {
                    this.isActive = false;
                }
            }.bind(this));
        }

    }

</script>