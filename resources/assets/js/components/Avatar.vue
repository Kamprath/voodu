<template>
    <figure class="avatar" :style="style">
        <span v-if="!src" class="avatar-letters"></span>
    </figure>
</template>

<script>
    export default {
        props: {
            src: {
                type: String,
                default: null
            },
        },
        computed: {
            style() {
                return 'background-image: url(\'' + this.src + '\');';
            }
        },
    }
</script>

<style lang="less" scoped>
    figure {
        width: 2rem;
        height: 2rem;
        border-radius: 50%;
        background-repeat: no-repeat;
        background-position: center center;
        background-color: rgba(71, 71, 71, 0.4);
        background-size: cover;

        &.is-small {
            width: 1.5rem;
            height: 1.5rem;
        }
        &.is-large {
            width: 3rem;
            height: 3rem;
        }
    }
</style>