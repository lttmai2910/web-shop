<script setup>
import { ref, computed } from 'vue';
import Sidebar from '@/Components/Admin/Sidebar.vue';
import Pagination from '@/Components/Pagination.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';
const props = defineProps({
    productItem: Object,
    sizes: Array,
    productSize: Object,
    productItemSizes: Array
});

const form = useForm({
    id_product_item: props.productItem.id,
    id_size: '',
});

const availableSizes = computed(() => {
    return props.sizes.filter(size => !props.productItemSizes.includes(size.id));
});

const errorMessage = ref('');
const showDialog = ref(false);

const submitForm = () => {
    if (!form.id_size) {
        errorMessage.value = 'Vui lòng chọn kích thước !';
        showDialog.value = true; 
        return;
    }

    errorMessage.value = '';
    showDialog.value = false;

    form.post(route('productsize.store'), {
      onError: (errors) => {
            if (errors.id_size) {
                errorMessage.value = 'Size này đã được thêm vào sản phẩm.';
                showDialog.value = true;
            }
        }
    });
};
</script>

<template>
    <AuthenticatedLayout>
      <Sidebar />
      <div class="bg-gray-200 p-4 sm:ml-64">
        <div class="flex items-center justify-center">
          <div class="flex flex-col overflow-hidden w-full">
            <main class="flex-1 overflow-x-hidden overflow-y-auto">
              <div class="w-auto font-lora">
                <div class="h-auto p-8">
                  <p class="text-4xl uppercase">Sản phẩm</p>
                  <br />
                  <form @submit.prevent="submitForm" class="mx-auto font-lora bg-white border-2 border-emerald-700 rounded-lg shadow-lg p-6">
                    <div class="flex flex-row items-center justify-between">
                      <h1>Thêm size</h1>
                      <a :href="route('product.index')" class="inline-flex items-center ml-4 px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-emerald-600 hover:bg-emerald-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                        Quay lại
                      </a>
                    </div>
                    
                    <hr class="my-4 border-gray-200">
                    
                    <div class="mb-4">
                      <p class="block text-lg font-bold text-gray-700">Mã chi tiết sản phẩm: {{ form.id_product_item }}</p>
                    </div>
                    
                    <hr class="my-4 border-gray-200">

                    <div class="mb-4">
                      <label for="id_size" class="text-base text-gray-600">Kích thước:</label>
                      <select id="id_size" name="id_size" v-model="form.id_size" class="mt-1 p-2 block w-full shadow-sm focus:ring-emerald-500 focus:border-emerald-500 border-gray-300 rounded-md">
                        <option disabled value="">Chọn kích thước</option>
                        <option :key="size.id" :value="size.id" v-for="size in availableSizes">{{ size.size }}</option>
                      </select>
                    </div>
  
                    <div class="mb-4">
                      <label for="id_size" class="text-base text-gray-600">Kích cỡ:</label>
                      <div class="flex flex-wrap mt-2">
                        <template v-if="productItemSizes.length > 0">
                          <div v-for="sizeId in productItemSizes" :key="sizeId" class="mr-4 mb-2">
                            <span class="bg-gray-200 px-3 py-2 rounded-lg text-sm">{{ sizes.find(size => size.id === sizeId).size }}</span>
                          </div>
                        </template>
                        <template v-else>
                          <p class="text-gray-500">Không có kích cỡ nào được chọn cho sản phẩm này.</p>
                        </template>
                      </div>
                    </div>
  
                      <!-- Dialog để hiển thị thông báo lỗi -->
        <dialog v-if="showDialog" class="fixed inset-0 z-50 flex items-center justify-center">
            <div class="fixed inset-0 bg-black opacity-50"></div>
            <div class="fixed inset-0 flex items-center justify-center">
                <div class="bg-white p-6 rounded-lg shadow-lg w-96">
                    <h2 class="text-xl font-semibold mb-4 text-center text-emerald-600">Thông báo</h2>
                    <p class="text-center">{{ errorMessage }}</p>
                    <div class="mt-4 flex justify-center">
                        <button @click="showDialog = false" class="inline-flex items-center px-8 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-emerald-600 hover:bg-emerald-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                            Đóng
                        </button>
                    </div>
                </div>
            </div>
        </dialog>
                    
                    <div class="mt-8 flex justify-center col-span-2">
                      <button type="submit" class="inline-flex items-center px-10 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-emerald-600 hover:bg-emerald-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                        Thêm mới
                      </button>
                    </div>
                  </form>
                </div>
              </div>
            </main>
          </div>
        </div>
      </div>
    </AuthenticatedLayout>
  </template>
  