<script setup>
import Sidebar from '@/Components/Admin/Sidebar.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { useForm } from '@inertiajs/vue3';
import jsPDF from 'jspdf';
import html2canvas from 'html2canvas';

const props = defineProps({
    order: Object
});

const form = useForm({
    id_customer: props.order.id_customer,
    name_customer: props.order.name_customer,
    phone: props.order.phone,
    email: props.order.email,
    address: props.order.address,
    note: props.order.note,
    total_amount: props.order.total_amount,
    date_order: props.order.date_order,
    time_order: props.order.time_order,
    name_payment: props.order.name_payment,
    status: props.order.status,
});

const submitForm = () => {
    form.post(route('order.update', props.order.id));
};

const exportToPDF = () => {
  const element = document.getElementById('orderDetails');

  // Hide elements with class no-print
  const noPrintElements = document.querySelectorAll('.no-print');
  noPrintElements.forEach(el => el.style.display = 'none');

  html2canvas(element).then(canvas => {
    const imgData = canvas.toDataURL('image/png');
    const pdf = new jsPDF('p', 'mm', 'a4');
    const imgProps = pdf.getImageProperties(imgData);
    const pdfWidth = pdf.internal.pageSize.getWidth();
    const pdfHeight = imgProps.height * pdfWidth / imgProps.width;

    pdf.addImage(imgData, 'PNG', 0, 0, pdfWidth, pdfHeight);
    pdf.save('orders.pdf');

    // Show elements with class no-print after PDF is generated
    noPrintElements.forEach(el => el.style.display = '');
  });
};
</script>

<template>
    <AuthenticatedLayout>
        <Sidebar />
        <div class="bg-gray-200 p-4 sm:ml-64 font-lora">
            <div class="flex items-center justify-center">
                <div class="flex flex-col w-full max-w-4xl">
                    <div class="flex justify-between items-center mb-6">
                        <p class="text-4xl uppercase no-print">Đơn hàng</p>
                        <button @click="exportToPDF" class="text-emerald-600 hover:text-emerald-800 no-print">
                            <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M8 3a2 2 0 0 0-2 2v3h12V5a2 2 0 0 0-2-2H8Zm-3 7a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h1v-4a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v4h1a2 2 0 0 0 2-2v-5a2 2 0 0 0-2-2H5Zm4 11a1 1 0 0 1-1-1v-4h8v4a1 1 0 0 1-1 1H9Z" clip-rule="evenodd"/>
                            </svg>
                        </button>
                    </div>

                    <!-- Status Section -->
                    <div class="flex flex-col items-center mb-8">
                        <h2 class="text-xl font-semibold mb-2">Trạng thái đơn hàng</h2>
                        <form @submit.prevent="submitForm" class="flex mt-2 space-x-6">
                            <label for="status_active" class="inline-flex items-center">
                                <input type="radio" id="status_active" name="status" value="1" v-model="form.status" class="h-4 w-4 text-emerald-500 border-gray-300 focus:ring-emerald-400">
                                <span class="ml-2 px-4 py-2 border border-green-200 rounded-lg bg-green-200 text-green-500">Đã xác nhận</span>
                            </label>
                            <label for="status_inactive" class="inline-flex items-center">
                                <input type="radio" id="status_inactive" name="status" value="0" v-model="form.status" class="h-4 w-4 text-red-500 border-gray-300 focus:ring-red-400">
                                <span class="ml-2 px-4 py-2 border border-red-300 rounded-lg bg-red-300 text-red-500">Chưa xác nhận</span>
                            </label>
                        </form>
                    </div>

                    <!-- Order Details Section -->
                    <div id="orderDetails" class="bg-white p-8 rounded-lg shadow-lg font-lora">
                        <div class="flex justify-between items-center mb-6">
                            <p class="text-3xl uppercase">Mã đơn hàng: #{{ props.order.id }}</p>
                        </div>
                        <hr class="my-4 border-t border-gray-300">
                        <div class="mb-6">
                            <h2 class="text-2xl font-semibold mb-2">Thông tin khách hàng</h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Tên khách hàng</label>
                                    <p class="mt-1 p-2 bg-gray-100 border border-gray-300 rounded-md">{{ props.order.name_customer }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Số điện thoại</label>
                                    <p class="mt-1 p-2 bg-gray-100 border border-gray-300 rounded-md">{{ props.order.phone }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Email</label>
                                    <p class="mt-1 p-2 bg-gray-100 border border-gray-300 rounded-md">{{ props.order.email }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Địa chỉ</label>
                                    <p class="mt-1 p-2 bg-gray-100 border border-gray-300 rounded-md">{{ props.order.address }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <hr class="my-4 border-t border-gray-300">
                        <div class="mb-6">
                            <h2 class="text-2xl font-semibold mb-2">Thông tin đơn hàng</h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Tổng tiền</label>
                                    <p class="mt-1 p-2 bg-gray-100 border border-gray-300 rounded-md">{{ props.order.total_amount }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Ngày đặt</label>
                                    <p class="mt-1 p-2 bg-gray-100 border border-gray-300 rounded-md">{{ props.order.date_order }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Giờ đặt</label>
                                    <p class="mt-1 p-2 bg-gray-100 border border-gray-300 rounded-md">{{ props.order.time_order }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Phương thức thanh toán</label>
                                    <p class="mt-1 p-2 bg-gray-100 border border-gray-300 rounded-md">{{ props.order.name_payment }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <hr class="my-4 border-t border-gray-300">
                        <div class="mb-6">
                            <h2 class="text-2xl font-semibold mb-2">Ghi chú</h2>
                            <p class="mt-1 p-2 bg-gray-100 border border-gray-300 rounded-md">{{ props.order.note }}</p>
                        </div>
                    </div>
                    
                    <!-- Submit and Return buttons -->
                    <div class="mt-8 flex justify-center">
                        <button @click="submitForm" class="inline-flex items-center px-8 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-emerald-600 hover:bg-emerald-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                            Cập nhật
                        </button>
                        <a :href="route('order.index')" class="inline-flex items-center ml-12 px-8 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-emerald-600 hover:bg-emerald-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                            Quay lại
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
