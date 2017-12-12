<template>
    <div>
        <a :class="{ 'avatar': true, 'create-team': !team }">
            <img v-if="team && team.avatar" :src="team.avatar">
            <span class="avatar-initials" v-else>{{ letter }}</span>
        </a>
    </div>
</template>

<style lang="less" scoped>
    @import '../../less/colors';

    .avatar {
        &.create-team {
            border: 1px dashed @color-gray-medium;
            transition: border-color 120ms;

            span {
                transition: color 120ms;
                color: @color-gray-medium;
            }
            &:hover {
                border-color: @color-white;
                span { color: @color-white; }
            }
        }
    }
</style>

<script>
    export default {
        computed: {
            team() {
                return this.$store.state.team || null;
            },
            letter() {
                return this.team ? this.team.name.match(/\b\w/g).join('').substr(0, 1) : '+';
            }
        }
    }
</script>