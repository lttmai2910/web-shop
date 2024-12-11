<script setup>
  import { defineProps } from 'vue';
  import Topbar from '@/Components/Public/Topbar.vue';
  import Footer from '@/Components/Public/Footer.vue';
  import { usePage } from '@inertiajs/vue3';

  const props = defineProps({
    products: Object,
    productItems: Array,
    productGalleries: Object,
    search: String,
  });

  const { search, productItems } = props; 
  const { productGalleries } = usePage().props;

  const getDiscountPrice = (productId) => {
    const productItem = productItems.find(item => item.id_product === productId);
    return productItem ? productItem.discount_price : '';
  };

  const getPrice = (productId) => {
    const productItem = productItems.find(item => item.id_product === productId);
    return productItem ? productItem.price : '';
  };

  const getProductGalleryImage = (productId) => {
    const productGallery = productGalleries.find(gallery => gallery.id_product_item === productId);
    return productGallery ? productGallery.image : 'default_image.png';
  };
</script>

<template>
    <div class="page-container">
      <Topbar />
      <div class="content-container">
        <div class="container mx-auto font-lora">
          <div class="flex flex-col items-center mt-8">
            <h1 class="text-3xl font-bold uppercase">Tìm kiếm</h1>
            <p v-if="products && products.data.length > 0" class="mt-6 text-lg">Có {{ products.data.length }} sản phẩm cho tìm kiếm</p>
            <div class="border-t border-black border-solid border-2 w-16 mt-10"></div>
          </div>
  
          <h1 v-if="products && products.data.length > 0" class="text-lg my-8">Kết quả tìm kiếm cho "<strong>{{ search }}</strong>".</h1>
  
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
                    <p v-if="getDiscountPrice(product.id)" class="text-gray-500 line-through text-lg ml-2">{{ getPrice(product.id) }},000đ</p>
                  </div>
                </div>
              </a>
            </div>
          </div>
          <div v-else>
          <!-- Hiển thị khi không tìm thấy dữ liệu -->
          <h1 class="flex justify-center text-2xl font-bold mt-8">Không tìm thấy nội dung bạn yêu cầu</h1>
          <p class="flex justify-center text-lg text-gray-600 mt-8">Không tìm thấy "{{ search }}". Vui lòng kiểm tra chính tả, sử dụng các từ tổng quát hơn và thử lại!</p>
          
          <!-- Thanh tìm kiếm với giá trị search trước đó -->
          <div class="bg-white w-full max-w-3xl mx-auto mt-8">
            <form action="/Public/Search" method="GET" class="relative flex items-center">
                <input type="text" name="search" v-model="search"
                    class="bg-gray-100 block w-full p-4 pl-10 pr-12 text-lg text-gray-900 border border-gray-200 rounded-lg focus:ring-red-500 focus:border-red-500"
                    placeholder="Tìm kiếm sản phẩm..." required />
                <button type="submit" class="absolute inset-y-0 right-0 flex items-center justify-center w-12 bg-red-400 hover:bg-red-500 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm text-white dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-800">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>
                </button>
            </form>
          </div>
        </div>
        <Pagination :links="products.links" v-if="products && products.links" class="flex justify-center mt-8" />
      </div>
      </div>
      <Footer />
    </div>
  </template>
  
  
  
  

  <style scoped>
  .page-container {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
  }
  
  .content-container {
    flex: 1;
  }
  
  /* Styling for the product card */
  .p-img {
    position: relative;
    width: 100%;
    padding-top: 75%; /* 4:3 Aspect Ratio */
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
  