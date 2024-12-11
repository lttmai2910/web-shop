<script setup>
    import Sidebar from '@/Components/Admin/Sidebar.vue';
    import Pagination from '@/Components/Pagination.vue';
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import {Head, Link, useForm, usePage} from '@inertiajs/vue3';
    
    const props = defineProps({
        id_product: Number,
        sizes: Array,
    });

    const form = useForm({
        id_product: props.id_product,
        id_color: '',
        price: '',
        discount_price: '',
        id_size: '',
    });
    
    const submitForm = () => {
        form.post(route('productitem.store'));
    };

</script>

<template>
    <AuthenticatedLayout>
        <Sidebar/>
        <div class="bg-gray-200 p-4 sm:ml-64">
        <div class="flex items-center justify-center">
            <div class="flex flex-col overflow-hidden w-full">
                <main class="flex-1 overflow-x-hidden overflow-y-auto">
                    <div class="w-auto font-lora">
                        <div class="h-auto p-8">
                            <p class="text-4xl uppercase">Chi tiết sản phẩm</p>
                            <br>
                            <form @submit.prevent="submitForm" class="mx-auto font-lora bg-white border-2  border-emerald-700 rounded-lg shadow-lg p-6">
                                <div class="flex flex-row items-center justify-between ">
                                    <h1>Thêm chi tiết sản phẩm</h1>
                                    <a :href="route('product.index')" class="inline-flex items-center ml-4 px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-emerald-600 hover:bg-emerald-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                                        Quay lại
                                    </a>
                                </div>
                                <hr class="my-4 border-gray-200">
                                <div class="mb-4">
                                    <label for="id_color" class="text-base text-gray-600">Màu sắc:</label>
                                    <select id="id_color" name="id_color" v-model="form.id_color" class="mt-1 p-2 block w-full shadow-sm focus:ring-emerald-500 focus:border-emerald-500 border-gray-300 rounded-md">
                                        <option disabled value="">Chọn màu sắc</option>
                                        <option :key="col.id" :value="col.id" :selected="col.id === form.id_color" v-for="col in $page.props.product_colors">{{ col.color_name }}</option>
                                    </select>
                                </div>
                                <div class="mb-4">
                                    <label for="id_size" class="text-base text-gray-600">Kích thước:</label>
                                    <select id="id_size" name="id_size" v-model="form.id_size" class="mt-1 p-2 block w-full shadow-sm focus:ring-emerald-500 focus:border-emerald-500 border-gray-300 rounded-md">
                                        <option disabled value="">Chọn kích thước</option>
                                        <option :key="size.id" :value="size.id" :selected="size.id === form.id_size" v-for="size in $page.props.sizes">{{ size.size }}</option>
                                    </select>
                                </div>
                                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                                    <div class="mb-4">
                                        <label for="price" class="text-base text-gray-600">Giá:</label>
                                        <input type="text" id="price" v-model="form.price" class="mt-1 focus:ring-emerald-500 focus:border-emerald-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    </div>
                                    <div class="mb-4">
                                        <label for="discount_price" class="text-base text-gray-600">Giá giảm:</label>
                                        <input type="text" id="discount_price" v-model="form.discount_price" class="mt-1 focus:ring-emerald-500 focus:border-emerald-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    </div>
                                </div>
                                <div class="mt-8 flex justify-center">
                                    <button type="submit" class="inline-flex items-center px-10 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-emerald-600 hover:bg-emerald-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                                        Thêm chi tiết sản phẩm
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
