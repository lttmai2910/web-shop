<script setup>
    import Sidebar from '@/Components/Admin/Sidebar.vue';
    import Pagination from '@/Components/Pagination.vue';
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import {Head, Link, useForm} from '@inertiajs/vue3';
    
    const props = defineProps({
        user: Object
    });

    const form = useForm
    ({
        name: props.user.name,
        birthday: props.user.birthday,
        address: props.user.address,
        gender: props.user.gender,
        image: null,
        role: props.user.role,
        status: props.user.status,
    });
    
    const submitForm = () =>
    {
        form.post(route('user.update', props.user.id));
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
                                <p class="text-4xl uppercase">Nhân viên</p>
                                <br>
                                <form @submit.prevent="submitForm" class="mx-auto font-lora bg-white border-2  border-emerald-700 rounded-lg shadow-lg p-6">
                                    <div class="flex flex-row items-center justify-between ">
                                        <h1>Thông tin nhân viên - {{ form.name }}</h1>
                                        <a :href="route('user.index')" class="inline-flex items-center ml-4 px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-emerald-600 hover:bg-emerald-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                                            Quay lại
                                        </a>
                                    </div>
                                    <hr class="my-4 border-gray-200">
                                    <div class="mb-4">
                                        <label for="name" class="block text-sm font-medium text-gray-700">Tên nhân viên</label>
                                        <input type="text"  id="name" name="name" v-model="form.name"  placeholder="Họ và tên của bạn" class="mt-1 p-2 block w-full shadow-sm focus:ring-emerald-500 focus:border-emerald-500 border-gray-300 rounded-md">
                                    </div>
                                    <div class="mb-4">
                                        <label for="birthday" class="block text-sm font-medium text-gray-700">Năm sinh</label>
                                        <input type="text" id="birthday" name="birthday" v-model="form.birthday"  placeholder="xxxx-xx-xx" class="mt-1 p-2 block w-full shadow-sm focus:ring-emerald-500 focus:border-emerald-500 border-gray-300 rounded-md">
                                    </div>                    
                                    <div class="mb-4">
                                        <label for="address" class="block text-sm font-medium text-gray-700">Địa chỉ</label>
                                        <input type="text" id="address" name="address" v-model="form.address"  placeholder="Địa chỉ của bạn" class="mt-1 p-2 block w-full shadow-sm focus:ring-emerald-500 focus:border-emerald-500 border-gray-300 rounded-md">
                                    </div>                    
                                    <div class="mb-4">
                                        <label for="gender" class="block text-sm font-medium text-gray-700">Giới tính</label>
                                        <select id="gender" name="gender" v-model="form.gender" required class="mt-1 p-2 block w-full shadow-sm focus:ring-emerald-500 focus:border-emerald-500 border-gray-300 rounded-md">
                                            <option disabled value="">Chọn giới tính</option>
                                            <option value="1">Nam</option>
                                            <option value="0">Nữ</option>
                                        </select>
                                    </div>                                        
                                    <div class="mb-4">
                                        <label for="role" class="block text-sm font-medium text-gray-700">Chức vụ</label>
                                        <select id="role" name="role" v-model="form.role" class="mt-1 p-2 block w-full shadow-sm focus:ring-emerald-500 focus:border-emerald-500 border-gray-300 rounded-md">
                                            <option disabled value="">Chọn chức vụ</option>
                                            <option value="1">Quản lý</option>
                                            <option value="0">Nhân viên</option>
                                        </select>
                                    </div>    
                                    <div class="mb-4">
                                        <label for="status" class="block text-sm font-medium text-gray-700">Trạng thái</label>
                                        <select id="status" name="status" v-model="form.status" class="mt-1 p-2 block w-full shadow-sm focus:ring-emerald-500 focus:border-emerald-500 border-gray-300 rounded-md">
                                            <option disabled value="">Chọn trạng thái</option>
                                            <option value="1">Hoạt động</option>
                                            <option value="0">Xóa</option>
                                        </select>
                                        </div>
                                    <div class="grid grid-cols-1 justify-center items-center">
                                        <div class="mb-4">
                                            <label for="image" class="block text-sm font-medium text-gray-700">Hình ảnh</label>
                                            <input type="file" id="image" name="image" @change="handleEvent"
                                            class="px-2 py-4 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer shadow-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 dark:text-black dark:placeholder-gray-400">
                                        </div>
                                        <img :src="'/image_admin/'+ props.user.image" class="mt-2 w-64 h-64 object-cover border-2 border-emerald-700 rounded-xl shadow-lg">
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