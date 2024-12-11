<script setup>
import { defineProps } from 'vue';
import { usePage } from '@inertiajs/vue3';

const props = defineProps({
  product: Object,
});

const { props: pageProps } = usePage();

const getProductGalleryImage = (productId) => {
  const productGallery = pageProps.productGalleries.find(gallery => gallery.id_product_item === productId);
  return productGallery ? productGallery.image : 'default_image.png';
};

const getPrice = (productId) => {
  const productItem = pageProps.productItems.find(item => item.id_product === productId);
  return productItem ? productItem.price : '';
};

const getDiscountPrice = (productId) => {
  const productItem = pageProps.productItems.find(item => item.id_product === productId);
  return productItem ? productItem.discount_price : '';
};
</script>

<template>
  <div v-if="product && product.id" class="flex justify-center items-center  border ">
    <a
      :href="`/Public/Product/ProductItem/${product.id}`"
      class="flex flex-col self-center overflow-hidden bg-white"
    >
      <div class="relative overflow-hidden">
        <img
          :src="'/image_productgall/' + getProductGalleryImage(product.id)"
          class="mt-4 h-96 w-72 object-cover transition-transform duration-300"
        />
      </div>
      <div class="flex flex-col justify-between bg-white">
        <h5 class="text-lg tracking-tight text-gray-800 font-semibold">
          {{ product.product_name }}
        </h5>
        <div class="mt-2 mb-5 flex items-center">
          <p class="text-lg font-bold text-red-500">
            {{ getDiscountPrice(product.id) }},000đ
          </p>
          <p class="text-lg text-gray-500 line-through ml-2">
            {{ getPrice(product.id) }},000đ
          </p>
        </div>
      </div>
    </a>
  </div>
  <div v-else class="flex justify-center items-center w-72 h-96">
    Loading...
  </div>
</template>
