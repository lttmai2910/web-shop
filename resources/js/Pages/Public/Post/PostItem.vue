<script setup>
import Topbar from '@/Components/Public/Topbar.vue';
import Footer from '@/Components/Public/Footer.vue';

const props = defineProps({
    post: Object,
    relatedPosts: Array,
});

const formatPostBody = (body) => {
    return body.split('\n').map(paragraph => `<p>${paragraph.trim()}</p>`).join('');
};

const formatDate = (dateTime) => {
    const date = new Date(dateTime);
    const day = date.getDate();
    const month = date.getMonth() + 1;
    const year = date.getFullYear();
    return `${day}/${month}/${year}`;
};

console.log('Related Posts:', props.relatedPosts); // Kiểm tra dữ liệu liên quan
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
                        <a :href="route('post')" class="text-lg">Tin tức - {{ props.post.title }}</a>
                    </div>
                </div>
                <hr class="mt-4 mb-6 hidden sm:block">
                <div class="flex flex-col justify-center mx-24">
                    <div class="flex justify-center items-center mb-8">
                        <img :src="'/image_post/' + props.post.image" class="h-96 object-cover rounded-lg shadow-lg">
                    </div>
                    <div>
                        <p class="text-3xl font-bold uppercase text-center mb-4">{{ props.post.title }}</p>
                        <div class="text-center text-gray-600 mb-8">
                            <span>Người đăng: {{ props.post.user.name }}</span> |
                            <span>{{ formatDate(props.post.created_at ? props.post.created_at : props.post.updated_at) }}</span>
                        </div>
                        <div class="post-content text-lg leading-relaxed mb-8" v-html="formatPostBody(props.post.body)">
                        </div>
                        <hr>
                        <div class="related-posts mt-8">
                            <h2 class="text-2xl font-bold mb-4 uppercase">Tin tức khác</h2>
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                                <!-- Vòng lặp để hiển thị các bài viết liên quan -->
                                <template v-for="(relatedPost, index) in props.relatedPosts" :key="index">
                                    <template v-if="relatedPost.status === 1">
                                        <div class="related-post bg-white p-4 rounded-lg shadow-lg">
                                            <a :href="`/Public/Post/PostItem/${relatedPost.id}`">
                                                <img :src="'/image_post/' + relatedPost.image" class="h-48 w-full object-cover rounded-t-lg">
                                                <h3 class="text-xl font-bold mt-2">{{ relatedPost.title }}</h3>
                                                <p class="truncate text-gray-600 mt-1">{{ relatedPost.body }}</p>
                                                <div class="flex items-center mt-1">
                                                    <span class="text-red-600 mr-1">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                        </svg>
                                                    </span>
                                                    <span class="text-red-600">{{ formatDate(relatedPost.created_at ? relatedPost.created_at : relatedPost.updated_at) }}</span>
                                                </div>
                                            </a>
                                        </div>
                                    </template>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>  
    <Footer/>
    </div>  
</template>

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
    width: 100%;
    text-decoration: none;
    color: inherit;
}

.p-body:hover {
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    transform: translateY(-2px);
    transition: transform 0.2s, box-shadow 0.2s;
}

.post-content p {
    margin-bottom: 1.5rem; /* Thay đổi khoảng cách giữa các đoạn văn nếu cần */
    line-height: 1.6; /* Thiết lập chiều cao dòng để văn bản dễ đọc hơn */
}

.related-posts h2 {
    text-align: center;
}

.related-posts .related-post img {
    transition: transform 0.3s;
}

.related-posts .related-post:hover img {
    transform: scale(1.05);
}
</style>
