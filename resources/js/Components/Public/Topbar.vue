<script setup>
import { ref } from 'vue';
import { usePage } from '@inertiajs/vue3';
const {session} = usePage().props;

const showSearchBox = ref(false);

const toggleSearchBox = () => {
  showSearchBox.value = !showSearchBox.value;
};


</script>

<template>
    <nav class="navbar text-white font-lora" :style="{ background: 'linear-gradient(to top, white, #9a0a11)' }">
        <div class="container mx-auto flex justify-between items-center py-4 relative">
        <div class="logo mx-2 my-2 font-script text-xl">
            <a href="/" class="">Dâu Store</a>
        </div>
        <!-- Hamburger Menu Button -->
        <button @click="toggleMenu" class="block md:hidden">
            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M5 7h14M5 12h14M5 17h14" />
            </svg>
        </button>
        <!-- Navbar Links -->
        <ul :class="menuOpen ? 'block' : 'hidden' + ' md:flex justify-evenly'">
            <li class="mx-2 my-2"><a href="/" class="link">HOME</a></li>
            <li class="mx-2 my-2"><a :href="route('product')" class="link">PRODUCT</a></li>
            <li class="mx-2 my-2"><a :href="route('post')" class="link">NEWS</a></li>
            <li class="mx-2 my-2"><a :href="route('about')" class="link">ABOUT</a></li>
            <li class="bar-search mx-2 my-2 relative flex items-center">
            <button @click="toggleSearchBox" class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                </svg>
            </button>
            </li>
            <li class="mx-2 my-2">
            <a v-if="session.customer == null" :href="route('login.index')">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                </svg>
            </a>
            <a v-else :href="route('profile')" class="flex">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                </svg>
                <span class="pl-2">  {{ session.customer.name_customer }} </span>
            </a>
            </li>
            <li class="mx-2 my-2">
            <a :href="route('cart')" class="cart-icon">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                </svg>
            </a>
            </li>
        </ul>
        </div>
    </nav>
    <!-- Search Modal -->
    <div v-if="showSearchBox" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white p-4 rounded-lg shadow-lg w-full max-w-md">
      <form action="/Public/Search" method="GET" class="flex items-center">
        <input type="text" name="search"
          class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500"
          placeholder="Tìm kiếm sản phẩm..." required />
        <button type="submit" class="p-2 ml-2 bg-red-400 hover:bg-red-500 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm text-white dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-800">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
          </svg>
        </button>
        <button type="button" @click="toggleSearchBox" class="p-2 ml-2 bg-gray-200 hover:bg-gray-300 focus:ring-4 focus:outline-none focus:ring-gray-200 font-medium rounded-lg text-sm text-black">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </form>
    </div>
  </div>
</template>
