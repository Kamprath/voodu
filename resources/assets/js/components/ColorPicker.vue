<template>
    <div class="color-picker fade-in">
        <div>
            <a href="#" @click.prevent="$emit('close')">
                <i class="fa fa-times-circle"></i>
            </a>
            <compact-picker v-model="colors" />
        </div>
    </div>
</template>

<style lang="less" scoped>
    .color-picker {
        position: absolute;
        z-index: 9999999;
        top: 0;
        left: 0;

        & > div {
            position: relative;

            & > a {
                position: absolute;
                top: -.3rem;
                right: -.3rem;
                font-size: 1.25rem;
                line-height: 1.25rem;
                color: #222;
            }
        }
        .vc-compact {
            width: 12rem;
        }
    }
</style>

<script>
    import { Compact } from 'vue-color';

    const defaultProps = {
        hex: '#194d33',
        hsl: {
            h: 150,
            s: 0.5,
            l: 0.2,
            a: 1
        },
        hsv: {
            h: 150,
            s: 0.66,
            v: 0.30,
            a: 1
        },
        rgba: {
            r: 25,
            g: 77,
            b: 51,
            a: 1
        },
        a: 1
    };

    export default {
        data() {
            return {
                colors: defaultProps
            }
        },
        computed: {
            style() {
                return 'background-color: black';
            }
        },
        watch: {
            colors(newValue) {
                this.$emit('change', newValue);
            }
        },
        components: {
            'compact-picker': Compact
        }
    }
</script>

