<script setup>
import Sidebar from '@/Components/Admin/Sidebar.vue';
import Pagination from '@/Components/Pagination.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const props = defineProps({
    customer: Object
});

const form = useForm({
    name_customer: props.customer.name_customer,
    password: props.customer.password,
    phone: props.customer.phone,
    email: props.customer.email,
    birthday: props.customer.birthday,
    gender: props.customer.gender,
    image: null,
    address: props.customer.address,
    status: props.customer.status,
});

const submitForm = () => {
    form.post(route('customer.update', props.customer.id));
};

const handleEvent = (e) => {
    form.image = e.target.files[0];
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
                                <p class="text-4xl uppercase">Khách hàng</p>
                                <br>
                                <form @submit.prevent="submitForm" method="post" enctype="multipart/form-data" class="flex-col justify-center items-center mx-auto font-lora bg-white border-2 border-emerald-700 rounded-lg shadow-lg p-6">
                                    <div class="flex flex-row items-center justify-between">
                                        <h1>Thông tin khách hàng - {{ form.name_customer }}</h1>
                                        <a :href="route('customer.index')" class="inline-flex items-center ml-4 px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-emerald-600 hover:bg-emerald-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                                            Quay lại
                                        </a>
                                    </div>
                                    <hr class="my-4 border-gray-200">
                                    <div class="mb-4">
                                        <label for="name_customer" class="block text-sm font-medium text-gray-700">Họ tên</label>
                                        <input type="text" id="name_customer" name="name_customer" v-model="form.name_customer" placeholder="Họ tên" required class="mt-1 p-2 block w-full shadow-sm focus:ring-emerald-500 focus:border-emerald-500 border-gray-300 rounded-md bg-gray-100 text-gray-500" disabled>
                                    </div>
                                    <div class="mb-4">
                                        <label for="phone" class="block text-sm font-medium text-gray-700">SĐT</label>
                                        <input type="tel" id="phone" name="phone" v-model="form.phone" placeholder="Số điện thoại" class="mt-1 p-2 block w-full shadow-sm focus:ring-emerald-500 focus:border-emerald-500 border-gray-300 rounded-md bg-gray-100 text-gray-500" disabled>
                                    </div>
                                    <div class="mb-4">
                                        <label for="birthday" class="block text-sm font-medium text-gray-700">Ngày sinh</label>
                                        <input type="text" id="birthday" name="birthday" v-model="form.birthday" placeholder="Ngày sinh" class="mt-1 p-2 block w-full shadow-sm focus:ring-emerald-500 focus:border-emerald-500 border-gray-300 rounded-md bg-gray-100 text-gray-500" disabled>
                                    </div>
                                    <div class="mb-4">
                                        <label for="address" class="block text-sm font-medium text-gray-700">Địa chỉ</label>
                                        <input type="text" id="address" name="address" v-model="form.address" placeholder="Địa chỉ" class="mt-1 p-2 block w-full shadow-sm focus:ring-emerald-500 focus:border-emerald-500 border-gray-300 rounded-md bg-gray-100 text-gray-500" disabled>
                                    </div>
                                    <div class="mb-4">
                                        <label for="gender" class="block text-sm font-medium text-gray-700">Giới tính</label>
                                        <select id="gender" name="gender" v-model="form.gender" class="mt-1 p-2 block w-full shadow-sm focus:ring-emerald-500 focus:border-emerald-500 border-gray-300 rounded-md bg-gray-100 text-gray-500" disabled>
                                            <option disabled value="">Chọn giới tính</option>
                                            <option value="1">Nam</option>
                                            <option value="0">Nữ</option>
                                        </select>
                                    </div>
                                    <div class="mb-4">
                                        <label for="status" class="block text-sm font-medium text-gray-700">Trạng thái</label>
                                        <select id="status" name="status" v-model="form.status" class="mt-1 p-2 block w-full shadow-sm focus:ring-emerald-500 focus:border-emerald-500 border-gray-300 rounded-md">
                                            <option disabled value="">Chọn trạng thái</option>
                                            <option value="1">Online</option>
                                            <option value="0">Offline</option>
                                        </select>
                                    </div>
                                    <div class="mb-4">
                                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                        <input type="text" id="email" name="email" v-model="form.email" placeholder="example@gmail.com" class="mt-1 p-2 block w-full shadow-sm focus:ring-emerald-500 focus:border-emerald-500 border-gray-300 rounded-md bg-gray-100 text-gray-500" disabled>
                                    </div>
                                    <div class="mb-4">
                                        <label for="password" class="block text-sm font-medium text-gray-700">Mật khẩu</label>
                                        <input type="text" id="password" name="password" v-model="form.password" placeholder="*******" class="mt-1 p-2 block w-full shadow-sm focus:ring-emerald-500 focus:border-emerald-500 border-gray-300 rounded-md bg-gray-100 text-gray-500" disabled>
                                    </div>
                                    <div class="col-span-1">
                                        <div class="mb-4">
                                            <label for="image" class="block text-sm font-medium text-gray-700">Hình ảnh</label>
                                            <input type="file" id="image" name="image" @change="handleEvent" class="px-2 py-4 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer shadow-sm focus:outline-none focus:border-2 focus:ring-emerald-500 focus:border-emerald-500 dark:text-black dark:placeholder-gray-400" disabled>
                                        </div>
                                        <img :src="'/image_customer/' + props.customer.image" class="w-64 h-64 object-cover border-2 border-emerald-700 rounded-xl shadow-lg">
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
