<script setup>
import Topbar from '@/Components/Public/Topbar.vue';
import Footer from '@/Components/Public/Footer.vue';
import Pagination from '@/Components/Pagination.vue';
import { useForm, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';

    defineProps({
        products: Object,
        productItems: Array,
        productGalleries: Object,
        categories: Array,
        categoryName: Object,
    });

    const { productGalleries } = usePage().props;
    const showAllSelected = ref(true);
    const selectedCategoryName = ref('Sản phẩm');

    const getProductGalleryImage = (productId) => {
        const productGallery = productGalleries.find(gallery => gallery.id_product_item === productId);
        return productGallery ? productGallery.image : 'default_image.png';
    };

    const form = useForm({});

    function showAllProducts() {
        location.href = route('product');
    }

</script>

<template>
    <div class="page-container">
    <Topbar />
    <div class="content-container">
        <div class="font-lora m-5">
            <div class="post font-lora mx-auto px-4">
                <div class="flex justify-center mb-4">
                    <div class="ab w-full h-10 flex items-center space-x-2">
                        <a href="/" class="text-lg flex flex-row items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 ml-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12L11.204 3.045c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                            </svg>
                            <span class="ml-2">Trang chủ</span>
                        </a>
                        <span class="mx-2">|</span>
                        <a :href="route('product')" class="text-lg">Danh mục</a>
                        <span class="mx-2">|</span>
                        <p v-for="categoryNames in categoryName" :key="categoryNames.id" class="text-lg">
                            {{ categoryNames.category_name }}
                        </p>
                        <p v-if="categoryName.length == 0" class="text-lg"> Sản phẩm </p>
                    </div>
                </div>

                <hr class="mt-4 mb-4 hidden sm:block">

                <div class="text-center">
                    <p class="text-3xl font-semibold italic mb-4">Phân loại theo danh mục</p>
                    <ul class="flex flex-wrap justify-center space-x-4">
                        <li>
                            <a :href="route('product')" @click="showAllProducts" :class="{ 'selected': showAllSelected }" class="inline-block px-4 py-2 border border-red-600 text-white bg-red-600 hover:bg-red-700 hover:text-white rounded-md">
                                Tất cả
                            </a>
                        </li>
                        <li v-for="category in categories" :key="category.id" class="mb-2">
                            <a :href="route('product', { category: category.id })" @click="selectCategory(category.id, category.category_name)" :class="{ 'selected': !showAllSelected }" class="inline-block px-4 py-2 border border-red-600 text-white bg-red-600 hover:bg-red-700 hover:text-white rounded-md">
                                {{ category.category_name }}
                            </a>
                        </li>

                    </ul>
                </div>

                <hr class="mt-4 mb-6">
               
                <div class="flex justify-center items-center mb-8">
                    <div class="border-t border-black w-32 mr-2"></div>
                    <p v-for="categoryNames in categoryName" :key="categoryNames.id" class="text-3xl font-bold uppercase">
                        {{ categoryNames.category_name }}
                    </p>
                    <p v-if="categoryName.length == 0" class="text-3xl font-bold uppercase">Sản phẩm</p>
                    <div class="border-t border-black w-32 ml-2"></div>
                </div>
                
                <div class="flex justify-center items-center flex-col">
                    <div v-if="products && products.data.length > 0" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        <div v-for="(product, index) in products.data" :key="index" class="w-72 bg-white shadow-lg rounded-lg overflow-hidden transform transition-transform hover:-translate-y-2 hover:shadow-2xl">
                            <a :href="route('productitem', { id: product.id })">
                                <div class="p-img w-full h-80 aspect-w-1 aspect-h-1 flex justify-center items-center">
                                    <img :src="'/image_productgall/' + getProductGalleryImage(product.id)" class=" p-4 shadow object-cover rounded-t-lg">
                                </div>
                                <div class="p-4 mb-2">
                                    <h3 class="text-gray-900 font-semibold text-xl mb-2">{{ product.product_name }}</h3>
                                    <div class="mt-4 flex items-center">
                                        <p v-if="getDiscountPrice(product.id)" class="text-red-500 text-lg">{{ getDiscountPrice(product.id) }},000đ</p>
                                        <p v-else class="text-gray-900 text-lg">{{ getPrice(product.id) }},000đ</p>
                                        <p v-if="getDiscountPrice(product.id)" class="text-gray-500 line-through text-lg ml-4">{{ getPrice(product.id) }},000đ</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <Pagination :links="products.links" v-if="products && products.links" class="flex justify-center" />
                </div>
            </div>
        </div>
        </div>
        <Footer />
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
  
.p-img {
    position: relative;
    width: 100%;
    padding-top: 75%; 
    overflow: hidden;
}

.p-img img {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.p-6 {
    padding: 1.5rem;
}

.text-gray-900 {
    color: #1a202c;
}

.text-red-500 {
    color: #f56565;
}

.text-gray-400 {
    color: #cbd5e0;
}

.font-semibold {
    font-weight: 600;
}

.font-bold {
    font-weight: 700;
}

.uppercase {
    text-transform: uppercase;
}

.bg-white {
    background-color: #ffffff;
}

.rounded-lg {
    border-radius: 0.5rem;
}

.shadow-lg {
    box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
}

.shadow-2xl {
    box-shadow: 0 20px 25px rgba(0, 0, 0, 0.15);
}

.overflow-hidden {
    overflow: hidden;
}

.transition-transform {
    transition: transform 0.3s;
}

.hover\\:-translate-y-2:hover {
    transform: translateY(-0.5rem);
}

.hover\\:shadow-2xl:hover {
    box-shadow: 0 20px 25px rgba(0, 0, 0, 0.15);
}
</style>


<script>
export default {
    methods: {
        getPrice(productId) {
            const productItem = this.productItems.find(item => item.id_product === productId);
            return productItem ? productItem.price : '';
        },
        getDiscountPrice(productId) {
            const productItem = this.productItems.find(item => item.id_product === productId);
            return productItem ? productItem.discount_price : '';
        },
    }
};
</script>