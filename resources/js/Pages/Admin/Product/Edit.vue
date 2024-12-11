<script setup>
    import Sidebar from '@/Components/Admin/Sidebar.vue';
    import Pagination from '@/Components/Pagination.vue';
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import {Head, Link, useForm} from '@inertiajs/vue3';
    
    const props = defineProps({
        product: Object
    });

    const form = useForm
    ({
        id_product_category: props.product.id_product_category,
        product_name: props.product.product_name,
        description: props.product.description,
        status: props.product.status,
    });
    
    const submitForm = () =>
    {
        form.post(route('product.update', props.product.id));
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
                            <p class="text-4xl uppercase">Sản phẩm</p>
                            <br>
                            <form @submit.prevent="submitForm" class="mx-auto font-lora bg-white border-2  border-emerald-700 rounded-lg shadow-lg p-6">
                                <div class="flex flex-row items-center justify-between ">
                                    <h1>Thông tin danh mục sản phẩm - {{ form.product_name }}</h1>
                                    <a :href="route('product.index')" class="inline-flex items-center ml-4 px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-emerald-600 hover:bg-emerald-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                                        Quay lại
                                    </a>
                                </div>
                                <hr class="my-4 border-gray-200">
                                <div class="mb-4">
                                    <label for="id_product_category" class="block text-sm font-medium text-gray-700">Mã danh mục</label>
                                    <select id="id_product_category" name="id_product_category" v-model="form.id_product_category" class="mt-1 p-2 block w-full shadow-sm focus:ring-emerald-500 focus:border-emerald-500 border-gray-300 rounded-md">
                                            <option disabled value="">Chọn danh mục sản phẩm</option>
                                            <option :key="category.id" :value="category.id" 
                                            v-for="category in $page.props.product_categories">{{ category.category_name }}</option>
                                    </select>                    
                                </div>
                                <div class="mb-4">
                                    <label for="product_name" class="block text-sm font-medium text-gray-700">Tên sản phẩm</label>
                                    <input type="text"  id="product_name" name="product_name" v-model="form.product_name" class="mt-1 p-2 block w-full shadow-sm focus:ring-emerald-500 focus:border-emerald-500 border-gray-300 rounded-md">
                                </div>
                                <div class="mb-4">
                                    <label for="description" class="block text-sm font-medium text-gray-700">Mô tả</label>
                                    <textarea type="text" id="description" name="description" v-model="form.description" class="mt-1 p-2 block w-full shadow-sm focus:ring-emerald-500 focus:border-emerald-500 border-gray-300 rounded-md">
                                    </textarea>
                                </div>
                                <div class="mb-4">
                                    <label for="status" class="block text-sm font-medium text-gray-700">Trạng thái</label>
                                    <div class="mt-2">
                                        <label for="status_active" class="inline-flex items-center mr-4">
                                            <input type="radio" id="status_active" name="status" value="1" v-model="form.status" class="h-4 w-4 text-emerald-500 border-gray-300 focus:ring-emerald-400">
                                            <span class="ml-2 px-8 py-2 border border-green-200 rounded-lg bg-green-200 text-green-500">Đăng</span>
                                        </label>
                                        <label for="status_inactive" class="inline-flex items-center">
                                            <input type="radio" id="status_inactive" name="status" value="0" v-model="form.status" class="h-4 w-4 text-red-500 border-gray-300 focus:ring-red-400">
                                            <span class="ml-2 px-8 py-2 border border-red-300 rounded-lg bg-red-300 text-red-500">Ẩn</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="mt-4 flex justify-center col-span-2">
                                    <button type="submit" class="inline-flex items-center px-10 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-emerald-600 hover:bg-emerald-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                                        Cập nhật
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