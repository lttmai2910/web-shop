<script setup>
import Sidebar from '@/Components/Admin/Sidebar.vue';
import Pagination from '@/Components/Pagination.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';

defineProps({
    products: Object,
    productItems: Array,
    categories: Array,
});

const { props } = usePage();
const productItems = ref(props.productItems);
const showAllSelected = ref(false);
const showDialogMissingDetails = ref(false);
const showDialogDetailsExist = ref(false);

function hasProductItem(productId) {
    return productItems.value.some(item => item.id_product === productId);
}

const form = useForm({});

function destroy(id) {
    if (confirm("Bạn có chắc là muốn xóa nó chứ")) {
        form.delete(route('product.destroy', id));
    }
}

function create() {
    form.get(route('product.create'));
}

function showAllProducts() {
    location.href = route('product.index');
}

function selectCategory() {
    showAllSelected.value = false;
}

function handleAddSize(productId) {
    if (!hasProductItem(productId)) {
        showDialogMissingDetails.value = true;
    } else {
        location.href = route('productsize.create', { id: productId });
    }
}

function handleAddDetails(productId) {
    if (hasProductItem(productId)) {
        showDialogDetailsExist.value = true;
    } else {
        location.href = route('productitem.create', productId);
    }
}

const showDialogMissingDetailsView = ref(false);

function handleViewDetails(productId) {
    if (!hasProductItem(productId)) {
        showDialogMissingDetailsView.value = true;
    } else {
        location.href = route('product.show', productId);
    }
}

</script>
<template>
    <AuthenticatedLayout>
        <Sidebar />
        <div class="bg-gray-200 p-4 sm:ml-64">
      <div class="flex items-center justify-center">
            <div class="flex flex-col overflow-hidden">
                <main class="flex-1 overflow-x-hidden overflow-y-auto">
                        <div class="relative flex flex-col md:flex-row w-auto font-lora">
                            <div class="h-auto p-8">
                                <p class="text-4xl uppercase">Sản phẩm</p>
                                <br>
                                <div class="flex justify-between items-center">
                                    <button @click="create" class="inline-flex items-center px-4 py-4 border border-transparent text-sm font-medium rounded-md text-white bg-emerald-600 hover:bg-emerald-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                                        Thêm sản phẩm
                                    </button>
                                </div>
                                <br>
                                <!-- <form action="/Admin/Product/Search" method="GET" class="flex-grow ml-56">   
                                    <label for="default-search" class="mb-2 text-sm font-medium sr-only">Search</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                            </svg>
                                        </div>
                                        <input name="search" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-white focus:ring-slate-500 focus:border-red-500 dark:border-red-600 dark:placeholder-gray-400 dark:focus:ring-red-500 dark:focus:border-red-500" placeholder="Tìm kiếm..." required />
                                        <button type="submit" class="absolute end-2.5 bottom-2.5 px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-red-500 hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">Search</button>
                                    </div>
                                </form> -->
                                <div class="text-center">
                                    <p class="text-3xl font-semibold italic mb-4">Phân loại theo danh mục</p>
                                    <ul class="flex flex-wrap justify-center space-x-4">
                                        <li>
                                            <a href="#" @click="showAllProducts" :class="{ 'selected': showAllSelected }" class="inline-block px-4 py-2 border border-emerald-600 text-white bg-emerald-600 hover:bg-emerald-700 hover:text-white rounded-md">
                                                Tất cả
                                            </a>
                                        </li>
                                        <li v-for="category in categories" :key="category.id" class="mb-2">
                                            <a :href="route('product.index', { category: category.id })" @click="selectCategory" :class="{ 'selected': !showAllSelected }" class="inline-block px-4 py-2 border border-emerald-600 text-white bg-emerald-600 hover:bg-emerald-700 hover:text-white rounded-md">
                                                {{ category.category_name }}
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <br>
                                <div class="table-container relative overflow-x-auto rounded-lg">
                                    <table class="w-full text-sm text-left rtl:text-right">
                                        <thead class="text-xs text-white uppercase bg-emerald-700 dark:bg-emerald-700">
                                            <tr>
                                                <th scope="col" class="px-6 py-3 sm:px-1 text-center w-36">Mã sản phẩm</th>
                                                <th scope="col" class="px-6 py-3 sm:px-1 text-center w-36">Mã danh mục</th>
                                                <th scope="col" class="px-6 py-3 sm:px-1 text-center w-48">Tên sản phẩm</th>
                                                <th scope="col" class="px-6 py-3 sm:px-1 text-center w-64">Mô tả</th>
                                                <th scope="col" class="px-6 py-3 sm:px-1 text-center w-32">Trạng thái</th>
                                                <th scope="col" class="px-6 py-3 sm:px-1 text-center W-40">Chức năng</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <template v-if="products && products.data && products.data.length > 0">
                                                <tr v-for="(prod, index) in products.data" :key="index" class="bg-slate-50 border-b border-gray-300 hover:bg-gray-100 cursor-pointer">
                                                    <td class="py-4 px-4 sm:px-3 text-center">{{ prod.id }}</td>
                                                    <td class="py-4 px-4 sm:px-3 text-center">{{ prod.id_product_category }}</td>
                                                    <td class="py-4 px-4 sm:px-3 text-center">{{ prod.product_name }}</td>
                                                    <td class="py-4 px-4 sm:px-3 text-center">{{ prod.description }}</td>
                                                    <td class="px-4 py-1 sm:px-3 text-center">
                                                        <p class="px-4 py-2 text-xs font-semibold rounded-full" :class="{'text-green-500 bg-green-200': prod.status === 1, 'text-red-500 bg-red-300': prod.status === 0}">
                                                            {{ prod.status === 1 ? 'Đăng' : 'Ẩn' }}
                                                        </p>                              
                                                    </td>
                                                    <template v-if="productItems && productItems.length > 0">
                                                        <td class="flex justify-center items-center py-6 px-4 sm:px-6 text-center">
                                                            <a @click="handleViewDetails(prod.id)" :class="{ 'hover:bg-emerald-800': hasProductItem(prod.id) }" 
                                                            class="flex items-center justify-center w-24 px-2 py-2 bg-emerald-600 text-white rounded-lg">
                                                                Xem chi tiết
                                                            </a>
                                                            <a @click="handleAddDetails(prod.id)" :class="{ 'hover:bg-emerald-800': hasProductItem(prod.id) }"
                                                            class="flex items-center justify-center w-24 ml-4 px-2 py-2 bg-emerald-600 text-white rounded-lg" :disabled="hasProductItem(prod.id)">
                                                                Thêm chi tiết
                                                            </a>
                                                            <a @click="handleAddSize(prod.id)" :class="{ 'hover:bg-emerald-800': hasProductItem(prod.id) }"
                                                            class="flex items-center justify-center w-24 ml-4 px-2 py-2 bg-emerald-600 text-white rounded-lg" :disabled="!hasProductItem(prod.id)">
                                                                Thêm size
                                                            </a>
                                                            <a @click="destroy(prod.id)" class="flex items-center justify-center ml-4 w-8 h-8">
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 hover:text-emerald-600">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                                </svg>
                                                            </a>  
                                                            <a :href="route('product.edit', prod.id)" class="flex items-center justify-center mr-2 w-8 h-8">
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 hover:text-emerald-600">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                                                </svg>
                                                            </a>                    
                                                        </td>
                                                    </template>
                                                </tr>
                                            </template>
                                        </tbody>
                                    </table>
                                    <div class="flex justify-center">
                                        <Pagination :links="products.links" colorScheme="admin" v-if="products && products.links" />
                                    </div>               
                                </div>
                            </div>
                        </div>
                    </main>
                </div>
            </div>
        </div>
        <!-- Dialog for Missing Details for View -->
        <div v-if="showDialogMissingDetailsView" class="fixed inset-0 z-50 flex items-center justify-center font-lora">
            <div class="flex items-center justify-center min-h-screen px-4">
                <div class="fixed inset-0 bg-black opacity-50"></div>
                <div class="fixed inset-0 flex items-center justify-center">
                <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all max-w-lg w-full p-6">
                    <div class="text-center">
                        <h2 class="text-xl font-semibold mb-4 text-center text-emerald-600">Thông báo</h2>
                        <div class="mt-2">
                            <p class="text-center">Vui lòng thêm chi tiết sản phẩm trước khi xem chi tiết !</p>
                        </div>
                    </div>
                    <div class="mt-4 flex justify-center">
                        <button @click="showDialogMissingDetailsView = false" class="inline-flex justify-center px-8 py-2 text-sm font-medium text-white bg-emerald-600 border border-transparent rounded-md hover:bg-emerald-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                            Đóng
                        </button>
                    </div>
                </div>
                </div>
            </div>
        </div>

        <!-- Dialog for Missing Details -->
        <div v-if="showDialogMissingDetails" class="fixed inset-0 z-50 flex items-center justify-center font-lora">
            <div class="flex items-center justify-center min-h-screen px-4">
                <div class="fixed inset-0 bg-black opacity-50"></div>
                <div class="fixed inset-0 flex items-center justify-center">
                    <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all max-w-lg w-full p-6">
                        <div class="text-center">
                            <h2 class="text-xl font-semibold mb-4 text-center text-emerald-600">Thông báo</h2>
                            <div class="mt-2">
                            <p class="text-center">Vui lòng thêm chi tiết sản phẩm trước khi thêm size !</p>
                        </div>
                    </div>
                    <div class="mt-4 flex justify-center">
                        <button @click="showDialogMissingDetails = false" class="inline-flex justify-center px-8 py-2 text-sm font-medium text-white bg-emerald-600 border border-transparent rounded-md hover:bg-emerald-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                            Đóng
                        </button>
                    </div>
                </div>
                </div>
            </div>
        </div>

        <!-- Dialog for Details Exist -->
        <div v-if="showDialogDetailsExist" class="fixed inset-0 z-50 flex items-center justify-center">
            <div class="flex items-center justify-center min-h-screen px-4 font-lora">
                <div class="fixed inset-0 bg-black opacity-50"></div>
                <div class="fixed inset-0 flex items-center justify-center">
                    <div class="bg-white p-6 rounded-lg shadow-lg w-96">
                        <div class="text-center">
                        <h2 class="text-xl font-semibold mb-4 text-center text-emerald-600">Thông báo</h2>
                        <div class="mt-2">
                            <p class="text-center">Chi tiết sản phẩm này đã tồn tại.</p>
                        </div>
                    </div>
                    <div class="mt-4 flex justify-center">
                        <button @click="showDialogDetailsExist = false" class="inline-flex justify-center px-8 py-2 text-sm font-medium text-white bg-emerald-600 border border-transparent rounded-md hover:bg-emerald-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                            Đóng
                        </button>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </AuthenticatedLayout>
</template>
<style scoped>
.table-container {
    width: 77cqi;
}

</style>
