<script setup>
    import Topbar from '@/Components/Public/Topbar.vue';
    import Footer from '@/Components/Public/Footer.vue';
    import Pagination from '@/Components/Pagination.vue';
    import { Head, Link, useForm, usePage } from '@inertiajs/vue3';
    defineProps({
        posts: Object,
        user: Object,
    });

    const form = useForm({});
</script>

<template>
    <div class="page-container">
    <Topbar />
    <div class="content-container">
        <div class="font-lora m-5">
            <div class="post font-lora mx-auto px-4">
                <div class="flex justify-center">
                    <div class="ab w-full h-10 flex items-center space-x-2">
                        <a href="/" class="text-lg flex flex-row items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-6 ml-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                            </svg>
                            <span class="ml-2">Trang chủ</span>
                        </a>
                        <span class="mx-2">|</span>
                        <p class="text-lg">Tin tức</p>
                    </div>
                </div>
                <hr class="mt-4 mb-6 hidden sm:block">
                <div class="flex justify-center items-center">
                    <div class="border-t border-black w-32 mr-2"></div>
                    <p class="text-3xl font-bold uppercase">Tin tức</p>
                    <div class="border-t border-black w-32 ml-2"></div>
                </div>
                <div class="flex justify-center items-center flex-wrap">
                        <div v-if="posts && posts.data.length > 0" class="w-full px-2 mb-4">
                        <div class="mx-auto max-w-7xl grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6"> 
                            <div v-for="(post, index) in posts.data" :key="index" class="w-full">
                                <template v-if="post.status === 1">
                                <a :href="route('postitem', { id: post.id })" class="block p-body p-2 shadow-lg no-underline text-current">
                                    <div class="flex justify-center items-center flex-wrap">
                                        <div class="p-img w-full aspect-w-1 aspect-h-1 flex justify-center items-center">
                                            <img :src="'/image_post/' + post.image" class="h-64 w-full p-5 object-cover">
                                        </div>
                                        <div class="p-content w-full mt-2">
                                            <span class="truncate font-bold block">{{ post.title }}</span>
                                            <p class="truncate block">{{ post.body }}</p>
                                            <div class="flex flex-row mt-2 text-sm text-gray-600">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                                </svg>
                                                <span class="ml-2">Người đăng: {{ post.user.name }}</span>
                                            </div>
                                            <div class="mt-4 flex justify-end">
                                                <div v-if="post.created_at || post.updated_at"
                                                    class="p-date w-24 p-3 z-20 bg-red-600 text-white">
                                                    <span class="flex justify-center">{{ formatDate(post.created_at ? post.created_at : post.updated_at) }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                </template>
                            </div>
                        </div>
                        <Pagination :links="posts.links" v-if="posts && posts.links" class="flex justify-center"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <Footer />
    </div>
</template>

<script>
export default {
    methods: {
        formatDate(dateTime) {
            const date = new Date(dateTime);
            // Lấy ngày, tháng và năm
            const day = date.getDate();
            const month = date.getMonth() + 1;
            const year = date.getFullYear();
            // Định dạng lại ngày tháng
            return `${day}/${month}/${year}`;
        }
    }
};
</script>

<style scoped>
@media (max-width: 640px) {
    .ab {
        display: none;
    }
}
    
.page-container {
display: flex;
flex-direction: column;
min-height: 100vh;
}

.content-container {
flex: 1;
}

.p-body {
    transition: transform 0.5s, box-shadow 0.2s; 
}

.p-body:hover {
    transform: translateY(-2px); 
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1); 
}
</style>
