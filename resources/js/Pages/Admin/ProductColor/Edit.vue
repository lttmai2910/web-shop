<script setup>
    import Sidebar from '@/Components/Admin/Sidebar.vue';
    import Pagination from '@/Components/Pagination.vue';
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import {Head, Link, useForm} from '@inertiajs/vue3';
    
    const props = defineProps({
        productcolor: Object
    });

    const form = useForm
    ({
        color_name: props.productcolor.color_name,
    });
    
    const submitForm = () =>
    {
        form.post(route('productcolor.update', props.productcolor.id));
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
                            <p class="text-4xl uppercase">Bảng màu</p>
                            <br>
                            <form @submit.prevent="submitForm" class="mx-auto font-lora bg-white border-2  border-emerald-700 rounded-lg shadow-lg p-6">
                                <div class="flex flex-row items-center justify-between ">
                                    <h1>Thông tin màu sắc</h1>
                                    <a :href="route('productcolor.index')" class="inline-flex items-center ml-4 px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-emerald-600 hover:bg-emerald-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                                        Quay lại
                                    </a>
                                </div>
                                <hr class="my-4 border-gray-200">
                                <div class="mb-4">
                                    <label for="color_name" class="block text-sm font-medium text-gray-700">Tên màu</label>
                                    <input type="text" id="color_name" name="color_name" v-model="form.color_name" class="mt-1 p-2 block w-full shadow-sm focus:ring-emerald-500 focus:border-emerald-500 border-gray-300 rounded-md">
                                </div>
                                <div class="mt-8 flex justify-center">
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