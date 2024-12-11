<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';

</script>
<template>
<aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
   <div class="h-full px-3 pb-4 overflow-y-auto bg-gradient-to-r from-green-600 to-emerald-900 dark:bg-gradient-to-r from-green-600 to-emerald-900">
      <div class="flex items-center ml-4">
          <div class="flex flex-row items-center justify-center h-20 mb-4">
            <ApplicationLogo class="block h-9 w-auto"/>
            <span class="self-center text-xl font-semibold ml-2 sm:text-2xl whitespace-nowrap text-white dark:text-white font-script lg:block hidden">Dâu Store</span>
          </div>
      </div>
      <a href="/" class="flex flex-col items-center px-4 py-2 text-sm text-white dark:text-gray-200 transition duration-300 ease-in-out hover:bg-opacity-25 hover:bg-gray-700 hover:text-gray-300">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
          </svg>
          <span>Trang chủ</span>
      </a>

    <ul class="space-y-2 font-medium">
        <li class="hover:bg-gradient-to-tl from-green-500 via-emerald-700 to-emerald-900 dark:hover:bg-gradient-to-tl from-green-500 via-emerald-700 to-emerald-900"> 
          <a :href="route('dashboard')" class="flex items-center px-4 py-2 text-sm text-white dark:text-gray-200">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white" class="w-6 h-6 mr-2" style="min-width: 24px; min-height: 24px;">
              <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6a7.5 7.5 0 1 0 7.5 7.5h-7.5V6Z" />
              <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5H21A7.5 7.5 0 0 0 13.5 3v7.5Z" />
            </svg>
            <span>Tổng quan</span>
          </a>
        </li>

        <li class="hover:bg-gradient-to-tl from-green-500 via-emerald-700 to-emerald-900 dark:hover:bg-gradient-to-tl from-green-500 via-emerald-700 to-emerald-900"> 
          <a :href="route('user.index')" class="flex items-center px-4 py-2 text-sm text-gray-400 text-white dark:text-gray-200">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white" class="w-6 h-6 mr-2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
            </svg>
            <span>Nhân viên</span>
          </a>
        </li>

        <li class="hover:bg-gradient-to-tl from-green-500 via-emerald-700 to-emerald-900 dark:hover:bg-gradient-to-tl from-green-500 via-emerald-700 to-emerald-900"> 
          <a :href="route('customer.index')" class="flex items-center px-4 py-2 text-sm text-gray-400 text-white dark:text-gray-200">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white" class="w-6 h-6 mr-2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
            </svg>
            <span>Khách hàng</span>
          </a>
        </li>

        <li class="hover:bg-gradient-to-tl from-green-500 via-emerald-700 to-emerald-900 dark:hover:bg-gradient-to-tl from-green-500 via-emerald-700 to-emerald-900"> 
          <a :href="route('productcategory.index')" class="flex items-center px-4 py-2 text-sm text-white dark:text-gray-200">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white" class="w-6 h-6 mr-2" style="min-width: 24px; min-height: 24px;">
              <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
            </svg>
            <span>Danh mục sản phẩm</span>
          </a>
        </li>

        <li class="group hover:bg-gradient-to-tl from-green-500 via-emerald-700 to-emerald-900 dark:hover:bg-gradient-to-tl from-green-500 via-emerald-700 to-emerald-900 relative">
          <a :href="route('product.index')" id="dropdownDefaultButton" data-dropdown-toggle="dropdown" class="flex items-center px-4 py-2 text-sm text-white dark:text-gray-200">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white" class="w-6 h-6 mr-2">
              <path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
            </svg>
            <span>Sản phẩm</span>
          </a>
          <div class="dropdown-content hidden group-hover:block absolute left-0 bg-gradient-to-tl from-green-500 via-emerald-700 to-emerald-900 dark:bg-gradient-to-tl from-green-500 via-emerald-700 to-emerald-900">
            <a :href="route('productcolor.index')" class="px-4 py-2 text-sm text-white dark:text-gray-200">Bảng màu</a>
            <a :href="route('size.index')" class="px-4 py-2 text-sm text-white dark:text-gray-200">Bảng size</a>
            <a :href="route('productgallery.index')" class="px-4 py-2 text-sm text-white dark:text-gray-200">Bảng hình ảnh</a>
          </div>
        </li>

        <li class="hover:bg-gradient-to-tl from-green-500 via-emerald-700 to-emerald-900 dark:hover:bg-gradient-to-tl from-green-500 via-emerald-700 to-emerald-900"> 
          <a :href="route('post.index')" class="flex items-center px-4 py-2 text-sm text-white dark:text-gray-200">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white" class="w-6 h-6 mr-2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 0 1-2.25 2.25M16.5 7.5V18a2.25 2.25 0 0 0 2.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 0 0 2.25 2.25h13.5M6 7.5h3v3H6v-3Z" />
            </svg>
            <span>Tin tức</span>
          </a>
        </li>

        <li class="hover:bg-gradient-to-tl from-green-500 via-emerald-700 to-emerald-900 dark:hover:bg-gradient-to-tl from-green-500 via-emerald-700 to-emerald-900"> 
          <a :href="route('order.index')"  class="flex items-center px-4 py-2 text-sm text-white dark:text-gray-200">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white" class="w-6 h-6 mr-2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h3.75M12 15h3.75M12 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6 7.5h3v3H6v-3Z" />
            </svg>
            <span>Đơn hàng</span>
          </a>
        </li>

        <li class="hover:bg-gradient-to-tl from-green-500 via-emerald-700 to-emerald-900 dark:hover:bg-gradient-to-tl from-green-500 via-emerald-700 to-emerald-900"> 
          <a :href="route('statistic.index')" class="flex items-center px-4 py-2 text-sm text-white dark:text-gray-200">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white" class="w-6 h-6 mr-2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 14.25v2.25m3-4.5v4.5m3-6.75v6.75m3-9v9M6 20.25h12A2.25 2.25 0 0 0 20.25 18V6A2.25 2.25 0 0 0 18 3.75H6A2.25 2.25 0 0 0 3.75 6v12A2.25 2.25 0 0 0 6 20.25Z" />
            </svg>
            <span>Thống kê</span>
          </a>
        </li>

        <!-- <li class="hover:bg-gradient-to-tl from-green-500 via-emerald-700 to-emerald-900 dark:hover:bg-gradient-to-tl from-green-500 via-emerald-700 to-emerald-900"> 
          <a :href="route('logout')" method="post" as="button" class="flex items-center px-4 py-2 text-sm text-white dark:text-gray-200">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white" class="w-6 h-6 mr-2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
            </svg>
            <span>Đăng xuất</span>
          </a>
        </li> -->
      </ul>
   </div>
</aside>
</template>
<script>

</script>
<style scoped>
li {
  transition: transform 0.1s, box-shadow 0.1s, background-color 0.1s;
}

li:hover {
  transform: scale(1.05); /* Co giãn kích thước */
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Đổ bóng */
}

 .dropdown-content {
  display: none;
  position: absolute;
  background-color: rgb(55 65 81);
  width: 100%;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color: white;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown-content a:hover {background: linear-gradient(to left, rgb(6 78 59), rgb(4 120 87), rgb(34 197 94));
} 


</style>

