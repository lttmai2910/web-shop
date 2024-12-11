<script setup>
import { defineProps } from 'vue';

const props = defineProps({
    links: Array,
    colorScheme: String, // Thêm prop colorScheme
});

const linkItems = props.links; // Sử dụng links như là một mảng các đối tượng link
</script>

<template>
    <div v-if="linkItems.length > 0">
        <div class="flex flex-wrap mt-8">
            <template v-for="(link, key) in linkItems" :key="key">
                <div
                    v-if="link.url === null"
                    class="mr-1 mb-1 px-4 py-3 text-sm leading-4 text-slate-950 border rounded-sm"
                    v-html="link.label"
                ></div>
                <a
                    v-else
                    :class="getLinkClass(link)"
                    :href="link.url"
                    v-html="link.label"
                ></a>
            </template>
        </div>
    </div>
</template>

<style scoped>
/* Các style scoped cho component này */
</style>

<script>
export default {
    props: {
        links: Array,
        colorScheme: {
            type: String,
            default: 'public',
        },
    },
    methods: {
        getLinkClass(link) {
            if (this.colorScheme === 'admin') {
                return [
                    'mr-1 mb-1 px-4 py-3 text-sm leading-4 border rounded hover:bg-green-500 focus:border-primary focus:text-primary',
                    { 'bg-green-700 text-white': link.active }
                ];
            } else {
                return [
                    'mr-1 mb-1 px-4 py-3 text-sm leading-4 border rounded hover:bg-red-400 focus:border-primary focus:text-primary',
                    { 'bg-red-700 text-white': link.active }
                ];
            }
        },
    },
};
</script>
