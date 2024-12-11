<script setup>
import BannerProduct from '@/Components/Public/BannerProduct.vue';
import BannerPost from '@/Components/Public/BannerPost.vue';
import Footer from '@/Components/Public/Footer.vue';
import Topbar from '@/Components/Public/Topbar.vue';
import ProductCard from "@/Components/Public/ProductCard.vue";
import PostCard from "@/Components/Public/PostCard.vue";
import { Head, Link, usePage } from '@inertiajs/vue3';
import { Splide, SplideSlide } from '@splidejs/vue-splide';
import { ref } from 'vue';
import Chatbot from '@/Components/Public/Chatbot.vue';
const { props } = usePage();
const productData = ref(props.products);
const postData = ref(props.posts);
const newProducts = ref(props.newProducts);

const sliderOptions = ref({
    type: 'carousel',
    perPage: 4,
    perMove: 1,
    gap: '2rem',
    height: '560px',
    padding: 30,
    rewind: true,
    autoplay: true,
});
    const prop = defineProps({
        customers: Object,
    });

// function handleImageError() {
//     document.getElementById('screenshot-container')?.classList.add('!hidden');
//     document.getElementById('docs-card')?.classList.add('!row-span-1');
//     document.getElementById('docs-card-content')?.classList.add('!flex-row');
//     document.getElementById('background')?.classList.add('!hidden');
// }
</script>

<template>
    <Topbar v-model:customers="prop.customers">

    </Topbar>
    <Chatbot/>
    <Banner/>
    <div class="Home font-lora">
        <BannerProduct/>
        <!-- Product Section -->
        <div class="h-body">
            <div class="h-spnb m-10">
                <div class="h-tieude pt-2 flex justify-center items-center text-3xl font-bold m-5">
                    <p class="text-3xl font-bold uppercase">Sản phẩm</p>  
                </div>
                <hr class="mt-8 mb-6">
                <div class="grid gap-6 lg:grid-cols-4 justify-center mx-10">
                    <ProductCard v-for="product in productData" :key="product.id" :product="product"         
                    class="w-full max-w-xs transition-transform transform hover:scale-105 hover:shadow-lg"/>
                </div>
                <div class="mt-8 bt-xemthem-container">
                    <a :href="route('product')" class="bt-xemthem uppercase text-lg">
                        Xem thêm
                    </a>
                </div>
            </div>
            <div class="h-spm p-10">
                <div class="h-tieude flex justify-center text-2xl font-bold m-10 py-2 bg-red-900">
                    <p class="text-white text-3xl font-bold uppercase">Nổi bật</p>
                </div>
                <div class="flex justify-center items-center m-10 bg-gray-100">
                    <splide :options="sliderOptions">
                        <splide-slide v-for="(productGallery, index) in newProducts" :key="index">
                            <a v-if="productGallery" :href="`/Public/Product/ProductItem/${productGallery.id_product_item}`">
                                <img v-if="productGallery.image" :src="`/image_productgall/${productGallery.image}`" alt="ProductImage" class="w-72 h-96 mt-20 object-cover transition-transform transform hover:scale-110 shadow-md hover:shadow-red-900">
                            </a>
                        </splide-slide>
                    </splide>
                </div> 
            </div>
        </div>

        <BannerPost/>

        <!-- News Section -->
        <div class="h-body">
            <div class="h-tintuc m-10">
                <div class="h-tieude pt-2 flex justify-center items-center text-3xl font-bold m-5">
                    <p class="text-3xl font-bold uppercase">Tin tức</p>  
                </div>
                <hr class="mt-8 mb-6">
                <div class="grid gap-6 lg:grid-cols-3 justify-center">
                <PostCard v-for="post in postData" :key="post.id" :post="post" />
                </div>
            </div>
        </div>
    </div>
    <Footer/>
</template>



<style scoped>
.group:hover {
    filter: none;
}

.bt-xemthem-container {
    display: flex;
    justify-content: center;
}

.bt-xemthem {
    padding: 0.5em 2em; /* Thiết lập padding cho nút */
    font-size: 1em; /* Thiết lập kích thước font */
    background-color: #9a0a11; /* Màu nền đỏ */
    border: 0.1em solid #9a0a11; /* Border màu đỏ */
    color: white; /* Màu chữ trắng */
    cursor: pointer;
    overflow: hidden;
    transition: color 0.5s, background-color 0.5s; /* Thêm transition cho màu và nền */
}

.bt-xemthem::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%; /* Bắt đầu với vị trí bên trái ngoài màn hình */
    width: 100%; /* Kích thước mặc định của pseudo-element */
    height: 100%;
    background-color: white; /* Màu nền trắng */
    z-index: -1;
    transition: left 0.5s; /* Thêm transition cho left */
}

.bt-xemthem:hover::before {
    left: 0; /* Khi hover, dịch chuyển pseudo-element từ trái vào trong */
}

.bt-xemthem:hover {
    color: #9a0a11; /* Khi hover, chữ chuyển sang màu đỏ */
    background-color: transparent; /* Khi hover, chuyển từ đỏ sang trong suốt */
    transform: scaleX(1); /* Bắt đầu với chiều rộng 0 */
    transform-origin: left; 
}


</style>