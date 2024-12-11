<script setup>
    import Sidebar from '@/Components/Admin/Sidebar.vue';
    import Pagination from '@/Components/Pagination.vue';
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import {Head, Link, useForm} from '@inertiajs/vue3';
    import { ref } from 'vue';

    const form = useForm
    ({
        size:'',
    });
    
    const showDialog = ref(false);
    const errorMessage = ref('');

    const submitForm = () => {
        if (!form.size) {
            errorMessage.value = 'Vui lòng nhập tên size !';
            showDialog.value = true; // Hiển thị dialog nếu không nhập đủ thông tin
            return; // Ngăn chặn việc submit form
        }

        // Reset error message and close dialog if all fields are filled
        errorMessage.value = '';
        showDialog.value = false;
        form.post(route('size.store'));
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
                            <p class="text-4xl uppercase">Bảng size</p>
                            <br>
                            <form @submit.prevent="submitForm" method="post" enctype="multipart/form-data" class="flex-col justify-center items-center mx-auto font-lora bg-white border-2 border-emerald-700 rounded-lg shadow-lg p-6">
                                <div class="flex flex-row items-center justify-between ">
                                    <h1>Thêm size mới</h1>
                                    <a :href="route('size.index')" class="inline-flex items-center ml-4 px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-emerald-600 hover:bg-emerald-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                                        Quay lại
                                    </a>
                                </div>
                                <hr class="my-4 border-gray-200">
                                <div class="mb-4">
                                    <label for="size" class="block text-sm font-medium text-gray-700">Tên kích cỡ</label>
                                    <input type="text" id="size" name="size" v-model="form.size" class="mt-1 p-2 block w-full shadow-sm focus:ring-emerald-500 focus:border-emerald-500 border-gray-300 rounded-md">
                                </div>
                                <div class="mt-8 flex justify-center">
                                    <button type="submit" class="inline-flex items-center px-10 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-emerald-600 hover:bg-emerald-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                                        Thêm mới
                                    </button>
                                </div>
                                <!-- Dialog modal -->
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
                            </form>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>
    </AuthenticatedLayout>
</template>