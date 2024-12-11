<script setup>
    import Sidebar from '@/Components/Admin/Sidebar.vue';
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import { useForm } from '@inertiajs/vue3';
    import { ref } from 'vue';

    const form = useForm({
        id_product_item: '',
        image: null,
    });

    const showDialog = ref(false);
    const errorMessage = ref('');

    const submitForm = () => {
        // Check if image is not selected
        if (!form.image) {
            showDialog.value = true;
            errorMessage.value = 'Vui lòng chọn hình ảnh để tải lên !';
            return;
        }

        errorMessage.value = '';
        showDialog.value = false;

        form.post(route('productgallery.store'))
    };

    const handleEvent = (e) => {
        form.image = e.target.files[0];
    };

    const closeDialog = () => {
        showDialog.value = false;
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
                                <p class="text-4xl uppercase">Danh mục hình ảnh</p>
                                <br>
                                <form @submit.prevent="submitForm" method="post" enctype="multipart/form-data" class="flex-col justify-center items-center mx-auto font-lora bg-white border-2 border-emerald-700 rounded-lg shadow-lg p-6">
                                    <div class="flex flex-row items-center justify-between">
                                        <h1>Thêm hình ảnh</h1>
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
                                            <input type="file" id="image" name="image" @change="handleEvent"     class="px-2 py-4 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer shadow-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 dark:text-black dark:placeholder-gray-400">
                                        </div>
                                    </div>
                                    <div class="mt-8 flex justify-center col-span-2">
                                        <button type="submit" class="inline-flex items-center px-10 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-emerald-600 hover:bg-emerald-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                                            Thêm mới
                                        </button>
                                    </div>
                                </form>
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
                            </div>
                        </div>
                    </main>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
