<script setup>
    import Sidebar from '@/Components/Admin/Sidebar.vue';
    import Pagination from '@/Components/Pagination.vue';
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import {Head, Link, useForm} from '@inertiajs/vue3';
    
    const props = defineProps({
        productgallery: Object
    });

    const form = useForm
    ({
        id_product_item: props.productgallery.id_product_item,
        image:null,
    });
    
    const submitForm = () =>
    {
        form.post(route('productgallery.update', props.productgallery.id));
    };

    const handleEvent = (e) =>
    {
        form.image = e.target.files[0];
    }

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
                            <p class="text-4xl uppercase">Danh mục hình ảnh</p>
                            <br>
                            <form @submit.prevent="submitForm" class="mx-auto font-lora bg-white border-2  border-emerald-700 rounded-lg shadow-lg p-6">
                                <div class="flex flex-row items-center justify-between ">
                                    <h1>Thông tin hình ảnh</h1>
                                    <a :href="route('productgallery.index')" class="inline-flex items-center ml-4 px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-emerald-600 hover:bg-emerald-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                                        Quay lại
                                    </a>
                                </div>
                                <hr class="my-4 border-gray-200">
                                <div class="mb-4">
                                    <label for="id_product_item" class="block text-sm font-medium text-gray-700">Mã chi tiết sản phẩm</label>
                                    <select id="id_product_item" name="id_product_item" v-model="form.id_product_item" class="mt-1 p-2 block w-full shadow-sm focus:ring-emerald-500 focus:border-emerald-500 border-gray-300 rounded-md">
                                        <option disabled value="">Chọn sản phẩm</option>
                                        <option :key="gal.id" :value="gal.id" v-for="gal in $page.props.product_items">{{ gal.id_product }}</option>
                                    </select>
                                </div>
                                <div class="col-span-1">
                                        <div class="mb-4">
                                            <label for="image" class="block text-sm font-medium text-gray-700">Hình ảnh</label>
                                            <input type="file" id="image" name="image" @change="handleEvent"
                                                class="px-2 py-4 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer text-white shadow-sm focus:outline-none focus:border-2 focus:ring-emerald-500 focus:border-emerald-500 dark:text-black dark:placeholder-gray-400">
                                        </div>
                                        <img :src="'/image_productgall/'+ props.productgallery.image" class="w-64 h-64 border-2 border-emerald-700 rounded-xl shadow-lg">
                                    </div>
                                <div class="mt-8 flex justify-center col-span-2">
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