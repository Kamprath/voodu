<template>

    <div :class="{ 'dropdown': true, 'is-active': isActive }">
        <div class="dropdown-trigger">
            <a class="icon is-small"
               href="#"
               @click.prevent="isActive = !isActive"
               aria-haspopup="true">
                <i class="fa fa-angle-down" aria-hidden="true"></i>
            </a>
        </div>

        <div class="dropdown-menu" role="menu">
            <div class="dropdown-content">
                <slot></slot>
            </div>
        </div>
    </div>

</template>

<script>

    export default {

        data() {
            return {
                isActive: false
            };
        }

    }

</script>