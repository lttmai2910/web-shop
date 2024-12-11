<script setup>
    import Sidebar from '@/Components/Admin/Sidebar.vue';
    import Pagination from '@/Components/Pagination.vue';
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import {Head, Link, useForm} from '@inertiajs/vue3';
    import { ref } from 'vue';

    const form = useForm
    ({
        id_user:'',
        title:'',
        body:'',
        image:null,
        status:'',
    });
    
    const errorMessage = ref('');
    const showDialog = ref(false);

    const submitForm = () => {
        if (!form.id_user || !form.title || !form.body || !form.status || !form.image) {
            errorMessage.value = 'Vui lòng nhập đầy đủ thông tin và chọn hình ảnh!';
            showDialog.value = true;
            return; 
        }

        errorMessage.value = '';
        showDialog.value = false;

        form.post(route('post.store'));
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
                            <p class="text-4xl uppercase">Tin tức</p>
                            <br>
                            <form @submit.prevent="submitForm" method="post" enctype="multipart/form-data" class="flex-col justify-center items-center mx-auto font-lora bg-white border-2 border-emerald-700 rounded-lg shadow-lg p-6">
                                <div class="flex flex-row items-center justify-between ">
                                    <h1>Thêm tin tức</h1>
                                    <a :href="route('post.index')" class="inline-flex items-center ml-4 px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-emerald-600 hover:bg-emerald-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                                        Quay lại
                                    </a>
                                </div>
                                <hr class="my-4 border-gray-200">
                                <div class="mb-4">
                                    <label for="title" class="block text-sm font-medium text-gray-700">Tiêu đề</label>
                                    <input type="text"  id="title" name="title" v-model="form.title" class="mt-1 p-2 block w-full shadow-sm focus:ring-emerald-500 focus:border-emerald-500 border-gray-300 rounded-md">
                                </div>
                                <div class="mb-4 input-wrap">
                                    <label for="body" class="block text-sm font-medium text-gray-700">Nội dung</label>
                                    <textarea type="text" id="body" name="body" v-model="form.body" class="mt-1 p-2 block w-full shadow-sm focus:ring-emerald-500 focus:border-emerald-500 border-gray-300 rounded-md">
                                    </textarea>
                                </div>            
                                <div class="mb-4">
                                    <label for="image" class="block text-sm font-medium text-gray-700">Hình ảnh</label>
                                    <input type="file" id="image" name="image" @change="handleEvent"
                                        class="px-2 py-4 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer shadow-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 dark:text-black dark:placeholder-gray-400">
                                </div>
                                <div class="mb-4">
                                    <label for="status" class="mb-2 block text-sm font-medium text-gray-700">Trạng thái</label>
                                    <label for="status_active" class="inline-flex items-center mr-4">
                                        <input type="radio" id="status_active" name="status" value="1" v-model="form.status" class="h-4 w-4 text-emerald-500 border-gray-300 focus:ring-emerald-400">
                                        <span class="ml-2 px-8 py-2 border border-green-200 rounded-lg bg-green-200 text-green-500">Đăng</span>
                                    </label>
                                    <label for="status_inactive" class="inline-flex items-center">
                                        <input type="radio" id="status_inactive" name="status" value="0" v-model="form.status" class="h-4 w-4 text-red-500 border-gray-300 focus:ring-red-400">
                                        <span class="ml-2 px-8 py-2 border border-red-300 rounded-lg bg-red-300 text-red-500">Ẩn</span>
                                    </label>
                                </div>
                                <div class="mb-4">
                                    <label for="id_user" class="block text-sm font-medium text-gray-700">Người đăng</label>
                                    <select id="id_user" name="id_user" v-model="form.id_user" class="mt-1 p-2 block w-full shadow-sm focus:ring-emerald-500 focus:border-emerald-500 border-gray-300 rounded-md">
                                        <option disabled value="">Chọn nhân viên</option>
                                        <option :key="cate.id" :value="cate.id" v-for="cate in $page.props.users">{{ cate.name }}</option>
                                    </select>
                                </div>
                                <div class="mt-8 flex justify-center col-span-2">
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

<style scoped>
.input-wrap {
    overflow-wrap: break-word;
}
</style>