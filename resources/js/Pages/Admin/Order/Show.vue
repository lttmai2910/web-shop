<script setup>
import Sidebar from '@/Components/Admin/Sidebar.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { defineProps } from 'vue';
import jsPDF from 'jspdf';
import html2canvas from 'html2canvas';

const props = defineProps({
  order: Object,
  orderdetails: Array,
});

const formatMoney = (value) => {
  return new Intl.NumberFormat('en-US').format(value * 1000);
};

const getTotalAmount = () => {
  let total = 0;
  props.orderdetails.forEach((item) => {
    total += item.discount_price * item.quantity;
  });
  return total;
};

const getTotalQuantity = () => {
  let totalQuantity = 0;
  props.orderdetails.forEach((item) => {
    totalQuantity += item.quantity;
  });
  return totalQuantity;
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
    pdf.save('order_details.pdf');

    // Show elements with class no-print after PDF is generated
    noPrintElements.forEach(el => el.style.display = '');
  });
};
</script>

<template>
  <AuthenticatedLayout>
    <Sidebar />
    <div class="bg-gray-200 p-4 sm:ml-64">
      <div class="flex items-center justify-center">
        <div class="flex flex-col overflow-hidden w-full">
          <main class="flex-1 overflow-x-hidden overflow-y-auto">
            <div class="w-3/4 mx-auto font-lora" id="orderDetails">
              <div class="h-auto p-8">
                <div class="flex justify-between items-center mb-6">
                  <p class="text-4xl uppercase no-print">Chi tiết đơn hàng</p>
                  <button @click="exportToPDF" class="text-emerald-600 hover:text-emerald-800 no-print">
                    <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                      <path fill-rule="evenodd" d="M8 3a2 2 0 0 0-2 2v3h12V5a2 2 0 0 0-2-2H8Zm-3 7a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h1v-4a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v4h1a2 2 0 0 0 2-2v-5a2 2 0 0 0-2-2H5Zm4 11a1 1 0 0 1-1-1v-4h8v4a1 1 0 0 1-1 1H9Z" clip-rule="evenodd"/>
                    </svg>
                  </button>
                </div>
                <div class="space-y-6 bg-white p-6 rounded-lg shadow-lg font-lora w-auto">
                  <div class="flex justify-center space-x-6">
                    <p class="font-script text-3xl font-bold mt-2 flex items-center">Dâu Store</p>
                    <div class="flex items-center ml-6">
                      <span class="font-bold">
                        <p>Đ/c: 11 Thảo Điền, Quận 1, TP.HCM</p>
                        <p>Phone: 0933695144</p>
                      </span>
                    </div>
                </div>

                  <span class="text-3xl font-bold flex justify-center">
                     HÓA ĐƠN BÁN HÀNG
                  </span>
                  
                  <hr class="mt-4 mb-2">
                  
                  <div class="mb-2 flex justify-between">
                    <p class="text-lg">Ngày: {{ props.order.date_order }}</p>
                    <p class="text-lg">Số HD: #{{ props.order.id }}</p>
                  </div>
                  
                  <div>
                    <p class="text-lg"> Khách hàng: {{ props.order.name_customer }}</p>
                  </div>
                  
                  <hr class="mt-2 mb-2">
                  
                  <div>
                    <table class="min-w-full divide-y divide-gray-200">
                      <thead class="bg-gray-100">
                        <tr>
                          <th scope="col" class="px-6 py-3 text-center text-s font-medium uppercase tracking-wider">
                            Mã sản phẩm
                          </th>
                          <th scope="col" class="px-6 py-3 text-center text-s font-medium uppercase tracking-wider">
                            Tên sản phẩm
                          </th>
                          <th scope="col" class="px-6 py-3 text-center text-s font-medium uppercase tracking-wider">
                            Kích cỡ
                          </th>
                          <th scope="col" class="px-6 py-3 text-center text-s font-medium uppercase tracking-wider">
                            Giá
                          </th>
                          <th scope="col" class="px-6 py-3 text-center text-s font-medium uppercase tracking-wider">
                            Số lượng
                          </th>
                        </tr>
                      </thead>
                      <tbody class="bg-slate-50 divide-y divide-gray-200">
                        <tr v-for="item in props.orderdetails" :key="item.id_product_item">
                          <td class="px-6 py-4 whitespace-nowrap text-s font-medium text-center">{{ item.id_product_item }}</td>
                          <td class="px-6 py-4 whitespace-nowrap text-s text-center">{{ item.product_name }}</td>
                          <td class="px-6 py-4 whitespace-nowrap text-s text-center">{{ item.size }}</td>
                          <td class="px-6 py-4 whitespace-nowrap text-s text-center">{{ formatMoney(item.discount_price) }}</td>
                          <td class="px-6 py-4 whitespace-nowrap text-s text-center">{{ item.quantity }}</td>
                        </tr>
                      </tbody>
                    </table>
                    
                    <hr class="mt-6 mb-4">
                    
                    <div class="mt-4 flex justify-between text-right text-lg">
                      <p>Tổng số lượng:</p>
                      <p>{{ getTotalQuantity() }}</p>
                    </div>
                    
                    <div class="mt-4 mb-4 flex justify-between text-right text-lg">
                      <p>Tổng tiền:</p>
                      <p>{{ formatMoney(getTotalAmount()) }}</p>
                    </div>

                    <div>
                      <span class="text-lg">
                        Phương thức thanh toán: {{ props.order.name_payment }}</span>
                    </div>
                  </div>

                  <hr class="mt-6 mb-4">

                  <div class="mt-8 flex flex-col justify-center items-center text-lg font-bold">
                    <p class="mb-1">
                      Cảm ơn quý khách hàng đã mua hàng! 
                    </p>
                    <p class="mb-2">
                      Hẹn gặp lại! 
                    </p>
                  </div>
                </div>

                <div class="mt-8 flex justify-center no-print">
                    <a :href="route('order.index')" class="inline-flex items-center px-8 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-emerald-600 hover:bg-emerald-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                      Quay lại
                    </a>
                </div>
              </div>
            </div>
          </main>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
