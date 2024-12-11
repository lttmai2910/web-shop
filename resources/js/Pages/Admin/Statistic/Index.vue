<script setup>
  import Sidebar from '@/Components/Admin/Sidebar.vue';
  import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
  import { ref, computed } from 'vue';
  import ChartComponent from '@/Components/Admin/Chart.vue';

  const props = defineProps({
  monthlyStatistic:Array,
  quarterlyStatistic: Array,
  years: Array,
  year: Number,
  todayOrders: Number,
});

const totalStatistic = computed(() => {
    if (!props.monthlyStatistic) return '';

    // Lấy tháng hiện tại
    const currentMonth = new Date().getMonth() + 1;

    // Tìm tổng doanh thu của tháng hiện tại trong mảng monthlyStatistic
    const currentMonthTotal = props.monthlyStatistic.find(item => item.month === currentMonth);

    // Trả về tổng doanh thu của tháng hiện tại
    return currentMonthTotal ? currentMonthTotal.total_revenue : 0;
  });
  
const formatMoney = (value) => {
    return new Intl.NumberFormat('en-US').format(value*1000) 
}
</script>

<template>
    <AuthenticatedLayout>
      <Sidebar/>
      <div class="bg-gray-200 p-4 sm:ml-64">
        <div class="flex items-center justify-center">
          <div class="w-full max-w-6xl font-lora">
            <div class="bg-white rounded-lg shadow-md p-8 mb-8">
              <h2 class="text-3xl font-bold mb-4">Thống kê</h2>
              <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="bg-gray-100 rounded-lg p-6 shadow-md">
                  <h3 class="text-xl font-semibold mb-2">Lượt mua hàng</h3>
                  <p class="text-gray-600 mb-4">Số đơn hàng được đặt hôm nay</p>
                  <div class="flex items-center">
                    <svg class="w-12 h-12 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M5.617 2.076a1 1 0 0 1 1.09.217L8 3.586l1.293-1.293a1 1 0 0 1 1.414 0L12 3.586l1.293-1.293a1 1 0 0 1 1.414 0L16 3.586l1.293-1.293A1 1 0 0 1 19 3v18a1 1 0 0 1-1.707.707L16 20.414l-1.293 1.293a1 1 0 0 1-1.414 0L12 20.414l-1.293 1.293a1 1 0 0 1-1.414 0L8 20.414l-1.293 1.293A1 1 0 0 1 5 21V3a1 1 0 0 1 .617-.924ZM9 7a1 1 0 0 0 0 2h6a1 1 0 1 0 0-2H9Zm0 4a1 1 0 1 0 0 2h6a1 1 0 1 0 0-2H9Zm0 4a1 1 0 1 0 0 2h6a1 1 0 1 0 0-2H9Z" clip-rule="evenodd"/>
                    </svg>
                    <div class="ml-4">
                        <p class="text-4xl font-bold text-rose-600 hover:text-yellow-400 transition-colors duration-300">{{ todayOrders }}</p>
                        <p class="text-gray-600">Đơn hàng</p>
                    </div>
                  </div>
                </div>
  
                <div class="bg-gray-100 rounded-lg p-6 shadow-md">
                  <h3 class="text-xl font-semibold mb-2">Doanh thu /Tháng này</h3>
                  <p class="text-gray-600 mb-4">Tổng tiền thu được trong tháng này</p>
                  <div class="flex items-center">
                    <svg class="w-12 h-12 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 17.345a4.76 4.76 0 0 0 2.558 1.618c2.274.589 4.512-.446 4.999-2.31.487-1.866-1.273-3.9-3.546-4.49-2.273-.59-4.034-2.623-3.547-4.488.486-1.865 2.724-2.899 4.998-2.31.982.236 1.87.793 2.538 1.592m-3.879 12.171V21m0-18v2.2"/>
                    </svg>
                    <div class="ml-4">
                      <p class="text-4xl font-bold text-rose-600 hover:text-yellow-400 transition-colors duration-300">{{ formatMoney(totalStatistic) }}</p>
                      <p class="text-gray-600">VNĐ</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
  
            <div class="bg-white rounded-lg shadow-md p-8">
                <h2 class="text-3xl font-bold mb-4">Biểu đồ doanh thu hàng tháng</h2>
                <ChartComponent :monthlyStatistic="monthlyStatistic" :year="year" />
            </div>
          </div>
        </div>
      </div>
    </AuthenticatedLayout>
</template>